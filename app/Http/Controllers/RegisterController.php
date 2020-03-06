<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $children = Child::with(['facility', 'facility_followup'])->where('camp_id', $facility->camp_id)->orderBy('created_at', 'desc')->limit(100)->get();
        }else{
            $children = Child::with(['facility', 'facility_followup'])->orderBy('created_at', 'desc')->get();
        }

        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('register.home', compact('children', 'facilities'));
    }

    public function iycf() {
        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $children = Child::with(['facility', 'facility_followup'])->where('camp_id', $facility->camp_id)->orderBy('created_at', 'desc')->get();
        }else{
            $children = Child::with(['facility', 'facility_followup'])->orderBy('created_at', 'desc')->get();
        }
        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('register.iycf', compact('children', 'facilities'));
    }
}
