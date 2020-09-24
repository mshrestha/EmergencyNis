<?php

namespace App\Http\Controllers;

use App\Pp;
use App\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    private $_notify_message = 'Sector saved.';
    private $_notify_type = 'success';

    public function index()
    {

        $sectors = Sector::orderBy('created_at', 'desc')->get();
        return view('sector.home', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pps=Pp::all();
        $selected_pp = [];
        return view('sector.create',compact('pps','selected_pp'));
    }

    public function store(Request $request)
    {
//        dd($request);
        try {
            $sector=Sector::create($request->all());

            $pp_ids = $request->input('pp');
            $sector->pps()->attach($pp_ids);

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save Sector, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('sector.index')->with([
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

        $sector = Sector::findOrFail($id);

        $pps=Pp::all();
        $selected_pp = $sector->pps->pluck('id')->toArray();


        return view('sector.edit', compact('sector','pps','selected_pp'));
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
            Sector::findOrFail($id)->update($request->all());

            $sector1 = Sector::findOrFail($id);
            $pp_ids = $request->input('pp');
            $sector1->pps()->sync($pp_ids);

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save Sector, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('sector.index')->with([
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
//            Pp::destroy($id);
//
//            $this->_notify_message = "Sector deleted.";
//        } catch (\Exception $e) {
//            $this->_notify_message = "Failed to delete Sector, Try again.";
//            $this->_notify_type = "danger";
//        }
//
//        return redirect()->back()->with([
//            'notify_message' => $this->_notify_message,
//            'notify_type' => $this->_notify_type
//        ]);
//    }


}
