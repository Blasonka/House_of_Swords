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

            // RESEARCH PARAMS
            $table->integer('currentScience')->unsigned()->nullable();
            $table->integer('storedScience')->unsigned()->nullable();

            // CHURCH PARAMS
            $table->dateTime('lastMassDate')->nullable();
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
