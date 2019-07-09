<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Camp;

use Illuminate\Http\Request;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camps = Camp::orderBy('created_at', 'asc')->get();

        return view('facility.create', compact('camps'));
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
            Facility::create($request->all());
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save facility, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('homepage')->with([
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
        $camps = Camp::orderBy('created_at', 'asc')->get();
        $facility = Facility::findOrFail($id);

        return view('facility.edit', compact('camps', 'facility'));
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

        return redirect()->route('homepage')->with([
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
            Facility::destroy($id);

            $this->_notify_message = "Facility deleted.";
        } catch (Exception $e) {
            $this->_notify_message = "Failed to delete facility, Try again.";
            $this->_notify_type = "danger";    
        }

        return redirect()->back()->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
