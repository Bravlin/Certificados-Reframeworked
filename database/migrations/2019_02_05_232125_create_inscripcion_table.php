<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion', function (Blueprint $table) {
            $table->increments('id_inscripcion');
            $table->string('tipo', 12);
            $table->dateTime('fecha_inscripcion')->useCurrent();
            $table->tinyInteger('asistencia')->default(-1);
            $table->integer('fk_perfil');
            $table->integer('fk_evento');

            $table->foreign('fk_perfil')->references('id')->on('perfil');
            $table->foreign('fk_evento')->references('id_evento')->on('evento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripcion');
    }
}