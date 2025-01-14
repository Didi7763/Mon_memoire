<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categorie_materiels', function (Blueprint $table) {
            $table->string('RefCatMat')->primary();
            $table->string('NomCatMat');
            $table->integer('QteStockMat')->default(0);
            $table->integer('QteMinStockMat')->default(0);
            $table->text('NoteCatMat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorie_materiels');
    }
};
