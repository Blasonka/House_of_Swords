<?php

namespace App\Console\Commands;

use App\Models\Building;
use App\Models\Buildings\Warehouse;
use Illuminate\Console\Command;
use App\Models\Town;

class TownResourcesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TownResourcesUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the resources in all the towns. Should run once every minute.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $towns = Town::all();

        error_log($towns);
        error_log('towns');
        foreach ($towns as $key => $town) {
            $buildings = Building::where([
                ['Towns_TownID', '=', $town->TownID],
                ['BuildingType', '=', 'Warehouse'],
            ]);
            error_log($buildings);
            error_log('buildings');

            $resourcheStats = Warehouse::find($buildings->BuildingLvl);
            error_log('resourcheStats');
            error_log($resourcheStats);
            $town->Wood += $town->BrigadeInWood * $resourcheStats->WoodCollectionPM;
            $town->Stone += $town->BrigadeInStone * $resourcheStats->StoneCollectionPM;
            $town->Metal += $town->BrigadeInMetal * $resourcheStats->MetalCollectionPM;
            $town->Gold += $town->BrigadeInGold * $resourcheStats->GoldCollectionPM;
            $town->save();
        }

        return Command::SUCCESS;
    }
}
