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
            // Supprimer la contrainte de clé étrangère pour NumAdmin
            $table->dropForeign('attribuer_numadmin_foreign');

            // Supprimer la colonne NumAdmin
            $table->dropColumn('NumAdmin');

            // Ajouter la colonne id (si elle n'existe pas déjà)
            if (!Schema::hasColumn('attribuer', 'id')) {
                $table->unsignedBigInteger('id');
            }

            // Définir id comme clé étrangère vers users
            $table->foreign('id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('attribuer', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère pour id
            $table->dropForeign(['id']);

            // Supprimer la colonne id
            $table->dropColumn('id');

            // Revenir à NumAdmin
            $table->unsignedBigInteger('NumAdmin');
            $table->foreign('NumAdmin')->references('id')->on('users');
        });
    }
};
