<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;
use DB;


class ReportController extends Controller
{
    public function index()
    {
        if (Auth::user()->facility_id) {
//            $facility = Facility::findOrFail(Auth::user()->facility_id);
////            dd($facility);
//            $children = Child::where('camp_id', $facility->camp_id)->get();
//            if (date('n') == 1) {
//                $report_month = 12;
//                $report_year = date('Y') - 1;
//            } else {
//                $report_month = date('n') - 1;
//                $report_year = date('Y');
//            }
////            $facilityId = Auth::user()->facility_id;
//
//            $facilities = Facility::all();
//            $current_month = $report_month;
//            $current_year = $report_year;
//            if ($facility->service_type == 'OTP') {
//                $report = $this->otp(Auth::user()->facility_id, $report_month, $report_year);
////                dd($facility);
//                return view('report.otp', compact('children', 'facility', 'report', 'facilities', 'current_month', 'current_year'));
//            }elseif($facility->service_type == 'BSFP'||$facility->service_type == 'TSFP/BSFP'){
//                $report = $this->bsfp(Auth::user()->facility_id, $report_month, $report_year);
//                return view('report.bsfp', compact('children', 'facility', 'report', 'facilities', 'current_month', 'current_year'));
//            }else{
//                return view('report.noReport');
//            }
            return view('report/report_home_admin');



        } else {

//            $children = Child::orderBy('created_at', 'desc')->get();
//            $facilities = Facility::all();
//            $current_month = date('n');
//            return view('report.search_home_otp', compact('children', 'current_month', 'facilities'));
            return view('report/report_home_admin');

        }


    }

    public function otp_report()
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

            $facilities = Facility::all();
            $current_month = $report_month;
            $current_year = $report_year;

//            dd($report_year);

            $report_male_6to23 = $this->otp($facility_id, $report_month, $report_year, 'male','6','23');
            $report_male_24to59 = $this->otp($facility_id, $report_month, $report_year, 'male','23','59');
            $report_male_60up = $this->otp($facility_id, $report_month, $report_year, 'male','60','120');
            $report_female_6to23 = $this->otp($facility_id, $report_month, $report_year, 'female','6','23');
            $report_female_24to59 = $this->otp($facility_id, $report_month, $report_year, 'female','23','59');
            $report_female_60up = $this->otp($facility_id, $report_month, $report_year, 'female','60','120');

//            dd($report_male_6to23);

            return view('report.otp', compact('children', 'facility',  'facilities', 'current_month', 'current_year', 'facility_id',
                'report_male_6to23','report_female_6to23','report_female_24to59','report_male_24to59','report_male_60up','report_female_60up'));

        } else {

            $children = Child::orderBy('created_at', 'desc')->get();

            $facilities = Facility::all();
            $current_month = date('n');

            return view('report.search_home_otp', compact('children', 'current_month', 'facilities'));
        }
    }

    public function otp_report_admin(Request $request)
    {
//        dd($request);
        $report_month = $request->month;
        $report_year = $request->year;

        if (Auth::user()->facility_id) {
            $facility = Facility::findOrFail(Auth::user()->facility_id);
        } else
            $facility = Facility::findOrFail($request->facility_id);
        $children = Child::where('camp_id', $facility->camp_id)->get();
        $facility_id = $facility->id;
        $report = $this->otp($facility_id, $report_month, $report_year);
        $facilities = Facility::all();
        $current_month = $report_month;
        $current_year = $report_year;

//            dd($report);
        return view('report.otp', compact('children', 'facility', 'report', 'facilities', 'facility_id', 'current_year', 'current_month'));

    }

    public function bsfp_report_admin(Request $request)
    {
//        dd($request);
        $report_month = $request->month;
        $report_year = $request->year;

        if (Auth::user()->facility_id) {
            $facility = Facility::findOrFail(Auth::user()->facility_id);
        } else
            $facility = Facility::findOrFail($request->facility_id);
//        dd($facility);
        $children = Child::where('camp_id', $facility->camp_id)->get();
        $facility_id = $facility->id;
        $report = $this->bsfp($facility_id, $report_month, $report_year);
        $facilities = Facility::all();
        $current_month = $report_month;
        $current_year = $report_year;

        return view('report.bsfp', compact('children', 'facility', 'report', 'facilities', 'facility_id', 'current_year', 'current_month'));
    }
    public function tsfp_report_admin(Request $request)
    {
//        dd($request);
        $report_month = $request->month;
        $report_year = $request->year;

        if (Auth::user()->facility_id) {
            $facility = Facility::findOrFail(Auth::user()->facility_id);
        } else
            $facility = Facility::findOrFail($request->facility_id);
//        dd($facility);
        $children = Child::where('camp_id', $facility->camp_id)->get();
        $facility_id = $facility->id;
        $report = $this->tsfp($facility_id, $report_month, $report_year);
        $facilities = Facility::all();
        $current_month = $report_month;
        $current_year = $report_year;

        return view('report.tsfp', compact('children', 'facility', 'report', 'facilities', 'facility_id', 'current_year', 'current_month'));
    }

    private function otp($facility_id, $report_month, $report_year, $sex, $start_age, $end_age)
    {
//        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year);
//dd($days_in_month);
        $begining_balance_1stday = \DB::table('facility_followups')->MIN('date');
        $begining_balance_lastday = date('Y-m-d', strtotime('-1 day', strtotime($report_year . '-' . $report_month . '-01')));
        $endof_month_lastday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . (cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year))));

        $otp['begining_balance_new_admission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.new_admission', '!=', null)
            ->where('facility_followups.new_admission', '!=', 'Age 6 to 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['begining_balance_readmission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.readmission', '!=', null)
            ->where('facility_followups.readmission', '!=', 'Readmission after non recovery')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['begining_balance_transfer_in'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.transfer_in', '!=', null)
            ->where('facility_followups.transfer_in', '!=', 'Transfer in from BSFP')
            ->where('facility_followups.transfer_in', '!=', 'Transfer in from Medical Center')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['begining_balance_total_enrolled']=$otp['begining_balance_new_admission']+$otp['begining_balance_readmission']+$otp['begining_balance_transfer_in'];

        $otp['begining_balance_discharge_criteria_exit'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_exit', '!=', null)
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['begining_balance_discharge_criteria_others'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_others', '!=', null)
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['begining_balance_discharge_criteria_transfer_out'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_transfer_out', '!=', null)
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to SAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to MAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other TSFP')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other BSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['begining_balance_total_exit']=$otp['begining_balance_discharge_criteria_exit']+$otp['begining_balance_discharge_criteria_others']+$otp['begining_balance_discharge_criteria_transfer_out'];


//        $endof_month_total_enrollment = FacilityFollowup::where('facility_id', $facility_id)
//            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
//            ->where('age', '<=', 23)
//            ->where('nutritionstatus', 'SAM')
//            ->where('outcome', 'SAM new case')
//            ->where('new_admission', '!=', null)
//            ->where('new_admission', '!=', 'Age 6 to 59m')
//            ->where('readmission', '!=', null)
//            ->where('readmission', '!=', 'Readmission after non recovery')
//            ->where('transfer_in', '!=', null)
//            ->where('transfer_in', '!=', 'Transfer in from BSFP')
//            ->where('transfer_in', '!=', 'Transfer in from Medical Center')
//            ->pluck('children_id')->toArray();
//
//        $endof_month_total_exit = FacilityFollowup::where('facility_id', $facility_id)
//            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
//            ->where('age', '<=', 23)
//            ->where('nutritionstatus', 'SAM')
//            ->where('outcome', '!=', 'SAM new case')
//            ->where('discharge_criteria_exit', '!=', null)
//            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
//            ->where('discharge_criteria_others', '!=', null)
//            ->where('discharge_criteria_transfer_out', '!=', null)
//            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to SAM treatment')
//            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to MAM treatment')
//            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other TSFP')
//            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other BSFP')
//            ->pluck('children_id')->toArray();
//
////OTP report 1st part (Table-1)
        $otp['new_admission_muac'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.new_admission', 'MUAC')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['new_admission_zscore'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.new_admission','!=', 'MUAC')
            ->where('facility_followups.new_admission','!=', 'Oedema')
            ->where('facility_followups.new_admission','!=', 'Age 6 to 59m')
            ->where('facility_followups.new_admission','!=', 'Relapse')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['new_admission_oedema'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.new_admission', 'Oedema')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['new_admission_relapse'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.new_admission', 'Relapse')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['new_admission_total']=$otp['new_admission_muac']+$otp['new_admission_zscore']+$otp['new_admission_oedema']+$otp['new_admission_relapse'];


        $otp['readmission_after_default'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.readmission', 'Readmission after default')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['transfer_in_from_tsfp'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.transfer_in', 'Transfer in from TSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['transfer_in_from_sc'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.transfer_in', 'Transfer in from SC')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['transfer_in_from_otp'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', 'SAM new case')
            ->where('facility_followups.transfer_in', 'Transfer in from OTP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['transfer_in_total']=$otp['readmission_after_default']+$otp['transfer_in_from_tsfp']+$otp['transfer_in_from_sc']+$otp['transfer_in_from_otp'];
        $otp['enrollment_total']=$otp['new_admission_total']+$otp['transfer_in_total'];

        $otp['discharge_criteria_exit_recovered'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_exit',  'Recovered')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['discharge_criteria_exit_death'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_exit',  'Death')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['discharge_criteria_exit_defaulted'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_exit',  'Defaulted')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['discharge_criteria_exit_nonrecovered'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_exit',  'Non recovered')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['discharge_criteria_exit_total']=$otp['discharge_criteria_exit_recovered']+$otp['discharge_criteria_exit_death']+$otp['discharge_criteria_exit_defaulted']+$otp['discharge_criteria_exit_nonrecovered'];

        $otp['discharge_criteria_others_medical_transfer'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_others', 'Medical transfer')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['discharge_criteria_others_unkown'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_others', 'Unkown')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['discharge_criteria_transfer_out_sc'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_transfer_out', 'Transfer to SC')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['discharge_criteria_transfer_out_otp'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereMonth('facility_followups.date', '=', $report_month)
            ->whereYear('facility_followups.date', '=', $report_year)
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('facility_followups.nutritionstatus', 'SAM')
            ->where('facility_followups.outcome', '!=', 'SAM new case')
            ->where('discharge_criteria_transfer_out', 'Transfer to other OTP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $otp['discharge_criteria_transfer_out_total']=$otp['discharge_criteria_others_medical_transfer']+$otp['discharge_criteria_others_unkown']+$otp['discharge_criteria_transfer_out_sc']+$otp['discharge_criteria_transfer_out_otp'];
        $otp['exit_total']=$otp['discharge_criteria_exit_total']+$otp['discharge_criteria_transfer_out_total'];



//        $otp['report_month'] = $report_month;
//        $otp['report_year'] = $report_year;

        return $otp;
    }

    public function bsfp_report()
    {

        if (Auth::user()->facility_id) {
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $children = Child::where('camp_id', $facility->camp_id)->get();

            if (date('n') == 1) {
                $report_month = 12;
                $report_year = date('Y') - 1;
            } else {
                $report_month = date('n') - 1;
                $report_year = date('Y');
            }
            $facility_id = Auth::user()->facility_id;

//            $report = $this->bsfp($facility_id, $report_month, $report_year);
            $facilities = Facility::all();
            $current_month = $report_month;
            $current_year = $report_year;
            $report = $this->bsfp($facility_id, $report_month, $report_year);
            return view('report.bsfp', compact('children', 'facility', 'report', 'facilities', 'current_month', 'current_year', 'facility_id'));

        } else {

            $children = Child::orderBy('created_at', 'desc')->get();
            $facilities = Facility::all();
            $current_month = date('n');

            return view('report.search_home_bsfp', compact('children', 'current_month', 'facilities'));
        }

    }
    public function tsfp_report()
    {

        if (Auth::user()->facility_id) {
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $children = Child::where('camp_id', $facility->camp_id)->get();

            if (date('n') == 1) {
                $report_month = 12;
                $report_year = date('Y') - 1;
            } else {
                $report_month = date('n') - 1;
                $report_year = date('Y');
            }
            $facility_id = Auth::user()->facility_id;

//            $report = $this->bsfp($facility_id, $report_month, $report_year);
            $facilities = Facility::all();
            $current_month = $report_month;
            $current_year = $report_year;
            $report = $this->tsfp($facility_id, $report_month, $report_year);
            return view('report.tsfp', compact('children', 'facility', 'report', 'facilities', 'current_month', 'current_year', 'facility_id'));

        } else {

            $children = Child::orderBy('created_at', 'desc')->get();
            $facilities = Facility::all();
            $current_month = date('n');

            return view('report.search_home_bsfp', compact('children', 'current_month', 'facilities'));
        }

    }

    private function bsfp($facility_id, $report_month, $report_year)
    {
//        dd($facility_id);
//        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year);
        $begining_balance_1stday = \DB::table('facility_followups')->MIN('date');
        $begining_balance_lastday = date('Y-m-d', strtotime('-1 day', strtotime($report_year . '-' . $report_month . '-01')));
        $this_month_1stday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . '1'));
        $endof_month_lastday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . (cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year))));
//dd($begining_balance_1stday.'/'.$begining_balance_lastday.'/'.$endof_month_lastday);

        $male_23 = Child::select('sync_id')->where('age', '<=', 23)->where('sex', 'male')->pluck('sync_id')->toArray();
        $female_23 = Child::select('sync_id')->where('age', '<=', 23)->where('sex', 'female')->pluck('sync_id')->toArray();
        $male_24to59 = Child::select('sync_id')->where('age', '>=', 24)->where('age', '<=', 59)->where('sex', 'male')->pluck('sync_id')->toArray();
        $female_24to59 = Child::select('sync_id')->where('age', '>=', 24)->where('age', '<=', 59)->where('sex', 'female')->pluck('sync_id')->toArray();

        $begining_balance_new_admission = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->pluck('children_id')->toArray();
        $begining_balance_re_admission = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('readmission', 'Readmission after default')
            ->pluck('children_id')->toArray();
        $begining_balance_transfer_in = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('transfer_in', 'Transfer in from BSFP')
            ->pluck('children_id')->toArray();
        $begining_balance_return_from = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('return_from', 'MAM Treatement')
            ->pluck('children_id')->toArray();
        $begining_balance_total_enrollment = array_merge($begining_balance_new_admission, $begining_balance_re_admission, $begining_balance_transfer_in, $begining_balance_return_from);
//dd(count($begining_balance_total_enrollment));
        $begining_balance_total_exit = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('discharge_criteria_exit', '!=', null)
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->pluck('children_id')->toArray();
//        dd($begining_balance_total_exit);

        $endof_month_total_enrollment = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->pluck('children_id')->toArray();

        $endof_month_total_exit = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
            ->where('discharge_criteria_exit', '!=', null)
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->pluck('children_id')->toArray();

        $new_admission = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->pluck('children_id')->toArray();
        $re_admission = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('readmission', 'Readmission after default')
            ->pluck('children_id')->toArray();
        $transfer_in = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('transfer_in', 'Transfer in from BSFP')
            ->pluck('children_id')->toArray();
        $return_from = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('return_from', 'MAM Treatement')
            ->pluck('children_id')->toArray();

        $total_admission_report_month = array_merge($new_admission, $re_admission, $transfer_in, $return_from);
//dd($total_admission_report_month);
        $discharge = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('discharge_criteria_exit', 'Age > 59m')
            ->pluck('children_id')->toArray();
//dd($discharge);
        $defaulted = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('discharge_criteria_exit', 'Defaulted')
            ->pluck('children_id')->toArray();

        $death = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('discharge_criteria_exit', 'Death')
            ->pluck('children_id')->toArray();

        $transfer_out = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('discharge_criteria_transfer_out', 'Transfer to other BSFP')
            ->pluck('children_id')->toArray();
//dd($transfer_out);
        $transfer_to_sam = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('discharge_criteria_transfer_out', 'Transfer to SAM treatment')
            ->pluck('children_id')->toArray();

        $transfer_to_mam = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('discharge_criteria_transfer_out', 'Transfer to MAM treatment')
            ->pluck('children_id')->toArray();

        $others = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('discharge_criteria_others', '!=', null)
            ->pluck('children_id')->toArray();

        $total_exits_report_month = array_merge($discharge, $defaulted, $death, $transfer_out, $transfer_to_sam, $transfer_to_mam, $others);
//        dd($total_exits_report_month);

        $report['begining_balance_23_male'] = count(array_intersect($begining_balance_total_enrollment, $male_23)) - count(array_intersect($begining_balance_total_exit, $male_23));
        $report['begining_balance_23_female'] = count(array_intersect($begining_balance_total_enrollment, $female_23)) - count(array_intersect($begining_balance_total_exit, $female_23));
        $report['begining_balance_24to59_male'] = count(array_intersect($begining_balance_total_enrollment, $male_24to59)) - count(array_intersect($begining_balance_total_exit, $male_24to59));
        $report['begining_balance_24to59_female'] = count(array_intersect($begining_balance_total_enrollment, $female_24to59)) - count(array_intersect($begining_balance_total_exit, $female_24to59));

        $report['new_admission_23_male'] = count(array_intersect($new_admission, $male_23));
        $report['new_admission_23_female'] = count(array_intersect($new_admission, $female_23));
        $report['new_admission_24to59_male'] = count(array_intersect($new_admission, $male_24to59));
        $report['new_admission_24to59_female'] = count(array_intersect($new_admission, $female_24to59));

        $report['re_admission_23_male'] = count(array_intersect($re_admission, $male_23));
        $report['re_admission_23_female'] = count(array_intersect($re_admission, $female_23));
        $report['re_admission_24to59_male'] = count(array_intersect($re_admission, $male_24to59));
        $report['re_admission_24to59_female'] = count(array_intersect($re_admission, $female_24to59));

        $report['transfer_in_23_male'] = count(array_intersect($transfer_in, $male_23));
        $report['transfer_in_23_female'] = count(array_intersect($transfer_in, $female_23));
        $report['transfer_in_24to59_male'] = count(array_intersect($transfer_in, $male_24to59));
        $report['transfer_in_24to59_female'] = count(array_intersect($transfer_in, $female_24to59));

        $report['return_from_23_male'] = count(array_intersect($return_from, $male_23));
        $report['return_from_23_female'] = count(array_intersect($return_from, $female_23));
        $report['return_from_24to59_male'] = count(array_intersect($return_from, $male_24to59));
        $report['return_from_24to59_female'] = count(array_intersect($return_from, $female_24to59));

        $report['total_admission_23_male'] = count(array_intersect($total_admission_report_month, $male_23));
        $report['total_admission_23_female'] = count(array_intersect($total_admission_report_month, $female_23));
        $report['total_admission_24to59_male'] = count(array_intersect($total_admission_report_month, $male_24to59));
        $report['total_admission_24to59_female'] = count(array_intersect($total_admission_report_month, $female_24to59));

//Exit/Discharge
        $report['discharge_23_male'] = count(array_intersect($discharge, $male_23));
        $report['discharge_23_female'] = count(array_intersect($discharge, $female_23));
        $report['discharge_24to59_male'] = count(array_intersect($discharge, $male_24to59));
        $report['discharge_24to59_female'] = count(array_intersect($discharge, $female_24to59));

        $report['defaulted_23_male'] = count(array_intersect($defaulted, $male_23));
        $report['defaulted_23_female'] = count(array_intersect($defaulted, $female_23));
        $report['defaulted_24to59_male'] = count(array_intersect($defaulted, $male_24to59));
        $report['defaulted_24to59_female'] = count(array_intersect($defaulted, $female_24to59));

        $report['death_23_male'] = count(array_intersect($death, $male_23));
        $report['death_23_female'] = count(array_intersect($death, $female_23));
        $report['death_24to59_male'] = count(array_intersect($death, $male_24to59));
        $report['death_24to59_female'] = count(array_intersect($death, $female_24to59));

        $report['transfer_out_23_male'] = count(array_intersect($transfer_out, $male_23));
        $report['transfer_out_23_female'] = count(array_intersect($transfer_out, $female_23));
        $report['transfer_out_24to59_male'] = count(array_intersect($transfer_out, $male_24to59));
        $report['transfer_out_24to59_female'] = count(array_intersect($transfer_out, $female_24to59));

        $report['transfer_to_sam_23_male'] = count(array_intersect($transfer_to_sam, $male_23));
        $report['transfer_to_sam_23_female'] = count(array_intersect($transfer_to_sam, $female_23));
        $report['transfer_to_sam_24to59_male'] = count(array_intersect($transfer_to_sam, $male_24to59));
        $report['transfer_to_sam_24to59_female'] = count(array_intersect($transfer_to_sam, $female_24to59));

        $report['transfer_to_mam_23_male'] = count(array_intersect($transfer_to_mam, $male_23));
        $report['transfer_to_mam_23_female'] = count(array_intersect($transfer_to_mam, $female_23));
        $report['transfer_to_mam_24to59_male'] = count(array_intersect($transfer_to_mam, $male_24to59));
        $report['transfer_to_mam_24to59_female'] = count(array_intersect($transfer_to_mam, $female_24to59));

        $report['others_23_male'] = count(array_intersect($others, $male_23));
        $report['others_23_female'] = count(array_intersect($others, $female_23));
        $report['others_24to59_male'] = count(array_intersect($others, $male_24to59));
        $report['others_24to59_female'] = count(array_intersect($others, $female_24to59));

        $report['total_exits_23_male'] = count(array_intersect($total_exits_report_month, $male_23));
        $report['total_exits_23_female'] = count(array_intersect($total_exits_report_month, $female_23));
        $report['total_exits_24to59_male'] = count(array_intersect($total_exits_report_month, $male_24to59));
        $report['total_exits_24to59_female'] = count(array_intersect($total_exits_report_month, $female_24to59));

        $report['endof_month_23_male'] = count(array_intersect($endof_month_total_enrollment, $male_23)) - count(array_intersect($endof_month_total_exit, $male_23));
        $report['endof_month_23_female'] = count(array_intersect($endof_month_total_enrollment, $female_23)) - count(array_intersect($endof_month_total_exit, $female_23));
        $report['endof_month_24to59_male'] = count(array_intersect($endof_month_total_enrollment, $male_24to59)) - count(array_intersect($endof_month_total_exit, $male_24to59));
        $report['endof_month_24to59_female'] = count(array_intersect($endof_month_total_enrollment, $female_24to59)) - count(array_intersect($endof_month_total_exit, $female_24to59));

        $report['report_month'] = $report_month;
        $report['report_year'] = $report_year;

        return $report;

    }
    private function tsfp($facility_id, $report_month, $report_year)
    {
//        dd($facility_id);
//        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year);
        $begining_balance_1stday = \DB::table('facility_followups')->MIN('date');
        $begining_balance_lastday = date('Y-m-d', strtotime('-1 day', strtotime($report_year . '-' . $report_month . '-01')));
        $this_month_1stday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . '1'));
        $endof_month_lastday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . (cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year))));
//dd($begining_balance_1stday.'/'.$begining_balance_lastday.'/'.$endof_month_lastday);

        $male_23 = Child::select('sync_id')->where('age', '<=', 23)->where('sex', 'male')->pluck('sync_id')->toArray();
        $female_23 = Child::select('sync_id')->where('age', '<=', 23)->where('sex', 'female')->pluck('sync_id')->toArray();
        $male_24to59 = Child::select('sync_id')->where('age', '>=', 24)->where('age', '<=', 59)->where('sex', 'male')->pluck('sync_id')->toArray();
        $female_24to59 = Child::select('sync_id')->where('age', '>=', 24)->where('age', '<=', 59)->where('sex', 'female')->pluck('sync_id')->toArray();

        $begining_balance_new_admission = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->pluck('children_id')->toArray();
        $begining_balance_readmission = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('readmission', '!=', null)
            ->pluck('children_id')->toArray();
        $begining_balance_transfer_in = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('transfer_in', 'Transfer in from TSFP')
            ->pluck('children_id')->toArray();
        $begining_balance_return_from = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('return_from', 'SAM Treatment')
            ->pluck('children_id')->toArray();
        $begining_balance_total_enrollment = array_merge($begining_balance_new_admission, $begining_balance_readmission,
            $begining_balance_transfer_in, $begining_balance_return_from);
//dd(count($begining_balance_total_enrollment));

        $begining_balance_discharge_exit = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', '!=', null)
            ->where('outcome','!=', 'Already admitted at OTP')
            ->where('discharge_criteria_exit', '!=', null)
            ->where('discharge_criteria_exit', '!=', 'Recovered')
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->pluck('children_id')->toArray();
        $begining_balance_discharge_transfer_out = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', '!=', null)
            ->where('outcome','!=', 'Already admitted at OTP')
            ->where('discharge_criteria_transfer_out', '!=', null)
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to MAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to SC')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other OTP')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other BSFP')
            ->pluck('children_id')->toArray();
        $begining_balance_discharge_others = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', '!=', null)
            ->where('outcome','!=', 'Already admitted at OTP')
            ->where('discharge_criteria_others', '!=', null)
            ->pluck('children_id')->toArray();
        $begining_balance_total_exit = array_merge($begining_balance_discharge_exit, $begining_balance_discharge_transfer_out, $begining_balance_discharge_others);

        $new_admission_muac = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('new_admission', 'MUAC')
            ->pluck('children_id')->toArray();
        $new_admission_zscore = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('new_admission','!=', null)
            ->where('new_admission','!=', 'Oedema')
            ->where('new_admission','!=', 'Age 6 to 59m')
            ->where('new_admission','!=', 'Relapse')
            ->pluck('children_id')->toArray();
        $readmission_after_default = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('readmission', 'Readmission after default')
            ->pluck('children_id')->toArray();
        $readmission_after_recovery = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('readmission', 'Readmission after non recovery')
            ->pluck('children_id')->toArray();
        $transfer_in_from_tsfp = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('transfer_in', 'Transfer in from TSFP')
            ->pluck('children_id')->toArray();
        $return_from_sam = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('return_from', 'SAM Treatment')
            ->pluck('children_id')->toArray();

        $discharge_cured = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_exit',  'Recovered')
            ->pluck('children_id')->toArray();
        $discharge_death = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_exit',  'Death')
            ->pluck('children_id')->toArray();
        $discharge_defaulted = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_exit',  'Defaulted')
            ->pluck('children_id')->toArray();
        $discharge_nonresponder = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_exit',  'Non responder')
            ->pluck('children_id')->toArray();
        $discharge_transfer_to_sam = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_transfer_out',  'Transfer to SAM treatment')
            ->pluck('children_id')->toArray();
        $discharge_transfer_to_other_tsfp = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_transfer_out',  'Transfer to other TSFP')
            ->pluck('children_id')->toArray();
        $discharge_others = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$this_month_1stday, $endof_month_lastday])
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_others','!=',  null)
            ->pluck('children_id')->toArray();

        $total_admission_report_month = array_merge($new_admission_muac, $new_admission_zscore, $readmission_after_default,
            $readmission_after_recovery, $transfer_in_from_tsfp, $return_from_sam);
//dd($total_admission_report_month);

        $total_exits_report_month = array_merge($discharge_cured, $discharge_death, $discharge_defaulted, $discharge_nonresponder,
            $discharge_transfer_to_sam, $discharge_transfer_to_other_tsfp, $discharge_others);
//        dd($total_exits_report_month);

        $report['begining_balance_23_male'] = count(array_intersect($begining_balance_total_enrollment, $male_23)) - count(array_intersect($begining_balance_total_exit, $male_23));
        $report['begining_balance_23_female'] = count(array_intersect($begining_balance_total_enrollment, $female_23)) - count(array_intersect($begining_balance_total_exit, $female_23));
        $report['begining_balance_24to59_male'] = count(array_intersect($begining_balance_total_enrollment, $male_24to59)) - count(array_intersect($begining_balance_total_exit, $male_24to59));
        $report['begining_balance_24to59_female'] = count(array_intersect($begining_balance_total_enrollment, $female_24to59)) - count(array_intersect($begining_balance_total_exit, $female_24to59));

        $report['new_admission_23_male_muac'] = count(array_intersect($new_admission_muac, $male_23));
        $report['new_admission_23_female_muac'] = count(array_intersect($new_admission_muac, $female_23));
        $report['new_admission_24to59_male_muac'] = count(array_intersect($new_admission_muac, $male_24to59));
        $report['new_admission_24to59_female_muac'] = count(array_intersect($new_admission_muac, $female_24to59));

        $report['new_admission_23_male_zscore'] = count(array_intersect($new_admission_zscore, $male_23));
        $report['new_admission_23_female_zscore'] = count(array_intersect($new_admission_zscore, $female_23));
        $report['new_admission_24to59_male_zscore'] = count(array_intersect($new_admission_zscore, $male_24to59));
        $report['new_admission_24to59_female_zscore'] = count(array_intersect($new_admission_zscore, $female_24to59));

        $report['readmission_after_default_23_male'] = count(array_intersect($readmission_after_default, $male_23));
        $report['readmission_after_default_23_female'] = count(array_intersect($readmission_after_default, $female_23));
        $report['readmission_after_default_24to59_male'] = count(array_intersect($readmission_after_default, $male_24to59));
        $report['readmission_after_default_24to59_female'] = count(array_intersect($readmission_after_default, $female_24to59));

        $report['readmission_after_recovery_23_male'] = count(array_intersect($readmission_after_recovery, $male_23));
        $report['readmission_after_recovery_23_female'] = count(array_intersect($readmission_after_recovery, $female_23));
        $report['readmission_after_recovery_24to59_male'] = count(array_intersect($readmission_after_recovery, $male_24to59));
        $report['readmission_after_recovery_24to59_female'] = count(array_intersect($readmission_after_recovery, $female_24to59));

        $report['transfer_in_from_tsfp_23_male'] = count(array_intersect($transfer_in_from_tsfp, $male_23));
        $report['transfer_in_from_tsfp_23_female'] = count(array_intersect($transfer_in_from_tsfp, $female_23));
        $report['transfer_in_from_tsfp_24to59_male'] = count(array_intersect($transfer_in_from_tsfp, $male_24to59));
        $report['transfer_in_from_tsfp_24to59_female'] = count(array_intersect($transfer_in_from_tsfp, $female_24to59));

        $report['return_from_sam_23_male'] = count(array_intersect($return_from_sam, $male_23));
        $report['return_from_sam_23_female'] = count(array_intersect($return_from_sam, $female_23));
        $report['return_from_sam_24to59_male'] = count(array_intersect($return_from_sam, $male_24to59));
        $report['return_from_sam_24to59_female'] = count(array_intersect($return_from_sam, $female_24to59));

        $report['total_admission_23_male'] = count(array_intersect($total_admission_report_month, $male_23));
        $report['total_admission_23_female'] = count(array_intersect($total_admission_report_month, $female_23));
        $report['total_admission_24to59_male'] = count(array_intersect($total_admission_report_month, $male_24to59));
        $report['total_admission_24to59_female'] = count(array_intersect($total_admission_report_month, $female_24to59));

//Exit/Discharge
        $report['discharge_cured_23_male'] = count(array_intersect($discharge_cured, $male_23));
        $report['discharge_cured_23_female'] = count(array_intersect($discharge_cured, $female_23));
        $report['discharge_cured_24to59_male'] = count(array_intersect($discharge_cured, $male_24to59));
        $report['discharge_cured_24to59_female'] = count(array_intersect($discharge_cured, $female_24to59));

        $report['discharge_defaulted_23_male'] = count(array_intersect($discharge_defaulted, $male_23));
        $report['discharge_defaulted_23_female'] = count(array_intersect($discharge_defaulted, $female_23));
        $report['discharge_defaulted_24to59_male'] = count(array_intersect($discharge_defaulted, $male_24to59));
        $report['discharge_defaulted_24to59_female'] = count(array_intersect($discharge_defaulted, $female_24to59));

        $report['discharge_death_23_male'] = count(array_intersect($discharge_death, $male_23));
        $report['discharge_death_23_female'] = count(array_intersect($discharge_death, $female_23));
        $report['discharge_death_24to59_male'] = count(array_intersect($discharge_death, $male_24to59));
        $report['discharge_death_24to59_female'] = count(array_intersect($discharge_death, $female_24to59));

        $report['discharge_nonresponder_23_male'] = count(array_intersect($discharge_nonresponder, $male_23));
        $report['discharge_nonresponder_23_female'] = count(array_intersect($discharge_nonresponder, $female_23));
        $report['discharge_nonresponder_24to59_male'] = count(array_intersect($discharge_nonresponder, $male_24to59));
        $report['discharge_nonresponder_24to59_female'] = count(array_intersect($discharge_nonresponder, $female_24to59));

        $report['discharge_transfer_to_sam_23_male'] = count(array_intersect($discharge_transfer_to_sam, $male_23));
        $report['discharge_transfer_to_sam_23_female'] = count(array_intersect($discharge_transfer_to_sam, $female_23));
        $report['discharge_transfer_to_sam_24to59_male'] = count(array_intersect($discharge_transfer_to_sam, $male_24to59));
        $report['discharge_transfer_to_sam_24to59_female'] = count(array_intersect($discharge_transfer_to_sam, $female_24to59));

        $report['discharge_transfer_to_other_tsfp_23_male'] = count(array_intersect($discharge_transfer_to_other_tsfp, $male_23));
        $report['discharge_transfer_to_other_tsfp_23_female'] = count(array_intersect($discharge_transfer_to_other_tsfp, $female_23));
        $report['discharge_transfer_to_other_tsfp_24to59_male'] = count(array_intersect($discharge_transfer_to_other_tsfp, $male_24to59));
        $report['discharge_transfer_to_other_tsfp_24to59_female'] = count(array_intersect($discharge_transfer_to_other_tsfp, $female_24to59));

        $report['discharge_others_23_male'] = count(array_intersect($discharge_others, $male_23));
        $report['discharge_others_23_female'] = count(array_intersect($discharge_others, $female_23));
        $report['discharge_others_24to59_male'] = count(array_intersect($discharge_others, $male_24to59));
        $report['discharge_others_24to59_female'] = count(array_intersect($discharge_others, $female_24to59));

        $report['total_exits_23_male'] = count(array_intersect($total_exits_report_month, $male_23));
        $report['total_exits_23_female'] = count(array_intersect($total_exits_report_month, $female_23));
        $report['total_exits_24to59_male'] = count(array_intersect($total_exits_report_month, $male_24to59));
        $report['total_exits_24to59_female'] = count(array_intersect($total_exits_report_month, $female_24to59));


        $report['endof_month_23_male'] = count(array_intersect($begining_balance_total_enrollment, $male_23)) - count(array_intersect($begining_balance_total_exit, $male_23))
        + count(array_intersect($total_admission_report_month, $male_23)) - count(array_intersect($total_exits_report_month, $male_23));
        $report['endof_month_23_female'] = count(array_intersect($begining_balance_total_enrollment, $female_23)) - count(array_intersect($begining_balance_total_exit, $female_23))
        + count(array_intersect($total_admission_report_month, $female_23)) - count(array_intersect($total_exits_report_month, $female_23));
        $report['endof_month_24to59_male'] = count(array_intersect($begining_balance_total_enrollment, $male_24to59)) - count(array_intersect($begining_balance_total_exit, $male_24to59))
        + count(array_intersect($total_admission_report_month, $male_24to59)) - count(array_intersect($total_exits_report_month, $male_24to59));
        $report['endof_month_24to59_female'] = count(array_intersect($begining_balance_total_enrollment, $female_24to59)) - count(array_intersect($begining_balance_total_exit, $female_24to59))
        + count(array_intersect($total_admission_report_month, $female_24to59)) - count(array_intersect($total_exits_report_month, $female_24to59));

        $report['report_month'] = $report_month;
        $report['report_year'] = $report_year;

        return $report;

    }


}
