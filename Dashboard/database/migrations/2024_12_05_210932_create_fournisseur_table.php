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
        Schema::create('fournisseur', function (Blueprint $table) {
            $table->id();
            $table->string('IdFour');
            $table->string('NomFour');
            $table->string('ContFour');
            $table->string('EmailFour');
            $table->string('AdressFour');
            $table->string('TypProdFounit');
            $table->string('NomPersCont');
            $table->string('NotesFour');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseur');
    }
};
