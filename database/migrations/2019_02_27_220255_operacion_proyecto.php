<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OperacionProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('operacion_proyecto', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('proyecto_id')->unsigned();
           $table->foreign('proyecto_id')->references('id')->on('proyectos');
           $table->integer('operacion_id')->unsigned();
           $table->foreign('operacion_id')->references('id')->on('operacion');
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
         Schema::dropIfExists('operacion_proyecto');
     }
}
