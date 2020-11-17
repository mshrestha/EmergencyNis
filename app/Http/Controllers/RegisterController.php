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
//            dd($facility);
            $camp_facilities=DB::table('facilities')->where('camp_id', $facility->camp_id)->get();
//            dd($camp_facilities);
            $children = Child::with(['facility', 'facility_followup'])->where('camp_id', $facility->camp_id)->orderBy('created_at', 'desc')->get();
        }else{
            $children = Child::with(['facility', 'facility_followup'])->orderBy('created_at', 'desc')->limit(1000)->get();
            $camp_facilities=DB::table('facilities')->get();
        }

        return view('register.home', compact('children','camp_facilities'));
    }

    public function sam_child() {

        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $camp_facilities=DB::table('facilities')->where('camp_id', $facility->camp_id)->get();
            $children = Child::where('children.camp_id', $facility->camp_id)
                ->join('facility_followups', 'facility_followups.children_id', '=', 'children.sync_id')
//                ->select('children.*'
//           DB::raw('children.date as childEntry'),
//           DB::raw('facility_followups.date as actualDate')
//          )
                ->where('facility_followups.nutritionstatus', 'SAM')
//                ->groupby('facility_followups.children_id')
//                ->distinct('facility_followups.children_id')
                ->whereIn('facility_followups.id', function($q){
                    $q->select(DB::raw('MAX(facility_followups.id) FROM facility_followups GROUP BY facility_followups.children_id'));
                })
                ->orderBy('facility_followups.date', 'desc')
            ->get();
//            dd($children);
            return view('register.home_nutritionStatus', compact('children','camp_facilities'));
        }else{
            $children = Child::with(['facility', 'facility_followup'])->orderBy('created_at', 'desc')->limit(1000)->get();
            $camp_facilities=DB::table('facilities')->get();
            return view('register.home', compact('children','camp_facilities'));
        }
    }
    public function mam_child() {

        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $camp_facilities=DB::table('facilities')->where('camp_id', $facility->camp_id)->get();
            $children = Child::where('children.camp_id', $facility->camp_id)
                ->join('facility_followups', 'facility_followups.children_id', '=', 'children.sync_id')
//                ->select('children.*'
//           DB::raw('children.date as childEntry'),
//           DB::raw('facility_followups.date as actualDate')
//          )
                ->where('facility_followups.nutritionstatus', 'MAM')
//                ->groupby('facility_followups.children_id')
//                ->distinct('facility_followups.children_id')
                ->whereIn('facility_followups.id', function($q){
                    $q->select(DB::raw('MAX(facility_followups.id) FROM facility_followups GROUP BY facility_followups.children_id'));
                })
                ->orderBy('facility_followups.date', 'desc')
            ->get();
//            dd($children);
            return view('register.home_nutritionStatus', compact('children','camp_facilities'));
        }else{
            $children = Child::with(['facility', 'facility_followup'])->orderBy('created_at', 'desc')->limit(1000)->get();
            $camp_facilities=DB::table('facilities')->get();
            return view('register.home', compact('children','camp_facilities'));
        }
    }
    public function normal_child() {

        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $camp_facilities=DB::table('facilities')->where('camp_id', $facility->camp_id)->get();
            $children = Child::where('children.camp_id', $facility->camp_id)
                ->join('facility_followups', 'facility_followups.children_id', '=', 'children.sync_id')
//                ->select('children.*'
//           DB::raw('children.date as childEntry'),
//           DB::raw('facility_followups.date as actualDate')
//          )
                ->where('facility_followups.nutritionstatus', 'Normal')
//                ->groupby('facility_followups.children_id')
//                ->distinct('facility_followups.children_id')
                ->whereIn('facility_followups.id', function($q){
                    $q->select(DB::raw('MAX(facility_followups.id) FROM facility_followups GROUP BY facility_followups.children_id'));
                })
                ->orderBy('facility_followups.date', 'desc')
            ->get();
//            dd($children);
            return view('register.home_nutritionStatus', compact('children','camp_facilities'));
        }else{
            $children = Child::with(['facility', 'facility_followup'])->orderBy('created_at', 'desc')->limit(1000)->get();
            $camp_facilities=DB::table('facilities')->get();
            return view('register.home', compact('children','camp_facilities'));
        }
    }
    public function defaulter_child() {

        if(Auth::user()->facility_id){
            $facility = Facility::findOrFail(Auth::user()->facility_id);
            $camp_facilities=DB::table('facilities')->where('camp_id', $facility->camp_id)->get();
            $children = Child::where('children.camp_id', $facility->camp_id)
                ->join('facility_followups', 'facility_followups.children_id', '=', 'children.sync_id')
//                ->select('children.*'
//           DB::raw('children.date as childEntry'),
//           DB::raw('facility_followups.date as actualDate')
//          )
                ->where('facility_followups.next_visit_date','<', date('Y-m-d'))
//                ->groupby('facility_followups.children_id')
//                ->distinct('facility_followups.children_id')
                ->whereIn('facility_followups.id', function($q){
                    $q->select(DB::raw('MAX(facility_followups.id) FROM facility_followups GROUP BY facility_followups.children_id'));
                })
                ->orderBy('facility_followups.date', 'desc')
            ->get();
//            dd($children);
            return view('register.home_nutritionStatus', compact('children','camp_facilities'));
        }else{
            $children = Child::with(['facility', 'facility_followup'])->orderBy('created_at', 'desc')->limit(1000)->get();
            $camp_facilities=DB::table('facilities')->get();
            return view('register.home', compact('children','camp_facilities'));
        }
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
