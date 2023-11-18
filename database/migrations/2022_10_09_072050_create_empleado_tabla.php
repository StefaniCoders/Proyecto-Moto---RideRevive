<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Empleado', function (Blueprint $table) {
            $table->id('IdEmpleado');
            $table->string('Nombres', '150');
            $table->string('Apellidos', '150');
            $table->string('DNI', '9');
            $table->string('correo', '150');
            $table->string('telefono', '20');
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
        Schema::dropIfExists('Empleado');
    }
}
