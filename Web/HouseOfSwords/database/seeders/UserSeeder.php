<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert([ 'Username' => 'admin' ],
        [
            'Username' => 'admin',
            'EmailAddress' => 'blasek.balazs@gmail.com',
            'IsEmailVerified' => true,
            'PwdHash' => 'f6f809cb210d98022cd466631bf95190b965b9f7885bb48bf1f716a89cba49583b0ee50e29b3d741e8797a0d1035dc0889356385de903faddd22a8fcdca50fbb',
            'PwdSalt' => 'xbSVinazxDnPAqNco0qe',
            'Role' => 2
        ]);

        DB::table('users')->updateOrInsert([ 'Username' => 'admin2' ],
        [
            'Username' => 'admin2',
            'EmailAddress' => 'venteralex1@gmail.com',
            'IsEmailVerified' => true,
            'PwdHash' => 'c6d8d9bb045f9da8d3e0f73356c8e6a31990bae59022216642f4d645325c6a7ad54a90312e503ce4ec8e7b974a1f337afb9f70af0db153887f7f93acdbf0be9e',
            'PwdSalt' => 't2V7ZtEY8hWYeDYwRiJA',
            'Role' => 2
        ]);

        DB::table('users')->updateOrInsert([ 'Username' => 'admin3' ],
        [
            'Username' => 'admin3',
            'EmailAddress' => 'laura.luksa03@gmail.com',
            'IsEmailVerified' => true,
            'PwdHash' => 'fc61a1a372095cadfd3ac9d96e63c07d03a6dfddf0a22040524a88d478e860f24f1927e458b736e135d94ce4982adbdce4ff94f3c327c7047697984549379244',
            'PwdSalt' => 'eVhEHxtt6Ygi9h649z3n',
            'Role' => 2
        ]);

        DB::table('users')->updateOrInsert([ 'Username' => 'TesztAdmin' ],
        [
            'Username' => 'TesztAdmin',
            'EmailAddress' => 'tesztadmin@gmail.com',
            'IsEmailVerified' => true,
            'PwdHash' => '693fed1f95492e00b26a61bd2d9e8c12f671de3c3077dfb04c7497160a909963a894368e3758770c17f8d6aae0ce2ba9876df16c7f282ce21cd8976a65466240',
            'PwdSalt' => 'qbwNy3zGHP9UiWNEaSXG',
            'Role' => 1
        ]);

        DB::table('users')->updateOrInsert([ 'Username' => 'TesztJozsef' ],
        [
            'Username' => 'TesztJozsef',
            'EmailAddress' => 'tesztjozsi@gmail.com',
            'IsEmailVerified' => true,
            'PwdHash' => '693fed1f95492e00b26a61bd2d9e8c12f671de3c3077dfb04c7497160a909963a894368e3758770c17f8d6aae0ce2ba9876df16c7f282ce21cd8976a65466240',
            'PwdSalt' => 'qbwNy3zGHP9UiWNEaSXG',
            'Role' => 0
        ]);
    }
}
