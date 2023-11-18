<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cliente', function (Blueprint $table) {
            $table->id('IdCliente');
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
        Schema::dropIfExists('Cliente');
    }
}
