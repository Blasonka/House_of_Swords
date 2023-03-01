<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Siege System Dependencies
use Database\Seeders\SiegeSystem\SiegesSeeder;
use Database\Seeders\SiegeSystem\SiegingUnitsSeeder;

// Levelstats Dependencies
use Database\Seeders\LevelstatsSeeders\BarrackStatsSeeder;
use Database\Seeders\LevelstatsSeeders\ChurchStatsSeeder;
use Database\Seeders\LevelstatsSeeders\DiplomacyStatsSeeder;
use Database\Seeders\LevelstatsSeeders\InfirmaryStatsSeeder;
use Database\Seeders\LevelstatsSeeders\MarketStatsSeeder;
use Database\Seeders\LevelstatsSeeders\ResearchStatsSeeder;
use Database\Seeders\LevelstatsSeeders\WarehouseStatsSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // Basic Seeders
            UserSeeder::class,
            TownSeeder::class,
            BuildingSeeder::class,
            FriendListSeeder::class,
            BugReportSeeder::class,
            UnitSeeder::class,

            // Levelstats Seeders
            BarrackStatsSeeder::class,
            ChurchStatsSeeder::class,
            DiplomacyStatsSeeder::class,
            InfirmaryStatsSeeder::class,
            MarketStatsSeeder::class,
            ResearchStatsSeeder::class,
            WarehouseStatsSeeder::class,

            // Attack System Seeders
            SiegesSeeder::class,
            SiegingUnitsSeeder::class
        ]);
    }
}
