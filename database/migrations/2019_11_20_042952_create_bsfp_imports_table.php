<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBsfpImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsfp_imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('period');
            $table->integer('year');
            $table->integer('month');
            $table->string('programPartner')->nullable();
            $table->string('partner')->nullable();
            $table->string('campSettlement')->nullable();
            $table->string('siteName')->nullable();
            $table->string('campId')->nullable();
            
            $table->integer('beginningMonthTotal')->nullable()->default(0);
            $table->integer('beginningMonth23M')->nullable()->default(0);
            $table->integer('beginningMonth23F')->nullable()->default(0);
            $table->integer('beginningMonth59M')->nullable()->default(0);
            $table->integer('beginningMonth59F')->nullable()->default(0);
            $table->integer('newEnrolmentTotal')->nullable()->default(0);
            $table->integer('newEnrolment23M')->nullable()->default(0);
            $table->integer('newEnrolment23F')->nullable()->default(0);
            $table->integer('newEnrolment59M')->nullable()->default(0);
            $table->integer('newEnrolment59F')->nullable()->default(0);
            $table->integer('readmissionAfterDefaultTotal')->nullable()->default(0);
            $table->integer('readmissionAfterDefault23M')->nullable()->default(0);
            $table->integer('readmissionAfterDefault23F')->nullable()->default(0);
            $table->integer('readmissionAfterDefault59M')->nullable()->default(0);
            $table->integer('readmissionAfterDefault59F')->nullable()->default(0);
            $table->integer('transferInFromOtherBsfpTotal')->nullable()->default(0);
            $table->integer('transferInFromOtherBsfp23M')->nullable()->default(0);
            $table->integer('transferInFromOtherBsfp23F')->nullable()->default(0);
            $table->integer('transferInFromOtherBsfp59M')->nullable()->default(0);
            $table->integer('transferInFromOtherBsfp59F')->nullable()->default(0);
            $table->integer('returnFromMamTreatmentTotal')->nullable()->default(0);
            $table->integer('returnFromMamTreatment23M')->nullable()->default(0);
            $table->integer('returnFromMamTreatment23F')->nullable()->default(0);
            $table->integer('returnFromMamTreatment59M')->nullable()->default(0);
            $table->integer('returnFromMamTreatment59F')->nullable()->default(0);
            $table->integer('totalAdmission')->nullable()->default(0);
            $table->integer('totalAdmission23M')->nullable()->default(0);
            $table->integer('totalAdmission23F')->nullable()->default(0);
            $table->integer('totalAdmission59M')->nullable()->default(0);
            $table->integer('totalAdmission59F')->nullable()->default(0);
            $table->integer('discharge59Total')->nullable()->default(0);
            $table->integer('discharge23M')->nullable()->default(0);
            $table->integer('discharge23F')->nullable()->default(0);
            $table->integer('discharge59M')->nullable()->default(0);
            $table->integer('discharge59F')->nullable()->default(0);
            $table->integer('defaulterTotal')->nullable()->default(0);
            $table->integer('defaulter23M')->nullable()->default(0);
            $table->integer('defaulter23F')->nullable()->default(0);
            $table->integer('defaulter59M')->nullable()->default(0);
            $table->integer('defaulter59F')->nullable()->default(0);
            $table->integer('deathTotal')->nullable()->default(0);
            $table->integer('death23M')->nullable()->default(0);
            $table->integer('death23F')->nullable()->default(0);
            $table->integer('death59M')->nullable()->default(0);
            $table->integer('death59F')->nullable()->default(0);
            $table->integer('totalTransferOut')->nullable()->default(0);
            $table->integer('totalTransferOut23M')->nullable()->default(0);
            $table->integer('totalTransferOut23F')->nullable()->default(0);
            $table->integer('totalTransferOut59M')->nullable()->default(0);
            $table->integer('totalTransferOut59F')->nullable()->default(0);
            $table->integer('transferToSamTotal')->nullable()->default(0);
            $table->integer('transferToSam23M')->nullable()->default(0);
            $table->integer('transferToSam23F')->nullable()->default(0);
            $table->integer('transferToSam59M')->nullable()->default(0);
            $table->integer('transferToSam59F')->nullable()->default(0);
            $table->integer('transferToMamTotal')->nullable()->default(0);
            $table->integer('transferToMam23M')->nullable()->default(0);
            $table->integer('transferToMam23F')->nullable()->default(0);
            $table->integer('transferToMam59M')->nullable()->default(0);
            $table->integer('transferToMam59F')->nullable()->default(0);
            $table->integer('othersTotal')->nullable()->default(0);
            $table->integer('others23M')->nullable()->default(0);
            $table->integer('others23F')->nullable()->default(0);
            $table->integer('others59M')->nullable()->default(0);
            $table->integer('others59F')->nullable()->default(0);
            $table->integer('totalExits')->nullable()->default(0);
            $table->integer('exits23M')->nullable()->default(0);
            $table->integer('exits23F')->nullable()->default(0);
            $table->integer('exits59M')->nullable()->default(0);
            $table->integer('exits59F')->nullable()->default(0);
            $table->integer('atTheEndTotal')->nullable()->default(0);
            $table->integer('atTheEnd23M')->nullable()->default(0);
            $table->integer('atTheEnd23F')->nullable()->default(0);
            $table->integer('atTheEnd59M')->nullable()->default(0);
            $table->integer('atTheEnd59F')->nullable()->default(0);
            $table->integer('reachedTotal')->nullable()->default(0);
            $table->integer('reached23M')->nullable()->default(0);
            $table->integer('reached23F')->nullable()->default(0);
            $table->integer('reached59M')->nullable()->default(0);
            $table->integer('reached59F')->nullable()->default(0);
            $table->integer('growthMonitoredTotal')->nullable()->default(0);
            $table->integer('growthMonitored23M')->nullable()->default(0);
            $table->integer('growthMonitored23F')->nullable()->default(0);
            $table->integer('growthMonitored59M')->nullable()->default(0);
            $table->integer('growthMonitored59F')->nullable()->default(0);
            $table->integer('mamTotal')->nullable()->default(0);
            $table->integer('samTotal')->nullable()->default(0);
            $table->decimal('prevalenceOfWasting_AcuteMalnutrition',5,2)->nullable()->default(0.00);
            $table->integer('stunting')->nullable()->default(0);
            $table->integer('prevalenceOfStunting')->nullable()->default(0);
            $table->integer('absentees')->nullable()->default(0);
            $table->integer('atTheBeginningOfTheMonthPlw')->nullable()->default(0);
            $table->integer('newAdmissionPlw')->nullable()->default(0);
            $table->integer('readmissionAfterDefault')->nullable()->default(0);
            $table->integer('transferInFromOtherBsfpPlw')->nullable()->default(0);
            $table->integer('referFromTsfp')->nullable()->default(0);
            $table->integer('others2')->nullable()->default(0);
            $table->integer('totalAdmissionPlw')->nullable()->default(0);
            $table->integer('dischargePlw')->nullable()->default(0);
            $table->integer('transferToOtherTsfpPlw')->nullable()->default(0);
            $table->integer('transferOutOtherBsfpPlw')->nullable()->default(0);
            $table->integer('defaulterPlw')->nullable()->default(0);
            $table->integer('deathPlw')->nullable()->default(0);
            $table->integer('unexpectedDiscontinuationPregnancy')->nullable()->default(0);
            $table->integer('otherPlw')->nullable()->default(0);
            $table->integer('totalExistPlw')->nullable()->default(0);
            $table->integer('totalBeneficiaryAtTheEndPLW')->nullable()->default(0);
            $table->integer('reachedBeneficiariesBsfp')->nullable()->default(0);
            $table->integer('absentees2')->nullable()->default(0);
            $table->decimal('wsb_distributedPlw',5,2)->nullable()->default(0.00);
            $table->decimal('vegetableOilDistributedPlw',5,2)->nullable()->default(0.00);
            $table->integer('otherSpecifyPlw')->nullable()->default(0);
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
        Schema::dropIfExists('bsfp_imports');
    }
}
