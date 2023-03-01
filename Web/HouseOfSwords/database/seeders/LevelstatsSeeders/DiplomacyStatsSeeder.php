<?php

namespace Database\Seeders\LevelstatsSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiplomacyStatsSeeder extends Seeder
{
    // Lvl => [ MaxAllyCount, MaxAllyRange ]
    private $statsPerLevel = [
        1 => [0, 0],
        2 => [1, 50],
        3 => [2, 100]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statsPerLevel as $key => $value) {
            DB::table('levelstats_diplomacy')->updateOrInsert([ 'Lvl' => $key ],
            [
                'Lvl' => $key,
                'MaxAllyCount' => $value[0],
                'MaxAllyRange' => $value[1]
            ]);
        }
    }
}
