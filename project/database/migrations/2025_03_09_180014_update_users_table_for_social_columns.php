<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           
            $table->dropColumn('google_id');
            
          
            $table->string('social_id')->nullable()->after('email'); 
            $table->string('social_type')->nullable()->after('social_id'); 
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('google_id')->nullable()->after('password');
            $table->dropColumn('social_id');
            $table->dropColumn('social_type');
        });
    }
};
