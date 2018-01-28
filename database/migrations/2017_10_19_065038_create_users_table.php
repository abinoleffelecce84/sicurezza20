<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->engine='InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->string('nick');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone');
            $table->string('role');
            $table->integer('checked'); //controlla se ha effettuato il check sul nome utente -> val boolean
            $table->timestamps();

            $table->integer('work_at')->unsigned();
        });

        Schema::table('users', function ($table) {
            $table->foreign('work_at')->references('id')->on('agencies');
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
}