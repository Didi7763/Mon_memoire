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
        Schema::create('admin', function (Blueprint $table) {
            $table->string('NumAdmin')->primary();
            $table->string('NomCompAdmin');
            $table->string('NomComptUser');
            $table->string('MotPassUser');
            $table->string('StatAdmin');
            $table->string('ListAccApp');
            $table->date('DatCreationCompt');
            $table->string('ListPermApp');
            $table->string('UrlPhotoAdmin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
