<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Inscription;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $inscriptions = Inscription::all();

        foreach ($inscriptions as $inscription) {

            Payment::create([
                'inscription_id' => $inscription->id,
                'payment_method' => 'stripe',
                'status' => 'payé',
                'transaction_id' => 'TX' . rand(100000, 999999), 
                'amount' => rand(100, 1000), 
            ]);
        }
    }
}
