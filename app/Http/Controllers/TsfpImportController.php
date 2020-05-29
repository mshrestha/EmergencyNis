<?php

namespace App\Http\Controllers;

use App\Imports\TsfpexcelImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;


class TsfpImportController extends Controller
{
    public function importExportTsfp()
    {
        $generated_data = DB::table('tsfp_imports')
            ->select('year', 'month', DB::raw('count(campSettlement) as camp_count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        return view('import_export/importExportTsfp', compact('generated_data'));
    }

    public function importTsfp(Request $request)
    {
//        dd($request);
        $path1 = $request->file('import_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
//        Excel::import(new OtpexcelImport(),request()->file('file'));
//        config(['excel.import.startRow' => 2]);
        Excel::import(new TsfpexcelImport(), $path);
        return redirect('importExportTsfp');
    }
    public function destroy($period)
    {
        $ym=explode("_", $period);
        DB::table('tsfp_imports')->where('year',$ym[0])->where('month',$ym[1])->delete();
        return redirect()->route('importExportTsfp')->with([
            'notify_message' => 'Successfully Deleted',
            'notify_type' => 'success'
        ]);
    }


}
