<?php

namespace App\Console\Commands;

use App\Models\Bugreport;
use Illuminate\Console\Command;

class ClearSolvedBugreports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ClearSolvedBugreports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the bugreports that have been solved during the week. Should run every Sunday at 23:59 PM.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Bugreport::where('IsSolved', 2)->delete();
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            return Command::FAILURE;
        }
    }
}
