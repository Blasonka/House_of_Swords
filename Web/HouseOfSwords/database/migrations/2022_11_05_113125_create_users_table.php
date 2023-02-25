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

            $table->id('UID');

            $table->string('Username', 30)->unique();
            $table->string('EmailAddress', 100)->unique();

            $table->string('PwdHash', 128);
            $table->string('PwdSalt', 20);

            $table->tinyInteger('Role')->unsigned()->default(0)->unsigned();

            $table->boolean('IsEmailVerified')->default(0)->unsigned();
            $table->string('EmailVerificationToken', 32)->nullable();

            $table->string('GameSessionToken', 32)->nullable();
            $table->dateTime('LastOnline')->nullable();
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
