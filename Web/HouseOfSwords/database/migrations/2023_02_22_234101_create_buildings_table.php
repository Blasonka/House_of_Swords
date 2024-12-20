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
        Schema::create('buildings', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('BuildingID');
            $table->foreignId('Towns_TownID')
                ->constrained('towns', 'TownID')
                ->onDelete('cascade');

            $table->string('BuildingType', 20);
            $table->integer('BuildingLvl')->unsigned()->default(1);

            // CHURCH PARAMS
            $table->dateTime('lastMassDate')->nullable();

            // INFIRMARY PARAMS
            $table->dateTime('lastCureDate')->nullable();
            $table->integer('currentCure')->unsigned()->nullable();
            $table->integer('injuredUnits')->unsigned()->nullable();
            $table->integer('healedUnits')->unsigned()->nullable();

            // RESEARCH PARAMS
            $table->integer('currentScience')->unsigned()->nullable();
            $table->integer('storedScience')->unsigned()->nullable();

            // WAREHOUSE PARAMS
            $table->integer('BrigadeInWood')->unsigned()->nullable();
            $table->integer('BrigadeInStone')->unsigned()->nullable();
            $table->integer('BrigadeInMetal')->unsigned()->nullable();
            $table->integer('BrigadeInGold')->unsigned()->nullable();
            $table->integer('BrigadeInWarehouse')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
};
