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

            $warehouseStats = Warehouse::find($buildings->BuildingLvl);
            $town->Wood += $buildings->BrigadeInWood * $warehouseStats->WoodCollectionPM;
            $town->Stone += $buildings->BrigadeInStone * $warehouseStats->StoneCollectionPM;
            $town->Metal += $buildings->BrigadeInMetal * $warehouseStats->MetalCollectionPM;
            $town->Gold += $buildings->BrigadeInGold * $warehouseStats->GoldCollectionPM;
            if($town->Wood > $warehouseStats->MaxCollectedWood){
                $town->Wood = $warehouseStats->MaxCollectedWood;
            }
            if($town->Stone > $warehouseStats->MaxCollectedStone){
                $town->Stone = $warehouseStats->MaxCollectedStone;
            }
            if($town->Metal > $warehouseStats->MaxCollectedMetal){
                $town->Metal = $warehouseStats->MaxCollectedMetal;
            }
            if($town->Gold > $warehouseStats->MaxCollectedGold){
                $town->Gold = $warehouseStats->MaxCollectedGold;
            }

            $town->save();
        }

        return Command::SUCCESS;
    }
}
