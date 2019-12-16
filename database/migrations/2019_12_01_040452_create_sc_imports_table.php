<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sc_imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('period');
            $table->integer('year');
            $table->integer('month');
            $table->string('programPartner')->nullable();
            $table->string('partner')->nullable();
            $table->string('campSettlement')->nullable();
            $table->string('siteName')->nullable();
            $table->string('campId')->nullable();
            $table->string('reportMode')->nullable();
            $table->string('ageGroup')->nullable();
            $table->integer('beginningMonth_M')->nullable()->default(0);
            $table->integer('beginningMonth_F')->nullable()->default(0);
            $table->integer('beginningMonthTotal')->nullable()->default(0);
            $table->integer('newAdmissionWfh_M')->nullable()->default(0);
            $table->integer('newAdmissionWfh_F')->nullable()->default(0);
            $table->integer('newAdmissionMuc_M')->nullable()->default(0);
            $table->integer('newAdmissionMuc_F')->nullable()->default(0);
            $table->integer('newAdmissionEdema_M')->nullable()->default(0);
            $table->integer('newAdmissionEdema_F')->nullable()->default(0);
            $table->integer('newAdmissionRelapse_M')->nullable()->default(0);
            $table->integer('newAdmissionRelapse_F')->nullable()->default(0);
            $table->integer('totalNewAdmission_M')->nullable()->default(0);
            $table->integer('totalNewAdmission_F')->nullable()->default(0);
            $table->integer('totalNewAdmission')->nullable()->default(0);
            $table->integer('readmissionAfterDefault_M')->nullable()->default(0);
            $table->integer('readmissionAfterDefault_F')->nullable()->default(0);
            $table->integer('transferInFromOtp_M')->nullable()->default(0);
            $table->integer('transferInFromOtp_F')->nullable()->default(0);
            $table->integer('totalEntries_M')->nullable()->default(0);
            $table->integer('totalEntries_F')->nullable()->default(0);
            $table->integer('totalEntries')->nullable()->default(0);
            $table->integer('recovered_M')->nullable()->default(0);
            $table->integer('recovered_F')->nullable()->default(0);
            $table->integer('death_M')->nullable()->default(0);
            $table->integer('death_F')->nullable()->default(0);
            $table->integer('default_M')->nullable()->default(0);
            $table->integer('default_F')->nullable()->default(0);
            $table->integer('nonRecovered_M')->nullable()->default(0);
            $table->integer('nonRecovered_F')->nullable()->default(0);
            $table->integer('unknown_M')->nullable()->default(0);
            $table->integer('unknown_F')->nullable()->default(0);
            $table->integer('medicalTransfer_M')->nullable()->default(0);
            $table->integer('medicalTransfer_F')->nullable()->default(0);
            $table->integer('transferToOtp_M')->nullable()->default(0);
            $table->integer('transferToOtp_F')->nullable()->default(0);
            $table->integer('totalDischarged_M')->nullable()->default(0);
            $table->integer('totalDischarged_F')->nullable()->default(0);
            $table->integer('totalDischarged')->nullable()->default(0);
            $table->integer('exitOther_M')->nullable()->default(0);
            $table->integer('exitOther_F')->nullable()->default(0);
            $table->integer('totalExit_M')->nullable()->default(0);
            $table->integer('totalExit_F')->nullable()->default(0);
            $table->integer('totalExit')->nullable()->default(0);
            $table->integer('totalEndOfMonth_M')->nullable()->default(0);
            $table->integer('totalEndOfMonth_F')->nullable()->default(0);
            $table->integer('totalEndOfMonth')->nullable()->default(0);
            $table->integer('alos')->nullable()->default(0);
            $table->integer('awg')->nullable()->default(0);

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
        Schema::dropIfExists('sc_imports');
    }
}
