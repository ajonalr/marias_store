<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('articulo_id')->unsigned();
            $table->foreign('articulo_id')->references('id')->on('articulos');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->double('cantidad');
            $table->char('factura', 35);
            $table->date('fecha')->nullable(true);
            $table->date('fecha_vencimiento')->nullable(true);

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
        Schema::dropIfExists('compra_articulos');
    }
}
