<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facturas_id')->unsigned();
            $table->integer('productos_id')->unsigned();
            $table->integer('cantidad');
            $table->float('precio');
            $table->float('subtotal');
            $table->foreign('facturas_id')->references('id')->on('facturas')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('productos_id')->references('id')->on('productos')
            ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('detalle_ventas');
    }
}
