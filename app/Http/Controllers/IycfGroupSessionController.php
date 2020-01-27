<?php

namespace App\Http\Controllers;

use App\IycfGroupSession;
use App\IycfGroupSessionBeneficiary;
use Illuminate\Http\Request;

class IycfGroupSessionController extends Controller
{

    public function iycf_session_home()
    {
        return view('iycf_group_session.iycf_session_home');
    }
    public function index()
    {
        $iycfGroupSessions = IycfGroupSession::latest()->get();
//        dd($iycfGroupSessions);
        return view('iycf_group_session.index',compact('iycfGroupSessions'));
    }

    public function create()
    {
        return view('iycf_group_session.create');
    }

    public function store(Request $request)
    {
//        dd($request);
        $this->validate($request, [
            'session_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'name.*' => 'required',
            'sex.*' => 'required',
            'type.*' => 'required',
            'beneficiary_type.*' => 'required',
        ]);

        $igs=new IycfGroupSession();
        $igs->sync_id = date('YmdHis');
        $igs->session_date = date('Y-m-d', strtotime($request->session_date));
        $igs->start_time = date('H:i:s', strtotime($request->start_time));
        $igs->end_time = date('H:i:s', strtotime($request->end_time));
        $igs->session_type = $request->session_type;
        $igs->session_topic = $request->session_topic;
        $igs->save();
        $naid=[];
        $seid=[];
        $tyid=[];
        $beid=[];
        foreach ($request['name'] as $nm) {
            $naid[] = $nm;
        }
        foreach ($request['sex'] as $sx) {
            $seid[] = $sx;
        }
        foreach ($request['type'] as $tid) {
            $tyid[] = $tid;
        }
        foreach ($request['beneficiary_type'] as $btid) {
            $beid[] = $btid;
        }
        $ne = $naid;
        $se = $seid;
        $te = $tyid;
        $be = $beid;

        $count_te = count($te);
        if (count($se) != $count_te) throw new \Exception("Bad Request Input Array lengths");
        for ($i = 0; $i < $count_te; $i++) {
            if (empty($te[$i])) continue; // skip all the blank ones

            $igsb = new IycfGroupSessionBeneficiary();
            $igsb->iycf_group_session_id= $igs->id;
            $igsb->name= $ne[$i];
            $igsb->sex= $se[$i];
            $igsb->type= $te[$i];
            $igsb->beneficiary_type= $be[$i];
            $igsb->save();
        }
        return redirect('iycfGroupSession');

    }

    public function show($id)
    {
    }


}
