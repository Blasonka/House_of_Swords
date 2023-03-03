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
        Schema::create('trained_units', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('TrainingID');

            $table->foreignId('TownID')->constrained('towns', 'TownID')
                ->onDelete('cascade');
            $table->foreignId('UnitID')->constrained('units', 'UnitID')
                ->onDelete('cascade');

            $table->integer('UnitAmount')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trained_units');
    }
};
