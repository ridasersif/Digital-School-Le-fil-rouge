<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Panier;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        // Récupérer l'étudiant connecté et ses cours dans le panier
        $etudiant = Auth::user()->etudiant;
        $panierCours = $etudiant->panier;
        
        // Passer ces données directement à la vue
        return view('student.courses.payment', compact('panierCours'));
    }
    
    // Cette méthode peut être conservée pour la compatibilité avec d'autres fonctionnalités
    public function getCourses()
    {
        $etudiant = Auth::user()->etudiant;
        $paniers = $etudiant->panier;
        
        $courses = [];
        foreach ($paniers as $cours) {
            $courses[] = [
                'id' => $cours->id,
                'titre' => $cours->titre,
                'image' => asset('storage/' . $cours->image),
                'formateur' => $cours->formateur->user->name,
                'duree' => $cours->duree,
                'niveau' => $cours->niveau,
                'price' => floatval($cours->price),
                'old_price' => $cours->old_price ? floatval($cours->old_price) : null,
            ];
        }
        
        // Calculer le résumé des prix
        $totalOld = $paniers->sum(function ($cours) {
            return $cours->old_price ? $cours->old_price : $cours->price;
        });
        $total = $paniers->sum('price');
        $saving = $totalOld - $total;
        $savingPercent = $totalOld > 0 ? round(($saving / $totalOld) * 100) : 0;
        
        $summary = [
            'original_price' => $totalOld,
            'reduced_price' => $total,
            'saving' => $saving,
            'saving_percent' => $savingPercent,
            'total' => $total
        ];
        
        return response()->json([
            'courses' => $courses,
            'summary' => $summary
        ]);
    }

    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $etudiant = Auth::user()->etudiant;
        $paniers = $etudiant->panier;
        
        $amount = $paniers->sum(function ($cours) {
            return intval($cours->price * 100);
        });
        
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'mad', // Dirham marocain
            'metadata' => [
                'etudiant_id' => $etudiant->id,
            ],
        ]);
        
        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
            'paymentIntentId' => $paymentIntent->id
        ]);
    }

    public function success()
    {
        $etudiant = Auth::user()->etudiant;
        $paniers = $etudiant->panier;
        
        foreach ($paniers as $panier) {
            $existing = Inscription::where('etudiant_id', $etudiant->id)
                ->where('cours_id', $panier->id)
                ->first();
            
            if (!$existing) {
                $inscription = Inscription::create([
                    'etudiant_id' => $etudiant->id,
                    'cours_id' => $panier->id,
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
        
        return redirect()->route('student.myCourses')->with('success', 'Paiement réussi ! Vous avez maintenant accès à vos cours.');
    }

    public function cancel()
    {
        return redirect()->route('student.panier')->with('error', 'Le paiement a été annulé.');
    }
}