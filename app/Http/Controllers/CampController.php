<?php

namespace App\Http\Controllers;

use App\Ip;
use App\Models\Camp;
use Illuminate\Http\Request;

class CampController extends Controller
{
    private $_notify_message = 'camp saved.';
    private $_notify_type = 'success';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $camps = Camp::orderBy('created_at', 'desc')->get();

        return view('camp.home', compact('camps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ips=Ip::all();
        return view('camp.create',compact('ips'));
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
            $camp=Camp::create($request->all());

            $ip_ids = $request->input('ip');
            $camp->ips()->attach($ip_ids);

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save camp, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('camp.index')->with([
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

        $camp = Camp::findOrFail($id);

//        $ips = Ip::pluck('name', 'id')->toArray();
        $ips=Ip::all();
        $selected_ip = $camp->ips->pluck('id')->toArray();
//        dd($selected_ip);

        return view('camp.edit', compact('camp','ips','selected_ip'));
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
            Camp::findOrFail($id)->update($request->all());
            $camp1 = Camp::findOrFail($id);
            $ip_ids = $request->input('ip');
            $camp1->ips()->sync($ip_ids);

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save camp, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('camp.index')->with([
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
//            Camp::destroy($id);
//
//            $this->_notify_message = "camp deleted.";
//        } catch (\Exception $e) {
//            $this->_notify_message = "Failed to delete camp, Try again.";
//            $this->_notify_type = "danger";
//        }
//
//        return redirect()->back()->with([
//            'notify_message' => $this->_notify_message,
//            'notify_type' => $this->_notify_type
//        ]);
//    }
}
