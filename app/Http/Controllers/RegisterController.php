<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
  /**
   * Show the homepage.
   * @return View
   */
  public function index()
  {
      return view('register');
  }
}
