<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->increments('id_evento');
            $table->string('nombre');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_realizacion');
            $table->mediumText('descripcion');
            $table->string('direccion_calle', 25);
            $table->smallInteger('direccion_altura');
            $table->unsignedInteger('fk_ciudad');
            $table->unsignedInteger('fk_categoria');

            $table->foreign('fk_ciudad')->references('id_ciudad')->on('ciudad');
            $table->foreign('fk_categoria')->references('id_categoria')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
