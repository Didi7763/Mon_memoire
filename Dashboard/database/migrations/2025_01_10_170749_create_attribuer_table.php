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
            $table->id(); // La clé primaire auto-incrémentée de la table 'attribuer'
            $table->string('IdAct');  // Relation avec "actifs" (IdAct est une chaîne)
            $table->string('CodeUser');  // Relation avec "utilisateurs"
            $table->unsignedBigInteger('NumAdmin');  // Relation avec "admins" (NumAdmin est une clé primaire auto-incrémentée)
            $table->date('DatAttAct'); // Date d'attribution de l'actif

            // Définir les clés étrangères
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');
            $table->foreign('CodeUser')->references('CodeUser')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('NumAdmin')->references('NumAdmin')->on('admins')->onDelete('cascade');

            $table->timestamps();  // Colonnes created_at et updated_at
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
