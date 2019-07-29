<?php

use Illuminate\Database\Seeder;

class GestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Canvas',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Premisas',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Área técnica/Financiera',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Razón social/marca',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'FODA (1)',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Proceso Due Dil',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Diseño Propuesta',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Modelos financieros',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Macroprocesos',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Procesos',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Políticas',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Comercial/Legal',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Recursos materiales',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Misión y visión',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'FODA (2)',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Partes Interesadas',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'ISO',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Contratos/Poderes',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Desarrollo',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Equipo Comercial/ISO',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('gestion_empresa')->insert([
           'nombre' => 'Control',
           'avance' => 0.48,
           'descripcion' => 'Sin descripcion',
       ]);
     }
}
