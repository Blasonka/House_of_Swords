<?php

namespace Database\Seeders\LevelstatsSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketStatsSeeder extends Seeder
{
    // Lvl => [ MaxTaxPercentage, HappinessModifierPerPercent ]
    private $statsPerLevel = [
        1 => [10, 100],
        2 => [15, 90],
        3 => [20, 85]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statsPerLevel as $key => $value) {
            DB::table('levelstats_market')->updateOrInsert([ 'Lvl' => $key ],
            [
                'Lvl' => $key,
                'MaxTaxPercentage' => $value[0],
                'HappinessModifierPerPercent' => $value[1]
            ]);
        }
    }
}
