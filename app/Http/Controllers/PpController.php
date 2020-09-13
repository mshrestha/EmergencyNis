<?php

namespace App\Http\Controllers;

use App\Pp;
use Illuminate\Http\Request;

class PpController extends Controller
{
    private $_notify_message = 'Program Partner saved.';
    private $_notify_type = 'success';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $facilities = Pp::orderBy('created_at', 'desc')->get();

        return view('programPartner.home', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('programPartner.create');
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
            Pp::create($request->all());
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save Program Partner, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('programPartner.index')->with([
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
        $facility = Pp::findOrFail($id);

        return view('programPartner.edit', compact('facility'));
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
            Pp::findOrFail($id)->update($request->all());
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save Program Partner, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('programPartner.index')->with([
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
            Pp::destroy($id);

            $this->_notify_message = "Program Partner deleted.";
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to delete Program Partner, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->back()->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
