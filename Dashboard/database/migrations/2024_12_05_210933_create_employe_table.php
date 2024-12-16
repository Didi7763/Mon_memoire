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
        Schema::create('employe', function (Blueprint $table) {
            $table->string('CodeUser')->primary();
            $table->string('FonctEmp');
            $table->string('StatEmp');
            $table->string('ListActif');
            $table->string('CodeUser')->nullable();
            $table->foreign('CodeUser')->references('CodeUser')->on('utilisateur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe');
    }
};
