<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado', function (Blueprint $table) {
            $table->increments('id_certificado');
            $table->string('nombre_certificado', 255);
            $table->tinyInteger('entregado')->default(0);
            $table->dateTime('fecha_emision')->useCurrent();
            $table->string('aleatorio', 10);
            $table->string('email_enviado', 254)->nullable();
            $table->unsignedInteger('fk_inscripcion');

            $table->foreign('fk_inscripcion')->references('id_inscripcion')->on('inscripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificado');
    }
}
