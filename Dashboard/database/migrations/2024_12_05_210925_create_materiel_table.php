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
        Schema::create('materiel', function (Blueprint $table) {
            $table->id();
            $table->string('MarqMat');
            $table->string('ModlMat');
            $table->string('NumSerieMat');
            $table->string('DataAcqMat');
            $table->string('StatMat');
            $table->string('QteMat');
            $table->string('DureVieMat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiel');
    }
};
