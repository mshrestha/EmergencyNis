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


    public function index(){
        $supplies=Supply::where('facilityId',Auth::user()->facility->facility_id)->orderBy('year', 'desc')
            ->orderBy('month', 'desc')->get();
//        dd($supplies);
        $current_month = date('n');

        return view('supply/index', compact('supplies','current_month'));

    }
    public function create(Request $request){
//        dd($request);
        if ($request->month == 1) {
            $previous_month = 12;
            $previous_year = $request->year - 1;
        } else {
            $previous_month = $request->month - 1;
            $previous_year = $request->year;
        }

        $previousMonthSupplies=Supply::where('facilityId',Auth::user()->facility->facility_id)->where('year',$previous_year)
            ->where('month',$previous_month)->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $month_year = date('F', mktime(0, 0, 0, $previous_month, 10)) . '-' . $previous_year;
//dd($previousMonthSupplies);
        return view('supply/create', compact('request','previousMonthSupplies','month_year'));

    }
    public function store(Request  $request){
        $this->validate($request, [
            'supply.*' => 'required',
            'remainingFromLastMonth.*' => 'required',
            'received.*' => 'required',
            'consumed.*' => 'required',
            'damaged.*' => 'required',
            'balance.*' => 'required',
        ]);

        $facility = Facility::where('id',Auth::user()->facility_id)->first();
//        dd($facility->program_partner);

        foreach ($request['supply'] as $sid) {
            $syid[] = $sid;
        }
        foreach ($request['remainingFromLastMonth'] as $rflm) {
            $rflmid[] = $rflm;
        }
        foreach ($request['received'] as $rid) {
            $rdid[] = $rid;
        }
        foreach ($request['consumed'] as $cid) {
            $cdid[] = $cid;
        }
        foreach ($request['damaged'] as $did) {
            $ddid[] = $did;
        }
        foreach ($request['balance'] as $bid) {
            $beid[] = $bid;
        }
        $sy = $syid;
        $rh = $rflmid;
        $rd = $rdid;
        $cd = $cdid;
        $dd = $ddid;
        $be = $beid;

        $count_sy = count($sy);
        if (count($rh) != $count_sy) throw new Exception("Bad Request Input Array lengths");
        for ($i = 0; $i < $count_sy; $i++) {
            if (empty($sy[$i])) continue; // skip all the blank ones


            $supply = new Supply();
            $supply->period = date('M', mktime(0, 0, 0, $request->month, 10)).'-'.substr( $request->year, -2);
            $supply->year = $request->year;
            $supply->month = $request->month;
            $supply->programPartner = $facility->program_partner;
            $supply->partner = $facility->partner;
            $supply->campSettlement = $facility->camp->name;
            $supply->facilityId = $facility->facility_id;
            $supply->reportMode = 1;

            $supply->supply = $sy[$i];
            $supply->remainingFromLastMonth = $rh[$i];
            $supply->received = $rd[$i];
            $supply->consumed = $cd[$i];
            $supply->damaged = $dd[$i];
            $supply->balance = $be[$i];
            $supply->save();

    }
        return redirect('supply')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
