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
        Schema::create('calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->nullable();
            $table->timestamp('start_at')->nullable();
            $table->enum('type', ['0', '1', '2'])->default('0')->comment('0 = User, 1 = Category, 2 = Site')->nullable();
            $table->longText('description')->nullable();
            $table->string('location', 255)->nullable();
            $table->enum('duration_type', ['0', '1', '2'])->default('0')->comment('0 = Without Duration, 1 = Unitil, 2 = Duration In Minute')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('duration_in_minute', 255)->nullable();
            $table->enum('is_repeat', ['0', '1'])->default('0')->comment('0 = No, 1 = Yes')->nullable();
            $table->string('repeat_times')->nullable();
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
        Schema::dropIfExists('calendars');
    }
};
