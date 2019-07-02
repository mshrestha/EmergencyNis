<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowupController extends Controller
{
  /**
   * Show the homepage.
   * @return View
   */
  public function index()
  {
      return view('followup');
  }
}
