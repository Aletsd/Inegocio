<?php

use Illuminate\Database\Seeder;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_posts')->insert([
            'title' => 'La importancia de la consultoría de proyectos de construcción',
            'introduction'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, laborum tempora! Consequuntur sequi culpa minus recusandae totam aspernatur.',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, laborum tempora! Consequuntur sequi culpa minus recusandae totam aspernatur, officiis quia est soluta id. Deleniti, velit sit nulla omnis voluptatum neque!, Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, laborum tempora! Consequuntur sequi culpa minus recusandae totam aspernatur, officiis quia est soluta id. Deleniti, velit sit nulla omnis voluptatum neque!',
            'avatar' => '1002676_3c6e_2_1551136282.jpg',
            'user_id'=>1,
            'category_id'=>1,
            'topic'=>'proyectos, construcción, demo',
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

        DB::table('blog_posts')->insert([
            'title' => '¿Desarrollo de proyectos Ágiles y Eficientes? Te mostramos como conseguirlo.',
            'introduction'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, laborum tempora! Consequuntur sequi culpa minus recusandae totam aspernatur.',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, laborum tempora! Consequuntur sequi culpa minus recusandae totam aspernatur, officiis quia est soluta id. Deleniti, velit sit nulla omnis voluptatum neque!, Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, laborum tempora! Consequuntur sequi culpa minus recusandae totam aspernatur, officiis quia est soluta id. Deleniti, velit sit nulla omnis voluptatum neque!',
            'avatar' => '1002676_3c6e_2_1551136282.jpg',
            'user_id'=>1,
            'category_id'=>2,
            'topic'=>'general, proyectos, demo',
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
