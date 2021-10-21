<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post();
        $post->description = "Hello I am a test";
        $post->photo = "Coucou";
        $post->user_id = 1;
        $post->save();
    }
}
