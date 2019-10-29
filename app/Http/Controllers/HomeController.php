<?php

namespace App\Http\Controllers;

use App\FacilitySupervisor;
use App\MonthlyDashboard;
use Auth;
use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;


class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->facility_id) {
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            //$children = Child::where('camp_id', $facility->camp_id)->get();
            $children = Child::where('facility_id', Auth::user()->facility_id)->orderBy('created_at', 'desc')->get();
            $facilityFollowup = FacilityFollowup::where('facility_id', Auth::user()->facility_id)->get();

//Average weight gain and average length of stay for facility based user
            $recovered_child = FacilityFollowup::where('facility_id', Auth::user()->facility_id)->where('discharge_criteria_exit', 'Recovered')->get();
            if ($recovered_child->count() == 0) {
                $average_rate['weight_gain'] = 0;
                $average_rate['length_of_stay'] = 0;
            } else {
                $average_rate['weight_gain'] = $recovered_child->sum('gain_of_weight') / $recovered_child->count();
                $average_rate['length_of_stay'] = $recovered_child->sum('duration_between_discharged_and_admission_days') / $recovered_child->count();
            }
//End Average weight gain and average length of stay for facility based user
//dashboard chart doughnut
            $muac = FacilityFollowup::where('facility_id', Auth::user()->facility_id)->where('new_admission', 'MUAC')->get();
            $zscore = FacilityFollowup::where('facility_id', Auth::user()->facility_id)->where('new_admission', 'WFH Zscore')->get();
            $muac_zscore = FacilityFollowup::where('facility_id', Auth::user()->facility_id)->where('new_admission', 'MUAC and WFH Zscore')->get();
            if ($muac->count() == 0)
                $chart_doughnut['muac'] = 0;
            else
                $chart_doughnut['muac'] = $muac->count();
            if ($zscore->count() == 0)
                $chart_doughnut['zscore'] = 0;
            else
                $chart_doughnut['zscore'] = $zscore->count();
            if ($muac_zscore->count() == 0)
                $chart_doughnut['muac_zscore'] = 0;
            else
                $chart_doughnut['muac_zscore'] = $muac_zscore->count();
            $chart_doughnut_value = array_values($chart_doughnut);
//end dashboard chart doughnut
//dashboard chart bar
            $fromDate = \Carbon\Carbon::now()->subDay(30)->toDateString();
            $tillDate = \Carbon\Carbon::now()->subDay()->toDateString();
            $admission = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
                ->selectRaw('DATE(created_at) as dat, COUNT(*) as cunt')
                ->where('new_admission', 'MUAC')
                ->orWhere('new_admission', 'WFH Zscore')
                ->orWhere('new_admission', 'MUAC and WFH Zscore')
                ->groupBy('dat')
                ->whereBetween('created_at', [$fromDate, $tillDate])
                ->orderBy('dat', 'ASC')
                ->pluck('cunt', 'dat')->toArray();
            $chart_bar_count_value = array_values($admission);
            $chart_bar_date_key = array_keys($admission);
//end dashboard chart bar
        } else {
//            dd('admin');
            $children = Child::orderBy('created_at', 'desc')->get();
            $facilityFollowup = FacilityFollowup::orderBy('id', 'desc')->get();
//Average weight gain and average length of stay for without facility based user
            $recovered_child = FacilityFollowup::where('discharge_criteria_exit', 'Recovered')->get();
            if ($recovered_child->count() == 0) {
                $average_rate['weight_gain'] = 0;
                $average_rate['length_of_stay'] = 0;
            } else {
                $average_rate['weight_gain'] = $recovered_child->sum('gain_of_weight') / $recovered_child->count();
                $average_rate['length_of_stay'] = $recovered_child->sum('duration_between_discharged_and_admission_days') / $recovered_child->count();
            }
//End Average weight gain and average length of stay for without facility based user
//dashboard chart doughnut without facility based user
            $muac = FacilityFollowup::where('new_admission', 'MUAC')->get();
            $zscore = FacilityFollowup::where('new_admission', 'WFH Zscore')->get();
            $muac_zscore = FacilityFollowup::where('new_admission', 'MUAC and WFH Zscore')->get();
            if ($muac->count() == 0)
                $chart_doughnut['muac'] = 0;
            else
                $chart_doughnut['muac'] = $muac->count();
            if ($zscore->count() == 0)
                $chart_doughnut['zscore'] = 0;
            else
                $chart_doughnut['zscore'] = $zscore->count();
            if ($muac_zscore->count() == 0)
                $chart_doughnut['muac_zscore'] = 0;
            else
                $chart_doughnut['muac_zscore'] = $muac_zscore->count();
            $chart_doughnut_value = array_values($chart_doughnut);

//dashboard chart doughnut without facility based user
//dashboard chart bar without facility based user
            $fromDate = \Carbon\Carbon::now()->subDay(30)->toDateString();
            $tillDate = \Carbon\Carbon::now()->subDay()->toDateString();
            $admission = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
                ->selectRaw('DATE(created_at) as dat, COUNT(*) as cunt')
                ->where('new_admission', 'MUAC')
                ->orWhere('new_admission', 'WFH Zscore')
                ->orWhere('new_admission', 'MUAC and WFH Zscore')
                ->groupBy('dat')
                ->whereBetween('created_at', [$fromDate, $tillDate])
                ->orderBy('dat', 'ASC')
                ->pluck('cunt', 'dat')->toArray();
            $chart_bar_count_value = array_values($admission);
            $chart_bar_date_key = array_keys($admission);
//end dashboard chart bar

        }
        $facilities = Facility::orderBy('created_at', 'desc')->get();
        $dashboard = $this->findDataFromFacilityFollowup($facilityFollowup);

        //Sync data count
        $children_sync_count = Child::whereIn('sync_status', ['created', 'updated'])->count();
        $facility_followup_sync_count = FacilityFollowup::whereIn('sync_status', ['created', 'updated'])->count();

        return view('homepage.home', compact('children', 'facilities', 'dashboard', 'average_rate',
            'chart_doughnut_value', 'chart_bar_count_value', 'chart_bar_date_key', 'children_sync_count', 'facility_followup_sync_count'));
    }


    public function childInfo($child_id)
    {

        $child = Child::findOrFail($child_id);

        $community_followups = CommunityFollowup::where('children_id', $child_id)->orderBy('created_at', 'asc')->get()->toArray();
        $facility_followups = FacilityFollowup::with('facility')->where('children_id', $child_id)->orderBy('created_at', 'asc')->get()->toArray();

        $followups = array_merge($community_followups, $facility_followups);
        // dd($followups);
        usort($followups, function ($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        $chart_date = array_column($facility_followups, 'date');
        $chart_weight = array_column($facility_followups, 'weight');

        return view('homepage.child-info', compact('child', 'followups', 'chart_date', 'chart_weight'))->render();
    }

    public function programManagerDashboard_ym($year, $month)
    {
        $report_month = $month;
        $report_year = $year;
        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;

        $cache_data = DB::table('monthly_dashboards')
            ->select('year', 'month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()->toArray();
        $facility_supervision = FacilitySupervisor::where('user_id', Auth::user()->id)->pluck('facility_id')->toArray();
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year.'-'.$report_month.'-01') . " -$i months"));
        }

        $line_chart = $this->manager_dashboard_linechart($months,$facility_supervision);
        $doughnut_chart = $this->manager_dashboard_doughnutchart($report_year, $report_month,$facility_supervision);
        $bar_chart = $this->manager_dashboard_barchart($report_year, $report_month,$facility_supervision);

        return view('homepage.program-manager', compact('cache_data', 'month_year', 'doughnut_chart', 'bar_chart', 'line_chart'));

    }

    public function programManagerDashboard()
    {
        $cache_data = DB::table('monthly_dashboards')
            ->select('year', 'month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()->toArray();
//        dd($cache_data);
        if (empty($cache_data)) {
            if (date('n') == 1) {
                $report_month = 12;
                $report_year = date('Y') - 1;
            } else {
                $report_month = date('n') - 1;
                $report_year = date('Y');
            }
        } else {
            $report_month = $cache_data[0]->month;
            $report_year = $cache_data[0]->year;
        }

        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date('Y-m-01') . " -$i months"));
        }
        $facility_supervision = FacilitySupervisor::where('user_id', Auth::user()->id)->pluck('facility_id')->toArray();
        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $line_chart = $this->manager_dashboard_linechart($months,$facility_supervision);
        $doughnut_chart = $this->manager_dashboard_doughnutchart($report_year, $report_month,$facility_supervision);
        $bar_chart = $this->manager_dashboard_barchart($report_year, $report_month,$facility_supervision);

        return view('homepage.program-manager', compact('cache_data', 'month_year', 'doughnut_chart', 'bar_chart', 'line_chart'));
    }

    private function manager_dashboard_linechart($months,$facility_supervision)
    {

        $line_chart = DB::table('monthly_dashboards')
            ->join('facilities', 'facilities.id', '=', 'monthly_dashboards.facility_id')
            ->select('monthly_dashboards.period as Month', 'monthly_dashboards.total_admit as TotalAdmission', 'facilities.facility_id as Facility_name')
            ->whereIn('monthly_dashboards.facility_id', $facility_supervision)
            ->whereIn('monthly_dashboards.period', $months)
//            ->orderBy('monthly_dashboards.facility_id','desc')
            ->orderBy('monthly_dashboards.year', 'desc')
            ->orderBy('monthly_dashboards.month', 'desc')
            ->get()
            ->toArray();
        return $line_chart;
    }

    private function manager_dashboard_doughnutchart($report_year, $report_month,$facility_supervision)
    {
        $doughnut_chart = DB::table('monthly_dashboards')->select(DB::raw('sum(otp_admit_23m) as otp_admit_23m'), DB::raw('sum(otp_admit_23f) as otp_admit_23f')
            , DB::raw('sum(otp_admit_24m) as otp_admit_24m'), DB::raw('sum(otp_admit_24f) as otp_admit_24f')
            , DB::raw('sum(otp_admit_60m) as otp_admit_60m'), DB::raw('sum(otp_admit_60f) as otp_admit_60f')
            , DB::raw('sum(otp_admit_male) as otp_admit_male'), DB::raw('sum(otp_admit_female) as otp_admit_female'), DB::raw('sum(otp_admit_others) as otp_admit_others')
            , DB::raw('sum(otp_admit_muac) as otp_admit_muac'), DB::raw('sum(otp_admit_whz) as otp_admit_whz'), DB::raw('sum(otp_admit_both) as otp_admit_both')
        )
            ->where('month', $report_month)->where('year', $report_year)
            ->whereIn('facility_id', $facility_supervision)
            ->get();
        return $doughnut_chart;
    }

    private function manager_dashboard_barchart($report_year, $report_month,$facility_supervision)
    {
        $facility_supervision = FacilitySupervisor::where('user_id', Auth::user()->id)->pluck('facility_id')->toArray();
        $bar_chart = DB::table('monthly_dashboards')
            ->join('facilities', 'facilities.id', '=', 'monthly_dashboards.facility_id')
            ->select('facilities.facility_id', 'monthly_dashboards.avg_weight_gain',
                'monthly_dashboards.cure_rate', 'monthly_dashboards.death_rate', 'monthly_dashboards.default_rate', 'monthly_dashboards.nonrespondent_rate')
            ->where('month', $report_month)->where('year', $report_year)
            ->whereIn('monthly_dashboards.facility_id', $facility_supervision)
            ->get()
            ->toArray();
        $bar_chart['facility_id'] = array_column($bar_chart, 'facility_id');
        $bar_chart['avg_weight_gain'] = array_column($bar_chart, 'avg_weight_gain');
        $bar_chart['cure_rate'] = array_column($bar_chart, 'cure_rate');
        $bar_chart['death_rate'] = array_column($bar_chart, 'death_rate');
        $bar_chart['default_rate'] = array_column($bar_chart, 'default_rate');
        $bar_chart['nonrespondent_rate'] = array_column($bar_chart, 'nonrespondent_rate');
        return $bar_chart;

    }

    public function facilityInfo($facility_id)
    {
        $facility = Facility::findOrFail($facility_id);
        $facility_followups = FacilityFollowup::where('facility_id', $facility_id)->get();

        return view('homepage.facility-info', compact('facility', 'facility_followups'));
    }

    public function childSearch(Request $request)
    {
        $children = Child::where('children_name', 'LIKE', '%' . $request->q . '%')->orderBy('created_at', 'desc')->get();
        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('homepage.home', compact('children', 'facilities'));
    }

    public function facilitySearch(Request $request)
    {
        $children = Child::orderBy('created_at', 'desc')->get();
        $facilities = Facility::where('facility_id', 'LIKE', '%' . $request->q . '%')->orderBy('created_at', 'desc')->get();

        return view('homepage.home', compact('children', 'facilities'));
    }

    private function findDataFromFacilityFollowup($data)
    {
        $dashboard['cureRate'] = 0;
        $dashboard['deathRate'] = 0;
        $dashboard['defaultRate'] = 0;
        $dashboard['nonRespondantRate'] = 0;
        $dashboard['count'] = 0;
        foreach ($data as $child) {
            if ($child->discharge_criteria_exit == 'Recovered') {
                $dashboard['cureRate']++;
            }
            if ($child->discharge_criteria_exit == 'Death') {
                $dashboard['deathRate']++;
            }
            if ($child->discharge_criteria_exit == 'Defaulted') {
                $dashboard['defaultRate']++;
            }
            if (isset($child->discharge_criteria_exit)) {
                $dashboard['count']++;
            }

            if ($child->new_admission == '') {

            }
        }
        if ($dashboard['count'] == 0) {
            $rate['cureRate'] = 0;
            $rate['deathRate'] = 0;
            $rate['defaultRate'] = 0;
            $rate['nonRespondantRate'] = 0;
        } else {
            $rate['cureRate'] = $dashboard['cureRate'] / $dashboard['count'] * 100;
            $rate['deathRate'] = $dashboard['deathRate'] / $dashboard['count'] * 100;
            $rate['defaultRate'] = $dashboard['defaultRate'] / $dashboard['count'] * 100;
            $rate['nonRespondantRate'] = $dashboard['nonRespondantRate'] / $dashboard['count'] * 100;
        }

        return $rate;
    }

    public function test()
    {

        return view('test');


    }


}
