<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_categories')->insert([
            'title' => 'General',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('blog_categories')->insert([
            'title' => 'Negocios',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('blog_categories')->insert([
            'title' => 'Proyectos',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
