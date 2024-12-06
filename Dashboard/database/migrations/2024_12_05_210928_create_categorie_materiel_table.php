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
        Schema::create('categorie_materiel', function (Blueprint $table) {
            $table->id();
            $table->string('RefCatMat');
            $table->string('NonCatMat');
            $table->string('QteStockMat');
            $table->string('QteMinStockMat');
            $table->string('NoteCatMat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_materiel');
    }
};
