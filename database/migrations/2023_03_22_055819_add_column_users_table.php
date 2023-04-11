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
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->after('id')->nullable();
            $table->string('lastname')->after('user_name')->nullable();
            $table->string('gender')->after('password')->nullable();
            $table->date('date_of_birth')->after('gender')->nullable();
            $table->string('town_of_birth')->after('date_of_birth')->nullable();
            $table->string('country_of_birth')->after('town_of_birth')->nullable();
            $table->string('state')->after('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};