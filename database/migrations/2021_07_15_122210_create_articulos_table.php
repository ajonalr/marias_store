<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categoria');

            $table->string('nombre');
            $table->string('cod_barras');
            $table->string('descripcion')->nullable();
            $table->text('descripcion_interna')->nullable();
            $table->double('p_venta', 7, 2);
            $table->double('p_costo', 7, 2);
            $table->double('stock', 7, 2)->default(0);
            $table->double('stock_maximo', 7, 2)->nullable()->default(0);
            $table->double('min_stock')->nullable()->default('0');
            $table->text('img')->nullable()->default('');
            $table->text('img2')->nullable()->default('');
            $table->date('fecha_promo')->nullable();

            $table->string('fabricante')->nullable();
            $table->string('medida')->nullable();
            $table->string('unidad')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('eti_equivalente')->nullable();
            $table->string('eti_carro')->nullable();

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
        Schema::dropIfExists('articulos');
    }
}
