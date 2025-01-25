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
        Schema::table('attribuer', function (Blueprint $table) {
            // Ajouter la colonne NumAdmin
            $table->unsignedBigInteger('NumAdmin');

            // Définir NumAdmin comme clé étrangère vers la table users
            $table->foreign('NumAdmin')
                  ->references('id') // Colonne référencée dans la table users
                  ->on('users')
                  ->onDelete('cascade'); // Optionnel : supprimer les enregistrements liés si l'utilisateur est supprimé
        });
    }

    /**
     * Annule la migration.
     */
    public function down()
    {
        Schema::table('attribuer', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère
            $table->dropForeign(['NumAdmin']);

            // Supprimer la colonne NumAdmin
            $table->dropColumn('NumAdmin');
        });
    }
};
