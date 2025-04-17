<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')->constrained()->onDelete('cascade');
            $table->string('payment_method')->default('stripe'); // stripe, paypal, etc.
            $table->decimal('amount', 8, 2);
            $table->string('status')->default('pending'); // pending, paid, failed
            $table->string('transaction_id')->nullable(); // kaykoun id dyal stripe wla paypal
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
