<?php

namespace Database\Seeders\SiegeSystem;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiegesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sieges')->updateOrInsert([ 'SiegeID' => 1 ], [
            'AttackerTownID' => 1,
            'DefenderTownID' => 2,
            'SiegeTime' => '2023-12-31 23:59:59',
            'LootPercentage' => 30
        ]);
    }
}
