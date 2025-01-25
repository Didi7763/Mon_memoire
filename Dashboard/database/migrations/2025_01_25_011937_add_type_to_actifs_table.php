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
        // Ajouter la colonne `type` à la table `actifs`
        Schema::table('actifs', function (Blueprint $table) {
            $table->enum('type', ['matériel', 'logiciel', 'donnée'])
                  ->default('matériel') // Valeur par défaut (optionnel)
                  ->after('NomAct'); // Position de la colonne (optionnel)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Supprimer la colonne `type` si la migration est annulée
        Schema::table('actifs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
