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
        Schema::create('historiques', function (Blueprint $table) {
            $table->id('NumHist');
            $table->date('DatAction');
            $table->text('DesAction');
            $table->unsignedBigInteger('IdAct');
            $table->timestamps();
        
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique');
    }
};
