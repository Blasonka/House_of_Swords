<?php

namespace Database\Seeders\SiegeSystem;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiegingUnitsSeeder extends Seeder
{
    // SiegingUnitID => [ SiegeID, UnitID, UnitAmount ]
    private $attackingUnits = [
        1 => [ 1, 1, 10 ],
        2 => [ 1, 3, 3]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->attackingUnits as $key => $value) {
            DB::table('sieging_units')->updateOrInsert([ 'SiegingUnitID' => $key ], [
                'SiegeID' => $value[0],
                'UnitID' => $value[1],
                'UnitAmount' => $value[2]
            ]);
        }
    }
}
