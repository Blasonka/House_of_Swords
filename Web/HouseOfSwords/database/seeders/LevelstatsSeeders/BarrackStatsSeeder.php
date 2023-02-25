<?php

namespace Database\Seeders\LevelstatsSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarrackStatsSeeder extends Seeder
{
    // Lvl => [ MaxUnitCount, MaxTrainingAmount, MaxAttackRange ]
    private $statsPerLevel = [
        1 => [ 10, 5, 50 ],
        2 => [ 20, 8, 100 ],
        3 => [ 40, 10, 150 ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statsPerLevel as $key => $value) {
            DB::table('levelstats_barrack')->updateOrInsert([ 'Lvl' => $key ],
            [
                'MaxUnitCount' => $value[0],
                'MaxTrainingAmount' => $value[1],

                'MaxAttackRange' => $value[2]
            ]);
        }
    }
}
