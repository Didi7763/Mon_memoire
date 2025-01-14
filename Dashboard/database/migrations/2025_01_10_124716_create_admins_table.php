<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('NumAdmin');
            $table->string('NomCompAdmin');
            $table->string('NomComptUser')->unique();
            $table->string('MotPassUser');
            $table->string('StatAdmin');
            $table->text('ListAccApp')->nullable();
            $table->date('DatCreationCompt')->nullable();
            $table->text('ListPermApp')->nullable();
            $table->string('UrlPhotoAdmin')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
