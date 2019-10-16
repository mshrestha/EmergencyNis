<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        if (Auth::user()->facility_id) {
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $children = Child::where('camp_id', $facility->camp_id)->get();
            //$facility_followup = FacilityFollowup::find();

        } else {

            $children = Child::orderBy('created_at', 'desc')->get();
            return 'report only for Facility based user';
        }

        if (date('n') == 1) {
            $report_month = 12;
            $report_year = date('Y') - 1;
        } else {
            $report_month = date('n') - 1;
            $report_year = date('Y');
        }

        $male_23 = Child::select('sync_id')->where('age','<=',23)->where('sex','male')->pluck('sync_id')->toArray();
        $female_23 = Child::select('sync_id')->where('age','<=',23)->where('sex','female')->pluck('sync_id')->toArray();

        $male_24to59 = Child::select('sync_id')->where('age','>=',24)->where('age','<=',59)->where('sex','male')->pluck('sync_id')->toArray();
        $female_24to59 = Child::select('sync_id')->where('age','>=',24)->where('age','<=',59)->where('sex','female')->pluck('sync_id')->toArray();

        $male_60 = Child::select('sync_id')->where('age','>=',60)->where('sex','male')->pluck('sync_id')->toArray();
        $female_60 = Child::select('sync_id')->where('age','>=',60)->where('sex','female')->pluck('sync_id')->toArray();

        $facility_followup_muac = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
            ->where('new_admission','muac')
            ->whereMonth('created_at', '=', $report_month)
            ->whereYear('created_at', '=', $report_year)
            ->pluck('children_id')->toArray();

        $facility_followup_zscore = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
            ->where('new_admission','WFH Zscore')
            ->whereMonth('created_at', '=', $report_month)
            ->whereYear('created_at', '=', $report_year)
            ->pluck('children_id')->toArray();

        $facility_followup_oedema = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
            ->where('new_admission','Oedema')
            ->whereMonth('created_at', '=', $report_month)
            ->whereYear('created_at', '=', $report_year)
            ->pluck('children_id')->toArray();

        $facility_followup_relapse = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
            ->where('new_admission','Relapse')
            ->whereMonth('created_at', '=', $report_month)
            ->whereYear('created_at', '=', $report_year)
            ->pluck('children_id')->toArray();

        $transfer_in_tsfp = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
            ->where('transfer_in','Transfer in from TSFP')
            ->whereMonth('created_at', '=', $report_month)
            ->whereYear('created_at', '=', $report_year)
            ->pluck('children_id')->toArray();

        $transfer_in_sc = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
            ->where('transfer_in','Transfer in from SC')
            ->whereMonth('created_at', '=', $report_month)
            ->whereYear('created_at', '=', $report_year)
            ->pluck('children_id')->toArray();

        $transfer_in_otp = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
            ->where('transfer_in','Transfer in from OTP')
            ->whereMonth('created_at', '=', $report_month)
            ->whereYear('created_at', '=', $report_year)
            ->pluck('children_id')->toArray();

//        $discharge_criteria_exit = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
//            ->where('discharge_criteria_exit','!=',null)
//            ->whereMonth('created_at', '=', $report_month)
//            ->whereYear('created_at', '=', $report_year)
//            ->pluck('children_id')->toArray();

        $report['muac_23_male']=count(array_intersect ($facility_followup_muac,$male_23));
        $report['muac_23_female']=count(array_intersect ($facility_followup_muac,$female_23));
        $report['muac_24to59_male']=count(array_intersect ($facility_followup_muac,$male_24to59));
        $report['muac_24to59_female']=count(array_intersect ($facility_followup_muac,$female_24to59));
        $report['muac_60_male']=count(array_intersect ($facility_followup_muac,$male_60));
        $report['muac_60_female']=count(array_intersect ($facility_followup_muac,$female_60));

        $report['zscore_23_male']=count(array_intersect ($facility_followup_zscore,$male_23));
        $report['zscore_23_female']=count(array_intersect ($facility_followup_zscore,$female_23));
        $report['zscore_24to59_male']=count(array_intersect ($facility_followup_zscore,$male_24to59));
        $report['zscore_24to59_female']=count(array_intersect ($facility_followup_zscore,$female_24to59));
        $report['zscore_60_male']=count(array_intersect ($facility_followup_zscore,$male_60));
        $report['zscore_60_female']=count(array_intersect ($facility_followup_zscore,$female_60));

        $report['oedema_23_male']=count(array_intersect ($facility_followup_oedema,$male_23));
        $report['oedema_23_female']=count(array_intersect ($facility_followup_oedema,$female_23));
        $report['oedema_24to59_male']=count(array_intersect ($facility_followup_oedema,$male_24to59));
        $report['oedema_24to59_female']=count(array_intersect ($facility_followup_oedema,$female_24to59));
        $report['oedema_60_male']=count(array_intersect ($facility_followup_oedema,$male_60));
        $report['oedema_60_female']=count(array_intersect ($facility_followup_oedema,$female_60));

        $report['relapse_23_male']=count(array_intersect ($facility_followup_relapse,$male_23));
        $report['relapse_23_female']=count(array_intersect ($facility_followup_relapse,$female_23));
        $report['relapse_24to59_male']=count(array_intersect ($facility_followup_relapse,$male_24to59));
        $report['relapse_24to59_female']=count(array_intersect ($facility_followup_relapse,$female_24to59));
        $report['relapse_60_male']=count(array_intersect ($facility_followup_relapse,$male_60));
        $report['relapse_60_female']=count(array_intersect ($facility_followup_relapse,$female_60));

        $report['return_default_23_male']=0;
        $report['return_default_23_female']=0;
        $report['return_default_24to59_male']=0;
        $report['return_default_24to59_female']=0;
        $report['return_default_60_male']=0;
        $report['return_default_60_female']=0;

        $report['transferin_tsfp_23_male']=count(array_intersect ($transfer_in_tsfp,$male_23));
        $report['transferin_tsfp_23_female']=count(array_intersect ($transfer_in_tsfp,$female_23));
        $report['transferin_tsfp_24to59_male']=count(array_intersect ($transfer_in_tsfp,$male_24to59));
        $report['transferin_tsfp_24to59_female']=count(array_intersect ($transfer_in_tsfp,$female_24to59));
        $report['transferin_tsfp_60_male']=count(array_intersect ($transfer_in_tsfp,$male_60));
        $report['transferin_tsfp_60_female']=count(array_intersect ($transfer_in_tsfp,$female_60));

        $report['transferin_sc_23_male']=count(array_intersect ($transfer_in_sc,$male_23));
        $report['transferin_sc_23_female']=count(array_intersect ($transfer_in_sc,$female_23));
        $report['transferin_sc_24to59_male']=count(array_intersect ($transfer_in_sc,$male_24to59));
        $report['transferin_sc_24to59_female']=count(array_intersect ($transfer_in_sc,$female_24to59));
        $report['transferin_sc_60_male']=count(array_intersect ($transfer_in_sc,$male_60));
        $report['transferin_sc_60_female']=count(array_intersect ($transfer_in_sc,$female_60));

        $report['transferin_otp_23_male']=count(array_intersect ($transfer_in_otp,$male_23));
        $report['transferin_otp_23_female']=count(array_intersect ($transfer_in_otp,$female_23));
        $report['transferin_otp_24to59_male']=count(array_intersect ($transfer_in_otp,$male_24to59));
        $report['transferin_otp_24to59_female']=count(array_intersect ($transfer_in_otp,$female_24to59));
        $report['transferin_otp_60_male']=count(array_intersect ($transfer_in_otp,$male_60));
        $report['transferin_otp_60_female']=count(array_intersect ($transfer_in_otp,$female_60));

//        $report['exit_23_male']=count(array_intersect ($discharge_criteria_exit,$male_23));
//        $report['exit_23_female']=count(array_intersect ($discharge_criteria_exit,$female_23));
//        $report['exit_24to59_male']=count(array_intersect ($discharge_criteria_exit,$male_24to59));
//        $report['exit_24to59_female']=count(array_intersect ($discharge_criteria_exit,$female_24to59));
//        $report['exit_60_male']=count(array_intersect ($discharge_criteria_exit,$male_60));
//        $report['exit_60_female']=count(array_intersect ($discharge_criteria_exit,$female_60));

//        dd($report);

        return view('report.home', compact('children', 'facility','report'));
    }
}
