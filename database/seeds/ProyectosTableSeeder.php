<?php

use Illuminate\Database\Seeder;

class ProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 1',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 10,
      ]);
      DB::table('desarrollo_proyecto')->insert([
          'proyecto_id' => 1,
          'desarrollo_id' => 1,
          'estatus' => 0,

      ]);
      DB::table('gestion_proyecto')->insert([
          'proyecto_id' => 1,
          'gestion_id' => 1,
          'estatus' => 0,

      ]);
      DB::table('diseno_propuesta_proyecto')->insert([
          'proyecto_id' => 1,
          'diseno_propuesta_id' => 1,
          'estatus' => 0,

      ]);
      DB::table('operacion_proyecto')->insert([
          'proyecto_id' => 1,
          'operacion_id' => 1,
          'estatus' => 0,

      ]);
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 2',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 15,
      ]);
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 3',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 30,
      ]);
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 4',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 50,
      ]);
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 5',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 30,
      ]);
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 6',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 50,
      ]);
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 7',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 30,
      ]);
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 8',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 50,
      ]);
      DB::table('proyectos')->insert([
          'nombre' => 'proyecto 9',
          'cliente' => str_random(10),
          'imagen' => '1002676_3c6e_2_1551136282.jpg',
          'proyectoid' => str_random(10),
          'descripcion' => str_random(10),
          'estatus' => 1,
          'porcentaje' => 50,
      ]);
    }
}
