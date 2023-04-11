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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name', 255)->nullable();
            $table->string('user_name', 255)->nullable();
            $table->string('email', 191)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0 = Inactive, 1 = Active')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
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
