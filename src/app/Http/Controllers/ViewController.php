<?php

namespace App\Http\Controllers;



use App\Models\Child;
use App\Models\Facility;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        $children = Child::orderBy('created_at', 'desc')->get();
        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('view.home', compact('children', 'facilities'));
    }
    
}
