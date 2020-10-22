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
            $report_male_24to59 = $this->otp($facility_id, $report_month, $report_year, 'male','24','59');
            $report_male_60up = $this->otp($facility_id, $report_month, $report_year, 'male','60','120');
            $report_female_6to23 = $this->otp($facility_id, $report_month, $report_year, 'female','6','23');
            $report_female_24to59 = $this->otp($facility_id, $report_month, $report_year, 'female','24','59');
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
    public function sc_report()
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

            $report_male_under6 = $this->sc($facility_id, $report_month, $report_year, 'male','0','6');
            $report_male_6to59 = $this->sc($facility_id, $report_month, $report_year, 'male','6','59');
            $report_male_60up = $this->sc($facility_id, $report_month, $report_year, 'male','60','520');
            $report_female_under6 = $this->sc($facility_id, $report_month, $report_year, 'female','0','6');
            $report_female_6to59 = $this->sc($facility_id, $report_month, $report_year, 'female','6','59');
            $report_female_60up = $this->sc($facility_id, $report_month, $report_year, 'female','60','520');

            return view('report.sc', compact('children', 'facility',  'facilities', 'current_month', 'current_year', 'facility_id',
                'report_male_under6','report_female_under6','report_female_6to59','report_male_6to59','report_male_60up','report_female_60up'));

        } else {

            $children = Child::orderBy('created_at', 'desc')->get();

            $facilities = Facility::all();
            $current_month = date('n');

            return view('report.search_home_sc', compact('children', 'current_month', 'facilities'));
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
//        $report = $this->otp($facility_id, $report_month, $report_year);
        $facilities = Facility::all();
        $current_month = $report_month;
        $current_year = $report_year;

        $report_male_6to23 = $this->otp($facility_id, $report_month, $report_year, 'male','6','23');
        $report_male_24to59 = $this->otp($facility_id, $report_month, $report_year, 'male','24','59');
        $report_male_60up = $this->otp($facility_id, $report_month, $report_year, 'male','60','120');
        $report_female_6to23 = $this->otp($facility_id, $report_month, $report_year, 'female','6','23');
        $report_female_24to59 = $this->otp($facility_id, $report_month, $report_year, 'female','24','59');
        $report_female_60up = $this->otp($facility_id, $report_month, $report_year, 'female','60','120');

//            dd($report);
        return view('report.otp', compact('children', 'facility', 'facilities', 'facility_id', 'current_year', 'current_month',
            'report_male_6to23','report_female_6to23','report_female_24to59','report_male_24to59','report_male_60up','report_female_60up'));

    }

    public function sc_report_admin(Request $request)
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
//        $report = $this->otp($facility_id, $report_month, $report_year);
        $facilities = Facility::all();
        $current_month = $report_month;
        $current_year = $report_year;

        $report_male_under6 = $this->sc($facility_id, $report_month, $report_year, 'male','0','6');
        $report_male_6to59 = $this->sc($facility_id, $report_month, $report_year, 'male','6','59');
        $report_male_60up = $this->sc($facility_id, $report_month, $report_year, 'male','60','520');
        $report_female_under6 = $this->sc($facility_id, $report_month, $report_year, 'female','0','6');
        $report_female_6to59 = $this->sc($facility_id, $report_month, $report_year, 'female','6','59');
        $report_female_60up = $this->sc($facility_id, $report_month, $report_year, 'female','60','520');

        return view('report.sc', compact('children', 'facility',  'facilities', 'current_month', 'current_year', 'facility_id',
            'report_male_under6','report_female_under6','report_female_6to59','report_male_6to59','report_male_60up','report_female_60up'));

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
        $facilities = Facility::all();
        $current_month = $report_month;
        $current_year = $report_year;

        $report_male_6to23 = $this->bsfp($facility_id, $report_month, $report_year, 'male','6','23');
        $report_male_24to59 = $this->bsfp($facility_id, $report_month, $report_year, 'male','24','59');
        $report_female_6to23 = $this->bsfp($facility_id, $report_month, $report_year, 'female','6','23');
        $report_female_24to59 = $this->bsfp($facility_id, $report_month, $report_year, 'female','24','59');

        return view('report.bsfp', compact('children', 'facility', 'facilities', 'current_month', 'current_year', 'facility_id',
            'report_male_6to23','report_female_6to23','report_male_24to59','report_female_24to59'));
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
//        $report = $this->tsfp($facility_id, $report_month, $report_year);
        $facilities = Facility::all();
        $current_month = $report_month;
        $current_year = $report_year;
        $report_male_6to23 = $this->tsfp($facility_id, $report_month, $report_year, 'male','6','23');
        $report_male_24to59 = $this->tsfp($facility_id, $report_month, $report_year, 'male','23','59');
        $report_female_6to23 = $this->tsfp($facility_id, $report_month, $report_year, 'female','6','23');
        $report_female_24to59 = $this->tsfp($facility_id, $report_month, $report_year, 'female','23','59');


        return view('report.tsfp', compact('children', 'facility', 'facilities', 'facility_id', 'current_year', 'current_month',
            'report_male_6to23','report_female_6to23','report_male_24to59','report_female_24to59'));

    }

    private function otp($facility_id, $report_month, $report_year, $sex, $start_age, $end_age)
    {
        $begining_balance_1stday = DB::table('facility_followups')->MIN('date');
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

        $otp['end_of_month']=$otp['begining_balance_total_enrolled']+$otp['enrollment_total']-$otp['exit_total'];

        return $otp;
    }
    private function sc($facility_id, $report_month, $report_year, $sex, $start_age, $end_age)
    {
        $begining_balance_1stday = DB::table('facility_followups')->MIN('date');
        $begining_balance_lastday = date('Y-m-d', strtotime('-1 day', strtotime($report_year . '-' . $report_month . '-01')));
        $this_month_1stday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . '1'));
        $endof_month_lastday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . (cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year))));

        $sc['begining_balance_new_admission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.new_admission', '!=', null)
            ->where('facility_followups.new_admission', '!=', 'Age 6 to 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['begining_balance_readmission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.readmission', '!=', null)
            ->where('facility_followups.readmission', '!=', 'Readmission after non recovery')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['begining_balance_transfer_in'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.transfer_in', 'Transfer in from OTP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['begining_balance_total_enrolled']=$sc['begining_balance_new_admission']+$sc['begining_balance_readmission']+$sc['begining_balance_transfer_in'];

        $sc['begining_balance_discharge_criteria_exit'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_exit', '!=', null)
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['begining_balance_discharge_criteria_others'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_others', '!=', null)
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['begining_balance_discharge_criteria_transfer_out'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_transfer_out', 'Transfer to other OTP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['begining_balance_total_exit']=$sc['begining_balance_discharge_criteria_exit']+$sc['begining_balance_discharge_criteria_others']+$sc['begining_balance_discharge_criteria_transfer_out'];

        $sc['begining_balance_total']=$sc['begining_balance_total_enrolled']+$sc['begining_balance_total_exit'];

        $sc['new_admission_muac'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.new_admission', 'MUAC')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['new_admission_zscore'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.new_admission','!=', null)
            ->where('facility_followups.new_admission','!=', 'MUAC')
            ->where('facility_followups.new_admission','!=', 'Oedema')
            ->where('facility_followups.new_admission','!=', 'Age 6 to 59m')
            ->where('facility_followups.new_admission','!=', 'Relapse')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['new_admission_oedema'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.new_admission', 'Oedema')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['new_admission_relapse'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.new_admission', 'Relapse')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['this_period_new_admission_total']=$sc['new_admission_muac']+$sc['new_admission_zscore']+$sc['new_admission_oedema']+$sc['new_admission_relapse'];

        $sc['readmission_after_default'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.readmission', 'Readmission after default')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['transfer_in_from_otp'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('facility_followups.transfer_in', 'Transfer in from OTP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $sc['this_period_transfer_in_total']=$sc['readmission_after_default']+$sc['transfer_in_from_otp'];

        $sc['this_period_enrollment_total']=$sc['this_period_new_admission_total']+$sc['this_period_transfer_in_total'];

        $sc['discharge_criteria_exit_recovered'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_exit',  'Recovered')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['discharge_criteria_exit_death'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_exit',  'Death')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['discharge_criteria_exit_defaulted'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_exit',  'Defaulted')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['discharge_criteria_exit_nonrecovered'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_exit',  'Non recovered')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['this_period_discharge_criteria_exit_total']=$sc['discharge_criteria_exit_recovered']+$sc['discharge_criteria_exit_death']+$sc['discharge_criteria_exit_defaulted']+$sc['discharge_criteria_exit_nonrecovered'];

        $sc['discharge_criteria_others_medical_transfer'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_others', 'Medical transfer')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['discharge_criteria_others_unkown'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_others', 'Unkown')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $sc['discharge_criteria_transfer_out_otp'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('medical_complecation', 1)
            ->where('discharge_criteria_transfer_out', 'Transfer to other OTP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $sc['this_period_discharge_criteria_transfer_out_total']=$sc['discharge_criteria_others_medical_transfer']+$sc['discharge_criteria_others_unkown'];

        $sc['this_period_exit_total']=$sc['this_period_discharge_criteria_exit_total']+$sc['this_period_discharge_criteria_transfer_out_total'];

        $sc['end_of_month']=$sc['begining_balance_total']+$sc['this_period_enrollment_total']-$sc['this_period_exit_total'];

        return $sc;
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
            $report_male_6to23 = $this->bsfp($facility_id, $report_month, $report_year, 'male','6','23');
            $report_male_24to59 = $this->bsfp($facility_id, $report_month, $report_year, 'male','24','59');
            $report_female_6to23 = $this->bsfp($facility_id, $report_month, $report_year, 'female','6','23');
            $report_female_24to59 = $this->bsfp($facility_id, $report_month, $report_year, 'female','24','59');
            return view('report.bsfp', compact('children', 'facility', 'facilities', 'current_month', 'current_year', 'facility_id',
                'report_male_6to23','report_female_6to23','report_male_24to59','report_female_24to59'));

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

            $facilities = Facility::all();
            $current_month = $report_month;
            $current_year = $report_year;

            $report_male_6to23 = $this->tsfp($facility_id, $report_month, $report_year, 'male','6','23');
            $report_male_24to59 = $this->tsfp($facility_id, $report_month, $report_year, 'male','24','59');
            $report_female_6to23 = $this->tsfp($facility_id, $report_month, $report_year, 'female','6','23');
            $report_female_24to59 = $this->tsfp($facility_id, $report_month, $report_year, 'female','24','59');

            return view('report.tsfp', compact('children', 'facility', 'facilities', 'current_month', 'current_year', 'facility_id',
                'report_male_6to23','report_female_6to23','report_male_24to59','report_female_24to59'));

        } else {

            $children = Child::orderBy('created_at', 'desc')->get();
            $facilities = Facility::all();
            $current_month = date('n');

            return view('report.search_home_bsfp', compact('children', 'current_month', 'facilities'));
        }

    }
    private function bsfp($facility_id, $report_month, $report_year, $sex, $start_age, $end_age)
    {
        $begining_balance_1stday = DB::table('facility_followups')->MIN('date');
        $begining_balance_lastday = date('Y-m-d', strtotime('-1 day', strtotime($report_year . '-' . $report_month . '-01')));
        $this_month_1stday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . '1'));
        $endof_month_lastday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . (cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year))));

//        $male_23 = Child::select('sync_id')->where('age', '<=', 23)->where('sex', 'male')->pluck('sync_id')->toArray();
//        $female_23 = Child::select('sync_id')->where('age', '<=', 23)->where('sex', 'female')->pluck('sync_id')->toArray();
//        $male_24to59 = Child::select('sync_id')->where('age', '>=', 24)->where('age', '<=', 59)->where('sex', 'male')->pluck('sync_id')->toArray();
//        $female_24to59 = Child::select('sync_id')->where('age', '>=', 24)->where('age', '<=', 59)->where('sex', 'female')->pluck('sync_id')->toArray();

        $bsfp['begining_balance_new_admission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome', 'Normal new case')
            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['begining_balance_readmission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome', 'Normal new case')
            ->where('readmission', 'Readmission after default')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $bsfp['begining_balance_transfer_in'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome', 'Normal new case')
            ->where('transfer_in', 'Transfer in from BSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $bsfp['begining_balance_return_from'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome', 'Normal new case')
            ->where('return_from', 'MAM Treatement')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $bsfp['begining_balance_total_enrollment']=$bsfp['begining_balance_new_admission']+$bsfp['begining_balance_readmission']+$bsfp['begining_balance_transfer_in']+$bsfp['begining_balance_return_from'];

        $bsfp['begining_balance_discharge_age>59'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_exit', 'Age > 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['begining_balance_discharge_defaulted'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_exit', 'Defaulted')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['begining_balance_discharge_death'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_exit', 'Death')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['begining_balance_transfer_out'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_transfer_out', 'Transfer to other BSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['begining_balance_transfer_to_sam'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_transfer_out', 'Transfer to SAM treatment')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['begining_balance_transfer_to_mam'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_transfer_out', 'Transfer to MAM treatment')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['begining_balance_others'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_others', '!=', null)
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $bsfp['begining_balance_total_exit']=$bsfp['begining_balance_discharge_age>59']+$bsfp['begining_balance_discharge_defaulted']+$bsfp['begining_balance_discharge_death']+$bsfp['begining_balance_transfer_out']+
            $bsfp['begining_balance_transfer_to_sam']+$bsfp['begining_balance_transfer_to_mam']+$bsfp['begining_balance_others'];

        $bsfp['begining_balance_total']=$bsfp['begining_balance_total_enrollment']-$bsfp['begining_balance_total_exit'];

        $bsfp['new_admission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome', 'Normal new case')
            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['readmission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome', 'Normal new case')
            ->where('readmission', 'Readmission after default')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $bsfp['transfer_in'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome', 'Normal new case')
            ->where('transfer_in', 'Transfer in from BSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $bsfp['return_from'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome', 'Normal new case')
            ->where('return_from', 'MAM Treatement')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['this_period_total_enrollment']=$bsfp['new_admission']+$bsfp['readmission']+$bsfp['transfer_in']+$bsfp['return_from'];

        $bsfp['discharge_age>59'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_exit', 'Age > 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['discharge_defaulted'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_exit', 'Defaulted')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['discharge_death'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_exit', 'Death')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['transfer_out'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_transfer_out', 'Transfer to other BSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['transfer_to_sam'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_transfer_out', 'Transfer to SAM treatment')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['transfer_to_mam'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_transfer_out', 'Transfer to MAM treatment')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['others'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'Normal')
            ->where('outcome','!=', 'Normal new case')
            ->where('discharge_criteria_others', '!=', null)
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();
        $bsfp['this_period_total_exit']=$bsfp['discharge_age>59']+$bsfp['discharge_defaulted']+$bsfp['discharge_death']+$bsfp['transfer_out']+
            $bsfp['transfer_to_sam']+$bsfp['transfer_to_mam']+$bsfp['others'];
        $bsfp['this_period_total']=$bsfp['this_period_total_enrollment']-$bsfp['this_period_total_exit'];
        $bsfp['end_of_month_total']=$bsfp['begining_balance_total']+$bsfp['this_period_total'];
//dd($bsfp);
        return $bsfp;

    }
    private function tsfp($facility_id, $report_month, $report_year, $sex, $start_age, $end_age)
    {
        $begining_balance_1stday = DB::table('facility_followups')->MIN('date');
        $begining_balance_lastday = date('Y-m-d', strtotime('-1 day', strtotime($report_year . '-' . $report_month . '-01')));
        $this_month_1stday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . '1'));
        $endof_month_lastday = date('Y-m-d', strtotime($report_year . '-' . $report_month . '-' . (cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year))));

        $tsfp['begining_balance_new_admission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['begining_balance_readmission'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('readmission', '!=', null)
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['begining_balance_transfer_in'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('transfer_in', 'Transfer in from TSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['begining_balance_return_from'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('return_from', 'SAM Treatment')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['begining_balance_total_enrollment'] = $tsfp['begining_balance_new_admission']+$tsfp['begining_balance_readmission']+$tsfp['begining_balance_transfer_in'] +$tsfp['begining_balance_return_from'];

        $tsfp['begining_balance_discharge_exit'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome','!=', 'Already admitted at sc')
            ->where('discharge_criteria_exit', '!=', null)
            ->where('discharge_criteria_exit', '!=', 'Recovered')
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['begining_balance_discharge_transfer_out'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome','!=', 'Already admitted at OTP')
            ->where('discharge_criteria_transfer_out', '!=', null)
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to MAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to SC')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other OTP')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other BSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['begining_balance_discharge_others'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$begining_balance_1stday, $begining_balance_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome','!=', 'Already admitted at OTP')
            ->where('discharge_criteria_others', '!=', null)
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['begining_balance_total_exit']=$tsfp['begining_balance_discharge_exit']+$tsfp['begining_balance_discharge_transfer_out']+$tsfp['begining_balance_discharge_others'];

        $tsfp['new_admission_muac'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('new_admission', 'MUAC')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['new_admission_zscore'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('new_admission','!=', null)
            ->where('new_admission','!=', 'Oedema')
            ->where('new_admission','!=', 'Age 6 to 59m')
            ->where('new_admission','!=', 'Relapse')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['readmission_after_default'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('readmission', 'Readmission after default')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['readmission_after_recovery'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('readmission', 'Readmission after non recovery')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['transfer_in_from_tsfp'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('transfer_in', 'Transfer in from TSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['return_from_sam'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('outcome', 'MAM new case')
            ->where('return_from', 'SAM Treatment')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['total_admission_report_month']=$tsfp['new_admission_muac']+$tsfp['new_admission_zscore']+$tsfp['readmission_after_default']+
            $tsfp['readmission_after_recovery']+$tsfp['transfer_in_from_tsfp']+ $tsfp['return_from_sam'];

        $tsfp['discharge_cured'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_exit',  'Recovered')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['discharge_death'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_exit',  'Death')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['discharge_defaulted'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_exit',  'Defaulted')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['discharge_nonresponder'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_exit',  'Non responder')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['discharge_transfer_to_sam'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_transfer_out',  'Transfer to SAM treatment')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['discharge_transfer_to_other_tsfp'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_transfer_out',  'Transfer to other TSFP')
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['discharge_others'] = DB::table('facility_followups')->where('facility_followups.facility_id', $facility_id)
            ->whereBetween('facility_followups.date', [$this_month_1stday, $endof_month_lastday])
            ->where('facility_followups.age', '>=', $start_age)
            ->where('facility_followups.age', '<=', $end_age)
            ->where('nutritionstatus', 'MAM')
            ->where('discharge_criteria_others','!=',  null)
            ->join('children', 'children.sync_id', '=', 'facility_followups.children_id')
            ->where('children.sex',$sex)
            ->count();

        $tsfp['total_exits_report_month']=$tsfp['discharge_cured']+ $tsfp['discharge_death']+$tsfp['discharge_defaulted']+$tsfp['discharge_nonresponder']+
            $tsfp['discharge_transfer_to_sam']+$tsfp['discharge_transfer_to_other_tsfp']+$tsfp['discharge_others'];

        $tsfp['end_of_month']=$tsfp['begining_balance_total_enrollment']- $tsfp['begining_balance_total_exit']+$tsfp['total_admission_report_month']-$tsfp['total_exits_report_month'];

//        dd($tsfp);
        return $tsfp;

    }


}
