<?php

namespace App\Http\Controllers;

use App\Ip;
use App\Models\Facility;
use App\Models\Camp;

use App\Pp;
use App\Sector;
use Illuminate\Http\Request;
use DB;

class FacilityController extends Controller
{
    private $_notify_message = 'Facility saved.';
    private $_notify_type = 'success';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $facilities = Facility::orderBy('created_at', 'asc')
            ->get();

//        dd($facilities);
    	
    	return view('facility.home', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camps = Camp::orderBy('created_at', 'asc')->get();
        $sectors = Sector::all();
        $pps = Pp::all();
        $ips = Ip::all();

        return view('facility.create', compact('camps','pps','ips','sectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        try {
            Facility::create($request->all());
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save facility, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('facility.index')->with([
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
        $facility = Facility::findOrFail($id);
//        dd($facility);
        $camps = Camp::orderBy('created_at', 'asc')->get();
        $sectors = Sector::all();
        $pps = Pp::all();
        $ips = Ip::all();

        return view('facility.edit', compact('camps', 'facility','ips','pps','sectors'));
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

        return redirect()->route('facility.index')->with([
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
//        try {
//            Facility::destroy($id);
//
//            $this->_notify_message = "Facility deleted.";
//        } catch (Exception $e) {
//            $this->_notify_message = "Failed to delete facility, Try again.";
//            $this->_notify_type = "danger";
//        }
//
//        return redirect()->back()->with([
//            'notify_message' => $this->_notify_message,
//            'notify_type' => $this->_notify_type
//        ]);
    }

    public function selectPp(Request $request)
    {
        if ($request->ajax()) {
            $pps=DB::table('pps')->select('pps.id','pps.name')
                ->join('pp_sectors','pp_sectors.pp_id','=','pps.id')
                ->where('pp_sectors.sector_id',$request->sector_id)->get();
            $data = view('facility.partials.select_pp', compact('pps'))->render();
            return response()->json(['options' => $data]);
        }
    }
    public function selectIp(Request $request)
    {
        if ($request->ajax()) {
            $ips=DB::table('ips')->select('ips.id','ips.name')
                ->join('ip_pps','ip_pps.ip_id','=','ips.id')
                ->where('ip_pps.pp_id',$request->pp_id)->get();
            $data = view('facility.partials.select_ip', compact('ips'))->render();
            return response()->json(['options' => $data]);
        }
    }
    public function selectCamp(Request $request)
    {
        if ($request->ajax()) {
            $camps=DB::table('camps')->select('camps.id','camps.name')
                ->join('camp_ips','camp_ips.camp_id','=','camps.id')
                ->where('camp_ips.ip_id',$request->ip_id)->get();
            $data = view('facility.partials.select_camp', compact('camps'))->render();
            return response()->json(['options' => $data]);
        }
    }

}
