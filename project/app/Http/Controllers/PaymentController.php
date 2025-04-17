<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Panier;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Checkout\Session;
class PaymentController extends Controller
{


public function checkout()
{
    $etudiant = Auth::user()->etudiant;
    $paniers = $etudiant->panier;

    if ($paniers->isEmpty()) {
        return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    Stripe::setApiKey(env('STRIPE_SECRET'));

    $lineItems = [];

    foreach ($paniers as $cours) {
        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $cours->titre,
                ],
                'unit_amount' => intval($cours->price * 100),
            ],
            'quantity' => 1,
        ];
    }

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [$lineItems],
        'mode' => 'payment',
        'success_url' => route('payment.success'),
        'cancel_url' => route('payment.cancel'),
    ]);

    return redirect($session->url);
}


public function success()
{
    $etudiant = Auth::user()->etudiant;
    $paniers = $etudiant->panier; 

    foreach ($paniers as $panier) {
                 // Vérifier si l'inscription existe déjà
        $existing = Inscription::where('etudiant_id', $etudiant->id)
                    ->where('cours_id', $panier->pivot->cours_id)
                    ->first();

        if (!$existing) {
            $inscription = Inscription::create([
                'etudiant_id' => $etudiant->id,
                'cours_id' => $panier->pivot->cours_id,
                'status' => 'accepted'
            ]);
            Payment::create([
                'inscription_id' => $inscription->id,
                'payment_method' => 'stripe',
                'status' => 'payé',
                'transaction_id' => Str::uuid()
            ]);
        }
    }
    $etudiant->panier()->detach();
    return redirect()->route('student.panier.afficher')->with('success', 'Paiement Stripe effectué avec succès !');
}


public function cancel()
{
    return redirect()->route('etudiant.mes-cours')->with('error', 'Paiement annulé.');
}



}
