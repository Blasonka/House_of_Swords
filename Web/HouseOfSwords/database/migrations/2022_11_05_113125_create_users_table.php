<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('UID')->comment('A Felhasználó azonosítója.');

            $table->string('Username', 30)->unique()->comment('A választott, egyedi felhasználónév. Bejelentkezéshez használatos.');
            $table->string('EmailAddress', 100)->unique()->comment('A felhasználó email címe. Email-es üzenetek küldésére, azonosításra, bejelentkezéshez használatos.');

            $table->string('PwdHash', 128)->comment('A felhasználó jelszavának titkosított változata.');
            $table->string('PwdSalt', 20)->comment('A titkosításhoz és ellenőrzéshez használt kulcs. Szigorúan titkos.');

            $table->tinyInteger('Role')->unsigned()->default(0)->comment('A felhasználó hatásköre (pl. 2 = tulajdonos, 1 = admin, 0 = felhasználó).');

            $table->boolean('IsEmailVerified')->default(0)->unsigned()->comment('Megerősítette-e a felhasználó az email címét regisztrálás után.');
            $table->string('EmailVerificationToken', 32)->nullable()->comment('Email cím megerősítés közben azonosításhoz használt zseton.');

            $table->string('GameSessionToken', 32)->nullable()->comment('A játékban bejelentkezést követően jut hozzá ehhez a zsetonhoz a kliens, nélküle nem szolgáljuk ki a játékadatokkal.');
            $table->dateTime('LastOnline')->nullable()->comment('Az utolsó beérkező kérés dátuma a játékklienstől. Ha több, mint 5 perce történt, kijelentkeztetjük a felhasználót, és elvesszük a GameSessionToken zsetont tőle.');

            $table->string('ProfileImageUrl', 100)->nullable()->comment('A felhasználó által beállított profilkép webcíme. Ha még nem állított be profilképet, akkor az értéke null.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
