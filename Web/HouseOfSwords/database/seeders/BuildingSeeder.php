<?php

namespace Database\Seeders;

use App\Models\Town;
use Carbon\Carbon;
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
        $defaultDate = Carbon::create(2000, 1, 1, 0, 0, 0);

        foreach (Town::all() as $key => $town) {
            foreach ($this->buildingTypes as $key => $building) {
                $params = [
                    'Towns_TownID' => $town->TownID,
                    'BuildingType' => $building
                ];

                switch ($building) {
                    case 'Barrack':
                        // ...
                        break;
                    case 'Church':
                        $params['lastMassDate'] = $defaultDate;
                        break;
                    case 'Diplomacy':
                        // ...
                        break;
                    case 'Infirmary':
                        $params['lastCureDate'] = $defaultDate;
                        $params['currentCure'] = 0;
                        $params['injuredUnits'] = 0;
                        $params['healedUnits'] = 0;
                        break;
                    case 'Market':
                        // ...
                        break;
                    case 'Research':
                        $params['currentScience'] = 0;
                        $params['storedScience'] = 0;
                        break;
                    case 'Warehouse':
                        $params['BrigadeInWood'] = 0;
                        $params['BrigadeInStone'] = 0;
                        $params['BrigadeInMetal'] = 0;
                        $params['BrigadeInGold'] = 0;
                        $params['BrigadeInWarehouse'] = 4;
                        break;
                    default:
                        break;
                }

                DB::table('buildings')
                    ->updateOrInsert(
                        ['Towns_TownID' => $town->Town_ID],
                        $params
                    );
            }
        }
    }
}
