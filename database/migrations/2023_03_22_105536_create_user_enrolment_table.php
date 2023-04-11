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
        Schema::create('user_enrolment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('order_id');
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->tinyInteger('usi')->default(0)->comment('0=No,1=Yes');
            $table->string('usi_no')->nullable();
            $table->tinyInteger('obtaining_usi')->default(0)->comment('0=No,1=Yes');
            $table->string('phone_no')->nullable();
            $table->string('emergeny_name')->nullable();
            $table->string('emergeny_relationship')->nullable();
            $table->string('emergeny_tel')->nullable();
            $table->string('emergeny_mobile')->nullable();
            $table->string('employee_status')->nullable();
            $table->string('employment_company')->nullable();
            $table->string('employment_email')->nullable();
            $table->string('employment_contact_person')->nullable();
            $table->string('employment_work_on')->nullable();
            $table->tinyInteger('australian_citizen')->default(0)->comment('0=No,1=Yes');
            $table->string('country_of_birth')->nullable();
            $table->string('visa_classification')->nullable();
            $table->tinyInteger('english_language')->default(0)->comment('0=No,1=Yes');
            $table->text('language_usually_speak')->nullable();
            $table->text('indigenous_status')->nullable();
            $table->tinyInteger('disability_status')->default(0)->comment('0=No,1=Yes');
            $table->text('disability_indicate')->nullable();
            $table->tinyInteger('additional_support')->default(0)->comment('0=No,1=Yes');
            $table->text('specify_support_required')->nullable();
            $table->text('highlighted_camouflaged')->nullable();
            $table->text('highlighted_carried_out')->nullable();
            $table->text('restaurant_bill')->nullable();
            $table->text('lunch_break')->nullable();
            $table->text('withdraw')->nullable();
            $table->text('education_completed')->nullable();
            $table->integer('education_year_completed')->nullable();
            $table->integer('education_month_completed')->nullable();
            $table->tinyInteger('highest_level_education_completed')->default(0)->comment('0=No,1=Yes');
            $table->text('certificate')->nullable();
            $table->text('certificate_discipline')->nullable();
            $table->text('enrolling_reason')->nullable();
            $table->text('enrolling_other_reason')->nullable();
            $table->string('identification_id_type')->nullable();
            $table->string('identification_id')->nullable();
            $table->string('identification_id_sighted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_enrolment');
    }
};