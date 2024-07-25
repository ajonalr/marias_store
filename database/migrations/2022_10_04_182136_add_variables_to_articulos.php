<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVariablesToArticulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articulos', function (Blueprint $table) {
            $table->double('minimo1')->nullable()->default(0);
            $table->double('maximo1')->nullable()->default(0);
            $table->double('precio1')->nullable()->default(0);

            $table->double('minimo2')->nullable()->default(0);
            $table->double('maximo2')->nullable()->default(0);
            $table->double('precio2')->nullable()->default(0);

            $table->double('minimo3')->nullable()->default(0);
            $table->double('maximo3')->nullable()->default(0);
            $table->double('precio3')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articulos', function (Blueprint $table) {
            $table->dropColumn('minimo1');
            $table->dropColumn('maximo1');
            $table->dropColumn('precio1');
            $table->dropColumn('minimo2');
            $table->dropColumn('maximo2');
            $table->dropColumn('precio2');
            $table->dropColumn('minimo3');
            $table->dropColumn('maximo3');
            $table->dropColumn('precio3');
        });
    }
}
