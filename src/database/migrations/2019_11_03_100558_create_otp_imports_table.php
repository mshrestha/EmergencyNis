<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtpImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otp_imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('period');
            $table->integer('year');
            $table->integer('month');
            $table->string('programPartner')->nullable();
            $table->string('partner')->nullable();
            $table->string('campSettlement')->nullable();
            $table->string('siteName')->nullable();
            $table->string('campId')->nullable();
//            $table->string('reportingStatus')->nullable();
            $table->string('extendedCriteria')->nullable();
            $table->string('age')->nullable();
            $table->integer('beginningMonth_M')->nullable()->default(0);
            $table->integer('beginningMonth_F')->nullable()->default(0);
            $table->integer('beginningMonthTotal')->nullable()->default(0);
            $table->integer('enrolmentMuc_M')->nullable()->default(0);
            $table->integer('enrolmentMuc_F')->nullable()->default(0);
            $table->integer('enrolmentWfh_M')->nullable()->default(0);
            $table->integer('enrolmentWfh_F')->nullable()->default(0);
            $table->integer('enrolmentBoth_M')->nullable()->default(0);
            $table->integer('enrolmentBoth_F')->nullable()->default(0);
            $table->integer('enrolmentEdema_M')->nullable()->default(0);
            $table->integer('enrolmentEdema_F')->nullable()->default(0);
            $table->integer('enrolmentRelapse_M')->nullable()->default(0);
            $table->integer('enrolmentRelapse_F')->nullable()->default(0);
            $table->integer('transferFromBsfp_M')->nullable()->default(0);
            $table->integer('transferFromBsfp_F')->nullable()->default(0);
            $table->integer('inpatientTreatment_M')->nullable()->default(0);
            $table->integer('inpatientTreatment_F')->nullable()->default(0);
            $table->integer('totalNewEnrolment_M')->nullable()->default(0);
            $table->integer('totalNewEnrolment_F')->nullable()->default(0);
            $table->integer('totalNewEnrolment')->nullable()->default(0);
            $table->integer('transferDefault_M')->nullable()->default(0);
            $table->integer('transferDefault_F')->nullable()->default(0);
            $table->integer('transferFromTsfp_M')->nullable()->default(0);
            $table->integer('transferFromTsfp_F')->nullable()->default(0);
            $table->integer('transferFromInp_M')->nullable()->default(0);
            $table->integer('transferFromInp_F')->nullable()->default(0);
            $table->integer('transferInOtherOtp_M')->nullable()->default(0);
            $table->integer('transferInOtherOtp_F')->nullable()->default(0);
            $table->integer('totalTransferIn_M')->nullable()->default(0);
            $table->integer('totalTransferIn_F')->nullable()->default(0);
            $table->integer('totalTransferIn')->nullable()->default(0);
            $table->integer('totalEnrolment_M')->nullable()->default(0);
            $table->integer('totalEnrolment_F')->nullable()->default(0);
            $table->integer('totalEnrolment')->nullable()->default(0);
            $table->integer('recovered_M')->nullable()->default(0);
            $table->integer('recovered_F')->nullable()->default(0);
            $table->integer('death_M')->nullable()->default(0);
            $table->integer('death_F')->nullable()->default(0);
            $table->integer('default_M')->nullable()->default(0);
            $table->integer('default_F')->nullable()->default(0);
            $table->integer('nonRecovered_M')->nullable()->default(0);
            $table->integer('nonRecovered_F')->nullable()->default(0);
            $table->integer('totalDischarged_M')->nullable()->default(0);
            $table->integer('totalDischarged_F')->nullable()->default(0);
            $table->integer('totalDischarged')->nullable()->default(0);
            $table->integer('medicalTransfer_M')->nullable()->default(0);
            $table->integer('medicalTransfer_F')->nullable()->default(0);
            $table->integer('unknown_M')->nullable()->default(0);
            $table->integer('unknown_F')->nullable()->default(0);
            $table->integer('transferSc_M')->nullable()->default(0);
            $table->integer('transferSc_F')->nullable()->default(0);
            $table->integer('transferOutOtherOtp_M')->nullable()->default(0);
            $table->integer('transferOutOtherOtp_F')->nullable()->default(0);
            $table->integer('totalExit_M')->nullable()->default(0);
            $table->integer('totalExit_F')->nullable()->default(0);
            $table->integer('totalExit')->nullable()->default(0);
            $table->integer('totalEndOfMonth_M')->nullable()->default(0);
            $table->integer('totalEndOfMonth_F')->nullable()->default(0);
            $table->integer('totalEndOfMonth')->nullable()->default(0);
            $table->integer('totalTransferFromOther')->nullable()->default(0);
            $table->integer('totalCured')->nullable()->default(0);
            $table->integer('totalDeath')->nullable()->default(0);
            $table->integer('totalDefault')->nullable()->default(0);
            $table->integer('totalNonRecovered')->nullable()->default(0);
            $table->decimal('curedRate',5,2)->nullable()->default(0.00);
            $table->decimal('deathRate',5,2)->nullable()->default(0.00);
            $table->decimal('defaultRate',5,2)->nullable()->default(0.00);
            $table->decimal('nonRecoveredRate',5,2)->nullable()->default(0.00);
            $table->integer('totalNewAdmissionCalculated')->nullable()->default(0);
            $table->integer('difference')->nullable()->default(0);
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
        Schema::dropIfExists('otp_imports');
    }
}
