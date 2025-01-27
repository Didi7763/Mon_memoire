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
        Schema::create('global_notifications', function (Blueprint $table) {
            $table->id();
            $table->text('message'); // Le message de la notification
            $table->string('url')->nullable(); // L'URL associée (optionnelle)
            $table->json('read_by')->nullable(); // Liste des ID des utilisateurs qui ont lu la notification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_notifications');
    }
};
