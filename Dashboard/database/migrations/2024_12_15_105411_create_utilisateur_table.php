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
    Schema::create('utilisateur', function (Blueprint $table) {
    $table->string('CodeUser')->primary();
    $table->string('NomCompUser');
    $table->string('ContactUser');
    $table->string('EmailUser')->unique();
    $table->timestamps();
});
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};
