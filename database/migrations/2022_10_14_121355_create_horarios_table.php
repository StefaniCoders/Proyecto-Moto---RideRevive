<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Horario', function (Blueprint $table) {
            $table->id('IdHorario');
            $table->date('fec_atencion');
            $table->string('estado', '20');
            $table->string('color_categoria', '20');
            $table->bigInteger('IdEmpleado')->unsigned();
            $table->bigInteger('IdCategoria')->unsigned();
            $table->foreign('IdEmpleado')->references('IdEmpleado')->on('Empleado');
            $table->foreign('IdCategoria')->references('IdCategoria')->on('Categoria');
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
        Schema::dropIfExists('Horario');
    }
}
