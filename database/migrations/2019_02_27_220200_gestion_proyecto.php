<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GestionProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('gestion_proyecto', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('proyecto_id')->unsigned();
           $table->foreign('proyecto_id')->references('id')->on('proyectos');
           $table->integer('gestion_id')->unsigned();
           $table->foreign('gestion_id')->references('id')->on('gestion_empresa');
           $table->boolean('estatus')->nullable();
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
         Schema::dropIfExists('gestion_proyecto');
     }
}
