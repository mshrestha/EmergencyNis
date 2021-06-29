<?php

namespace App\Http\Controllers;

use App\Imports\ScexcelImport;
use Illuminate\Http\Request;
use DB;
//use Excel;
use Maatwebsite\Excel\Facades\Excel;

class ScImportController extends Controller
{
    public function importExportSc()
    {
        $generated_data = DB::table('sc_imports')
            ->select('year', 'month', DB::raw('count(campSettlement) as camp_count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
//        dd($generated_data);

        return view('import_export/importExportSc', compact('generated_data'));
    }

    public function importSc(Request $request)
    {
//        dd($request);
        $path1 = $request->file('import_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
//        Excel::import(new OtpexcelImport(),request()->file('file'));
//        config(['excel.import.startRow' => 2]);
        Excel::import(new ScexcelImport(), $path);
        return redirect('importExportSc');
    }
    public function destroy($period)
    {
        $ym=explode("_", $period);
        DB::table('sc_imports')->where('year',$ym[0])->where('month',$ym[1])->delete();
        return redirect()->route('importExportSc')->with([
            'notify_message' => 'Successfully Deleted',
            'notify_type' => 'success'
        ]);
    }


}
