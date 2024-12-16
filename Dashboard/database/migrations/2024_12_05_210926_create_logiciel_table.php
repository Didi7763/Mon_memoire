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
        Schema::create('logiciel', function (Blueprint $table) {
            $table->id('IdAct');
            $table->string('VersionLog');
            $table->string('TypLicLog');
            $table->integer('NbrLicLog');
            $table->integer('NbrMinLicLog');
            $table->string('CleLicLog');
            $table->date('DatAchLog');
            $table->date('DatExpLog');
            $table->unsignedBigInteger('IdFour');
            $table->foreign('IdFour')->references('IdFour')->on('fournisseur');
            $table->timestamps();
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
