<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function otpApi($report_year, $report_month)
    {
//        dd($report_year);
        $otp_info = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSettlement'),
                DB::raw('sum(beginningMonth_M) as beginningMonth_M'), DB::raw('sum(beginningMonth_F) as beginningMonth_F'), DB::raw('sum(beginningMonthTotal) as beginningMonthTotal'),
                DB::raw('sum(totalNewEnrolment_M) as totalNewEnrolment_M'), DB::raw('sum(totalNewEnrolment_F) as totalNewEnrolment_F'), DB::raw('sum(totalNewEnrolment) as totalNewEnrolment'),
                DB::raw('sum(totalEnrolment_M) as totalEnrolment_M'), DB::raw('sum(totalEnrolment_F) as totalEnrolment_F'), DB::raw('sum(totalEnrolment) as totalEnrolment'),
                DB::raw('sum(totalTransferFromOther) as totalTransferFromOther'), DB::raw('sum(totalDischarged) as totalDischarged'),
                DB::raw('sum(totalCured) as totalCured'), DB::raw('sum(totalDefault) as totalDefault'), DB::raw('sum(totalDeath) as totalDeath'),
                DB::raw('sum(totalNonRecovered) as totalNonRecovered'),
                DB::raw('sum(transferSc_M) as transferSc_M'), DB::raw('sum(transferSc_F) as transferSc_F'),
                DB::raw('sum(enrolmentMuc_M) as enrolmentMuc_M'), DB::raw('sum(enrolmentMuc_F) as enrolmentMuc_F'),
                DB::raw('sum(enrolmentWfh_M) as enrolmentWfh_M'), DB::raw('sum(enrolmentWfh_F) as enrolmentWfh_F'),
                DB::raw('sum(enrolmentBoth_M) as enrolmentBoth_M'), DB::raw('sum(enrolmentBoth_F) as enrolmentBoth_F'),
                DB::raw('sum(enrolmentEdema_M) as enrolmentEdema_M'), DB::raw('sum(enrolmentEdema_F) as enrolmentEdema_F'),
                DB::raw('sum(enrolmentRelapse_M) as enrolmentRelapse_M'), DB::raw('sum(enrolmentRelapse_F) as enrolmentRelapse_F'),
                DB::raw('sum(totalEndOfMonth_M) as totalEndOfMonth_M'), DB::raw('sum(totalEndOfMonth_F) as totalEndOfMonth_F'),
                DB::raw('sum(alos) as alos'), DB::raw('sum(awg) as awg')
            )
            ->where('month', $report_month)->where('year', $report_year)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
            ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        $campSettlement = [];
        $curedRate = [];
        $deathRate = [];
        $defaultRate = [];
        $nonRecoveredRate = [];
        $beginningMonth_M = [];
        $beginningMonth_F = [];
        $beginningMonthTotal = [];
        $totalNewEnrolment_M = [];
        $totalNewEnrolment_F = [];
        $totalNewEnrolment = [];
        $totalEnrolment_M = [];
        $totalEnrolment_F = [];
        $totalEnrolment = [];
        $totalTransferFromOther = [];
        $totalDischarged = [];
        $totalCured = [];
        $totalDefault = [];
        $totalDeath = [];
        $totalNonRecovered = [];
        $transferSc_M = [];
        $transferSc_F = [];
        $enrolmentMuc_M = [];
        $enrolmentMuc_F = [];
        $enrolmentWfh_M = [];
        $enrolmentWfh_F = [];
        $enrolmentBoth_M = [];
        $enrolmentBoth_F = [];
        $enrolmentEdema_M = [];
        $enrolmentEdema_F = [];
        $enrolmentRelapse_M = [];
        $enrolmentRelapse_F = [];
        $totalEndOfMonth_M = [];
        $totalEndOfMonth_F = [];
        $alos = [];
        $awg = [];
        foreach ($otp_info as $bc) {
            for ($i = 0; $i < count($otp_info); $i++) ;
            $campSettlement[] = $bc->campSettlement;
            $curedRate[] = ($bc->totalDischarged == 0) ? 0 : (($bc->totalCured / $bc->totalDischarged) * 100);
            $deathRate[] = ($bc->totalDischarged == 0) ? 0 : (($bc->totalDeath / $bc->totalDischarged) * 100);
            $defaultRate[] = ($bc->totalDischarged == 0) ? 0 : (($bc->totalDefault / $bc->totalDischarged) * 100);
            $nonRecoveredRate[] = ($bc->totalDischarged == 0) ? 0 : (($bc->totalNonRecovered / $bc->totalDischarged) * 100);
            $beginningMonth_M[] = $bc->beginningMonth_M;
            $beginningMonth_F[] = $bc->beginningMonth_F;
            $beginningMonthTotal[] = $bc->beginningMonthTotal;
            $totalNewEnrolment_M[] = $bc->totalNewEnrolment_M;
            $totalNewEnrolment_F[] = $bc->totalNewEnrolment_F;
            $totalEnrolment_M[] = $bc->totalEnrolment_M;
            $totalEnrolment_F[] = $bc->totalEnrolment_F;
            $totalEnrolment[] = $bc->totalEnrolment;
            $totalTransferFromOther[] = $bc->totalTransferFromOther;
            $totalDischarged[] = $bc->totalDischarged;
            $totalCured[] = $bc->totalCured;
            $totalDefault[] = $bc->totalDefault;
            $totalDeath[] = $bc->totalDeath;
            $totalNonRecovered[] = $bc->totalNonRecovered;
            $transferSc_M[] = $bc->transferSc_M;
            $transferSc_F[] = $bc->transferSc_F;
            $enrolmentMuc_M[] = $bc->enrolmentMuc_M;
            $enrolmentMuc_F[] = $bc->enrolmentMuc_F;
            $enrolmentWfh_M[] = $bc->enrolmentWfh_M;
            $enrolmentWfh_F[] = $bc->enrolmentWfh_F;
            $enrolmentBoth_M[] = $bc->enrolmentBoth_M;
            $enrolmentBoth_F[] = $bc->enrolmentBoth_F;
            $enrolmentEdema_M[] = $bc->enrolmentEdema_M;
            $enrolmentEdema_F[] = $bc->enrolmentEdema_F;
            $enrolmentRelapse_M[] = $bc->enrolmentRelapse_M;
            $enrolmentRelapse_F[] = $bc->enrolmentRelapse_F;
            $totalEndOfMonth_M[] = $bc->totalEndOfMonth_M;
            $totalEndOfMonth_F[] = $bc->totalEndOfMonth_F;
            $alos[] = $bc->alos;
            $awg[] = $bc->awg;
        }
        $otpapi['campSettlement'] = $campSettlement;
        $otpapi['curedRate'] = $curedRate;
        $otpapi['deathRate'] = $deathRate;
        $otpapi['defaultRate'] = $defaultRate;
        $otpapi['nonRecoveredRate'] = $nonRecoveredRate;
        $otpapi['beginningMonth_M'] = $beginningMonth_M;
        $otpapi['beginningMonth_F'] = $beginningMonth_F;
        $otpapi['beginningMonthTotal'] = $beginningMonthTotal;
        $otpapi['totalNewEnrolment_M'] = $totalNewEnrolment_M;
        $otpapi['totalNewEnrolment_F'] = $totalNewEnrolment_F;
        $otpapi['totalNewEnrolment'] = $totalNewEnrolment;
        $otpapi['totalEnrolment_M'] = $totalEnrolment_M;
        $otpapi['totalEnrolment_F'] = $totalEnrolment_F;
        $otpapi['totalEnrolment'] = $totalEnrolment;
        $otpapi['totalTransferFromOther'] = $totalTransferFromOther;
        $otpapi['totalDischarged'] = $totalDischarged;
        $otpapi['totalCured'] = $totalCured;
        $otpapi['totalDefault'] = $totalDefault;
        $otpapi['totalDeath'] = $totalDeath;
        $otpapi['totalNonRecovered'] = $totalNonRecovered;
        $otpapi['transferSc_M'] = $transferSc_M;
        $otpapi['transferSc_F'] = $transferSc_F;
        $otpapi['enrolmentMuc_M'] = $enrolmentMuc_M;
        $otpapi['enrolmentMuc_F'] = $enrolmentMuc_F;
        $otpapi['enrolmentWfh_M'] = $enrolmentWfh_M;
        $otpapi['enrolmentWfh_F'] = $enrolmentWfh_M;
        $otpapi['enrolmentBoth_M'] = $enrolmentBoth_M;
        $otpapi['enrolmentBoth_F'] = $enrolmentBoth_F;
        $otpapi['enrolmentEdema_M'] = $enrolmentEdema_M;
        $otpapi['enrolmentEdema_F'] = $enrolmentEdema_F;
        $otpapi['enrolmentRelapse_M'] = $enrolmentRelapse_M;
        $otpapi['enrolmentRelapse_F'] = $enrolmentRelapse_F;
        $otpapi['totalEndOfMonth_M'] = $totalEndOfMonth_M;
        $otpapi['totalEndOfMonth_F'] = $totalEndOfMonth_F;
        $otpapi['alos'] = $alos;
        $otpapi['awg'] = $awg;

        return $otpapi;
    }

    public function tsfpApi($report_year, $report_month)
    {
        $tsfp_info = DB::table('tsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSettlement'),
                DB::raw('sum(beginningMonthTotal) as beginningMonthTotal'),
                DB::raw('sum(newEnrolmentMuacTotal) as newEnrolmentMuacTotal'),
                DB::raw('sum(newEnrolmentWfhTotal) as newEnrolmentWfhTotal'),
                DB::raw('sum(readmissionAfterDefaultTotal) as readmissionAfterDefaultTotal'),
                DB::raw('sum(readmissionAfterRecoveryTotal) as readmissionAfterRecoveryTotal'),
                DB::raw('sum(transferInFromTsfpTotal) as transferInFromTsfpTotal'),
                DB::raw('sum(returnFromSamTotal) as returnFromSamTotal'),
                DB::raw('sum(admissionTotal) as admissionTotal'),

                DB::raw('sum(dischargeCuredToBsfpTotal) as totalCured'),
                DB::raw('sum(defaultTotal) as totalDefault'),
                DB::raw('sum(deathTotal) as totalDeath'),
                DB::raw('sum(nonResponseTotal) as totalNonRecovered'),

//                DB::raw('sum(dischargeCuredToBsfpTotal) as dischargeCuredToBsfpTotal'),
//                DB::raw('sum(defaultTotal) as defaultTotal'),
//                DB::raw('sum(deathTotal) as deathTotal'),
//                DB::raw('sum(nonResponseTotal) as nonResponseTotal'),
                DB::raw('sum(transferToSamTreatmentTotal) as transferToSamTreatmentTotal'),
                DB::raw('sum(transferOutToTsfpTotal) as transferOutToTsfpTotal'),
                DB::raw('sum(othersTotal) as othersTotal'),
                DB::raw('sum(exitTotal) as exitTotal'),
                DB::raw('sum(endOfMonthTotal) as endOfMonthTotal'),
                DB::raw('sum(reachedTotal) as reachedTotal'),
                DB::raw('sum(tsfpChildNewAdmissionM) as tsfpChildNewAdmissionM'),
                DB::raw('sum(tsfpChildNewAdmissionF) as tsfpChildNewAdmissionF'),
                DB::raw('sum(newAdmissionTotal) as newAdmissionTotal'),
                DB::raw('sum(newAdmissionTotal) as newAdmissionTotal'),

                DB::raw('sum(atTheBeginningOfTheMonthPlw) as atTheBeginningOfTheMonthPlw'),
                DB::raw('sum(newAdmissionPlw) as newAdmissionPlw'),
                DB::raw('sum(readmissionAfterBeingdefault) as readmissionAfterBeingdefault'),
                DB::raw('sum(referFromBsfpPlw) as referFromBsfpPlw'),
                DB::raw('sum(transferInFromOtherTsfpPlw) as transferInFromOtherTsfpPlw'),
                DB::raw('sum(totalAdmissionPlw) as totalAdmissionPlw'),
                DB::raw('sum(dischargeCuredPlwToBsfp) as dischargeCuredPlwToBsfp'),
                DB::raw('sum(dischargePlw) as dischargePlw'),
                DB::raw('sum(transferOutToOtherTsfpPlw) as transferOutToOtherTsfpPlw'),
                DB::raw('sum(defaulterPlw) as defaulterPlw'),
                DB::raw('sum(deathPlw) as deathPlw'),
                DB::raw('sum(otherPlw) as otherPlw'),
                DB::raw('sum(totalExistPlw) as totalExistPlw'),
                DB::raw('sum(totalBeneficiaryAtTheEndPlw) as totalBeneficiaryAtTheEndPlw')
            )
            ->where('month', $report_month)->where('year', $report_year)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
            ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        $campSettlement = [];
        $curedRate = [];
        $deathRate = [];
        $defaultRate = [];
        $nonRecoveredRate = [];
        $beginningMonthTotal = [];
        $newEnrolmentMuacTotal = [];
        $newEnrolmentWfhTotal = [];
        $readmissionAfterRecoveryTotal = [];
        $transferInFromTsfpTotal = [];
        $returnFromSamTotal = [];
        $admissionTotal = [];
        $dischargeCuredToBsfpTotal = [];
        $defaultTotal = [];
        $deathTotal = [];
        $nonResponseTotal = [];
        $transferToSamTreatmentTotal = [];
        $transferOutToTsfpTotal = [];
        $othersTotal = [];
        $exitTotal = [];
        $endOfMonthTotal = [];
        $reachedTotal = [];
        $tsfpChildNewAdmissionM = [];
        $tsfpChildNewAdmissionF = [];
        $newAdmissionTotal = [];

        $atTheBeginningOfTheMonthPlw = [];
        $newAdmissionPlw = [];
        $readmissionAfterBeingdefault = [];
        $referFromBsfpPlw = [];
        $transferInFromOtherTsfpPlw = [];
        $totalAdmissionPlw = [];
        $dischargeCuredPlwToBsfp = [];
        $dischargePlw = [];
        $transferOutToOtherTsfpPlw = [];
        $defaulterPlw = [];
        $deathPlw = [];
        $otherPlw = [];
        $totalExistPlw = [];
        $totalBeneficiaryAtTheEndPlw = [];

        foreach ($tsfp_info as $tsfp) {
            for ($i = 0; $i < count($tsfp_info); $i++) ;
            $campSettlement[] = $tsfp->campSettlement;
            $curedRate[] = ($tsfp->totalCured == 0) ? 0 : ($tsfp->totalCured / ($tsfp->totalCured + $tsfp->totalDefault + $tsfp->totalDeath + $tsfp->totalNonRecovered)) * 100;
            $deathRate[] = ($tsfp->totalDeath == 0) ? 0 : ($tsfp->totalDeath / ($tsfp->totalCured + $tsfp->totalDefault + $tsfp->totalDeath + $tsfp->totalNonRecovered)) * 100;
            $defaultRate[] = ($tsfp->totalDefault == 0) ? 0 : ($tsfp->totalDefault / ($tsfp->totalCured + $tsfp->totalDefault + $tsfp->totalDeath + $tsfp->totalNonRecovered)) * 100;
            $nonRecoveredRate[] = ($tsfp->totalNonRecovered == 0) ? 0 : ($tsfp->totalNonRecovered / ($tsfp->totalCured + $tsfp->totalDefault + $tsfp->totalDeath + $tsfp->totalNonRecovered)) * 100;

            $beginningMonthTotal[] = $tsfp->beginningMonthTotal;
            $newEnrolmentMuacTotal[] = $tsfp->newEnrolmentMuacTotal;
            $newEnrolmentWfhTotal[] = $tsfp->newEnrolmentWfhTotal;
            $readmissionAfterRecoveryTotal[] = $tsfp->readmissionAfterRecoveryTotal;
            $transferInFromTsfpTotal[] = $tsfp->transferInFromTsfpTotal;
            $returnFromSamTotal[] = $tsfp->returnFromSamTotal;
            $admissionTotal[] = $tsfp->admissionTotal;
            $dischargeCuredToBsfpTotal[] = $tsfp->totalCured;
            $defaultTotal[] = $tsfp->totalDefault;
            $deathTotal[] = $tsfp->totalDeath;
            $nonResponseTotal[] = $tsfp->totalNonRecovered;
            $transferToSamTreatmentTotal[] = $tsfp->transferToSamTreatmentTotal;
            $transferOutToTsfpTotal[] = $tsfp->transferOutToTsfpTotal;
            $othersTotal[] = $tsfp->othersTotal;
            $exitTotal[] = $tsfp->exitTotal;
            $endOfMonthTotal[] = $tsfp->endOfMonthTotal;
            $reachedTotal[] = $tsfp->reachedTotal;
            $tsfpChildNewAdmissionM[] = $tsfp->tsfpChildNewAdmissionM;
            $tsfpChildNewAdmissionF[] = $tsfp->tsfpChildNewAdmissionF;
            $newAdmissionTotal[] = $tsfp->newAdmissionTotal;

            $atTheBeginningOfTheMonthPlw[] = $tsfp->atTheBeginningOfTheMonthPlw;
            $newAdmissionPlw[] = $tsfp->newAdmissionPlw;
            $readmissionAfterBeingdefault[] = $tsfp->readmissionAfterBeingdefault;
            $referFromBsfpPlw[] = $tsfp->referFromBsfpPlw;
            $transferInFromOtherTsfpPlw[] = $tsfp->transferInFromOtherTsfpPlw;
            $totalAdmissionPlw[] = $tsfp->totalAdmissionPlw;
            $dischargeCuredPlwToBsfp[] = $tsfp->dischargeCuredPlwToBsfp;
            $dischargePlw[] = $tsfp->dischargePlw;
            $transferOutToOtherTsfpPlw[] = $tsfp->transferOutToOtherTsfpPlw;
            $defaulterPlw[] = $tsfp->defaulterPlw;
            $deathPlw[] = $tsfp->deathPlw;
            $otherPlw[] = $tsfp->otherPlw;
            $totalExistPlw[] = $tsfp->totalExistPlw;
            $totalBeneficiaryAtTheEndPlw [] = $tsfp->totalBeneficiaryAtTheEndPlw;
        }
//        $tsfpapi['awg'] = $awg;
        $tsfpapi['campSettlement'] = $campSettlement;
        $tsfpapi['curedRate'] = $curedRate;
        $tsfpapi['deathRate'] = $deathRate;
        $tsfpapi['defaultRate'] = $defaultRate;
        $tsfpapi['nonRecoveredRate'] = $nonRecoveredRate;
        $tsfpapi['beginningMonthTotal'] = $beginningMonthTotal;
        $tsfpapi['newEnrolmentMuacTotal'] = $newEnrolmentMuacTotal;
        $tsfpapi['newEnrolmentWfhTotal'] = $newEnrolmentWfhTotal;
        $tsfpapi['readmissionAfterRecoveryTotal'] = $readmissionAfterRecoveryTotal;
        $tsfpapi['transferInFromTsfpTotal'] = $transferInFromTsfpTotal;
        $tsfpapi['returnFromSamTotal'] = $returnFromSamTotal;
        $tsfpapi['admissionTotal'] = $admissionTotal;
        $tsfpapi['dischargeCuredToBsfpTotal'] = $dischargeCuredToBsfpTotal;
        $tsfpapi['defaultTotal'] = $defaultTotal;
        $tsfpapi['deathTotal'] = $deathTotal;
        $tsfpapi['nonResponseTotal'] = $nonResponseTotal;
        $tsfpapi['transferToSamTreatmentTotal'] = $transferToSamTreatmentTotal;
        $tsfpapi['transferOutToTsfpTotal'] = $transferOutToTsfpTotal;
        $tsfpapi['othersTotal'] = $othersTotal;
        $tsfpapi['exitTotal'] = $exitTotal;
        $tsfpapi['endOfMonthTotal'] = $endOfMonthTotal;
        $tsfpapi['reachedTotal'] = $reachedTotal;
        $tsfpapi['tsfpChildNewAdmissionM'] = $tsfpChildNewAdmissionM;
        $tsfpapi['tsfpChildNewAdmissionF'] = $tsfpChildNewAdmissionF;
        $tsfpapi['newAdmissionTotal'] = $newAdmissionTotal;

        $tsfpapi['atTheBeginningOfTheMonthPlw'] = $atTheBeginningOfTheMonthPlw;
        $tsfpapi['newAdmissionPlw'] = $newAdmissionPlw;
        $tsfpapi['readmissionAfterBeingdefault'] = $readmissionAfterBeingdefault;
        $tsfpapi['referFromBsfpPlw'] = $referFromBsfpPlw;
        $tsfpapi['transferInFromOtherTsfpPlw'] = $transferInFromOtherTsfpPlw;
        $tsfpapi['totalAdmissionPlw'] = $totalAdmissionPlw;
        $tsfpapi['dischargeCuredPlwToBsfp'] = $dischargeCuredPlwToBsfp;
        $tsfpapi['dischargePlw'] = $dischargePlw;
        $tsfpapi['transferOutToOtherTsfpPlw'] = $transferOutToOtherTsfpPlw;
        $tsfpapi['defaulterPlw'] = $defaulterPlw;
        $tsfpapi['deathPlw'] = $deathPlw;
        $tsfpapi['otherPlw'] = $otherPlw;
        $tsfpapi['totalExistPlw'] = $totalExistPlw;
        $tsfpapi['totalBeneficiaryAtTheEndPlw'] = $totalBeneficiaryAtTheEndPlw;


        return $tsfpapi;
    }

    public function bsfpApi($report_year, $report_month)
    {
        $bsfp_info = DB::table('bsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSettlement'),
                DB::raw('sum(beginningMonthTotal) as beginningMonthTotal'),
                DB::raw('sum(newEnrolmentTotal) as newEnrolmentTotal'),
                DB::raw('sum(readmissionAfterDefaultTotal) as readmissionAfterDefaultTotal'),
                DB::raw('sum(transferInFromOtherBsfpTotal) as transferInFromOtherBsfpTotal'),
                DB::raw('sum(returnFromMamTreatmentTotal) as returnFromMamTreatmentTotal'),
                DB::raw('sum(totalAdmission) as totalAdmission'),
                DB::raw('sum(discharge59Total) as discharge59Total'),
                DB::raw('sum(defaulterTotal) as defaulterTotal'),
                DB::raw('sum(deathTotal) as deathTotal'),
                DB::raw('sum(totalTransferOut) as totalTransferOut'),
                DB::raw('sum(transferToSamTotal) as transferToSamTotal'),
                DB::raw('sum(transferToMamTotal) as transferToMamTotal'),
                DB::raw('sum(othersTotal) as othersTotal'),
                DB::raw('sum(totalExits) as totalExits'),
                DB::raw('sum(atTheEndTotal) as atTheEndTotal'),
                DB::raw('sum(reachedTotal) as reachedTotal'),
                DB::raw('sum(growthMonitoredTotal) as growthMonitoredTotal'),
                DB::raw('sum(mamTotal) as mamTotal'),
                DB::raw('sum(samTotal) as samTotal'),
                DB::raw('sum(atTheBeginningOfTheMonthPlw) as atTheBeginningOfTheMonthPlw'),
                DB::raw('sum(newAdmissionPlw) as newAdmissionPlw'),
                DB::raw('sum(readmissionAfterDefault) as readmissionAfterDefault'),
                DB::raw('sum(transferInFromOtherBsfpPlw) as transferInFromOtherBsfpPlw'),
                DB::raw('sum(totalAdmissionPlw) as totalAdmissionPlw'),
                DB::raw('sum(dischargePlw) as dischargePlw'),
                DB::raw('sum(transferToOtherTsfpPlw) as transferToOtherTsfpPlw'),
                DB::raw('sum(transferOutOtherBsfpPlw) as transferOutOtherBsfpPlw'),
                DB::raw('sum(defaulterPlw) as defaulterPlw'),
                DB::raw('sum(deathPlw) as deathPlw'),
                DB::raw('sum(totalExistPlw) as totalExistPlw'),
                DB::raw('sum(totalBeneficiaryAtTheEndPLW) as totalBeneficiaryAtTheEndPLW'),
                DB::raw('sum(reachedBeneficiariesBsfp) as reachedBeneficiariesBsfp')
            )
            ->where('month', $report_month)->where('year', $report_year)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
            ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();

        $campSettlement = [];
        $beginningMonthTotal = [];
        $newEnrolmentTotal = [];
        $readmissionAfterDefaultTotal = [];
        $transferInFromOtherBsfpTotal = [];
        $returnFromMamTreatmentTotal = [];
        $totalAdmission = [];
        $discharge59Total = [];
        $defaulterTotal = [];
        $deathTotal = [];
        $totalTransferOut = [];
        $transferToSamTotal = [];
        $transferToMamTotal = [];
        $othersTotal = [];
        $totalExits = [];
        $atTheEndTotal = [];
        $reachedTotal = [];
        $growthMonitoredTotal = [];
        $mamTotal = [];
        $samTotal = [];

        $atTheBeginningOfTheMonthPlw = [];
        $newAdmissionPlw = [];
        $readmissionAfterDefault = [];
        $transferInFromOtherBsfpPlw = [];
        $referFromTsfp = [];
        $totalAdmissionPlw = [];
        $dischargePlw = [];
        $transferToOtherTsfpPlw = [];
        $transferOutOtherBsfpPlw = [];
        $defaulterPlw = [];
        $deathPlw = [];
        $otherPlw = [];
        $totalExistPlw = [];
        $totalBeneficiaryAtTheEndPLW = [];
        $reachedBeneficiariesBsfp = [];

        foreach ($bsfp_info as $bsfp) {
            for ($i = 0; $i < count($bsfp_info); $i++) ;
            $campSettlement[] = $bsfp->campSettlement;
            $beginningMonthTotal[] = $bsfp->beginningMonthTotal;
            $newEnrolmentTotal[] = $bsfp->newEnrolmentTotal;
            $readmissionAfterDefaultTotal[] = $bsfp->readmissionAfterDefaultTotal;
            $transferInFromOtherBsfpTotal[] = $bsfp->transferInFromOtherBsfpTotal;
            $returnFromMamTreatmentTotal[] = $bsfp->returnFromMamTreatmentTotal;
            $totalAdmission[] = $bsfp->totalAdmission;
            $discharge59Total[] = $bsfp->discharge59Total;
            $defaulterTotal[] = $bsfp->defaulterTotal;
            $deathTotal[] = $bsfp->deathTotal;
            $totalTransferOut[] = $bsfp->totalTransferOut;
            $transferToSamTotal[] = $bsfp->transferToSamTotal;
            $transferToMamTotal[] = $bsfp->transferToMamTotal;
            $othersTotal[] = $bsfp->othersTotal;
            $totalExits[] = $bsfp->totalExits;
            $atTheEndTotal[] = $bsfp->atTheEndTotal;
            $reachedTotal[] = $bsfp->reachedTotal;
            $growthMonitoredTotal[] = $bsfp->growthMonitoredTotal;
            $mamTotal[] = $bsfp->mamTotal;
            $samTotal[] = $bsfp->samTotal;
            $atTheBeginningOfTheMonthPlw[] = $bsfp->atTheBeginningOfTheMonthPlw;
            $newAdmissionPlw[] = $bsfp->newAdmissionPlw;
            $readmissionAfterDefault[] = $bsfp->readmissionAfterDefault;
            $transferInFromOtherBsfpPlw[] = $bsfp->transferInFromOtherBsfpPlw;
            $totalAdmissionPlw[] = $bsfp->totalAdmissionPlw;
            $dischargePlw[] = $bsfp->dischargePlw;
            $transferToOtherTsfpPlw[] = $bsfp->transferToOtherTsfpPlw;
            $transferOutOtherBsfpPlw[] = $bsfp->transferOutOtherBsfpPlw;
            $defaulterPlw[] = $bsfp->defaulterPlw;
            $deathPlw[] = $bsfp->deathPlw;
            $totalExistPlw[] = $bsfp->totalExistPlw;
            $totalBeneficiaryAtTheEndPLW[] = $bsfp->totalBeneficiaryAtTheEndPLW;
            $reachedBeneficiariesBsfp[] = $bsfp->reachedBeneficiariesBsfp;
        }
        $bsfpapi['campSettlement'] = $campSettlement;
        $bsfpapi['beginningMonthTotal'] = $beginningMonthTotal;
        $bsfpapi['newEnrolmentTotal'] = $newEnrolmentTotal;
        $bsfpapi['readmissionAfterDefaultTotal'] = $readmissionAfterDefaultTotal;
        $bsfpapi['transferInFromOtherBsfpTotal'] = $transferInFromOtherBsfpTotal;
        $bsfpapi['returnFromMamTreatmentTotal'] = $returnFromMamTreatmentTotal;
        $bsfpapi['totalAdmission'] = $totalAdmission;
        $bsfpapi['discharge59Total'] = $discharge59Total;
        $bsfpapi['defaulterTotal'] = $defaulterTotal;
        $bsfpapi['deathTotal'] = $deathTotal;
        $bsfpapi['totalTransferOut'] = $totalTransferOut;
        $bsfpapi['transferToSamTotal'] = $transferToSamTotal;
        $bsfpapi['transferToMamTotal'] = $transferToMamTotal;
        $bsfpapi['othersTotal'] = $othersTotal;
        $bsfpapi['totalExits'] = $totalExits;
        $bsfpapi['atTheEndTotal'] = $atTheEndTotal;
        $bsfpapi['reachedTotal'] = $reachedTotal;
        $bsfpapi['growthMonitoredTotal'] = $growthMonitoredTotal;
        $bsfpapi['mamTotal'] = $mamTotal;
        $bsfpapi['samTotal'] = $samTotal;
        $bsfpapi['atTheBeginningOfTheMonthPlw'] = $atTheBeginningOfTheMonthPlw;
        $bsfpapi['newAdmissionPlw'] = $newAdmissionPlw;
        $bsfpapi['readmissionAfterDefault'] = $readmissionAfterDefault;
        $bsfpapi['transferInFromOtherBsfpPlw'] = $transferInFromOtherBsfpPlw;
        $bsfpapi['totalAdmissionPlw'] = $totalAdmissionPlw;
        $bsfpapi['dischargePlw'] = $dischargePlw;
        $bsfpapi['transferToOtherTsfpPlw'] = $transferToOtherTsfpPlw;
        $bsfpapi['transferOutOtherBsfpPlw'] = $transferOutOtherBsfpPlw;
        $bsfpapi['defaulterPlw'] = $defaulterPlw;
        $bsfpapi['deathPlw'] = $deathPlw;
        $bsfpapi['totalExistPlw'] = $totalExistPlw;
        $bsfpapi['totalBeneficiaryAtTheEndPLW'] = $totalBeneficiaryAtTheEndPLW;
        $bsfpapi['reachedBeneficiariesBsfp'] = $reachedBeneficiariesBsfp;


        return $bsfpapi;
    }


}
