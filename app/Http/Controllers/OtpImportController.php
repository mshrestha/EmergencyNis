<?php

namespace App\Http\Controllers;

use App\Imports\OtpexcelImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\OtpImport;
use DB;
//use Excel;
use Maatwebsite\Excel\Facades\Excel;

class OtpImportController extends Controller
{
    public function importExport()
    {

        return view('otp_import/import_export');
    }

    public function importExcel(Request $request){
//        dd($request);
        $path1 = $request->file('import_file')->store('temp');
        $path=storage_path('app').'/'.$path1;
//        Excel::import(new OtpexcelImport(),request()->file('file'));
//        config(['excel.import.startRow' => 2]);
        Excel::import(new OtpexcelImport(),$path);
        return redirect('importExport');
    }

}
