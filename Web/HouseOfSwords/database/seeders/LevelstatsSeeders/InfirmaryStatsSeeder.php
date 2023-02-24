<?php

namespace Database\Seeders\LevelstatsSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfirmaryStatsSeeder extends Seeder
{
    private $statsPerLevel = [
        1 => ['06:00:00', 25, 10, 10],
        2 => ['05:30:00', 25, 15, 25],
        3 => ['05:00:00', 33, 15, 25]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statsPerLevel as $key => $value) {
            DB::table('levelstats_infirmary')->insert([
                'Lvl' => $key,
                'HealingTime' => $value[0],
                'Effectivity' => $value[1],
                'MaxInjuredUnits' => $value[2],
                'MaxHealedUnits' => $value[3]
            ]);
        }
    }
}
