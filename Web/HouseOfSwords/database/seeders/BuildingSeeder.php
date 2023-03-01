<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    public $buildingTypes = [
        'Barrack',
        'Church',
        'Diplomacy',
        'Infirmary',
        'Market',
        'Research',
        'Warehouse'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Town::all() as $key => $town) {
            foreach ($this->buildingTypes as $key => $building) {
                DB::table('buildings')->updateOrInsert([ 'Towns_TownID' => $town->Town_ID ],
                [
                    'Towns_TownID' => 1,
                    'BuildingType' => $building
                ]);
            }
        }
    }
}
