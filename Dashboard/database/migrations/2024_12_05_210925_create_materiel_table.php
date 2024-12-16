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
        Schema::create('materiel', function (Blueprint $table) {
            $table->id('IdAct');
            $table->string('MarqMat');
            $table->string('ModMarq');
            $table->string('NumSerieMat');
            $table->date('DatAcqMat');
            $table->string('StatMat');
            $table->integer('QteMat');
            $table->integer('DureVieMat');
            $table->unsignedBigInteger('IdFour');
            $table->unsignedBigInteger('RefCatMat');
            $table->foreign('IdFour')->references('IdFour')->on('fournisseur');
            $table->foreign('RefCatMat')->references('RefCatMat')->on('categorie_materiel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiel');
    }
};
