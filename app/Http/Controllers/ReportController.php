<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        if (Auth::user()->facility_id) {
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $children = Child::where('camp_id', $facility->camp_id)->get();
            //$facility_followup = FacilityFollowup::find();

            if (date('n') == 1) {
                $report_month = 12;
                $report_year = date('Y') - 1;
            } else {
                $report_month = date('n') - 1;
                $report_year = date('Y');
            }

            $facility_id = Auth::user()->facility_id;

            $report = $this->otp_report($facility_id, $report_month, $report_year);
//            dd($facility_id);
            $facilities = Facility::all();
            $current_month = $report_month;
            $current_year = $report_year;

            return view('report.home', compact('children', 'facility', 'report','facilities','current_month','current_year','facility_id'));


        } else {

            $children = Child::orderBy('created_at', 'desc')->get();

            $facilities = Facility::all();
            $current_month = date('n');

            return view('report.search_home', compact('children', 'current_month', 'facilities'));
        }
    }

    public function otp_report_admin(Request $request)
    {
//        dd($request);
        $report_month = $request->month;
        $report_year = $request->year;
        $facility = Facility::findOrFail($request->facility_id);
        $children = Child::where('camp_id', $facility->camp_id)->get();
        $facility_id = $request->facility_id;
        $report = $this->otp_report($facility_id, $report_month, $report_year);
        $facilities = Facility::all();
        $current_month = $report_month;
        $current_year = $report_year;

//            dd($report);
        return view('report.home', compact('children', 'facility', 'report','facilities','facility_id','current_year','current_month'));

    }

    private function otp_report($facility_id, $report_month, $report_year)
    {

        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year);

//dd($days_in_month);
        $begining_balance_1stday = \DB::table('facility_followups')->MIN('date');
        $begining_balance_lastday = date('Y-m-d', strtotime('-1 day', strtotime($report_year . '-' . $report_month . '-01')));
        $endof_month_lastday = date('Y-m-d', strtotime($report_year . '-' . $report_month .'-'.(cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year))));
//dd($begining_balance_1stday.'/'.$begining_balance_lastday.'/'.$endof_month_lastday);

        $male_23 = Child::select('sync_id')->where('age', '<=', 23)->where('sex', 'male')->pluck('sync_id')->toArray();
        $female_23 = Child::select('sync_id')->where('age', '<=', 23)->where('sex', 'female')->pluck('sync_id')->toArray();

        $male_24to59 = Child::select('sync_id')->where('age', '>=', 24)->where('age', '<=', 59)->where('sex', 'male')->pluck('sync_id')->toArray();
        $female_24to59 = Child::select('sync_id')->where('age', '>=', 24)->where('age', '<=', 59)->where('sex', 'female')->pluck('sync_id')->toArray();

        $male_60 = Child::select('sync_id')->where('age', '>=', 60)->where('sex', 'male')->pluck('sync_id')->toArray();
        $female_60 = Child::select('sync_id')->where('age', '>=', 60)->where('sex', 'female')->pluck('sync_id')->toArray();

        $begining_balance_total_enrollment=FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date',[$begining_balance_1stday,$begining_balance_lastday])
            ->where('new_admission', '!=',null)
            ->where('new_admission', '!=','Age 6 to 59m')
//            ->where('new_admission', '!=','MUAC and WFH Zscore')
            ->where('transfer_in', '!=',null)
            ->where('transfer_in', '!=','Transfer in from BSFP')
            ->where('transfer_in', '!=','Transfer in from Medical Center')
            ->pluck('children_id')->toArray();

        $begining_balance_total_exit=FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date',[$begining_balance_1stday,$begining_balance_lastday])
            ->where('discharge_criteria_exit', '!=',null)
            ->where('discharge_criteria_exit', '!=','Age > 59m')
            ->where('discharge_criteria_transfer_out', '!=',null)
            ->where('discharge_criteria_transfer_out', '!=','Transfer to SAM treatment')
            ->where('discharge_criteria_transfer_out', '!=','Transfer to MAM treatment')
            ->where('discharge_criteria_transfer_out', '!=','Transfer to other TSFP')
            ->where('discharge_criteria_transfer_out', '!=','Transfer to other BSFP')
            ->where('discharge_criteria_others', '!=',null)
            ->pluck('children_id')->toArray();

        $endof_month_total_enrollment=FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date',[$begining_balance_1stday,$endof_month_lastday])
            ->where('new_admission', '!=',null)
            ->where('new_admission', '!=','Age 6 to 59m')
//            ->where('new_admission', '!=','MUAC and WFH Zscore')
            ->where('transfer_in', '!=',null)
            ->where('transfer_in', '!=','Transfer in from BSFP')
            ->where('transfer_in', '!=','Transfer in from Medical Center')
            ->pluck('children_id')->toArray();

        $endof_month_total_exit=FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date',[$begining_balance_1stday,$endof_month_lastday])
            ->where('discharge_criteria_exit', '!=',null)
            ->where('discharge_criteria_exit', '!=','Age > 59m')
            ->where('discharge_criteria_transfer_out', '!=',null)
            ->where('discharge_criteria_transfer_out', '!=','Transfer to SAM treatment')
            ->where('discharge_criteria_transfer_out', '!=','Transfer to MAM treatment')
            ->where('discharge_criteria_transfer_out', '!=','Transfer to other TSFP')
            ->where('discharge_criteria_transfer_out', '!=','Transfer to other BSFP')
            ->where('discharge_criteria_others', '!=',null)
            ->pluck('children_id')->toArray();

//OTP report 1st part (Table-1)
        $facility_followup_muac = FacilityFollowup::where('facility_id', $facility_id)
            ->where('new_admission', 'MUAC')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $facility_followup_zscore = FacilityFollowup::where('facility_id', $facility_id)
            ->where('new_admission', 'WFH Zscore')
//            ->where('new_admission', '!=','MUAC')
//            ->where('new_admission', '!=','Oedema')
//            ->where('new_admission', '!=','Age 6 to 59m')
//            ->where('new_admission', '!=','Relapse')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();
//dd($facility_followup_zscore);
        $facility_followup_oedema = FacilityFollowup::where('facility_id', $facility_id)
            ->where('new_admission', 'Oedema')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $facility_followup_relapse = FacilityFollowup::where('facility_id', $facility_id)
            ->where('new_admission', 'Relapse')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $transfer_in_tsfp = FacilityFollowup::where('facility_id', $facility_id)
            ->where('transfer_in', 'Transfer in from TSFP')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $transfer_in_sc = FacilityFollowup::where('facility_id', $facility_id)
            ->where('transfer_in', 'Transfer in from SC')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $transfer_in_otp = FacilityFollowup::where('facility_id', $facility_id)
            ->where('transfer_in', 'Transfer in from OTP')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

//        $readmission_after_default = FacilityFollowup::where('facility_id', $facility_id)
//            ->where('readmission', 'Readmission after default')
//            ->whereMonth('date', '=', $report_month)
//            ->whereYear('date', '=', $report_year)
//            ->pluck('children_id')->toArray();
//dd($readmission_after_default);

        $report['begining_balance_23_male'] = count(array_intersect($begining_balance_total_enrollment, $male_23))-count(array_intersect($begining_balance_total_exit, $male_23));
        $report['begining_balance_23_female'] = count(array_intersect($begining_balance_total_enrollment, $female_23))-count(array_intersect($begining_balance_total_exit, $female_23));
        $report['begining_balance_24to59_male'] = count(array_intersect($begining_balance_total_enrollment, $male_24to59))-count(array_intersect($begining_balance_total_exit, $male_24to59));
        $report['begining_balance_24to59_female'] = count(array_intersect($begining_balance_total_enrollment, $female_24to59))-count(array_intersect($begining_balance_total_exit, $female_24to59));
        $report['begining_balance_60_male'] = count(array_intersect($begining_balance_total_enrollment, $male_60))-count(array_intersect($begining_balance_total_exit, $male_60));
        $report['begining_balance_60_female'] = count(array_intersect($begining_balance_total_enrollment, $female_60))-count(array_intersect($begining_balance_total_exit, $female_60));

        $report['endof_month_23_male'] = count(array_intersect($endof_month_total_enrollment, $male_23))-count(array_intersect($endof_month_total_exit, $male_23));
        $report['endof_month_23_female'] = count(array_intersect($endof_month_total_enrollment, $female_23))-count(array_intersect($endof_month_total_exit, $female_23));
        $report['endof_month_24to59_male'] = count(array_intersect($endof_month_total_enrollment, $male_24to59))-count(array_intersect($endof_month_total_exit, $male_24to59));
        $report['endof_month_24to59_female'] = count(array_intersect($endof_month_total_enrollment, $female_24to59))-count(array_intersect($endof_month_total_exit, $female_24to59));
        $report['endof_month_60_male'] = count(array_intersect($endof_month_total_enrollment, $male_60))-count(array_intersect($endof_month_total_exit, $male_60));
        $report['endof_month_60_female'] = count(array_intersect($endof_month_total_enrollment, $female_60))-count(array_intersect($endof_month_total_exit, $female_60));

        $report['muac_23_male'] = count(array_intersect($facility_followup_muac, $male_23));
        $report['muac_23_female'] = count(array_intersect($facility_followup_muac, $female_23));
        $report['muac_24to59_male'] = count(array_intersect($facility_followup_muac, $male_24to59));
        $report['muac_24to59_female'] = count(array_intersect($facility_followup_muac, $female_24to59));
        $report['muac_60_male'] = count(array_intersect($facility_followup_muac, $male_60));
        $report['muac_60_female'] = count(array_intersect($facility_followup_muac, $female_60));

        $report['zscore_23_male'] = count(array_intersect($facility_followup_zscore, $male_23));
        $report['zscore_23_female'] = count(array_intersect($facility_followup_zscore, $female_23));
        $report['zscore_24to59_male'] = count(array_intersect($facility_followup_zscore, $male_24to59));
        $report['zscore_24to59_female'] = count(array_intersect($facility_followup_zscore, $female_24to59));
        $report['zscore_60_male'] = count(array_intersect($facility_followup_zscore, $male_60));
        $report['zscore_60_female'] = count(array_intersect($facility_followup_zscore, $female_60));

        $report['oedema_23_male'] = count(array_intersect($facility_followup_oedema, $male_23));
        $report['oedema_23_female'] = count(array_intersect($facility_followup_oedema, $female_23));
        $report['oedema_24to59_male'] = count(array_intersect($facility_followup_oedema, $male_24to59));
        $report['oedema_24to59_female'] = count(array_intersect($facility_followup_oedema, $female_24to59));
        $report['oedema_60_male'] = count(array_intersect($facility_followup_oedema, $male_60));
        $report['oedema_60_female'] = count(array_intersect($facility_followup_oedema, $female_60));

        $report['relapse_23_male'] = count(array_intersect($facility_followup_relapse, $male_23));
        $report['relapse_23_female'] = count(array_intersect($facility_followup_relapse, $female_23));
        $report['relapse_24to59_male'] = count(array_intersect($facility_followup_relapse, $male_24to59));
        $report['relapse_24to59_female'] = count(array_intersect($facility_followup_relapse, $female_24to59));
        $report['relapse_60_male'] = count(array_intersect($facility_followup_relapse, $male_60));
        $report['relapse_60_female'] = count(array_intersect($facility_followup_relapse, $female_60));

        $report['return_default_23_male'] = 0;
        $report['return_default_23_female'] = 0;
        $report['return_default_24to59_male'] = 0;
        $report['return_default_24to59_female'] = 0;
        $report['return_default_60_male'] = 0;
        $report['return_default_60_female'] = 0;

        $report['transferin_tsfp_23_male'] = count(array_intersect($transfer_in_tsfp, $male_23));
        $report['transferin_tsfp_23_female'] = count(array_intersect($transfer_in_tsfp, $female_23));
        $report['transferin_tsfp_24to59_male'] = count(array_intersect($transfer_in_tsfp, $male_24to59));
        $report['transferin_tsfp_24to59_female'] = count(array_intersect($transfer_in_tsfp, $female_24to59));
        $report['transferin_tsfp_60_male'] = count(array_intersect($transfer_in_tsfp, $male_60));
        $report['transferin_tsfp_60_female'] = count(array_intersect($transfer_in_tsfp, $female_60));

        $report['transferin_sc_23_male'] = count(array_intersect($transfer_in_sc, $male_23));
        $report['transferin_sc_23_female'] = count(array_intersect($transfer_in_sc, $female_23));
        $report['transferin_sc_24to59_male'] = count(array_intersect($transfer_in_sc, $male_24to59));
        $report['transferin_sc_24to59_female'] = count(array_intersect($transfer_in_sc, $female_24to59));
        $report['transferin_sc_60_male'] = count(array_intersect($transfer_in_sc, $male_60));
        $report['transferin_sc_60_female'] = count(array_intersect($transfer_in_sc, $female_60));

        $report['transferin_otp_23_male'] = count(array_intersect($transfer_in_otp, $male_23));
        $report['transferin_otp_23_female'] = count(array_intersect($transfer_in_otp, $female_23));
        $report['transferin_otp_24to59_male'] = count(array_intersect($transfer_in_otp, $male_24to59));
        $report['transferin_otp_24to59_female'] = count(array_intersect($transfer_in_otp, $female_24to59));
        $report['transferin_otp_60_male'] = count(array_intersect($transfer_in_otp, $male_60));
        $report['transferin_otp_60_female'] = count(array_intersect($transfer_in_otp, $female_60));


//OTP report 2st part (Table-2)
        $discharge_recovered = FacilityFollowup::where('facility_id', $facility_id)
            ->where('discharge_criteria_exit', 'Recovered')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $discharge_death = FacilityFollowup::where('facility_id', $facility_id)
            ->where('discharge_criteria_exit', 'Death')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $discharge_defaulted= FacilityFollowup::where('facility_id', $facility_id)
            ->where('discharge_criteria_exit', 'Defaulted')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $discharge_non_responder= FacilityFollowup::where('facility_id', $facility_id)
            ->where('discharge_criteria_exit', 'Non responder')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $discharge_medical_transfer= FacilityFollowup::where('facility_id', $facility_id)
            ->where('discharge_criteria_exit', 'Medical Transfer')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $discharge_transferout_otp= FacilityFollowup::where('facility_id', $facility_id)
            ->where('discharge_criteria_transfer_out', 'Transfer to other OTP')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $discharge_transferout_sc= FacilityFollowup::where('facility_id', $facility_id)
            ->where('discharge_criteria_transfer_out', 'Transfer to SC')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $discharge_others_unkown= FacilityFollowup::where('facility_id', $facility_id)
            ->where('discharge_criteria_others', 'Unkown')
            ->whereMonth('date', '=', $report_month)
            ->whereYear('date', '=', $report_year)
            ->pluck('children_id')->toArray();

        $report['recovered_23_male'] = count(array_intersect($discharge_recovered, $male_23));
        $report['recovered_23_female'] = count(array_intersect($discharge_recovered, $female_23));
        $report['recovered_24to59_male'] = count(array_intersect($discharge_recovered, $male_24to59));
        $report['recovered_24to59_female'] = count(array_intersect($discharge_recovered, $female_24to59));
        $report['recovered_60_male'] = count(array_intersect($discharge_recovered, $male_60));
        $report['recovered_60_female'] = count(array_intersect($discharge_recovered, $female_60));

        $report['death_23_male'] = count(array_intersect($discharge_death, $male_23));
        $report['death_23_female'] = count(array_intersect($discharge_death, $female_23));
        $report['death_24to59_male'] = count(array_intersect($discharge_death, $male_24to59));
        $report['death_24to59_female'] = count(array_intersect($discharge_death, $female_24to59));
        $report['death_60_male'] = count(array_intersect($discharge_death, $male_60));
        $report['death_60_female'] = count(array_intersect($discharge_death, $female_60));

        $report['defaulted_23_male'] = count(array_intersect($discharge_defaulted, $male_23));
        $report['defaulted_23_female'] = count(array_intersect($discharge_defaulted, $female_23));
        $report['defaulted_24to59_male'] = count(array_intersect($discharge_defaulted, $male_24to59));
        $report['defaulted_24to59_female'] = count(array_intersect($discharge_defaulted, $female_24to59));
        $report['defaulted_60_male'] = count(array_intersect($discharge_defaulted, $male_60));
        $report['defaulted_60_female'] = count(array_intersect($discharge_defaulted, $female_60));

        $report['non_responder_23_male'] = count(array_intersect($discharge_non_responder, $male_23));
        $report['non_responder_23_female'] = count(array_intersect($discharge_non_responder, $female_23));
        $report['non_responder_24to59_male'] = count(array_intersect($discharge_non_responder, $male_24to59));
        $report['non_responder_24to59_female'] = count(array_intersect($discharge_non_responder, $female_24to59));
        $report['non_responder_60_male'] = count(array_intersect($discharge_non_responder, $male_60));
        $report['non_responder_60_female'] = count(array_intersect($discharge_non_responder, $female_60));

        $report['medical_transfer_23_male'] = count(array_intersect($discharge_medical_transfer, $male_23));
        $report['medical_transfer_23_female'] = count(array_intersect($discharge_medical_transfer, $female_23));
        $report['medical_transfer_24to59_male'] = count(array_intersect($discharge_medical_transfer, $male_24to59));
        $report['medical_transfer_24to59_female'] = count(array_intersect($discharge_medical_transfer, $female_24to59));
        $report['medical_transfer_60_male'] = count(array_intersect($discharge_medical_transfer, $male_60));
        $report['medical_transfer_60_female'] = count(array_intersect($discharge_medical_transfer, $female_60));

        $report['transferout_otp_23_male'] = count(array_intersect($discharge_transferout_otp, $male_23));
        $report['transferout_otp_23_female'] = count(array_intersect($discharge_transferout_otp, $female_23));
        $report['transferout_otp_24to59_male'] = count(array_intersect($discharge_transferout_otp, $male_24to59));
        $report['transferout_otp_24to59_female'] = count(array_intersect($discharge_transferout_otp, $female_24to59));
        $report['transferout_otp_60_male'] = count(array_intersect($discharge_transferout_otp, $male_60));
        $report['transferout_otp_60_female'] = count(array_intersect($discharge_transferout_otp, $female_60));

        $report['transferout_sc_23_male'] = count(array_intersect($discharge_transferout_sc, $male_23));
        $report['transferout_sc_23_female'] = count(array_intersect($discharge_transferout_sc, $female_23));
        $report['transferout_sc_24to59_male'] = count(array_intersect($discharge_transferout_sc, $male_24to59));
        $report['transferout_sc_24to59_female'] = count(array_intersect($discharge_transferout_sc, $female_24to59));
        $report['transferout_sc_60_male'] = count(array_intersect($discharge_transferout_sc, $male_60));
        $report['transferout_sc_60_female'] = count(array_intersect($discharge_transferout_sc, $female_60));

        $report['others_unkown_23_male'] = count(array_intersect($discharge_others_unkown, $male_23));
        $report['others_unkown_23_female'] = count(array_intersect($discharge_others_unkown, $female_23));
        $report['others_unkown_24to59_male'] = count(array_intersect($discharge_others_unkown, $male_24to59));
        $report['others_unkown_24to59_female'] = count(array_intersect($discharge_others_unkown, $female_24to59));
        $report['others_unkown_60_male'] = count(array_intersect($discharge_others_unkown, $male_60));
        $report['others_unkown_60_female'] = count(array_intersect($discharge_others_unkown, $female_60));

        $report['report_month'] = $report_month;
        $report['report_year'] = $report_year;

//        dd($discharge_death);
        return $report;
    }

}
