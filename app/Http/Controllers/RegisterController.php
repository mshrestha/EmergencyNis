<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    
    public function index() {
    	$children = Child::orderBy('created_at', 'desc')->get();
    	$facilities = Facility::orderBy('created_at', 'desc')->get();
    	
    	return view('register.home', compact('children', 'facilities'));
    }
}
