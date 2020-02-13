<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Camp;
use App\Models\Facility;
use App\Models\PregnantWomen;

use Illuminate\Http\Request;

class PregnantWomenController extends Controller
{
    private $_notify_message = 'Pregnant women information saved successfully.';
    private $_notify_type = 'success';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pregnant_womens = PregnantWomen::orderby('created_at', 'desc')->get();

        return view('pregnant_women.index', compact('pregnant_womens'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->facility_id) {
            $camps = Camp::orderBy('id', 'asc')->get();
            $facility_id = Auth::user()->facility_id;
//        dd($facility_id);
            $facility = Facility::findOrFail($facility_id);
            return view('pregnant_women.create', compact('camps', 'facility'));
        }
        else {
//            dd('Only Facility Based user can Add');
            \Session::flash('notify_message', 'Only Facility Based user can Register');
            \Session::flash('notify_type','danger');
            return \Redirect::back();
        }
    }

    public function store(Request $request) {
        try {
            if(!env('SERVER_CODE')) {
                dd('No server code found.');
            }
            
            $data = $request->all();
            $data['facility_id'] = Auth::user()->facility_id;

            //Create sync id
            $latest_pregnant_women = PregnantWomen::orderBy('id', 'desc')->first();
            $app_id = $latest_pregnant_women ? $latest_pregnant_women->id + 1 : 1;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';

            $pregnant_women = PregnantWomen::create($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save pregmant women, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('pregnant-women-followup.show', $pregnant_women->sync_id)->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    public function edit($id) {
        $camps = Camp::orderBy('id', 'asc')->get();
        $facility_id= Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        $pregnant_women = PregnantWomen::findOrFail($id);
        
        return view('pregnant_women.edit', compact('pregnant_women', 'camps', 'facility'));
    }

    public function update($id, Request $request) {
        try {
            $data = $request->all();
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'updated';

            PregnantWomen::findOrFail($id)->update($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save pregnant women, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('pregnant-women.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    public function info($id) {
        $pregnant_women = PregnantWomen::with('followups')->findOrFail($id);

        return view('pregnant_women.info', compact('pregnant_women'))->render();
    }

    public function destroy($id) {
        try {
            PregnantWomen::destroy($id);

            $this->_notify_message = "Pregnant women deleted.";
        } catch (Exception $e) {
            $this->_notify_message = "Failed to delete pregnant women, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('pregnant-women.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
