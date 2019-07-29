<?php

use Illuminate\Database\Seeder;

class RelacionProyectoRolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('proyecto_role')->insert([
          'id' => 1,
          'role_id' => 1,
          'proyecto_id' => 1,
      ]);
      DB::table('proyecto_role')->insert([
          'id' => 2,
          'role_id' => 1,
          'proyecto_id' => 2,
      ]);
    }
}
