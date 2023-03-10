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
        Schema::create('towns', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('TownID')->comment('A város azonosítója.');
            $table->foreignId('Users_UID')
                ->comment('A várost birtokló felhasználó azonosítója. A felhasználó törlése esetén kaszkádoltan törlődik a rekord.')
                ->constrained('users', 'UID')
                ->onDelete('cascade');

            $table->string('TownName', 20)->comment('A város neve.');
            $table->integer('HappinessValue')->unsigned()->default(100)->comment('A város lakosságának boldogsága százalékban. Hatással lesz a város termelékenységére, illetve a militarizálásra.');

            // $table->integer('Wood')->unsigned()->default(100);
            // $table->integer('Stone')->unsigned()->default(100);
            // $table->integer('Metal')->unsigned()->default(50);
            // $table->integer('Gold')->unsigned()->default(25);

            $table->double('Wood')->unsigned()->default(100)->comment('A város rendelkezésre álló nyersanyaga: fa.');
            $table->double('Stone')->unsigned()->default(100)->comment('A város rendelkezésre álló nyersanyaga: kő.');
            $table->double('Metal')->unsigned()->default(50)->comment('A város rendelkezésre álló nyersanyaga: fém.');
            $table->double('Gold')->unsigned()->default(25)->comment('A város rendelkezésre álló nyersanyaga: arany.');

            $table->integer('CampaignLvl')->unsigned()->default(0)->comment('A város ezen a szinten tart a kampányban.');

            $table->integer('XCords')->comment('A város X koordinátája a kétdimenziós világtérképen. A város létrehozásakor véletlenszerűen generált értéket kap a térkép méretei között.');
            $table->integer('YCords')->comment('A város Y koordinátája a kétdimenziós világtérképen. A város létrehozásakor véletlenszerűen generált értéket kap a térkép méretei között.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('towns');
    }
};
