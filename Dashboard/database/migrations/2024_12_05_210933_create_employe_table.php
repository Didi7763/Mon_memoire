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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('CodeUser1');
            $table->string('FonctEmp');
            $table->string('StatEmp');
            $table->text('ListActif');
            $table->string('CodeUser');
            $table->timestamps();
        
            $table->foreign('CodeUser')->references('CodeUser')->on('utilisateurs')->onDelete('cascade');
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
