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
            $table->unsignedBigInteger('IdAct');
            $table->string('FormatData');
            $table->string('SourceData');
            $table->string('ResponsabeData');
            $table->string('NivSensData');
            $table->string('StatData');
            $table->date('DatRecpData');
            $table->date('DatMajData');
            $table->timestamps();
        
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donnee');
    }
};
