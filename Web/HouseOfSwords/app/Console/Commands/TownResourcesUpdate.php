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

        foreach ($towns as $key => $town) {
            $buildings = Building::where([
                ['Towns_TownID', '=', $town->TownID],
                ['BuildingType', '=', 'Warehouse'],
            ])->get()->first();

            $resourcheStats = Warehouse::find($buildings->BuildingLvl);
            $town->Wood += $buildings->BrigadeInWood * $resourcheStats->WoodCollectionPM;
            $town->Stone += $buildings->BrigadeInStone * $resourcheStats->StoneCollectionPM;
            $town->Metal += $buildings->BrigadeInMetal * $resourcheStats->MetalCollectionPM;
            $town->Gold += $buildings->BrigadeInGold * $resourcheStats->GoldCollectionPM;
            $town->save();
        }

        return Command::SUCCESS;
    }
}
