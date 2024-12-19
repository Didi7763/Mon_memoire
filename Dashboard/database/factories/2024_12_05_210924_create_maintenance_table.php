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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id('NumMaint');
            $table->text('DesMaint');
            $table->string('TypMaint');
            $table->date('DatMaint');
            $table->string('NomTechMaint');
            $table->decimal('CoutMaint', 10, 2);
            $table->date('DatProchMaint');
            $table->text('ComtMaint');
            $table->unsignedBigInteger('IdAct');
            $table->timestamps();
        
            $table->foreign('IdAct')->references('IdAct')->on('actifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
