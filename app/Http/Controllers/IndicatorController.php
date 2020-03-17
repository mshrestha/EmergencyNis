<?php

namespace App\Http\Controllers;

use App\Indicator;
use Illuminate\Http\Request;
use DB;

class IndicatorController extends Controller
{
    private $_notify_message = "Indicator saved.";
    private $_notify_type = "success";

    public function index()
    {
        $indicators = DB::table('indicators')->get();
        return view('indicator/index', compact('indicators'));
    }

    public function store(Request $request)
    {
//        dd($request);
        try {
            $data = $request->all();
//            dd($data);

            Indicator::create($data);
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to save Indicator, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('indicator.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
