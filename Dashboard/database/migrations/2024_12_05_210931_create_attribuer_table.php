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
        Schema::create('attribuer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Actif_id');
            $table->unsignedBigInteger('Attribuer_id');
            $table->timestamps();

            // Ajoutez vos clés étrangères, si nécessaire
            $table->foreign('Actif_id')->references('id')->on('actif')->onDelete('cascade');
            $table->foreign('Attribuer_id')->references('id')->on('attributions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribuer');
    }
};
