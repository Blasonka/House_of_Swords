<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $towns = DB::table('towns');



        return Command::SUCCESS;
    }
}
