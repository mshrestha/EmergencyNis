<?php

namespace App\Http\Controllers;

use App\Imports\BsfpexcelImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class BsfpImportController extends Controller
{
    public function importExportBsfp()
    {
        $generated_data = DB::table('bsfp_imports')
            ->select('year', 'month', DB::raw('count(campSettlement) as camp_count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
//        dd($generated_data);

        return view('import_export/importExportBsfp', compact('generated_data'));
    }

    public function importBsfp(Request $request)
    {
//        dd($request);
        $path1 = $request->file('import_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
//        Excel::import(new OtpexcelImport(),request()->file('file'));
//        config(['excel.import.startRow' => 2]);
        Excel::import(new BsfpexcelImport(), $path);
        return redirect('importExportBsfp');
    }

}
