<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proyecto_id')->unsigned()->nullable();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->integer('emisor_id')->unsigned()->nullable();
            $table->foreign('emisor_id')->references('id')->on('users');
            $table->integer('receptor_id')->unsigned()->nullable();
            $table->foreign('receptor_id')->references('id')->on('users');
            $table->string('tipo');
            $table->string('mensaje');
            $table->boolean('visto')->nullable();
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
        Schema::dropIfExists('mensajes');
    }
}
