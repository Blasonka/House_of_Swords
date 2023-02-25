<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    private $buildingTypes = [
        'Church',
        'Research',
        'Warehouse',
        'Market',
        'Barrack',
        'Diplomacy',
        'Infirmary'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->buildingTypes as $key => $value) {
            DB::table('buildings')->updateOrInsert([ 'Towns_TownID' => 1 ],
            [
                'Towns_TownID' => 1,
                'BuildingType' => $value
            ]);
        }
    }
}
