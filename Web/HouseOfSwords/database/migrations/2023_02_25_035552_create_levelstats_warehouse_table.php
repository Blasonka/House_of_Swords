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
        Schema::create('levelstats_warehouse', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('Lvl');

            $table->integer('MaxBrigadeCount')->unsigned();

            $table->integer('MaxCollectedWood')->unsigned();
            $table->integer('MaxCollectedStone')->unsigned();
            $table->integer('MaxCollectedMetal')->unsigned();
            $table->integer('MaxCollectedGold')->unsigned();

            $table->integer('TrainingCostWood')->unsigned();
            $table->integer('TrainingCostStone')->unsigned();
            $table->integer('TrainingCostMetal')->unsigned();
            $table->integer('TrainingCostGold')->unsigned();

            $table->float('WoodCollectionPM')->unsigned();
            $table->float('StoneCollectionPM')->unsigned();
            $table->float('MetalCollectionPM')->unsigned();
            $table->float('GoldCollectionPM')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levelstats_warehouse');
    }
};
