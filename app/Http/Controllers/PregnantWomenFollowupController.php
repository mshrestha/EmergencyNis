<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Facility;
use App\Models\PregnantWomen;
use App\Models\PregnantWomenFollowup;

use Auth;
use Illuminate\Http\Request;
use DB;
use DateTime;

class PregnantWomenFollowupController extends Controller
{
    private $_notify_message = "Pregnant women followup saved.";
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
        try {
            if(!env('SERVER_CODE')) {
                dd('No server code found.');
            }
            
            $data = $request->all();
            $data['facility_id'] = Auth::user()->facility_id;

            //Create sync id
            $latest_pregnant_women_followup = PregnantWomenFollowup::orderBy('id', 'desc')->first();
            $app_id = $latest_pregnant_women_followup ? $latest_pregnant_women_followup->id + 1 : 1;
            $data['id'] = $app_id;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';

            $data['planed_date'] = ($request->planed_date) ? new DateTime($request->planed_date) : null;
            $data['actual_date'] = ($request->actual_date) ? new DateTime($request->actual_date) : null;
            $data['next_visit_date'] = ($request->next_visit_date) ? new DateTime($request->next_visit_date) : null;


            PregnantWomenFollowup::create($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save followup, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('pregnant-women.index')->with([
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
        $camps = Camp::orderBy('id', 'asc')->get();
        $facility_id= Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        $pregnant_women_id = $id;
        $pregnant_women = PregnantWomen::findOrFail($id);

        return view('pregnant_women.followup', compact('camps', 'facility', 'pregnant_women_id','pregnant_women'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        dd($id);
        $camps = Camp::orderBy('id', 'asc')->get();
        $facility_id= Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        $pregnant_women_id = $id;

        $pregnant_followup = PregnantWomenFollowup::findOrFail($id);
//        dd($pregnant_followup);
        $pregnant_women = DB::table('pregnant_womens')->where('sync_id',$pregnant_followup->pregnant_women_id)->first();
//        dd($pregnant_women->id);

        return view('pregnant_women.followup-edit', compact('camps', 'facility', 'pregnant_women_id', 'pregnant_followup','pregnant_women'));
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
        try {
            $data = $request->all();
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'updated';
            $data['planed_date'] = ($request->planed_date) ? new DateTime($request->planed_date) : null;
            $data['actual_date'] = ($request->actual_date) ? new DateTime($request->actual_date) : null;
            $data['next_visit_date'] = ($request->next_visit_date) ? new DateTime($request->next_visit_date) : null;

            PregnantWomenFollowup::findOrFail($id)->update($data);
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to update pregnant women followup, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('pregnant-women.index')->with([
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
            $pregnant_women_followup = PregnantWomenFollowup::destroy($id);

            $this->_notify_message = "Followup deleted.";
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to delete followup, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('pregnant-women.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
