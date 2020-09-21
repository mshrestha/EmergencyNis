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
        $facility_followups = FacilityFollowup::with('facility')->where('children_id', $id)->orderBy('created_at', 'asc')->get()->toArray();
        $chart_date = array_column($facility_followups, 'date');
        $chart_weight = array_column($facility_followups, 'weight');
        $child_sex=$children->sex;


        return view('facility_followup.create', compact('facilities', 'children','chart_date','chart_weight','child_sex'));
    }

    public function save($id, Request $request) {
//        dd($request);
        try {
            if(!env('SERVER_CODE')) {
                dd('No server code found.');
            }

            $data = $request->all();
            $data['referal_slip_no'] = time(). rand(1000,9999);

            //Create sync id
            $latest_followup = FacilityFollowup::orderBy('id', 'desc')->first();
            $app_id = $latest_followup ? $latest_followup->id + 1 : 1;
            $data['id'] = $app_id;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';

            $facility_followup = FacilityFollowup::create($data);
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save followup, Try again";
            $this->_notify_type = "danger";
        }

        return redirect()->route('register')->with([
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
        $facility_followups = FacilityFollowup::with('facility')->where('children_id', $id)->orderBy('created_at', 'asc')->get()->toArray();
        $chart_date = array_column($facility_followups, 'date');
        $chart_weight = array_column($facility_followups, 'weight');
        $child_sex=$children->sex;

        return view('facility_followup.edit', compact('facility_followup', 'children', 'facilities','chart_date','chart_weight','child_sex'));
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
//        dd($id);
//        try {
            $data = $request->all();

            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'updated';
//            dd($data);

            FacilityFollowup::findOrFail($id)->update($data);
//        } catch (\Exception $e) {
//            $this->_notify_message = "Failed to save followup, Try again";
//            $this->_notify_type = "danger";
//        }

        return redirect()->back()->with([
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
        try {
            FacilityFollowup::destroy($id);
            $this->_notify_message = 'Deleted Followup.';
        } catch (\Exception $e) {
            $this->_notify_message = 'Failed to delete Followup, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect()->route('register')->with([
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
    public function delete($id)
    {
        //
    }
}
