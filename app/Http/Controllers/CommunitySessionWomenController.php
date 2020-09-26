<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\CommunitySessionWomen;

use Illuminate\Http\Request;
use Auth;
class CommunitySessionWomenController extends Controller
{
    private $_notify_message = "Successfully saved community session women.";
    private $_notify_type = "success";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!request()->user()->facility) {
            dd('No facility associated to user.');
        }

        $auth_user_camp_id = request()->user()->facility->camp->id;
        $volunteers = Volunteer::with('communitySessionWomens')
            ->where('camp_id', $auth_user_camp_id)
            ->orderBy('created_at', 'desc')->get();
        $selected_date = request()->get('date') ?: date('Y-m-d');
        $community_session_womens = CommunitySessionWomen::orderBy('created_at', 'desc')->where('date', $selected_date)->get();

        return view('community_session_women.index', compact('volunteers', 'selected_date', 'community_session_womens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_user_camp_id = request()->user()->facility->camp->id;
        $volunteers = Volunteer::with('communitySessionWomens')
            ->where('camp_id', $auth_user_camp_id)
            ->orderBy('created_at', 'desc')->pluck('name', 'sync_id');

        return view('community_session_women.create', compact('volunteers'));
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
            $data = $request->all();
            $data['facility_id'] = Auth::user()->facility_id;

            //Create sync id
            $latest_community_session = CommunitySessionWomen::orderBy('id', 'desc')->first();
            $app_id = $latest_community_session ? $latest_community_session->id + 1 : 1;
            $data['id'] = $app_id;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';
            
            CommunitySessionWomen::create($data);
        } catch (Exception $e) {
            $this->_notify_message = "Failed to save community session women, Try again.";
            $this->_notify_type = "danger";
        }

        return redirect()->route('community-session-women.index')->with([
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
