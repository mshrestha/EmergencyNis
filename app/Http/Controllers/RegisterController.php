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
            $children = Child::where('camp_id', $facility->camp_id)->orderBy('created_at', 'desc')->limit(10)->get();    
        }else{
            $children = Child::orderBy('created_at', 'desc')->limit(10)->get();
        }
        
        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('register.home', compact('children', 'facilities'));
    }
}
