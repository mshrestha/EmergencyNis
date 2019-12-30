<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function otpApi($report_year, $report_month){
//        dd($report_year);
        $otp_info = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSettlement'),
                DB::raw('sum(beginningMonth_M) as beginningMonth_M'), DB::raw('sum(beginningMonth_F) as beginningMonth_F'),DB::raw('sum(beginningMonthTotal) as beginningMonthTotal'),
                DB::raw('sum(totalNewEnrolment_M) as totalNewEnrolment_M'), DB::raw('sum(totalNewEnrolment_F) as totalNewEnrolment_F'),DB::raw('sum(totalNewEnrolment) as totalNewEnrolment'),
                DB::raw('sum(totalEnrolment_M) as totalEnrolment_M'), DB::raw('sum(totalEnrolment_F) as totalEnrolment_F'),DB::raw('sum(totalEnrolment) as totalEnrolment'),
                DB::raw('sum(totalTransferFromOther) as totalTransferFromOther'), DB::raw('sum(totalDischarged) as totalDischarged'),
                DB::raw('sum(totalCured) as totalCured'),DB::raw('sum(totalDefault) as totalDefault'), DB::raw('sum(totalDeath) as totalDeath'),
                DB::raw('sum(totalNonRecovered) as totalNonRecovered'),
                DB::raw('sum(transferSc_M) as transferSc_M'),DB::raw('sum(transferSc_F) as transferSc_F'),
                DB::raw('sum(enrolmentMuc_M) as enrolmentMuc_M'),DB::raw('sum(enrolmentMuc_F) as enrolmentMuc_F'),
                DB::raw('sum(enrolmentWfh_M) as enrolmentWfh_M'),DB::raw('sum(enrolmentWfh_F) as enrolmentWfh_F'),
                DB::raw('sum(enrolmentBoth_M) as enrolmentBoth_M'),DB::raw('sum(enrolmentBoth_F) as enrolmentBoth_F'),
                DB::raw('sum(enrolmentEdema_M) as enrolmentEdema_M'),DB::raw('sum(enrolmentEdema_F) as enrolmentEdema_F'),
                DB::raw('sum(enrolmentRelapse_M) as enrolmentRelapse_M'),DB::raw('sum(enrolmentRelapse_F) as enrolmentRelapse_F'),
                DB::raw('sum(totalEndOfMonth_M) as totalEndOfMonth_M'),DB::raw('sum(totalEndOfMonth_F) as totalEndOfMonth_F'),
                DB::raw('sum(alos) as alos'),DB::raw('sum(awg) as awg')
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
        $alos= [];
        $awg= [];
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

}
