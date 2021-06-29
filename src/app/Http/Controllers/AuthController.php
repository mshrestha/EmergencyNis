<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class AuthController extends Controller
{
    private $_notifyMessage = null;
    private $_notifyType = 'info';

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember_token)
        ) {
            $this->_notifyMessage = "Login Failed";
            $this->_notifyType = 'danger';

            return redirect()->back()->with([
                'notify_message' => $this->_notifyMessage,
                'notify_type' => $this->_notifyType
            ])->withInput($request->all());
        }

//		dd($request);
        $user_type = User::where('email', $request->email)->first();
//        dd($user_type->role);
        $this->_notifyMessage = "Login Successful.";
        if ($user_type->role == 'manager') {
            return redirect()->intended('/program-manager')->with([
                'notify_message' => $this->_notifyMessage,
                'notify_type' => $this->_notifyType
            ]);

        } else {
            return redirect()->intended('/homepage')->with([
                'notify_message' => $this->_notifyMessage,
                'notify_type' => $this->_notifyType
            ]);
        }
    }

    public function getLogout()
    {
        try {
            Auth::logout();
            $this->_notifyMessage = "You have successfully logged Out";
        } catch (Exception $e) {
            $this->_notifyMessage = "Logout Failed. Please Try Again.";
            $this->_notifyType = "danger";
        }

//        return redirect()->route('auth.login');
        return redirect()->route('open_dashboard')->with([
                'notify_message' => $this->_notifyMessage,
                'notify_type' => $this->_notifyType
            ]);

    }
}
