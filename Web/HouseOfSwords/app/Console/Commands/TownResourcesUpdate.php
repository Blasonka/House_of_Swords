<?php

namespace App\Console\Commands;

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
            $town->Wood += 1;
            $town->Stone += 1;
            $town->Metal += 1;
            $town->Gold += 1;
            $town->save();
        }

        return Command::SUCCESS;
    }
}
