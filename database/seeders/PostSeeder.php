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
        $posts = [
            0 => ['1', '1', 'post by user 1 page 1'],
            1 => ['3', null, 'post by user 3'],
            2 => ['3', '3', 'post by user 3 page 3'],
            3 => ['4', null, 'post by user 4'],
        ];

        foreach ($posts as $post)
        {
            $p = new Post;
            $p->creator_id = $post[0];
            $p->page_id = $post[1];
            $p->content = $post[2];
            $p->save();
        }

    }
}
