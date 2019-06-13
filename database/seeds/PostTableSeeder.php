<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post=new \App\Post([
        	'title'=>'learning Laravel 5.7',
        	'content'=>'this blog will be post on timeline'
        ]);
        $post->save();
         $post=new \App\Post([
        	'title'=>'another thing',
        	'content'=>'Something else'
        ]);
        $post->save(); 
    }
}
