<?php

namespace App\Http\Controllers;

use App\Ip;
use App\Pp;
use Illuminate\Http\Request;

class IpController extends Controller
{
    private $_notify_message = 'Implementing Partner saved.';
    private $_notify_type = 'success';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ips = Ip::orderBy('created_at', 'desc')->get();

        return view('implementingPartner.home', compact('ips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pps=Pp::all();
        return view('implementingPartner.create',compact('pps'));
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
            $ip=Ip::create($request->all());

            $pp_ids = $request->input('pp');
            $ip->pps()->attach($pp_ids);

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save implementing partner, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('implementingPartner.index')->with([
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
        $ip = Ip::findOrFail($id);
        $pps=Pp::all();

        $selected_pp = $ip->pps->pluck('id')->toArray();

        return view('implementingPartner.edit', compact('ip','selected_pp','pps'));
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
//        dd($request);
        try {
            Ip::findOrFail($id)->update($request->all());

            $ip1 = Ip::findOrFail($id);
            $pp_ids = $request->input('pp');
            $ip1->pps()->sync($pp_ids);

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save implementing partner, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('implementingPartner.index')->with([
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
//    public function destroy($id)
//    {
//        try {
//            Ip::destroy($id);
//
//            $this->_notify_message = "Implementing Partner deleted.";
//        } catch (\Exception $e) {
//            $this->_notify_message = "Failed to delete implementing partner, Try again.";
//            $this->_notify_type = "danger";
//        }
//
//        return redirect()->back()->with([
//            'notify_message' => $this->_notify_message,
//            'notify_type' => $this->_notify_type
//        ]);
//    }
}
