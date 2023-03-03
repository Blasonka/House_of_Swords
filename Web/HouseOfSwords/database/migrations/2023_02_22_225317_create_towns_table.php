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

            $table->id('TownID');
            $table->foreignId('Users_UID')
                ->constrained('users', 'UID')
                ->onDelete('cascade');

            $table->string('TownName', 20);
            $table->integer('HappinessValue')->unsigned()->default(100);

            // $table->integer('Wood')->unsigned()->default(100);
            // $table->integer('Stone')->unsigned()->default(100);
            // $table->integer('Metal')->unsigned()->default(50);
            // $table->integer('Gold')->unsigned()->default(25);

            $table->double('Wood')->unsigned()->default(100);
            $table->double('Stone')->unsigned()->default(100);
            $table->double('Metal')->unsigned()->default(50);
            $table->double('Gold')->unsigned()->default(25);

            $table->integer('CampaignLvl')->unsigned()->default(0);

            $table->integer('XCords');
            $table->integer('YCords');
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
