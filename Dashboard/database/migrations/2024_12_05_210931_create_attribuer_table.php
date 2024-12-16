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
        Schema::create('attribuer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IdAct');
            $table->string('CodeUser1');
            $table->string('NumAdmin');
            $table->date('DatAttAct');
            $table->foreign('IdAct')->references('IdAct')->on('actif');
            $table->foreign('CodeUser1')->references('CodeUser1')->on('employe');
            $table->foreign('NumAdmin')->references('NumAdmin')->on('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribuer');
    }
};
