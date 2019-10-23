<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\MonthlyDashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class MonthlyDashboardController extends Controller
{
    private $_notify_message = 'Dashboard cache data generated successfully.';
    private $_notify_type = 'success';

    public function index()
    {
        dd('done');
        return view('monthly-dashboard');
    }

    public function create()
    {

        $current_month = date('n');
        $generated_data=\DB::table('monthly_dashboards')
            ->select('year','month')
            ->groupBy('year','month')
//            ->groupBy(\DB::raw('month') )
            ->orderBy('year','desc')
            ->orderBy('month','desc')
            ->get();
//        dd($generated_data);


        return view('monthly_dashboard.create', compact('current_month', 'generated_data'));

    }

    public function store(Request $request)
    {
//        dd($request);
        if ($request->save == 'generate') {
            $dataExists = MonthlyDashboard::where('month', $request->month)
                ->where('year', $request->year)
                ->exists();
            if ($dataExists) {
                return Redirect::back()->with([
                    'notify_message' => 'Already data generated for this month',
                    'notify_type' => 'danger'
                ]);
            }
        }
        if ($request->save == 're-generate') {
            $del_data = MonthlyDashboard::where('month', $request->month)
                ->where('year', $request->year)->delete();
        }
        $facilities = Facility::all();

        for ($i = 0; $i < $facilities->count(); $i++) {
            $md = new MonthlyDashboard();
            $md->facility_id = $facilities[$i]->id;
            $md->month = $request->month;
            $md->year = $request->year;
//            $md->created_by = Auth::user()->id;
            $md->otp_admit_23m = $this->otp_admit_23($facilities[$i]->id, $request->month, $request->year, 'male');
            $md->otp_admit_23f = $this->otp_admit_23($facilities[$i]->id, $request->month, $request->year, 'female');
            $md->otp_admit_24m = $this->otp_admit_24($facilities[$i]->id, $request->month, $request->year, 'male');
            $md->otp_admit_24f = $this->otp_admit_24($facilities[$i]->id, $request->month, $request->year, 'female');
            $md->otp_admit_60m = $this->otp_admit_60($facilities[$i]->id, $request->month, $request->year, 'male');
            $md->otp_admit_60f = $this->otp_admit_60($facilities[$i]->id, $request->month, $request->year, 'female');
            $md->otp_admit_male = $this->otp_admit_gender($facilities[$i]->id, $request->month, $request->year, 'male');
            $md->otp_admit_female = $this->otp_admit_gender($facilities[$i]->id, $request->month, $request->year, 'female');
            $md->otp_admit_others = $this->otp_admit_gender($facilities[$i]->id, $request->month, $request->year, 'other');
            $md->otp_admit_muac = $this->otp_admit_anthropometry($facilities[$i]->id, $request->month, $request->year, 'MUAC');
            $md->otp_admit_whz = $this->otp_admit_anthropometry($facilities[$i]->id, $request->month, $request->year, 'WFH Zscore');
            $md->otp_admit_both = $this->otp_admit_anthropometry($facilities[$i]->id, $request->month, $request->year, 'MUAC and WFH Zscore');
            $md->total_admit = $this->total_registration($facilities[$i]->id, $request->month, $request->year);
            $md->cure_rate = $this->discharge_criteria_rate($facilities[$i]->id, $request->month, $request->year, 'Recovered');
            $md->death_rate = $this->discharge_criteria_rate($facilities[$i]->id, $request->month, $request->year, 'Death');
            $md->default_rate = $this->discharge_criteria_rate($facilities[$i]->id, $request->month, $request->year, 'Defaulted');
            $md->nonrespondent_rate = $this->discharge_criteria_rate($facilities[$i]->id, $request->month, $request->year, 'Non responder');
            $md->avg_weight_gain = $this->average_weight_gain($facilities[$i]->id, $request->month, $request->year);
            $md->avg_length_stay = $this->average_length_of_stay($facilities[$i]->id, $request->month, $request->year);
            $md->otp_mnthend_23m = $this->otp_mnthend_23($facilities[$i]->id, $request->month, $request->year, 'male');
            $md->otp_mnthend_23f = $this->otp_mnthend_23($facilities[$i]->id, $request->month, $request->year, 'female');
            $md->otp_mnthend_24m = $this->otp_mnthend_24($facilities[$i]->id, $request->month, $request->year, 'male');
            $md->otp_mnthend_24f = $this->otp_mnthend_24($facilities[$i]->id, $request->month, $request->year, 'female');
            $md->otp_mnthend_60m = $this->otp_mnthend_60($facilities[$i]->id, $request->month, $request->year, 'male');
            $md->otp_mnthend_60f = $this->otp_mnthend_60($facilities[$i]->id, $request->month, $request->year, 'female');

            $md->save();
        }
        return redirect('monthly-dashboard/create')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);

    }

    private function otp_mnthend_23($facility_id, $month, $year, $sex)
    {
        $begining_balance_1stday = \DB::table('facility_followups')->MIN('date');
        $endof_month_lastday = date('Y-m-d', strtotime($year . '-' . $month . '-' . (cal_days_in_month(CAL_GREGORIAN, $month, $year))));
        $child_23 = Child::where('age', '<=', 23)->where('sex', $sex)->pluck('sync_id')->toArray();
//dd($child_23);
        $endof_month_total_enrollment = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->where('transfer_in', '!=', 'Transfer in from Medical Center')
            ->pluck('children_id')->toArray();
//dd($endof_month_total_enrollment);
        $endof_month_total_exit = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to SAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to MAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other TSFP')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other BSFP')
            ->pluck('children_id')->toArray();
//dd($endof_month_total_exit);
        return (count(array_intersect($endof_month_total_enrollment, $child_23)) - count(array_intersect($endof_month_total_exit, $child_23)));
//        return count(array_intersect($endof_month_total_enrollment, $child_23));
    }

    private function otp_mnthend_24($facility_id, $month, $year, $sex)
    {
        $begining_balance_1stday = \DB::table('facility_followups')->MIN('date');
        $endof_month_lastday = date('Y-m-d', strtotime($year . '-' . $month . '-' . (cal_days_in_month(CAL_GREGORIAN, $month, $year))));
        $child_24 = Child::where('age', '>=', 24)->where('age', '<=', 59)->where('sex', $sex)->pluck('sync_id')->toArray();
        $endof_month_total_enrollment = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->where('transfer_in', '!=', 'Transfer in from Medical Center')
            ->pluck('children_id')->toArray();
        $endof_month_total_exit = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to SAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to MAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other TSFP')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other BSFP')
            ->pluck('children_id')->toArray();
        return (count(array_intersect($endof_month_total_enrollment, $child_24)) - count(array_intersect($endof_month_total_exit, $child_24)));
    }

    private function otp_mnthend_60($facility_id, $month, $year, $sex)
    {
        $begining_balance_1stday = \DB::table('facility_followups')->MIN('date');
        $endof_month_lastday = date('Y-m-d', strtotime($year . '-' . $month . '-' . (cal_days_in_month(CAL_GREGORIAN, $month, $year))));
        $child_60 = Child::where('age', '>=', 60)->where('sex', $sex)->pluck('sync_id')->toArray();
        $endof_month_total_enrollment = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->where('transfer_in', '!=', 'Transfer in from Medical Center')
            ->pluck('children_id')->toArray();
        $endof_month_total_exit = FacilityFollowup::where('facility_id', $facility_id)
            ->whereBetween('date', [$begining_balance_1stday, $endof_month_lastday])
            ->where('discharge_criteria_exit', '!=', 'Age > 59m')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to SAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to MAM treatment')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other TSFP')
            ->where('discharge_criteria_transfer_out', '!=', 'Transfer to other BSFP')
            ->pluck('children_id')->toArray();
        return (count(array_intersect($endof_month_total_enrollment, $child_60)) - count(array_intersect($endof_month_total_exit, $child_60)));
    }

    private function total_registration($facility_id, $month, $year)
    {
        $children = Child::where('facility_id', $facility_id)
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->get();
        return count($children);
    }

    private function average_weight_gain($facility_id, $month, $year)
    {
        $recovered_child = FacilityFollowup::where('facility_id', $facility_id)
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->where('discharge_criteria_exit', 'Recovered')->get();
        if ($recovered_child->count() == 0) {
            $average_weight_gain = 0;
        } else {
            $average_weight_gain = $recovered_child->sum('gain_of_weight') / $recovered_child->count();
        }
        return $average_weight_gain;
    }

    private function average_length_of_stay($facility_id, $month, $year)
    {
        $recovered_child = FacilityFollowup::where('facility_id', $facility_id)
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->where('discharge_criteria_exit', 'Recovered')->get();
        if ($recovered_child->count() == 0) {
            $average_length_of_stay = 0;
        } else {
            $average_length_of_stay = $recovered_child->sum('duration_between_discharged_and_admission_days') / $recovered_child->count();
        }
        return $average_length_of_stay;
    }

    private function discharge_criteria_rate($facility_id, $month, $year, $criteria)
    {
        $facilityFollowup = FacilityFollowup::where('facility_id', $facility_id)
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->get();
        $dashboard_cureRate = 0;
        $dashboard_count = 0;
        foreach ($facilityFollowup as $child) {
            if ($child->discharge_criteria_exit == $criteria) {
                $dashboard_cureRate++;
            }
            if (isset($child->discharge_criteria_exit)) {
                $dashboard_count++;
            }
        }
        if ($dashboard_count == 0) {
            $rate_cureRate = 0;
        } else {
            $rate_cureRate = $dashboard_cureRate / $dashboard_count * 100;
        }
        return $rate_cureRate;
    }

    private function otp_admit_23($facility_id, $month, $year, $sex)
    {
        $child_23 = Child::where('age', '<=', 23)->where('sex', $sex)->pluck('sync_id')->toArray();
        $otp_admission_23 = FacilityFollowup::where('facility_id', $facility_id)
//            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->pluck('children_id')->toArray();
        return count(array_intersect($otp_admission_23, $child_23));
    }

    private function otp_admit_24($facility_id, $month, $year, $sex)
    {
        $child_24to59 = Child::where('age', '>=', 24)->where('age', '<=', 59)->where('sex', $sex)->pluck('sync_id')->toArray();
        $otp_admission_24 = FacilityFollowup::where('facility_id', $facility_id)
//            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->pluck('children_id')->toArray();
        return count(array_intersect($otp_admission_24, $child_24to59));
    }

    private function otp_admit_60($facility_id, $month, $year, $sex)
    {
        $child_60 = Child::where('age', '>=', 60)->where('sex', $sex)->pluck('sync_id')->toArray();
        $otp_admission_60 = FacilityFollowup::where('facility_id', $facility_id)
//            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->pluck('children_id')->toArray();
        return count(array_intersect($otp_admission_60, $child_60));
    }

    private function otp_admit_gender($facility_id, $month, $year, $sex)
    {
        $child = Child::where('age', '!=', null)->where('sex', $sex)->pluck('sync_id')->toArray();
        $otp_admission = FacilityFollowup::where('facility_id', $facility_id)
//            ->where('new_admission', '!=', null)
            ->where('new_admission', '!=', 'Age 6 to 59m')
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->pluck('children_id')->toArray();
        return count(array_intersect($otp_admission, $child));
    }

    private function otp_admit_anthropometry($facility_id, $month, $year, $type)
    {
        $child = Child::where('age', '!=', null)->pluck('sync_id')->toArray();
        $otp_admission_anthropometry = FacilityFollowup::where('facility_id', $facility_id)
            ->where('new_admission', $type)
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->pluck('children_id')->toArray();
        return count(array_intersect($otp_admission_anthropometry, $child));
    }


}
