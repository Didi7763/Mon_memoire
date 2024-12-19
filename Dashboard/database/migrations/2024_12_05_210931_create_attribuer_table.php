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
            $table->string('CodeUser');
            $table->unsignedBigInteger('NumAdmin');
            $table->date('DatAttAct');
            $table->timestamps();
        
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');
            $table->foreign('CodeUser')->references('CodeUser')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('NumAdmin')->references('NumAdmin')->on('admins')->onDelete('cascade');
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
