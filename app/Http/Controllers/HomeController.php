<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Facility;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    	$children = Child::orderBy('created_at', 'desc')->get();
    	$facilities = Facility::orderBy('created_at', 'desc')->get();
    	
    	return view('home', compact('children', 'facilities'));
    }

    public function childInfo($child_id) {
    	$child = Child::findOrFail($child_id);
    	$child_followups = CommunityFollowup::where('children_id', $child_id)->get();
    	
    	return view('child-info', compact('child', 'child_followups'))->render();
    }
}
