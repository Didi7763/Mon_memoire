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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id('NumMaint');
            $table->string('DesMaint');
            $table->string('TypMaint');
            $table->date('DatMaint');
            $table->string('NomTechMaint');
            $table->decimal('CoutMaint');
            $table->date('DatProchMaint');
            $table->string('ComtMaint');
            $table->unsignedBigInteger('IdAct');
            $table->foreign('IdAct')->references('IdAct')->on('actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
