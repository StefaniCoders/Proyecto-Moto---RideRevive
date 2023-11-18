<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetalleCita', function (Blueprint $table) {
            $table->id('IdDetalleCita');
            $table->bigInteger('IdCita')->unsigned();
            $table->bigInteger('IdMoto')->unsigned();
            $table->bigInteger('IdMotor')->unsigned();
            $table->text('detalle_moto');
            $table->text('detalle_motor');
            $table->foreign('IdCita')->references('IdCita')->on('Cita');
            $table->foreign('IdMoto')->references('IdMoto')->on('Moto');
            $table->foreign('IdMotor')->references('IdMotor')->on('Motor');

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
        Schema::dropIfExists('DetalleCita');
    }
}
