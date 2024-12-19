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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id('IdFour');
            $table->string('NomFour');
            $table->string('ContFour');
            $table->string('EmailFour');
            $table->text('AdressFour');
            $table->string('TypProdFournit');
            $table->string('NomPersCont');
            $table->text('NotesFour')->nullable();
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
