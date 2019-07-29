<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DesarrolloProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('desarrollo_proyecto', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('proyecto_id')->unsigned();
           $table->foreign('proyecto_id')->references('id')->on('proyectos');
           $table->integer('desarrollo_id')->unsigned();
           $table->foreign('desarrollo_id')->references('id')->on('desarrollos');
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
         Schema::dropIfExists('desarrollo_proyecto');
     }
}
