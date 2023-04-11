<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('custaddress', 255)->nullable();
            $table->string('custzipcode')->nullable();
            $table->string('custcity')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0 = Unavailable, 1 = Available')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
