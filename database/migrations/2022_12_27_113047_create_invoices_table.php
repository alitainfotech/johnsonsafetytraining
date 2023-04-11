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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('companyname', 255)->nullable();
            $table->string('taxid')->nullable();
            $table->string('companyaddress', 255)->nullable();
            $table->string('companyzipcode')->nullable();
            $table->string('companycity')->nullable();
            $table->string('companystate')->nullable();
            $table->string('companycountry')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
