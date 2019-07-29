<?php

use Illuminate\Database\Seeder;

class UsuarioPruebaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'nombres' => 'Pako Regalado',
          'Apellidos' => str_random(10),
          'empresa' => "empresa 1",
          'rol_id' => 1,
          'img_perfil' => 'img-user_1551979596.png',
          'email' => 'pako@moustrillos.com',
          'password' => bcrypt('123456'),
      ]);
      DB::table('users')->insert([
          'nombres' => 'Alfredo Argenis Barraza Guillén',
          'Apellidos' => str_random(10),
          'empresa' => 'empresa 2',
          'rol_id' => 2,
          'img_perfil' => 'img-user_1551979596.png',
          'email' => 'argenisbg@thundertechnology.mx',
          'password' => bcrypt('123456'),
      ]);
      DB::table('users')->insert([
          'nombres' => 'Alexis Harol',
          'Apellidos' => str_random(10),
          'empresa' => 'empresa 3',
          'rol_id' => 3,
          'img_perfil' => 'img-user_1551979596.png',
          'email' => 'oaletsd@gmail.com',
          'password' => bcrypt('123456'),
      ]);
      DB::table('users')->insert([
          'nombres' => 'Cliente C',
          'Apellidos' => str_random(10),
          'empresa' => 'empresa 3',
          'rol_id' => 4,
          'img_perfil' => 'img-user_1551979596.png',
          'email' => 'prueba4@gmail.com',
          'password' => bcrypt('123456'),
      ]);
      DB::table('users')->insert([
          'nombres' => 'Mario Moreno',
          'Apellidos' => str_random(10),
          'empresa' => 'empresa 3',
          'rol_id' => 5,
          'img_perfil' => 'img-user_1551979596.png',
          'email' => 'mario-moreno-a93@hotmail.com',
          'password' => bcrypt('123456'),
      ]);
      DB::table('users')->insert([
          'nombres' => 'Colaborador B',
          'Apellidos' => str_random(10),
          'empresa' => 'empresa 3',
          'rol_id' => 6,
          'img_perfil' => 'img-user_1551979596.png',
          'email' => 'prueba6@gmail.com',
          'password' => bcrypt('123456'),
      ]);
      DB::table('users')->insert([
          'nombres' => 'Colaborador C',
          'Apellidos' => str_random(10),
          'empresa' => 'empresa 3',
          'rol_id' => 7,
          'img_perfil' => 'img-user_1551979596.png',
          'email' => 'prueba7@gmail.com',
          'password' => bcrypt('123456'),
      ]);
    }
}
