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
        Schema::create('friendlist', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id('RelationID');

            $table->foreignId('Users_UID')
                ->constrained('users', 'UID')
                ->onDelete('cascade');

            $table->foreignId('FriendID')
                ->constrained('users', 'UID')
                ->onDelete('cascade');

            $table->foreignId('isConfirmed')
                ->default(0)
                ->constrained('users', 'UID')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friendlist');
    }
};
