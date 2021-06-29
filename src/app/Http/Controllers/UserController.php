<?php

namespace App\Http\Controllers;

use App\FacilitySupervisor;
use App\User;
use Illuminate\Http\Request;
use App\Models\Facility;
use Hash;
use DB;
use Auth;


class UserController extends Controller
{
    private $_notify_message = "User saved.";
    private $_notify_type = "success";

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $role = Auth::user()->role;
            if ($role !== 'admin') {
                abort(503);
            }
            return $next($request);
        }, ['except' => ['myprofile','password_update']]);
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
        $supervisor_facility = [];

        return view('user.create', compact('facilities', 'supervisor_facility'));
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
        $this->validate($request, [
            'email' => 'email|unique:users'
        ]);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->role = $request->role;
            $user->category = $request->category;
            $user->facility_id = $request->facility_id;
            $user->save();

//if Manager user
            if ($request->mfacility_id != null && $request->role == 'manager') {
                foreach ($request['mfacility_id'] as $item) {
                    $fasup_id[] = $item;
                }
                $fid = $fasup_id;
                $count_fids = count($fid);
                if (count($fid) != $count_fids) throw new Exception("Bad Request Input Array lengths");
                for ($i = 0; $i < $count_fids; $i++) {
                    if (empty($fid[$i])) continue; // skip all the blank ones
                    $fac_sup = new FacilitySupervisor();
                    $fac_sup->user_id = $user->id;
                    $fac_sup->facility_id = $fid[$i];
                    $fac_sup->save();
                }
            }
//End Manager user

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $facilities = Facility::all();
        $supervisor_facility = FacilitySupervisor::where('user_id', $user->id)->pluck('facility_id')->toArray();

        return view('user.edit', compact('user', 'facilities', 'supervisor_facility'));
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
//        dd($request);
        $this->validate($request, [
            'email' => 'email|unique:users,email,' . $id
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


            if ($request->mfacility_id != null && $request->role == 'manager') {
                $user->facility_id = null;
                $user->save();
                $facility_supervisor = FacilitySupervisor::where('user_id', $user->id)->delete();

                foreach ($request['mfacility_id'] as $item) {
                    $fasup_id[] = $item;
                }
                $fid = $fasup_id;
                $count_fids = count($fid);
                if (count($fid) != $count_fids) throw new Exception("Bad Request Input Array lengths");
                for ($i = 0; $i < $count_fids; $i++) {
                    if (empty($fid[$i])) continue; // skip all the blank ones
                    $fac_sup = new FacilitySupervisor();
                    $fac_sup->user_id = $user->id;
                    $fac_sup->facility_id = $fid[$i];
                    $fac_sup->save();
                }
            } elseif ($request->role == 'admin') {
                $user->facility_id = null;
                $user->save();
                $facility_supervisor = FacilitySupervisor::where('user_id', $user->id)->delete();
            } else {
                $facility_supervisor = FacilitySupervisor::where('user_id', $user->id)->delete();
            }

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->role == 'admin') {
                $user->delete();
                $this->_notify_message = "User deleted.";
            } else {
                $this->_notify_message = "Can't delete user without admin role.";
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

    public function myprofile()
    {
        $user = \Auth::user();
//        dd($user);
        return view('user.profile', compact('user'));
    }

    //By selfUser
    public function password_update(Request $request)
    {
//        dd($request);
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => ['required',
                'min:6',
//                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*_]).*$/',
                'different:current_password'],
            'confirm_password' => 'required|same:new_password',
        ]);
        $data = $request->all();
        $user = User::find(auth()->user()->id);
//        dd($user);
        if (!Hash::check($data['current_password'], $user->password)) {
//            dd('not match');
            return back()->with([
                'notify_message' => "Current password does not match the system.",
                'notify_type' => "danger"

            ]);
        } else {
//            dd('match');
            $input = $request->all();
            $input['password'] = bcrypt($request['new_password']);
            $user->update($input);

//            return view('homepage');
            return redirect('/myprofile')->with([
                'notify_message' => "Password Changed successfully",
                'notify_type' => "success"
            ]);
        }
    }
}
