<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuario', function (Blueprint $table) {
            $table->id('IdUsuario');
            $table->string('nom_usuario');
            $table->string('clave');
            $table->string('estado', '20');
            $table->bigInteger('IdEmpleado')->unsigned();
            $table->foreign('IdEmpleado')->references('IdEmpleado')->on('Empleado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Usuario');
    }
}
