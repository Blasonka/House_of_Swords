<?php

namespace Database\Seeders\SiegeSystem;

use App\Models\Town;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainedUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 1;
        foreach (Town::all() as $key => $town) {
            foreach (Unit::all() as $key => $unit) {
                DB::table('trained_units')->updateOrInsert([ 'TrainingID' => $count ], [
                    'UnitID' => $unit->UnitID,
                    'TownID' => $town->TownID
                ]);
                $count++;
            }
        }
    }
}
