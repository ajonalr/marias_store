<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_archivo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('archivo_id')->unsigned();
            $table->foreign('archivo_id')->references('id')->on('archivos');
            $table->text('foto', 500);
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
        Schema::dropIfExists('foto_archivo');
    }
}
