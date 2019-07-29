<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('img_perfil')->nullable();
            $table->string('email')->unique();
            $table->string('empresa')->nullable();
            $table->string('datos_fiscales')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefono')->nullable();
            $table->string('status')->default('online');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
