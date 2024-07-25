<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddData2ToVentaArticulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('venta_articulos', function (Blueprint $table) {
            $table->double('p_venta')->nullable();
            $table->double('p_costo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('venta_articulos', function (Blueprint $table) {
            $table->dropColumn(['p_venta', 'p_costo']);
        });
    }
}
