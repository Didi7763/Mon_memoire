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
        Schema::create('logiciels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IdAct');
            $table->string('VersionLog');
            $table->string('TypLicLog');
            $table->integer('NbrLicLog');
            $table->integer('NbrMinLicLog');
            $table->string('CleLicLog');
            $table->date('DatAchLog');
            $table->date('DatExpLog');
            $table->unsignedBigInteger('IdFour');
            $table->timestamps();
        
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');
            $table->foreign('IdFour')->references('IdFour')->on('fournisseurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logiciel');
    }
};
