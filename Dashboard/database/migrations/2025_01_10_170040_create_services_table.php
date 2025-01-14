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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('CodeUser');
            $table->string('DesServ');
            $table->string('NpnomRespServ');

            // Ajouter la contrainte de clé étrangère pour 'CodeUser' vers 'utilisateurs'
            $table->foreign('CodeUser')->references('CodeUser')->on('utilisateurs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
