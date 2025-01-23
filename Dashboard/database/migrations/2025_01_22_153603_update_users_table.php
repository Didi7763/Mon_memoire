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
        Schema::table('users', function (Blueprint $table) {

            // Ajouter les nouveaux champs
            $table->string('NomCompUser')->nullable();
            $table->string('StatAdmin')->nullable(); // Statut de l'administrateur
            $table->json('ListAccApp')->nullable(); // Liste des accès aux applications
            $table->json('ListPermApp')->nullable(); // Liste des permissions des applications
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Supprimer les nouveaux champs
            $table->dropColumn('NomCompUser');
            $table->dropColumn('StatAdmin');
            $table->dropColumn('ListAccApp');
            $table->dropColumn('ListPermApp');
        });
    }
};
