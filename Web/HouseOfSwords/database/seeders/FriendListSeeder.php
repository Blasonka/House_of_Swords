<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friendlist')->insert([
            'Users_UID' => 1,
            'FriendID' => 2
        ]);

        DB::table('friendlist')->insert([
            'Users_UID' => 2,
            'FriendID' => 1
        ]);
    }
}
