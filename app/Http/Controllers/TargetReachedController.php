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
