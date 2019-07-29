<?php

use Illuminate\Database\Seeder;

class DisenoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Cédula informativa para DD (Gestión)',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Cédula informativa para DD (Jurídico)',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Cédula Proyecto',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Cédula Terreno',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Cédula Financiera',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Mapeo general',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Cédula Due Diligente',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Programa de titulación STD',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Bases de diseño y programa (Arquitectura)',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Bases de diseño y programa (Ingenierías)',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Pase paramétrica',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Programa de obra STD',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Programa de ventas STD',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Bases de mercado',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Modelo financiero',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Visita al predio',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Análisis de base paramétrica',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Bench Mark general',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Escenarios',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Análisis de costos hitóricos',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Estudios preliminares',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
       DB::table('diseno_propuestas')->insert([
           'nombre' => 'Cédula de eficiencia',
           'avance' => 0.4545,
           'descripcion' => 'Sin descripcion',
       ]);
     }
}
