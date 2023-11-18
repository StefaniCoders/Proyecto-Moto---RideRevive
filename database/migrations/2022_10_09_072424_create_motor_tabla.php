<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Motor', function (Blueprint $table) {
            $table->id('IdMotor');
            $table->string('modelo', '250');
            $table->decimal('potencia', '10','2');
            $table->decimal('cilindrada', '10','2');
            $table->string('estado', '20');
            $table->string('observaciones');
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
        Schema::dropIfExists('Motor');
    }
}
