<?php

namespace Database\Seeders\LevelstatsSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseStatsSeeder extends Seeder
{
    // Lvl => [ MaxBrigadeCount, /**/ MaxCollected{resourceName} * 4, /**/ TrainingCost{resourceName} * 4, /**/ {resourceName}CollectionPM * 4 ]
    private $statsPerLevel = [
        1 => [4, /**/ 1000, 1000, 400, 100, /**/ 10, 10, 3, 1, /**/ 3, 3, 1, 0.25],
        2 => [6, /**/ 1200, 1200, 500, 150, /**/ 10, 10, 3, 1, /**/ 10, 10, 3, 0.5],
        3 => [8, /**/ 1500, 1500, 600, 225, /**/ 10, 10, 3, 1, /**/ 20, 15, 5, 1]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statsPerLevel as $key => $value) {
            DB::table('levelstats_warehouse')->updateOrInsert([ 'Lvl' => $key ],
            [
                'Lvl' => $key,

                'MaxBrigadeCount' => $value[0],

                'MaxCollectedWood' => $value[1],
                'MaxCollectedStone' => $value[2],
                'MaxCollectedMetal' => $value[3],
                'MaxCollectedGold' => $value[4],

                'TrainingCostWood' => $value[5],
                'TrainingCostStone' => $value[6],
                'TrainingCostMetal' => $value[7],
                'TrainingCostGold' => $value[8],

                'WoodCollectionPM' => $value[9],
                'StoneCollectionPM' => $value[10],
                'MetalCollectionPM' => $value[11],
                'GoldCollectionPM' => $value[12],
            ]);
        }
    }
}
