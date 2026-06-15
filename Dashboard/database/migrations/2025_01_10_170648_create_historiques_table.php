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
        Schema::create('historiques', function (Blueprint $table) {
            $table->id('NumHist');
            $table->dateTime('DatAction');
            $table->text('DesAction');
            $table->string('IdAct');  // Créer la colonne 'IdAct' de type string
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');  // Définir la clé étrangère
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};
