<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $_notify_message = 'Service saved.';
    private $_notify_type = 'success';

    public function index()
    {

        $services = Service::orderBy('created_at', 'desc')->get();
        return view('service.home', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request)
    {
//        dd($request);
        try {
            Service::create($request->all());

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save Service, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('service.index')->with([
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

        $service = Service::findOrFail($id);


        return view('service.edit', compact('service'));
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
            Service::findOrFail($id)->update($request->all());

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save Service, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('service.index')->with([
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
//            $this->_notify_message = "Service deleted.";
//        } catch (\Exception $e) {
//            $this->_notify_message = "Failed to delete Service, Try again.";
//            $this->_notify_type = "danger";
//        }
//
//        return redirect()->back()->with([
//            'notify_message' => $this->_notify_message,
//            'notify_type' => $this->_notify_type
//        ]);
//    }
}
