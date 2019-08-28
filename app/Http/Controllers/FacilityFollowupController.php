<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Facility;
use App\Models\FacilityFollowup;

use Illuminate\Http\Request;

class FacilityFollowupController extends Controller
{
    private $_notify_message = "Facility followup saved.";
    private $_notify_type = "success";

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $children = Child::findOrFail($id);
        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('facility_followup.create', compact('facilities', 'children'));
    }

    public function save($id, Request $request) {
        try {
            $data = $request->all();
            $data['referal_slip_no'] = time(). rand(1000,9999);

            FacilityFollowup::create($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save followup, Try again";
            $this->_notify_type = "danger";
        }

        return redirect()->route('homepage')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facility_followup = FacilityFollowup::findOrFail($id);
        $children = Child::findOrFail($facility_followup->children_id);
        $facilities = Facility::where('id', $facility_followup->facility_id)->get();

        return view('facility_followup.edit', compact('facility_followup', 'children', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            FacilityFollowup::findOrFail($id)->update($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save followup, Try again";
            $this->_notify_type = "danger";
        }

        return redirect()->route('homepage')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
