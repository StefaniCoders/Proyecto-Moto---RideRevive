<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cita', function (Blueprint $table) {
            $table->id('IdCita');
            $table->date('fec_registro');
            $table->dateTime('fec_atencion');
            $table->string('estado', '20');
            $table->bigInteger('IdHorario')->unsigned();
            $table->bigInteger('IdCliente')->unsigned();
            $table->bigInteger('IdUsuario')->unsigned();
            $table->foreign('IdHorario')->references('IdHorario')->on('Horario');
            $table->foreign('IdCliente')->references('IdCliente')->on('Cliente');
            $table->foreign('IdUsuario')->references('IdUsuario')->on('Usuario');

            $table->timestamps();
            // $table->bigInteger('IdMotocicleta')->unsigned();
            // $table->bigInteger('IdEmpleado')->unsigned();
            // $table->bigInteger('IdTipoCita')->unsigned();
            // $table->foreign('IdMotocicleta')->references('IdMotocicleta')->on('Motocicleta');
            // $table->foreign('IdEmpleado')->references('IdEmpleado')->on('Empleado');
            // $table->foreign('IdTipoCita')->references('IdTipoCita')->on('TipoCita');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cita');
    }
}
