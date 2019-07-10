<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Facility;
use App\Models\CommunityFollowup;

use Illuminate\Http\Request;

class CommunityFollowupController extends Controller
{
    private $_notify_message = null;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $child = Child::findOrFail($id);
        $facilities = Facility::orderBy('created_at', 'asc')->get();

        return view('community_followup.create', compact('child', 'facilities'));
    }

    public function save(Request $request, $id) {
        try {
            $data = $request->all();
            $data['date'] = date('Y-m-d');
            $data['children_id'] = $id;
            $data['exclusive_breastfeeding'] = $request->exclusive_breastfeeding ?: 0;
            $data['continued_breastfeeding'] = $request->continued_breastfeeding ?: 0;
            $data['received_all_epi_vaccination'] = $request->received_all_epi_vaccination ?: 0;
            $data['edema'] = $request->edema ?: 0;
            $data['referel_slip_no'] = time() . rand(1000,9999);

            CommunityFollowup::create($data);

            $this->_notify_message = "Followup saved.";
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save followup, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('homepage')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facilities = Facility::orderBy('created_at', 'asc')->get();
        $community_followup = CommunityFollowup::findOrFail($id);
     
        return view('community_followup.edit', compact('community_followup', 'facilities'));
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
            $data = $request->all();
            $data['exclusive_breastfeeding'] = $request->exclusive_breastfeeding ?: 0;
            $data['continued_breastfeeding'] = $request->continued_breastfeeding ?: 0;
            $data['received_all_epi_vaccination'] = $request->received_all_epi_vaccination ?: 0;
            $data['edema'] = $request->edema ?: 0;

            CommunityFollowup::findOrFail($id)->update($data);
            $this->_notify_message = "Followup saved.";
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save followup, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->back();
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
            CommunityFollowup::destroy($id);
            $this->_notify_message = "Followup deleted.";
        } catch (Exception $e) {
            $this->_notify_message = "Failed to delete followup, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->back();
    }
}
