<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;

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
            $admission= FacilityFollowup::where('facility_id', Auth::user()->facility_id)
                ->selectRaw('DATE(created_at) as dat, COUNT(*) as cunt')
                ->where('new_admission', 'MUAC')
                ->orWhere('new_admission', 'WFH Zscore')
                ->orWhere('new_admission', 'MUAC and WFH Zscore')
                ->groupBy('dat')
                ->whereBetween('created_at',[$fromDate, $tillDate] )
                ->orderBy('dat', 'ASC')
                ->pluck('cunt', 'dat')->toArray();
            $chart_bar_count_value = array_values($admission);
            $chart_bar_date_key = array_keys($admission);
//end dashboard chart bar
        } else {
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
            $admission= FacilityFollowup::where('facility_id', Auth::user()->facility_id)
                ->selectRaw('DATE(created_at) as dat, COUNT(*) as cunt')
                ->where('new_admission', 'MUAC')
                ->orWhere('new_admission', 'WFH Zscore')
                ->orWhere('new_admission', 'MUAC and WFH Zscore')
                ->groupBy('dat')
                ->whereBetween('created_at',[$fromDate, $tillDate] )
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
            'chart_doughnut_value','chart_bar_count_value','chart_bar_date_key', 'children_sync_count', 'facility_followup_sync_count'));
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

        $chart_date = array_column($facility_followups, 'created_at');
        $chart_weight = array_column($facility_followups, 'weight');

        return view('homepage.child-info', compact('child', 'followups', 'chart_date', 'chart_weight'))->render();
    }
    
    public function programManagerDashboard(){
        
        $facilityFollowup = FacilityFollowup::where('facility_id', Auth::user()->facility_id)->get();
        $dashboard = $this->findDataFromFacilityFollowup($facilityFollowup);
        //$dashboard = '';
        return view('homepage.program-manager', compact('dashboard'))->render();
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
//        $b=FacilityFollowup::selectRaw('DATE(created_at) as x, COUNT(*) as y')
//            ->where('new_admission', 'MUAC')
//            ->groupBy('x')
//            ->where('created_at', '>', \Carbon\Carbon::now()->subDays(30))
//            ->pluck('x','y');

        $fromDate = \Carbon\Carbon::now()->subDay(30)->toDateString();
        $tillDate = \Carbon\Carbon::now()->subDay()->toDateString();
//dd($fromDate);

       $a= FacilityFollowup::selectRaw('DATE(created_at) as dat, COUNT(*) as cunt')
            ->where('new_admission', 'MUAC')
            ->orWhere('new_admission', 'WFH Zscore')
            ->orWhere('new_admission', 'MUAC and WFH Zscore')
        ->groupBy('dat')
           ->whereBetween('created_at',[$fromDate, $tillDate] )
//           ->whereBetween('created_at', [$min_createdat, $pre_date])

           ->orderBy('dat', 'ASC')
        ->pluck('cunt', 'dat');

        $c= FacilityFollowup::selectRaw('DATE(created_at) as dat, COUNT(*) as cunt')
            ->where('new_admission', 'MUAC')
            ->orWhere('new_admission', 'WFH Zscore')
            ->orWhere('new_admission', 'MUAC and WFH Zscore')
            ->groupBy('dat')
            ->pluck('cunt', 'dat');

       dd($a);


    }


}
