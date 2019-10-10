<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil', function (Blueprint $table) {
            $table->increments('id_perfil');
            $table->string('email', 100);
            $table->string('nombre', 100)->unique();
            $table->string('apellido', 100);
            $table->string('telefono', 100);
            $table->string('organismo', 100);
            $table->string('cargo', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil');
    }
}
