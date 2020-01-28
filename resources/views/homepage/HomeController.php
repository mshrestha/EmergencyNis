<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\ChcpsImport;
use App\Chcp;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }
    private $group = '26971a54-c1be-4b72-8470-3bc7ece87697';

    public function index()
    {

        $chcps = Chcp::all();
        return view('home.app', compact('chcps'));
    }
    public function list()
    {

      $chcps = Chcp::all();
      return view('home.list', compact('chcps'));
    }
    public function viewContact($id){
      $chcp = Chcp::find($id);
      var_dump($this->jsonChcp($chcp));
      exit();
    }
    public function upload()
    {
      return view('home.upload');
    }
    private function jsonChcp($chcp){
      $result= array(
        "name"=> $chcp->name,
        "language"=> "ben",
        "urns"=> array("tel:+".$chcp->phone),
        "groups"=> array($this->group),
        "fields"=> array(
          "division"=> $chcp->division,
          "district"=> $chcp->district,
          "upazila"=> $chcp->upazila,
          "facility"=> $chcp->facility,
          "registeredpregwomen"=> $chcp->pregnantwomen,
          "receivedifa"=> $chcp->ifa,
          "counselledwomen"=> $chcp->counseled,
          "weighed" => $chcp->weighed,
          "allthreeserice"=> $chcp->allthree,
          "maternalscore" => $chcp->score
          )
        );
        return(json_encode($result));
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new ChcpsImport,request()->file('file'));

        return back();
    }



}
