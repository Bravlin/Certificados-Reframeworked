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
            $table->string('email', 100);
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('telefono', 100);
            $table->string('organismo', 100);
            $table->string('cargo', 50);
            $table->string('tipo', 12);
            $table->dateTime('fecha_inscripcion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('asistencia')->default(-1);
            $table->unsignedInteger('fk_evento');
            $table->unsignedInteger('fk_perfil');

            $table->foreign('fk_evento')->references('id_evento')->on('evento');
            $table->foreign('fk_perfil')->references('id_perfil')->on('perfil');
            $table->unique(array('fk_evento','email'));
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
