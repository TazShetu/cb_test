<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = new Page;
        $p->creator_id = 1;
        $p->name = 'page by user 1';
        $p->save();

        $p2 = new Page;
        $p2->creator_id = 3;
        $p2->name = 'page by user 3';
        $p2->save();
        $p2->followers()->attach([2]);

        $p4 = new Page;
        $p4->creator_id = 4;
        $p4->name = 'page by user 4';
        $p4->save();

    }
}
