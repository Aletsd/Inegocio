<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
           DesarrolloTableSeeder::class,
           DisenoTableSeeder::class,
           GestionTableSeeder::class,
           OperacionTableSeeder::class,
           //ProyectosTableSeeder::class,
           UsuarioPruebaTableSeeder::class,
           //RelacionUserPoryectoTableSeeder::class,
           RolesTableSeeder::class,
           //RelacionProyectoRolTableSeeder::class,
           //BlogCategoryTableSeeder::class,
           //BlogPostTableSeeder::class

       ]);
    }
}
