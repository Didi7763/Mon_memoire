<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActifsTable extends Migration
{
    public function up()
    {
        Schema::create('actifs', function (Blueprint $table) {
            $table->string('IdAct')->primary();
            $table->string('NomAct');
            $table->text('ComtAct')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actifs');
    }
}
