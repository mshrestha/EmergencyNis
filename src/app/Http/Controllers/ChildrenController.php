<?php

namespace App\Http\Controllers;

use App\Models\PregnantWomen;
use Auth;
use App\Models\Child;
use App\Models\Camp;
use App\Models\Facility;
use App\Models\CommunityFollowup;
use App\Models\IycfFollowup;
use App\Models\FacilityFollowup;

use Illuminate\Http\Request;
use DateTime;

class ChildrenController extends Controller
{
    private $_notify_message = 'Child information saved successfully.';
    private $_notify_type = 'success';
    private $_children_image_location = 'uploads/children';

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

        $camps = Camp::orderBy('id', 'asc')->get();
        $facility_id = Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        $mothers = PregnantWomen::all();
        $selected_mother = [];


        return view('children.create', compact('camps', 'facility', 'mothers', 'selected_mother'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        try {
            if (!env('SERVER_CODE')) {
                dd('No server code found.');
            }

            $data = $request->all();
            $image = $this->uploadImage($request);
            $image ? $data['picture'] = $image : false;
            $data['date'] = date('y-m-d');
            $data['registration_date'] = new DateTime($request->registration_date);

            if ($request->date_of_birth == null) {
                $now = new DateTime();
                $childrenage = $request->age;
                $dob = $now->modify("-" . $childrenage . ' months');
                $data['date_of_birth'] = $dob;
            } else
                $data['date_of_birth'] = new DateTime($request->date_of_birth);

            $data['facility_id'] = Auth::user()->facility_id;

            //Create sync id
            $latest_child = Child::orderBy('id', 'desc')->first();
            $app_id = $latest_child ? $latest_child->id + 1 : 1;
            $data['id'] = $app_id;
            $data['sync_id'] = env('SERVER_CODE') . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';

            $id = Child::create($data)->sync_id;
//            $id=only sync_id 9996964
//            dd($id);
            $childId = Child::where('sync_id', $id)->first();
//            dd($childId);
            $mother_moha_id = $request->input('mother_moha_id');
            $childId->pregnant_womens()->attach($mother_moha_id);

        } catch (\Exception $e) {
            $this->_notify_message = 'Failed to save child, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect('facility-followup/' . $id)->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    public function uploadImage($request)
    {
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = time() . "-" . $file->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);

            $image = $this->_children_image_location . '/' . $fileName;
            $upload_success = $file->move($this->_children_image_location, $fileName);

            // $upload = Image::make($image);
            // $upload->fit(380, 408)->save($this->_children_image_location .'/'. $fileName, 100);

            return $fileName;
        }

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        dd($id);
        $children = Child::with('facility_followup')->findOrFail($id);

        $facility_followup = $children->facility_followup->last();
        $todays_followup = false;

        if ($facility_followup && $facility_followup->date == date('Y-m-d')) {
            $todays_followup = true;
        }

        // Followups
        $community_followups = CommunityFollowup::where('children_id', $children->sync_id)->orderBy('created_at', 'desc')->get()->toArray();
        $facility_followups_query = FacilityFollowup::with('facility');
        $facility_followups_query->where('children_id', $children->sync_id);
        if ($todays_followup) {
            $facility_followups_query->where('sync_id', '!=', $facility_followup->sync_id);
        }
        $facility_followups = $facility_followups_query->orderBy('created_at', 'desc')->get()->toArray();

        $followups_facility = array_merge($community_followups, $facility_followups);
        usort($followups_facility, function ($a, $b) {
            return $b['date'] <=> $a['date'];
        });

        $iycf_followups = IycfFollowup::where('children_id', $children->sync_id)->orderBy('created_at', 'desc')->get()->toArray();

        $followups = array_merge($followups_facility, $iycf_followups);
        usort($followups, function ($a, $b) {
            return $b['date'] <=> $a['date'];
        });

        $facility_followups = FacilityFollowup::with('facility')->where('children_id', $id)->orderBy('created_at', 'asc')->get()->toArray();
        if (count($facility_followups) >= 1) {
            $facility_followups_latest = FacilityFollowup::with('facility')->where('children_id', $id)->orderBy('date', 'desc')->limit(1)->first();
            $plan_date = $facility_followups_latest->next_visit_date;
        } else {
            $plan_date = '';
        }

        return view('children.show', compact('children', 'facility_followup', 'followups', 'todays_followup', 'plan_date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $child = Child::findOrFail($id);
        $facility_id = Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        $camps = Camp::orderBy('id', 'asc')->get();

        $mothers = PregnantWomen::all();
        $selected_mother = $child->pregnant_womens->pluck('sync_id')->toArray();

        return view('children.edit', compact('child', 'camps', 'facility', 'mothers', 'selected_mother'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $image = $this->uploadImage($request);
            $image ? $data['picture'] = $image : false;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'updated';
            $data['registration_date'] = new DateTime($request->registration_date);
//            $data['date_of_birth'] = ($request->date_of_birth) ? new DateTime($request->date_of_birth) : null;

            if ($request->date_of_birth == null) {
                $now = new DateTime();
                $childrenage = $request->age;
                $dob = $now->modify("-" . $childrenage . ' months');
                $data['date_of_birth'] = $dob;
            } else
                $data['date_of_birth'] = new DateTime($request->date_of_birth);


            Child::findOrFail($id)->update($data);

//            $childId = Child::where('sync_id',$id)->first();
//            $mother_moha_id = $request->input('mother_moha_id');
//            $childId->pregnant_womens()->attach($mother_moha_id);

            $ip1 = Child::findOrFail($id);
            $pp_ids = $request->input('mother_moha_id');
            $ip1->pregnant_womens()->sync($pp_ids);

        } catch (\Exception $e) {
            $this->_notify_message = 'Failed to save child, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect()->route('register')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Child::destroy($id);
            $this->_notify_message = 'Deleted child.';
        } catch (\Exception $e) {
            $this->_notify_message = 'Failed to delete child, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect()->route('register')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
