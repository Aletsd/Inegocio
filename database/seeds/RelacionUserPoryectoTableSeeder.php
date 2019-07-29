<?php

use Illuminate\Database\Seeder;

class RelacionUserPoryectoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('proyecto_user')->insert([
          'id' => 1,
          'user_id' => 1,
          'proyecto_id' => 1,
      ]);
      DB::table('proyecto_user')->insert([
          'id' => 2,
          'user_id' => 2,
          'proyecto_id' => 1,
      ]);
      DB::table('proyecto_user')->insert([
          'id' => 3,
          'user_id' => 3,
          'proyecto_id' => 1,
      ]);
      DB::table('proyecto_user')->insert([
          'id' => 4,
          'user_id' => 4,
          'proyecto_id' => 1,
      ]);
      DB::table('proyecto_user')->insert([
          'id' => 5,
          'user_id' => 1,
          'proyecto_id' => 6,
      ]);
      DB::table('proyecto_user')->insert([
          'id' => 6,
          'user_id' => 1,
          'proyecto_id' => 8,
      ]);
      DB::table('proyecto_user')->insert([
          'id' => 7,
          'user_id' => 1,
          'proyecto_id' => 9,
      ]);
    }
}
