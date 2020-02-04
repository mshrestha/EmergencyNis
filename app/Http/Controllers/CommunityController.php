<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityController extends Controller
{
    //
    /**
     * Display Community Information
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('community.index');
    }

}
