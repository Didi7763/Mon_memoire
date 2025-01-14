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
        Schema::create('materiels', function (Blueprint $table) {
             // Utilisez une chaîne comme 'IdAct' et définissez-le comme clé primaire dans 'materiels'
             $table->id();
             $table->string('IdAct'); // 'IdAct' comme clé primaire de type chaîne
             $table->string('MarqMat');
             $table->string('ModMarq')->nullable();
             $table->string('NumSerieMat')->nullable();
             $table->date('DatAcqMat')->nullable();
             $table->string('StatMat')->nullable();
             $table->integer('QteMat')->nullable();
             $table->integer('DureVieMat')->nullable();
             $table->string('RefCatMat');
             $table->string('IdFour');
             // Ajouter la contrainte de clé étrangère pour 'IdAct' vers 'actifs'
             $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');

             // Clés étrangères pour 'IdFour' et 'RefCatMat'
             $table->foreign('IdFour')->references('IdFour')->on('fournisseurs')->onDelete('cascade');
             $table->foreign('RefCatMat')->references('RefCatMat')->on('categorie_materiels')->onDelete('cascade');


             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiels');
    }
};
