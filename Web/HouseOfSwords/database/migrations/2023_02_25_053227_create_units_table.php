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
        Schema::create('units', function (Blueprint $table) {
            $table->id('UnitID');

            $table->string('UnitName', 30)->unique();
            $table->integer('UnitSize')->unsigned();

            $table->integer('AttackValue')->unsigned();
            $table->integer('DefenseValue')->unsigned();
            $table->integer('MobilityValue')->unsigned();

            $table->time('TrainingTime');

            $table->integer('TrainingCostGold')->unsigned();
            $table->integer('TrainingCostFallen')->unsigned();

            $table->integer('ResearchCost')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
};
