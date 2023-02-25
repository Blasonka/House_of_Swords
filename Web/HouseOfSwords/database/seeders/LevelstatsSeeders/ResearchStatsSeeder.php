<?php

namespace Database\Seeders\LevelstatsSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchStatsSeeder extends Seeder
{
    // Lvl => [ SciencePM, MaxScience ]
    private $statsPerLevel = [
        1 => [2, 30],
        2 => [3, 45],
        3 => [10, 150]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statsPerLevel as $key => $value) {
            DB::table('levelstats_research')->updateOrInsert([ 'Lvl' => $key ],
            [
                'Lvl' => $key,
                'SciencePM' => $value[0],
                'MaxScience' => $value[1]
            ]);
        }
    }
}
