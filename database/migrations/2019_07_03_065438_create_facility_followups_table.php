<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_followups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->bigInteger('children_id')->unsigned();
            $table->foreign('children_id')->references('id')->on('children')->onDelete('cascade');
            $table->enum('refered_by', ['CNV', 'BSFP', 'TSFP', 'Other service center', 'Self', 'Others'])->nullable();
            $table->string('referal_slip_no')->nullable();
            $table->date('date')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->integer('age')->nullable();
            $table->enum('attandance', ['present', 'absent'])->nullable();
            $table->integer('muac')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->string('wfh_z_score')->nullable();
            $table->enum('oedema', ['0', '+', '++', '+++'])->nullable();
            $table->integer('medical_history_diarrhoea')->nullable();
            $table->integer('medical_history_vomiting')->nullable();
            $table->integer('medical_history_fever')->nullable();
            $table->integer('medical_history_cough')->nullable();
            $table->integer('medical_history_others')->nullable();
            $table->string('medical_history_others_detail')->nullable();
            $table->integer('temperature')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->enum('sign_of_dehydration', ['Yes', 'No'])->nullable();
            $table->enum('pneumonia', ['Yes', 'No', 'Severe'])->nullable();
            $table->enum('skin_changes', ['Yes', 'No'])->nullable();
            $table->enum('pale_conjunctiva', ['Yes', 'No'])->nullable();
            $table->enum('presence_of_appetite', ['Yes', 'No'])->nullable();
            $table->enum('new_admission', ['MUAC', 'WFH Zscore', 'Oedema', 'Age 6 to 59m'])->nullable();
            $table->enum('readmission', ['Readmission after default', 'Readmission after recovery'])->nullable();
            $table->enum('transfer_in', ['Transfer in from TSFP', 'Transfer in from SC', 'Transfer in from OTP', 'Transfer in from BSFP'])->nullable();
            $table->enum('return_from', ['SAM Treatment', 'MAM Treatement'])->nullable();
            $table->enum('antibiotic', ['125mg (6-11m)', '187.5mg (12-23m)', '250mg (24-59m)'])->nullable();
            $table->enum('albendazole', ['200mg (12-23m)', '400mg (>24m)'])->nullable();
            $table->integer('no_of_rutf')->nullable();
            $table->integer('no_of_rusf')->nullable();
            $table->integer('wsb_plus_plus_kg')->nullable();
            $table->integer('wsb_plus_kg')->nullable();
            $table->integer('oil_kg')->nullable();
            $table->integer('others')->nullable();
            $table->enum('discharge_criteria_exit', ['Recovered/Age>59m', 'Death', 'Defaulted', 'Non recovered'])->nullable();
            $table->enum('discharge_criteria_transfer_out', ['Transfer to SAM treatment', 'Transfer to MAM treatment', 'Transfer to SC', 'Transfer to other OTP', 'Transfer to other TSFP', 'Transfer to other BSFP'])->nullable();
            $table->enum('discharge_criteria_others', ['Medical transfer', 'Unkown'])->nullable();
            $table->integer('discharge_weight_kg')->nullable();
            $table->integer('lowest_weight_kg')->nullable();
            $table->integer('duration_between_lowest_weight_and_discharged_weight_days')->nullable();
            $table->integer('gain_of_weight')->nullable();
            $table->integer('duration_between_discharged_and_admission_days')->nullable();
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
        Schema::dropIfExists('facility_followups');
    }
}
