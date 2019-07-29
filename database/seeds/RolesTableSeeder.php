<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
        'rol' => 'Administrador',
        'tipo' => 'admin',
      ]);
      DB::table('roles')->insert([
          'rol' => 'Cliente A',
          'tipo' => 'cliente',
      ]);
      DB::table('roles')->insert([
        'rol' => 'Cliente B',
        'tipo' => 'cliente',
      ]);
      DB::table('roles')->insert([
          'rol' => 'Cliente C',
          'tipo' => 'cliente',
      ]);
      DB::table('roles')->insert([
        'rol' => 'Colaborador A',
        'tipo' => 'colaborador',
      ]);
      DB::table('roles')->insert([
          'rol' => 'Colaborador B',
          'tipo' => 'colaborador',
      ]);
      DB::table('roles')->insert([
          'rol' => 'Colaborador C',
          'tipo' => 'colaborador',
      ]);
    }
}
