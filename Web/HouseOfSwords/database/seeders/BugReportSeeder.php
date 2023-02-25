<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BugReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bugreports')->updateOrInsert([ 'Id' => 1 ],
        [
            'Text' => 'A felhasználók által jelentett hibák itt fognak megjelenni.',
            'EmailAddress' => 'blasek.balazs@gmail.com',
            'IsSolved' => 2
        ]);
    }
}
