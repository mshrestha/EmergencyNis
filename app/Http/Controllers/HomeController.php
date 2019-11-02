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

            $cache_data = DB::table('monthly_dashboards')->select('year', 'month')->groupBy('year', 'month')
                ->orderBy('year', 'desc')->orderBy('month', 'desc')->get()->toArray();
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
            if ($report_month == 1) {
                $previous_month = 12;
                $previous_year = $report_year - 1;
            } else {
                $previous_month = $report_month - 1;
                $previous_year = $report_year;
            }

            $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
            $report_month_dashboard = MonthlyDashboard::where('year', $report_year)->where('month', $report_month)
                ->where('facility_id', Auth::user()->facility_id)->first();
//            dd($report_month_dashboard);
            $previous_month_dashboard = MonthlyDashboard::where('year', $previous_year)->where('month', $previous_month)
                ->where('facility_id', Auth::user()->facility_id)->first();
//            dd($previous_month_dashboard);
            $children = Child::where('facility_id', Auth::user()->facility_id)->orderBy('created_at', 'desc')->get();
            $user_barchart = $this->user_dashboard_barchart();
            //Sync data count
            $children_sync_count = Child::whereIn('sync_status', ['created', 'updated'])->count();
            $facility_followup_sync_count = FacilityFollowup::whereIn('sync_status', ['created', 'updated'])->count();

            return view('homepage.home_user', compact('cache_data', 'month_year', 'report_month_dashboard', 'previous_month_dashboard',
                'children', 'user_barchart', 'children_sync_count', 'facility_followup_sync_count'));
        } else {
            $cache_data = DB::table('monthly_dashboards')->select('year', 'month')->groupBy('year', 'month')
                ->orderBy('year', 'desc')->orderBy('month', 'desc')->get()->toArray();
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

            $dashboard_data = $this->admin_dashboard_data($report_year, $report_month);
            $chart_doughnut_value = $this->admin_dashboard_doughnutchart($report_year, $report_month);
            $admin_barchart = $this->admin_dashboard_barchart();

            $facilityFollowup = FacilityFollowup::orderBy('id', 'desc')->whereMonth('date', '=', $report_month)->whereYear('date', '=', $report_year)->get();
            $dashboard = $this->findDataFromFacilityFollowup($facilityFollowup);

            //Sync data count
            $children_sync_count = Child::whereIn('sync_status', ['created', 'updated'])->count();
            $facility_followup_sync_count = FacilityFollowup::whereIn('sync_status', ['created', 'updated'])->count();

            return view('homepage.home', compact('cache_data','dashboard','dashboard_data',
//                'month_year',  'death_reportmonth','facilities',  'average_rate', 'admission_reportmonth', 'admission_total',
                'chart_doughnut_value', 'admin_barchart', 'children_sync_count', 'facility_followup_sync_count'));
        }
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

    public function adminDashboard_ym($year, $month)
    {
        $report_month = $month;
        $report_year = $year;
        $cache_data = DB::table('monthly_dashboards')
            ->select('year', 'month')->groupBy('year', 'month')
            ->orderBy('year', 'desc')->orderBy('month', 'desc')
            ->get()->toArray();
        $dashboard_data = $this->admin_dashboard_data($report_year, $report_month);
        $chart_doughnut_value = $this->admin_dashboard_doughnutchart($report_year, $report_month);
        $admin_barchart = $this->admin_dashboard_barchart();

        $facilityFollowup = FacilityFollowup::orderBy('id', 'desc')->whereMonth('date', '=', $report_month)->whereYear('date', '=', $report_year)->get();
        $dashboard = $this->findDataFromFacilityFollowup($facilityFollowup);

        //Sync data count
        $children_sync_count = Child::whereIn('sync_status', ['created', 'updated'])->count();
        $facility_followup_sync_count = FacilityFollowup::whereIn('sync_status', ['created', 'updated'])->count();

        return view('homepage.home', compact('cache_data', 'dashboard','dashboard_data',
            'chart_doughnut_value', 'admin_barchart', 'children_sync_count', 'facility_followup_sync_count'));
    }

    public function programUserDashboard_ym($year, $month)
    {
        $report_month = $month;
        $report_year = $year;
        if ($report_month == 1) {
            $previous_month = 12;
            $previous_year = $report_year - 1;
        } else {
            $previous_month = $report_month - 1;
            $previous_year = $report_year;
        }
        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $cache_data = DB::table('monthly_dashboards')
            ->select('year', 'month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()->toArray();
        $report_month_dashboard = MonthlyDashboard::where('year', $report_year)->where('month', $report_month)
            ->where('facility_id', Auth::user()->facility_id)->first();
//        dd($report_month_dashboard);
        if ($report_month_dashboard==null)
        {
//            dd($report_month_dashboard);
            $report_month_dashboard['otp_admit_23m']=0;
            $report_month_dashboard['otp_admit_23f']=0;
            $report_month_dashboard['otp_admit_24m']=0;
            $report_month_dashboard['otp_admit_24f']=0;
            $report_month_dashboard['otp_admit_60m']=0;
            $report_month_dashboard['otp_admit_60f']=0;
            $report_month_dashboard['otp_admit_male']=0;
            $report_month_dashboard['otp_admit_female']=0;
            $report_month_dashboard['otp_admit_others']=0;
            $report_month_dashboard['otp_admit_muac']=0;
            $report_month_dashboard['otp_admit_whz']=0;
            $report_month_dashboard['otp_admit_both']=0;
            $report_month_dashboard['total_admit']=0;
            $report_month_dashboard['cure_rate']=0;
            $report_month_dashboard['death_rate']=0;
            $report_month_dashboard['default_rate']=0;
            $report_month_dashboard['nonrespondent_rate']=0;
            $report_month_dashboard['avg_weight_gain']=0;
            $report_month_dashboard['avg_length_stay']=0;
            $report_month_dashboard['otp_mnthend_23m']=0;
            $report_month_dashboard['otp_mnthend_23f']=0;
            $report_month_dashboard['otp_mnthend_24m']=0;
            $report_month_dashboard['otp_mnthend_24f']=0;
            $report_month_dashboard['otp_mnthend_60m']=0;
            $report_month_dashboard['otp_mnthend_60f']=0;

        }
        $previous_month_dashboard = MonthlyDashboard::where('year', $previous_year)->where('month', $previous_month)
            ->where('facility_id', Auth::user()->facility_id)->first();

        if ($previous_month_dashboard==null)
        {
            $previous_month_dashboard['otp_admit_23m']=0;
            $previous_month_dashboard['otp_admit_23f']=0;
            $previous_month_dashboard['otp_admit_24m']=0;
            $previous_month_dashboard['otp_admit_24f']=0;
            $previous_month_dashboard['otp_admit_60m']=0;
            $previous_month_dashboard['otp_admit_60f']=0;
            $previous_month_dashboard['otp_admit_male']=0;
            $previous_month_dashboard['otp_admit_female']=0;
            $previous_month_dashboard['otp_admit_others']=0;
            $previous_month_dashboard['otp_admit_muac']=0;
            $previous_month_dashboard['otp_admit_whz']=0;
            $previous_month_dashboard['otp_admit_both']=0;
            $previous_month_dashboard['total_admit']=0;
            $previous_month_dashboard['cure_rate']=0;
            $previous_month_dashboard['death_rate']=0;
            $previous_month_dashboard['default_rate']=0;
            $previous_month_dashboard['nonrespondent_rate']=0;
            $previous_month_dashboard['avg_weight_gain']=0;
            $previous_month_dashboard['avg_length_stay']=0;
            $previous_month_dashboard['otp_mnthend_23m']=0;
            $previous_month_dashboard['otp_mnthend_23f']=0;
            $previous_month_dashboard['otp_mnthend_24m']=0;
            $previous_month_dashboard['otp_mnthend_24f']=0;
            $previous_month_dashboard['otp_mnthend_60m']=0;
            $previous_month_dashboard['otp_mnthend_60f']=0;

        }
//        dd($previous_month_dashboard);
        $children = Child::where('facility_id', Auth::user()->facility_id)->orderBy('created_at', 'desc')->get();
//dashboard chart bar
        $user_barchart = $this->user_dashboard_barchart();
//end dashboard chart bar
        //Sync data count
        $children_sync_count = Child::whereIn('sync_status', ['created', 'updated'])->count();
        $facility_followup_sync_count = FacilityFollowup::whereIn('sync_status', ['created', 'updated'])->count();

        return view('homepage.home_user', compact('cache_data', 'month_year', 'report_month_dashboard', 'previous_month_dashboard',
            'children', 'user_barchart', 'children_sync_count', 'facility_followup_sync_count'));
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
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }

        $line_chart = $this->manager_dashboard_linechart($months, $facility_supervision);
        $doughnut_chart = $this->manager_dashboard_doughnutchart($report_year, $report_month, $facility_supervision);
        $bar_chart = $this->manager_dashboard_barchart($report_year, $report_month, $facility_supervision);

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
        $line_chart = $this->manager_dashboard_linechart($months, $facility_supervision);
        $doughnut_chart = $this->manager_dashboard_doughnutchart($report_year, $report_month, $facility_supervision);
        $bar_chart = $this->manager_dashboard_barchart($report_year, $report_month, $facility_supervision);

        return view('homepage.program-manager', compact('cache_data', 'month_year', 'doughnut_chart', 'bar_chart', 'line_chart'));
    }

    private function user_dashboard_barchart()
    {
        //dashboard chart bar
        $admission = FacilityFollowup::where('facility_id', Auth::user()->facility_id)
            ->selectRaw('DATE(date) as dat, COUNT(*) as cunt')
            ->groupBy('dat')
            ->whereDate('date', '>', \Carbon\Carbon::now()->subDays(30))
            ->where('new_admission', '!=', 'Age 6 to 59m')
//            ->where('new_admission', 'MUAC')
//            ->orWhere('new_admission', 'WFH Zscore')
//            ->orWhere('new_admission', 'MUAC and WFH Zscore')
            ->orderBy('dat', 'ASC')
            ->pluck('cunt', 'dat')->toArray();
        $user_barchart['count'] = array_values($admission);
        $user_barchart['date'] = array_keys($admission);

        return $user_barchart;
//end dashboard chart bar
    }

    private function admin_dashboard_data($report_year, $report_month)
    {
        $dashboard_data['month_year'] = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $admission_total = DB::table('facility_followups')->where('new_admission', '!=', 'Age 6 to 59m')->count();
        if ($admission_total == 0)
            $dashboard_data['admission_total'] = 0;
        else
            $dashboard_data['admission_total'] = $admission_total;
        $admission_reportmonth = DB::table('facility_followups')->whereYear('date', $report_year)->whereMonth('date', $report_month)
            ->where('new_admission', '!=', 'Age 6 to 59m')->count();
        if ($admission_reportmonth == 0)
            $dashboard_data['admission_reportmonth'] = 0;
        else
            $dashboard_data['admission_reportmonth'] = $admission_reportmonth;
        $death_reportmonth = FacilityFollowup::where('discharge_criteria_exit', 'Death')->whereMonth('date', '=', $report_month)->whereYear('date', '=', $report_year)->count();
        if ($death_reportmonth == 0)
            $dashboard_data['death_reportmonth'] = 0;
        else
            $dashboard_data['death_reportmonth'] = $death_reportmonth;
        $recovered_child = FacilityFollowup::where('discharge_criteria_exit', 'Recovered')->whereMonth('date', '=', $report_month)->whereYear('date', '=', $report_year)->get();
        if ($recovered_child->count() == 0) {
            $dashboard_data['weight_gain'] = 0;
            $dashboard_data['length_of_stay'] = 0;
        } else {
            $dashboard_data['weight_gain'] = $recovered_child->sum('gain_of_weight') / $recovered_child->count();
            $dashboard_data['length_of_stay'] = $recovered_child->sum('duration_between_discharged_and_admission_days') / $recovered_child->count();
        }
        return $dashboard_data;
    }

    private function admin_dashboard_doughnutchart($report_year, $report_month)
    {
        $muac = FacilityFollowup::where('new_admission', 'MUAC')->whereMonth('date', '=', $report_month)->whereYear('date', '=', $report_year)->count();
        $zscore = FacilityFollowup::where('new_admission', 'WFH Zscore')->whereMonth('date', '=', $report_month)->whereYear('date', '=', $report_year)->count();
        $muac_zscore = FacilityFollowup::where('new_admission', 'MUAC and WFH Zscore')->whereYear('date', $report_year)->whereMonth('date', $report_month)->count();
//dd($muac_zscore);
        if ($muac == 0)
            $chart_doughnut['muac'] = 0;
        else
            $chart_doughnut['muac'] = $muac;
        if ($zscore == 0)
            $chart_doughnut['zscore'] = 0;
        else
            $chart_doughnut['zscore'] = $zscore;
        if ($muac_zscore == 0)
            $chart_doughnut['muac_zscore'] = 0;
        else
            $chart_doughnut['muac_zscore'] = $muac_zscore;
        return array_values($chart_doughnut);
    }

    private function admin_dashboard_barchart()
    {
        $admission = DB::table('facility_followups')->selectRaw('DATE(date) as dat, COUNT(*) as cunt')
            ->groupBy('dat')
            ->whereDate('date', '>', \Carbon\Carbon::now()->subDays(30))
            ->where('new_admission', '!=', 'Age 6 to 59m')
//            ->where('new_admission', 'MUAC')
//            ->orwhere('new_admission', 'WFH Zscore')
//            ->orWhere('new_admission', 'MUAC and WFH Zscore')
//            ->whereBetween('created_at', [$fromDate, $tillDate])
            ->orderBy('dat', 'ASC')
            ->pluck('cunt', 'dat')->toArray();
        $admin_barchart['count'] = array_values($admission);
        $admin_barchart['date'] = array_keys($admission);

        return $admin_barchart;
//end dashboard chart bar
    }

    private function manager_dashboard_linechart($months, $facility_supervision)
    {

        $line_chart = DB::table('monthly_dashboards')
            ->join('facilities', 'facilities.id', '=', 'monthly_dashboards.facility_id')
//            ->select('monthly_dashboards.period as Month', 'monthly_dashboards.total_admit as TotalAdmission', 'facilities.facility_id as Facility_name')
            ->select('monthly_dashboards.period as Month', 'monthly_dashboards.total_admit as TotalAdmission'
                ,DB::raw('SUBSTRING_INDEX(facilities.facility_id, "/", -1) as Facility_name'))
            ->whereIn('monthly_dashboards.facility_id', $facility_supervision)
            ->whereIn('monthly_dashboards.period', $months)
//            ->orderBy('monthly_dashboards.facility_id','desc')
            ->orderBy('monthly_dashboards.year', 'desc')
            ->orderBy('monthly_dashboards.month', 'desc')
            ->get()
            ->toArray();
//        dd($line_chart);
        return $line_chart;
    }

    private function manager_dashboard_doughnutchart($report_year, $report_month, $facility_supervision)
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

    private function manager_dashboard_barchart($report_year, $report_month, $facility_supervision)
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
        $facilities = array_column($bar_chart, 'facility_id');
        $bar_chart['facility_id'] = array();
        foreach ($facilities as $facility) {
            array_push($bar_chart['facility_id'], explode('/', $facility)[1]);
        }
        //$bar_chart['facility_id'] = array_column($bar_chart, 'facility_id');
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
