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
        Schema::table('calendars', function (Blueprint $table) {
            DB::statement("ALTER TABLE calendars CHANGE COLUMN `type` `type` ENUM('0', '1', '2', '3') NULL DEFAULT '0' COMMENT '0 = User, 1 = Course, 2 = Category, 3 = Site'");
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendars', function (Blueprint $table) {
            DB::statement("ALTER TABLE calendars CHANGE COLUMN `type` `type` ENUM('0', '1', '2') NULL DEFAULT '0' COMMENT '0 = User, 1 = Category, 2 = Site'");
            $table->dropColumn('type_id');
        });
    }
};
