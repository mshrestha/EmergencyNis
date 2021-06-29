<?php

namespace App\Http\Controllers;

use App\TargetReached;
use Illuminate\Http\Request;
use DB;

class TargetReachedController extends Controller
{
    private $_notify_message = "Saved Successfully.";
    private $_notify_type = "success";

    public function index()
    {
        $targetReached = TargetReached::latest()->get();
        $indicators = DB::table('indicators')->get();
        return view('target_reached/index', compact('targetReached','indicators'));
    }
    public function edit($id)
    {
        $targetReached = TargetReached::findOrFail($id);
        $indicators = DB::table('indicators')->get();

        return view('target_reached/edit', compact('targetReached','indicators'));
    }
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            TargetReached::findOrFail($id)->update($data);
        } catch (\Exception $e) {
            $this->_notify_message = 'Failed to save Target Reached Data, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect()->route('targetReached.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }


    public function store(Request $request)
    {
//        dd($request);
//        try {
            $data = $request->all();
//            dd($data);

            TargetReached::create($data);
//        } catch (\Exception $e) {
//            $this->_notify_message = "Failed to save , Try again.";
//            $this->_notify_type = "danger";
//        }

        return redirect()->route('targetReached.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

}
