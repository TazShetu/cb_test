<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRelation;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            0 => ['John', 'Doe', 'j@g.com', '123456789'],
            1 => ['John2', 'Doe2', 'j2@g.com', '123456789'],
            2 => ['John3', 'Doe3', 'j3@g.com', '123456789'],
            4 => ['John4', 'Doe4', 'j4@g.com', '123456789'],
        ];

        foreach ($users as $user) {
            $u = new User;
            $u->first_name = $user[0];
            $u->last_name = $user[1];
            $u->email = $user[2];
            $u->password = bcrypt($user[3]);
            $u->save();
        }

        $ur = new UserRelation;
        $ur->user_id = 1;
        $ur->follower_id = 2;
        $ur->save();


    }
}
