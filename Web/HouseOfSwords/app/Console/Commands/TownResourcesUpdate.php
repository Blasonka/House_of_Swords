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

        foreach ($towns as $key => $value) {
            $value->Wood += 1;
            $value->Stone += 1;
            $value->Metal += 1;
            $value->Gold += 1;
            $value->save();
        }

        return Command::SUCCESS;
    }
}
