<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('proyecto_id')->unsigned();
          $table->foreign('proyecto_id')->references('id')->on('proyectos');
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users');
          $table->string('nombre_archivo');
          $table->string('nombre_nube');
          $table->string('peso_archivo');
          $table->integer('etapa')->comment('1 - Diseño propuesta, 2 - Desarrollo, 3 - Administracion del proyecto, 4 - Gestion de Empresa');
          $table->integer('tipo')->comment('1 - legal, 2 - Proyecto Ejecutivo, 3 - Tecnico, 4 - Comercial, 5 - Administrativo, 6 - Metodologia, 7 - Capacitacion y Desarrollo');
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
