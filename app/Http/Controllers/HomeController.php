<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    	$children = Child::orderBy('created_at', 'desc')->get();
    	
    	return view('home', compact('children'));
    }
}
