<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Camp;
use App\Models\Facility;

use Illuminate\Http\Request;

class PregnantWomanController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('pregnant_woman.followup', compact('camps', 'facility'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $camps = Camp::orderBy('id', 'asc')->get();
        $facility_id= Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        
        
        return view('pregnant_woman.create', compact('camps', 'facility'));
    }
    /**
     * Show the form for Followup.
     *
     * @return \Illuminate\Http\Response
     */
    public function followup()
    {
        
        $camps = Camp::orderBy('id', 'asc')->get();
        $facility_id= Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        
        
        return view('pregnant_woman.followup', compact('camps', 'facility'));
    }

}
