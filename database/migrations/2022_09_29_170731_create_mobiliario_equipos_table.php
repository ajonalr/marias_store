<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobiliarioEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiliario_equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('cantidad');
            $table->double('precio')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('mantenimiento')->nullable();
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
        Schema::dropIfExists('mobiliario_equipos');
    }
}
