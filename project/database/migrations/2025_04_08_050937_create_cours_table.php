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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('set null');
            $table->decimal('price', 8, 2)->default(0); 
            $table->string('image')->nullable();
            $table->string('video_intro')->nullable();
            $table->enum('status', ['draft', 'pending', 'published'])->default('draft');
            $table->foreignId('formateur_id')->constrained('formateurs')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
