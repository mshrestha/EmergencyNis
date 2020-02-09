<?php

namespace App\Http\Controllers;

use App\Models\CommunitySession;

use Illuminate\Http\Request;

class CommunitySessionController extends Controller
{
    protected $_notify_message = "Community session saved.";
    protected $_notify_type = "success";

    public function __construct() {
        if(!env('SERVER_CODE')) {
            dd('No server code found.');
        }
    }
    
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
        try {
            $community_session = CommunitySession::where('volunteer_id', $request->volunteer_id)
                ->where('date', $request->date)
                ->first();

            $data = $request->all();

            // IF NEW COMMUNITY SESSION
            if(!$community_session) {
                //Create sync id
                $latest_community_session = CommunitySession::orderBy('id', 'desc')->first();
                $app_id = $latest_community_session ? $latest_community_session->id + 1 : 1;
                $data['sync_id'] = env('SERVER_CODE') . $app_id;
                $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';
                
                CommunitySession::create($data);
            } else {
                $community_session->update($data);
            }


        } catch (Exception $e) {
            $this->_notify_message = "Failed to save community session, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->back()->with([
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
    public function show($id, Request $request)
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
