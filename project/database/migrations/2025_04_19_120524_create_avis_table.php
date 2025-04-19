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
       // database/migrations/xxxx_xx_xx_create_avis_table.php

        Schema::create('avis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('etudiant_id')->constrained()->onDelete('cascade');
        $table->foreignId('cours_id')->constrained()->onDelete('cascade');
        $table->tinyInteger('note'); 
        $table->text('commentaire')->nullable(); 
        $table->timestamps();

      
        $table->unique(['etudiant_id', 'cours_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
