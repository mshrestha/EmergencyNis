<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Supply;
use Illuminate\Http\Request;
use Auth;

class SupplyController extends Controller
{
    private $_notify_message = 'Successfully Added';
    private $_notify_type = 'success';


    public function index()
    {
        $supplies = Supply::where('facilityId', Auth::user()->facility->facility_id)->orderBy('supply_date', 'desc')
            ->get();

        return view('supply/index', compact('supplies'));

    }

    public function create()
    {
        return view('supply/create');

    }

    public function store(Request $request)
    {
//        dd($request);
        $facility = Facility::where('id', Auth::user()->facility_id)->first();
        $this->validate($request, [
            'supply_date' => 'required',
            'expire_date' => 'required',
            'supply_item' => 'required',
            'supply_type' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
        ]);

        $supply = new Supply();

        $supply->programPartner = (Auth::user()->facility_id) ? $facility->program_partner : '';
        $supply->partner = (Auth::user()->facility_id) ? $facility->partner : '';
        $supply->campSettlement = (Auth::user()->facility_id) ? $facility->camp->name : '';
        $supply->facilityId = (Auth::user()->facility_id) ? $facility->facility_id : '';

        $supply->supply_date= date('Y-m-d', strtotime($request->supply_date));
        $supply->expire_date= date('Y-m-d', strtotime($request->expire_date));
        $supply->supply_item = $request->supply_item;
        $supply->supply_type = $request->supply_type;
        $supply->location = $request->location;
        $supply->quantity = $request->quantity;
        $supply->unit = $request->unit;
        $supply->remarks= $request->remarks;
        $supply->save();

        return redirect('supply')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
