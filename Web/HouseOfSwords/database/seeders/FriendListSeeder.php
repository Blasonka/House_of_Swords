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
        DB::table('friendlist')->updateOrInsert([
            'Users_UID' => 1,
            'FriendID' => 2,
            'isConfirmed' => 1
        ],
        [
            'Users_UID' => 1,
            'FriendID' => 2,
            'isConfirmed' => 1
        ]);

        DB::table('friendlist')->updateOrInsert([
            'Users_UID' => 3,
            'FriendID' => 1,
            'isConfirmed' => 0
        ],
        [
            'Users_UID' => 3,
            'FriendID' => 1,
            'isConfirmed' => 0
        ]);
    }
}
