<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    // UnitID => [ UnitName, UnitSize, AttackValue, DefenseValue, MobilityValue, TrainingTime, TrainingCostGold, TrainingCostFallen, ResearchCost ]
    private $units = [
        1 => [ 'Swordsman', 1, 5, 5, 5, '00:03:00', 1, 1, 0 ],
        2 => [ 'Archer', 1, 7, 2, 7, '00:05:00', 3, 2, 30 ],
        3 => [ 'Cavalry', 3, 10, 4, 15, '00:15:00', 6, 5, 100 ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->units as $key => $value) {
            DB::table('units')->updateOrInsert([ 'UnitID' => $key ],
            [
                'UnitID' => $key,

                'UnitName' => $value[0],
                'UnitSize' => $value[1],

                'AttackValue' => $value[2],
                'DefenseValue' => $value[3],
                'MobilityValue' => $value[4],

                'TrainingTime' => $value[5],
                'TrainingCostGold' => $value[6],
                'TrainingCostFallen' => $value[7],

                'ResearchCost' => $value[8],
            ]);
        }
    }
}
