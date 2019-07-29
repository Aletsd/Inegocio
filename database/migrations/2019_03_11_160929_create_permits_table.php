<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proyecto_id')->unsigned();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('diseño')->default(false);
            $table->boolean('desarrollo')->default(false);
            $table->boolean('operacion')->default(false);
            $table->boolean('gestion')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permits');
    }
}
