<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

class LogoutOfflineUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LogoutOfflineUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the GameSessionToken of any user that has not sent a request in the past 5 minutes. Should run every minute.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (User::all() as $key => $user) {
            if ($user->GameSessionToken){
                $fiveMinutesAgo = Carbon::now()->subMinutes(5);

                if (Carbon::parse($user->LastOnline)->lessThan($fiveMinutesAgo)){
                    $user->GameSessionToken = null;
                    $user->save();
                }
            }
        }

        return Command::SUCCESS;
    }
}
