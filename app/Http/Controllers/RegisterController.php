<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    public function index() {
//
        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $camp_facilities=DB::table('facilities')->where('camp_id', $facility->camp_id)->get();
//            dd($camp_facilities);
            $children = Child::with(['facility', 'facility_followup'])->where('camp_id', $facility->camp_id)->orderBy('created_at', 'desc')->get();
        }else{
            $children = Child::with(['facility', 'facility_followup'])->orderBy('created_at', 'desc')->limit(1000)->get();
            $camp_facilities=DB::table('facilities')->get();
        }

//        $facilities = Facility::orderBy('created_at', 'desc')->get();
//        $camp_facilities=DB::table('facilities')->where('camp_id', $facility->camp_id)->get();

        return view('register.home', compact('children','camp_facilities'));
    }

    public function register_selected_facility($fac) {
//        dd($facility);

        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $camp_facilities=DB::table('facilities')->where('camp_id', $facility->camp_id)->get();
            $children = Child::where('facility_id', $fac)->orderBy('created_at', 'desc')->get();
        }else{
//            dd($facility);
            $children = Child::where('facility_id', $fac)->orderBy('created_at', 'desc')->limit(1000)->get();
//            dd($children);
            $camp_facilities=DB::table('facilities')->get();
        }
//        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('register.home', compact('children', 'camp_facilities'));
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
