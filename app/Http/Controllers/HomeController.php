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
    public function index() {
        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
    	   //$children = Child::where('camp_id', $facility->camp_id)->get();    
            $children = Child::where('facility_id', Auth::user()->facility_id)->orderBy('created_at', 'desc')->get();
            $facilityFollowup = FacilityFollowup::where('facility_id', Auth::user()->facility_id)->get();
        }else{
            $children = Child::orderBy('created_at', 'desc')->get();    
            $facilityFollowup = FacilityFollowup::orderBy('id', 'desc')->get();
        }
    	
    	$facilities = Facility::orderBy('created_at', 'desc')->get();
    	$dashboard = $this->findDataFromFacilityFollowup($facilityFollowup);
        
    	return view('homepage.home', compact('children', 'facilities', 'dashboard'));
    }
    

    public function childInfo($child_id) {
    	$child = Child::findOrFail($child_id);
    	$community_followups = CommunityFollowup::where('children_id', $child_id)->orderBy('created_at', 'asc')->get()->toArray();
    	$facility_followups = FacilityFollowup::with('facility')->where('children_id', $child_id)->orderBy('created_at', 'asc')->get()->toArray();

        $followups = array_merge($community_followups, $facility_followups);
        // dd($followups);
        usort($followups, function($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        $chart_date= array_column($facility_followups, 'created_at');
        $chart_weight= array_column($facility_followups, 'weight');
        $chart_height= array_column($facility_followups, 'height');
//        $chart_followup=array_keys($facility_followups);

        return view('homepage.child-info', compact('child', 'followups','chart_date','chart_weight','chart_height'))->render();
    }

    public function facilityInfo($facility_id) {
        $facility = Facility::findOrFail($facility_id);
        $facility_followups = FacilityFollowup::where('facility_id', $facility_id)->get();

        return view('homepage.facility-info', compact('facility', 'facility_followups'));
    }

    public function childSearch(Request $request) {
        $children = Child::where('children_name', 'LIKE', '%'.$request->q.'%')->orderBy('created_at', 'desc')->get();
        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('homepage.home', compact('children', 'facilities'));
    }

    public function facilitySearch(Request $request) {
        $children = Child::orderBy('created_at', 'desc')->get();
        $facilities = Facility::where('facility_id', 'LIKE', '%'.$request->q.'%')->orderBy('created_at', 'desc')->get();

        return view('homepage.home', compact('children', 'facilities'));
    }
    private function findDataFromFacilityFollowup($data){
        $dashboard['cureRate'] =  0;
        $dashboard['deathRate'] = 0;
        $dashboard['defaultRate'] = 0;
        $dashboard['nonRespondantRate'] = 0;
        $dashboard['count']=0;
        foreach($data as $child){
            if($child->discharge_criteria_exit == 'Recovered'){
                $dashboard['cureRate']++;
            }
            if($child->discharge_criteria_exit == 'Death'){
                $dashboard['deathRate']++;
            }
            if($child->discharge_criteria_exit == 'Defaulted'){
                $dashboard['defaultRate']++;
            }
            if(isset($child->discharge_criteria_exit)){
                $dashboard['count']++;
            }
            if($child->new_admission == ''){
                
            }
            
            
        }
        if($dashboard['count'] == 0){
            $rate['cureRate'] = 0;
            $rate['deathRate'] = 0;
            $rate['defaultRate'] = 0;
            $rate['nonRespondantRate'] = 0;
        }else{
            $rate['cureRate'] = $dashboard['cureRate'] / $dashboard['count'] * 100;
            $rate['deathRate'] = $dashboard['deathRate'] / $dashboard['count'] * 100;
            $rate['defaultRate'] = $dashboard['defaultRate'] / $dashboard['count'] * 100;
            $rate['nonRespondantRate'] = $dashboard['nonRespondantRate'] / $dashboard['count'] * 100;    
        }
        
        return $rate;
    }


}
