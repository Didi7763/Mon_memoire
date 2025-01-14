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
            $table->string('ListActif');  // Vous pouvez ajuster selon vos besoins
            $table->string('CodeUser');

            $table->foreign('CodeUser1')->references('CodeUser')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('CodeUser')->references('CodeUser')->on('services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
