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
            $table->id();
            $table->unsignedBigInteger('IdAct');
            $table->string('MarqMat');
            $table->string('ModMarq');
            $table->string('NumSerieMat');
            $table->date('DatAcqMat');
            $table->string('StatMat');
            $table->integer('QteMat');
            $table->integer('DureVieMat');
            $table->unsignedBigInteger('IdFour');
            $table->unsignedBigInteger('RefCatMat');
            $table->timestamps();
        
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');
            $table->foreign('IdFour')->references('IdFour')->on('fournisseurs')->onDelete('cascade');
            $table->foreign('RefCatMat')->references('RefCatMat')->on('categorie_materiels')->onDelete('cascade');
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
