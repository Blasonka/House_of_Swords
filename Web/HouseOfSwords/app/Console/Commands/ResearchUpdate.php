<?php

namespace App\Console\Commands;

use App\Models\Building;
use App\Models\Buildings\Research;
use Illuminate\Console\Command;

class ResearchUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ResearchUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Increases all research buildings' current science based on the building's level. Should run once every minute.";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $researchBuildings = Building::all()->where('BuildingType', 'LIKE', 'Research');

        $scienceBasedOnLevel = [];
        $maxScienceBasedOnLevel = [];
        foreach (Research::all() as $key => $value) {
            array_push($scienceBasedOnLevel, $value->SciencePM);
            array_push($maxScienceBasedOnLevel, $value->MaxScience);
        }

        foreach ($researchBuildings as $key => $value) {
            $params = json_decode($value->Params);

            $params->currentScience += $scienceBasedOnLevel[$value->BuildingLvl - 1];
            if ($params->currentScience > $maxScienceBasedOnLevel[$value->BuildingLvl - 1]){
                $params->currentScience = $maxScienceBasedOnLevel[$value->BuildingLvl - 1];
            }

            $value->Params = json_encode($params);
            $value->save();
        }

        return Command::SUCCESS;
    }
}
