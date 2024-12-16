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
        Schema::create('donnee', function (Blueprint $table) {
            $table->id('IdAct');
            $table->string('FormatData');
            $table->string('SourceData');
            $table->string('ResponsabeData');
            $table->string('NivSensData');
            $table->string('StatData');
            $table->date('DatRecpData');
            $table->date('DatMajData');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donnee');
    }
};
