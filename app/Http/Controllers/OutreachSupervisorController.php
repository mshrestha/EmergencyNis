<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\OutreachSupervisor;
use App\Models\OutreachMonthlyReport;

use Illuminate\Http\Request;

class OutreachSupervisorController extends Controller
{
    private $_notify_message = "Outreach supervisor saved.";
    private $_notify_type = "success";
    
    public function __construct() {
        if(!env('SERVER_CODE')) {
            dd('No server code found.');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!request()->user()->facility_id) {
            dd('No facility associated to user.');
        }

        $auth_user_camp_id = request()->user()->facility->camp->id;

        $outreach_supervisors = OutreachSupervisor::where('camp_id', $auth_user_camp_id)
            ->orderBy('id', 'desc')
            ->pluck('name', 'sync_id');
        $outreach_monthly_reports = OutreachMonthlyReport::where('camp_id', $auth_user_camp_id)->get();

        return view('outreach.supervisor.index', compact('outreach_supervisors', 'outreach_monthly_reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!request()->user()->facility_id) {
            dd('No facility associated to user.');
        }

        $auth_user_camp_id = request()->user()->facility->camp->id;
        $camps = Camp::orderBy('id', 'asc')->where('id', $auth_user_camp_id)->pluck('name', 'id');

        return view('outreach.supervisor.create', compact('camps'));
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
            $data = $request->all();

            //Create sync id
            $latest_outreach_supervisor = OutreachSupervisor::orderBy('id', 'desc')->first();
            $app_id = $latest_outreach_supervisor ? $latest_outreach_supervisor->id + 1 : 1;
            $data['id'] = $app_id;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';

            OutreachSupervisor::create($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save outreach supervisor, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('outreach-supervisor.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
