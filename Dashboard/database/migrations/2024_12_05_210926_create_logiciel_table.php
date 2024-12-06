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
        Schema::create('logiciel', function (Blueprint $table) {
            $table->id();
            $table->string('VersionLog');
            $table->string('TypLicog');
            $table->string('NbrLicLog');
            $table->string('NbrMinLicLog');
            $table->string('CleLog');
            $table->string('DatAchLog');
            $table->string('DatExpLog');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logiciel');
    }
};
