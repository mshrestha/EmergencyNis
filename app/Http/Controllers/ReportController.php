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
    public function index() {
        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
    	   $children = Child::where('camp_id', $facility->camp_id)->get();    
        }else{
            
    	   $children = Child::orderBy('created_at', 'desc')->get();
        }
    	return view('report.home', compact('children', 'facility'));
    }
}
