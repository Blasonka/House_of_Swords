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
        Schema::create('sieges', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('SiegeID');

            $table->foreignId('AttackerTownID')->constrained('towns', 'TownID');
            $table->foreignId('DefenderTownID')->constrained('towns', 'TownID');

            $table->dateTime('SiegeTime');

            $table->integer('LootPercentage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sieges');
    }
};
