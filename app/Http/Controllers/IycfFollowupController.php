<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Facility;
use App\Models\IycfFollowup;

use Illuminate\Http\Request;

class IycfFollowupController extends Controller
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

        return view('iycf_followup.create', compact('facilities', 'children'));
    }

    public function save($id, Request $request) {
        try {
            if(!env('SERVER_CODE')) {
                dd('No server code found.');
            }
            
            $data = $request->all();

            //Create sync id
            $latest_followup = IycfFollowup::orderBy('id', 'desc')->first();
            $app_id = $latest_followup ? $latest_followup->id + 1 : 1;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';

            $iycf_followup = IycfFollowup::create($data);
        } catch (Exception $e) {
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
        $iycf_followup = IycfFollowup::findOrFail($id);
        $children = Child::findOrFail($iycf_followup->children_id);
        $facilities = Facility::orderBy('created_at', 'desc')->get();

        return view('iycf_followup.edit', compact('iycf_followup', 'children', 'facilities'));
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
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'updated';

            IycfFollowup::findOrFail($id)->update($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save followup, Try again";
            $this->_notify_type = "danger";
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
    public function destroy($id)
    {
        //
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
