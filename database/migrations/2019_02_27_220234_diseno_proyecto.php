<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DisenoProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('diseno_propuesta_proyecto', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('proyecto_id')->unsigned();
           $table->foreign('proyecto_id')->references('id')->on('proyectos');
           $table->integer('diseno_propuesta_id')->unsigned();
           $table->foreign('diseno_propuesta_id')->references('id')->on('diseno_propuestas');
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
         Schema::dropIfExists('diseno_propuesta_proyecto');
     }
}
