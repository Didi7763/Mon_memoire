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
        Schema::create('donnees', function (Blueprint $table) {
            $table->id();
            $table->string('IdAct');
            $table->string('FormatData');
            $table->string('SourceData')->nullable();
            $table->string('ResponsabeData');
            $table->string('NivSensData');
            $table->string('StatData');
            $table->date('DatRecpData')->nullable();
            $table->date('DatMajData')->nullable();
             // Ajouter la contrainte de clé étrangère pour 'IdAct' vers 'actifs'
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donnees');
    }
};
