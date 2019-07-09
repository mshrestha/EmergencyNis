<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class AuthController extends Controller
{
    private $_notifyMessage = null;
    private $_notifyType = 'info';

    public function getLogin() {
    	return view('auth.login');
    }

    public function postLogin(Request $request) {
        if(!Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password, 
        ], $request->remember_token))
        {
            $this->_notifyMessage = "Login Failed";
            $this->_notifyType = 'danger';

            return redirect()->back()->with([
            	'notify_message' => $this->_notifyMessage,
            	'notify_type' => $this->_notifyType
            ])->withInput($request->all());
		}

        $this->_notifyMessage = "Login Successful.";
        return redirect()->intended('/backend/banner')->with([
        	'notify_message' => $this->_notifyMessage,
        	'notify_type' => $this->_notifyType
        ]);
    }

    public function getLogout() {
        try {
            Auth::logout();
            $this->_notifyMessage = "Logged Out";
        } catch (Exception $e) {
            $this->_notifyMessage = "Logout Failed. Please Try Again.";
            $this->_notifyType = "danger";
        }

		return redirect()->route('auth.login');

    }
}
