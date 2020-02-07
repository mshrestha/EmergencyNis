<?php

namespace App\Http\Controllers;

use App\Models\OutreachMonthlyReport;
use Illuminate\Http\Request;

class OutreachMonthlyReportController extends Controller
{
    private $_notify_message = 'Outreach monthly report saved successfully.';
    private $_notify_type = 'success';

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
        if(!request()->user()->facility_id) {
            dd('No facility associated to user.');
        }

        $check_old = OutreachMonthlyReport::where('supervisor_id', $request->supervisor_id)
            ->where('date_month', $request->date_month)
            ->where('date_year', $request->date_year)
            ->first();
        if($check_old) {
            return redirect()->back()->with([
                'notify_message' => 'Monthly report already submitted of that month for that supervisor.',
                'notify_type' => 'danger'
            ]);
        }

        try {
            $data = $request->all();

            //Create sync id
            $latest_outreach_monthly_report = OutreachMonthlyReport::orderBy('id', 'desc')->first();
            $app_id = $latest_outreach_monthly_report ? $latest_outreach_monthly_report->id + 1 : 1;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';
            $data['camp_id'] = request()->user()->facility->camp->id;

            OutreachMonthlyReport::create($data);
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
        $outreach_monthly_report = OutreachMonthlyReport::findOrFail($id);

        return view('outreach.monthly_report.edit', compact('outreach_monthly_report'));
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
            $outreach_monthly_report = OutreachMonthlyReport::findOrFail($id);
            $outreach_monthly_report->update($request->all());
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save monthly report, Try again.";
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
            OutreachMonthlyReport::destroy($id);
            
            $this->_notify_message = "Outreach monthly report deleted.";
        } catch (Exception $e) {
            $this->_notify_message = "Failed to delete outreach monthly report, try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->back()->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type,
        ]);
    }
}
