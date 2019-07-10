<?php

namespace App\Http\Controllers;

use App\Models\Child;

use Illuminate\Http\Request;
// use Intervention\Image\Facades\Image;

class ChildrenController extends Controller
{
    private $_notify_message = 'Children saved.';
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
        return view('children.create');
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
            
            Child::create($data);
        } catch (Exception $e) {
            $this->_notify_message = 'Failed to save child, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect()->route('homepage')->with([
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

        return view('children.edit', compact('child'));
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
            
            Child::findOrFail($id)->update($data);
        } catch (Exception $e) {
            $this->_notify_message = 'Failed to save child, Try again.';
            $this->_notify_type = 'danger';
        }

        return redirect()->route('homepage')->with([
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

        return redirect()->route('homepage')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
