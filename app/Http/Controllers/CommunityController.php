<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Facility;
use App\Models\Volunteer;
use App\Models\CommunitySession;

use Illuminate\Http\Request;

class CommunityController extends Controller
{
    private $_notify_message = 'Volunteer information saved successfully.';
    private $_notify_type = 'success';

    public function __construct() {
        if(!env('SERVER_CODE')) {
            dd('No server code found.');
        }
    }
    
    /**
     * Display Community Information
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!request()->user()->facility) {
            dd('No facility associated to user.');
        }

        $auth_user_camp_id = request()->user()->facility->camp->id;
        $volunteers = Volunteer::with('communitySessions')
            ->where('camp_id', $auth_user_camp_id)
            ->orderBy('created_at', 'desc')->get();

        $selected_date = request()->get('date') ?: date('Y-m-d');
        $community_sessions = CommunitySession::orderBy('created_at', 'desc')->where('date', $selected_date)->get();

        return view('community.index', compact('volunteers', 'selected_date', 'community_sessions'));
    }

    public function create()
    {
        if(!request()->user()->facility_id) {
            dd('No facility associated to user.');
        }

        $auth_user_camp_id = request()->user()->facility->camp->id;
        $camps = Camp::orderBy('id', 'asc')->where('id', $auth_user_camp_id)->pluck('name', 'id');

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
//        dd($request->all());
        if(!env('SERVER_CODE')) {
            dd('No server code found.');
        }

        try {
            $data = $request->all();

            //Create sync id
            $latest_volunteer = Volunteer::orderBy('id', 'desc')->first();
            $app_id = $latest_volunteer ? $latest_volunteer->id + 1 : 1;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';

            Volunteer::create($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save volunteer, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('community.index')->with([
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
        if(!request()->user()->facility_id) {
            dd('No facility associated to user.');
        }

        $auth_user_camp_id = request()->user()->facility->camp->id;
        $camps = Camp::orderBy('id', 'asc')->where('id', $auth_user_camp_id)->pluck('name', 'id');
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
            $data = $request->all();
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'updated';

            Volunteer::findOrFail($id)->update($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save volunteer, Try again.";
            $this->_notify_type = "danger";
        }

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

}
