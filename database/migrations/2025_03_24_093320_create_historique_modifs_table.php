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
        Schema::create('historique_modifs', function (Blueprint $table) {
            $table->id();
            $table->string('ancienNomCavalier');
            $table->string('ancienNomCheval');
            $table->string('nouveauNomCavalier');
            $table->string('nouveauNomCheval');
            $table->unsignedBigInteger('couple_id'); 
            $table->foreign('couple_id')->references('id')->on('couples');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_modifs');
    }
};
