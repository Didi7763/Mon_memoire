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
        Schema::create('admins', function (Blueprint $table) {
            $table->id('NumAdmin');
            $table->string('NomCompAdmin');
            $table->string('NomComptUser');
            $table->string('MotPassUser');
            $table->string('StatAdmin');
            $table->text('ListAccApp');
            $table->date('DatCreationCompt');
            $table->text('ListPermApp');
            $table->string('UrlPhotoAdmin')->nullable();
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
