<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('edad');
            $table->string('telefono');
            $table->string('direccion');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
