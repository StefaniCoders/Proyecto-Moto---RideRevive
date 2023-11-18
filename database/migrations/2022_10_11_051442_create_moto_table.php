<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Moto', function (Blueprint $table) {
            $table->id('IdMoto');
            $table->string('marca');
            $table->string('modelo');
            $table->string('color');
            $table->string('estado');
            // $table->decimal('kilometraje', '8', '2');
            // $table->string('VIN');
            // $table->year('anio');
            // $table->string('combustible');
            // $table->decimal('PesoBruto', '8', '2');
            // $table->decimal('PesoNeto', '8', '2');
            // $table->decimal('altura', '8', '2');
            // $table->decimal('ancho', '8', '2');
            // $table->text('observaciones');
            $table->timestamps();
            $table->bigInteger('IdMotor')->unsigned();
            $table->foreign('IdMotor')->references('IdMotor')->on('Motor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Moto');
    }
}
