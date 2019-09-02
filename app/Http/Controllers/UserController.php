<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Models\Facility;

class UserController extends Controller
{
    private $_notify_message = "User saved.";
    private $_notify_type = "success";

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $role = Auth::user()->role;
            if($role !== 'admin') {
                abort(503);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilities = Facility::all();
        
        return view('user.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:users'
        ]);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->name);
            }
            $user->role = $request->role;
            $user->category = $request->category;
            $user->facility_id = $request->facility_id;
            $user->save();
        } catch (Exception $e) {
            $this->_notify_message = "Failed to create user, try again.";
            $this->_notify_type = "dager";    
        }

        return redirect()->route('user.index')->with([
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
        $user = User::findOrFail($id);
        $facilities = Facility::all();

        return view('user.edit', compact('user', 'facilities'));
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
        $this->validate($request, [
            'email' => 'email|unique:users,email,'.$id
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->role = $request->role;
            $user->category = $request->category;
            $user->facility_id = $request->facility_id;
            $user->save();
        } catch (Exception $e) {
            $this->_notify_message = "Failed to update user, try again.";
            $this->_notify_type = "dager";    
        }

        return redirect()->route('user.index')->with([
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
            $user = User::findOrFail($id);
            if($user->role !== 'admin') {
                $user->delete();
                $this->_notify_message = "User deleted.";
            } else {
                $this->_notify_message = "Can't delete user with admin role.";
                $this->_notify_type = "danger";
            }
        } catch (Exception $e) {
            $this->_notify_message = "Failed to delete user, try again";
            $this->_notify_type = "danger";
        }

        return redirect()->route('user.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
