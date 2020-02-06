<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Facility;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
  private $_notify_message = 'Volunteer information saved successfully.';
  private $_notify_type = 'success';
    //
    /**
     * Display Community Information
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $volunteers = Volunteer::orderBy('created_at', 'desc')->get();
      return view('community.index', compact('volunteers'));


    }
    public function create()
    {

        $camps = Camp::orderBy('id', 'asc')->get();
        //$facility = Facility::findOrFail(Auth::user()->facility_id);



        return view('community.create', compact('camps'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Volunteer::create($request->all());
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save facility, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('community')->with([
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
        $camps = Camp::orderBy('created_at', 'asc')->get();
        $volunteer = Volunteer::findOrFail($id);

        return view('community.edit', compact('camps', 'volunteer'));
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
            Facility::findOrFail($id)->update($request->all());
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save facility, Try again.";
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
        try {
            Volunteer::destroy($id);

            $this->_notify_message = "Volunteer deleted.";
        } catch (Exception $e) {
            $this->_notify_message = "Failed to delete Volunteer, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->back()->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
    public function outreach(){

      return view('community.outreach');
    }
    public function show(){

      return view('community.outreach');
    }
}
