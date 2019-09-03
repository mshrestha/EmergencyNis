<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    	$children = Child::orderBy('created_at', 'desc')->get();
    	$facilities = Facility::orderBy('created_at', 'desc')->get();
    	
    	return view('homepage.home', compact('children', 'facilities'));
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

    	return view('homepage.child-info', compact('child', 'followups'))->render();
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
}
