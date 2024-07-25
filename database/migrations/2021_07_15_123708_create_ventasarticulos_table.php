<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasarticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_articulos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('articulo_id')->unsigned();
            $table->foreign('articulo_id')->references('id')->on('articulos');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->bigInteger('factura_id')->unsigned();
            $table->foreign('factura_id')->references('id')->on('facturas');

            $table->char('credito', 10);
            $table->double('cantidad');
            $table->double('total');
            $table->double('descuento');

            $table->softDeletes();
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
        Schema::dropIfExists('ventasarticulos');
    }
}
