<?php

namespace Database\Seeders\LevelstatsSeeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class ChurchStatsSeeder extends Seeder
{
    private $statsPerLevel = [
        1 => [ '00:10:00', 2 ],
        2 => [ '00:20:00', 5 ],
        3 => [ '00:30:00', 10 ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statsPerLevel as $key => $value) {
            DB::table('levelstats_church')->insert([
                'Lvl' => $key,
                'MassLength' => $value[0],
                'HappinessBoost' => $value[1]
            ]);
        }
    }
}
