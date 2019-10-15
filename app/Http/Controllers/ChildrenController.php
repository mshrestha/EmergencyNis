<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Child;
use App\Models\Camp;
use App\Models\Facility;

use Illuminate\Http\Request;
// use Intervention\Image\Facades\Image;

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
        $facility_id= Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        

        return view('children.create', compact('camps', 'facility'));
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
            $image = $this->uploadImage($request);
            $image ? $data['picture'] = $image : false ;
            $data['date'] = date('y-m-d');
            $data['facility_id'] = Auth::user()->facility_id;
            
            //Create sync id
            $latest_child = Child::orderBy('id', 'desc')->first();
            $app_id = $latest_child ? $latest_child->id + 1 : 1;
            $data['sync_id'] = 101 . $app_id;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'created';

            $id = Child::create($data)->id;
        } catch (Exception $e) {
            $this->_notify_message = 'Failed to save child, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect('facility-followup/'.$id)->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    public function uploadImage($request) {
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = time() ."-". $file->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);

            $image = $this->_children_image_location. '/' .$fileName;
            $upload_success= $file->move($this->_children_image_location, $fileName);

            // $upload = Image::make($image);
            // $upload->fit(380, 408)->save($this->_children_image_location .'/'. $fileName, 100);
            
            return $fileName;
        }

        return false;
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
        $child = Child::findOrFail($id);
        $facility_id= Auth::user()->facility_id;
        $facility = Facility::findOrFail($facility_id);
        $camps = Camp::orderBy('id', 'asc')->get();

        return view('children.edit', compact('child', 'camps', 'facility'));
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
            $image = $this->uploadImage($request);
            $image ? $data['picture'] = $image : false ;
            $data['sync_status'] = env('LIVE_SERVER') ? 'synced' : 'updated';
            
            Child::findOrFail($id)->update($data);
        } catch (Exception $e) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Child::destroy($id);
            $this->_notify_message = 'Deleted child.';
        } catch (Exception $e) {
            $this->_notify_message = 'Failed to delete child, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect()->route('register')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
