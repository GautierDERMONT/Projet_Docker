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
        Schema::create('couples', function (Blueprint $table) {
            $table->id();
            $table->string('cavalier');
            $table->string('cheval');
            $table->string('coach');
            $table->string('ecurie');
            $table->time('temps')->nullable(); // sous forme de HH:MM:SS
            $table->integer('penalite')->nullable(); 
            $table->integer('ordrePassage'); 
            $table->time('temps_total')->nullable(); // sous forme de HH:MM:SS
            $table->string('classement')->nullable();
            $table->unsignedBigInteger('epreuve_id'); 
            $table->foreign('epreuve_id')->references('id')->on('epreuves')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couples');
    }
};
