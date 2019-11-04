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
    public function importExcel1()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            dd($data);
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
//                    dd($value);
//                    dd($value->date_and_time);
                    $insert[] =
                        [
                        'year'=> $value->year,
                        'month'=> $value->month,
                        'programPartner'=> $value->programPartner,
                        'partner'=> $value->partner,
                        'campSattlement'=> $value->campSattlement,
                        'siteName'=> $value->siteName,
                        'reportingStatus'=> $value->reportingStatus,
                        'extendedCriteria'=> $value->extendedCriteria,
                        'age'=> $value->age,
                        'biginingMonth_M'=> $value->biginingMonth_M,
                        'biginingMonth_F'=> $value->biginingMonth_F,
                        'biginingMonthTotal'=> $value->biginingMonthTotal,
                        'enrolmentMuc_M'=> $value->enrolmentMuc_M,
                        'enrolmentMuc_F'=> $value->enrolmentMuc_F,
                        'enrolmentWfh_M'=> $value->enrolmentWfh_M,
                        'enrolmentWfh_F'=> $value->enrolmentWfh_F,
                        'enrolmentEdema_M'=> $value->enrolmentEdemaM,
                        'enrolmentEdema_F'=> $value->enrolmentEdema_F,
                        'enrolmentRelapse_M'=> $value->enrolmentRelapse_M,
                        'enrolmentRelapse_F'=> $value->enrolmentRelapse_F,
                        'totalNewEnrolment_M'=> $value->totalNewEnrolment_M,
                        'totalNewEnrolment_F'=> $value->totalNewEnrolment_F,
                        'totalNewEnrolment'=> $value->totalNewEnrolment,
                        'transferDefult_M'=> $value->transferDefult_M,
                        'transferDefult_F'=> $value->transferDefult_F,
                        'transferFromTsfp_M'=> $value->transferFromTsfp_M,
                        'transferFromTsfp_F'=> $value->transferFromTsfp_F,
                        'transferFromInp_M'=> $value->transferFromInp_M,
                        'transferFromInp_F'=> $value->transferFromInp_F,
                        'transferOtherOtp_M'=> $value->transferOtherOtp_M,
                        'transferOtherOtp_F'=> $value->transferOtherOtp_F,
                        'totalTransferIn_M'=> $value->totalTransferIn_M,
                        'totalTransferIn_F'=> $value->totalTransferIn_F,
                        'totalTransferIn'=> $value->totalTransferIn,
                        'totalEnrolment_M'=> $value->totalEnrolment_M,
                        'totalEnrolment_F'=> $value->totalEnrolment_F,
                        'totalEnrolment'=> $value->totalEnrolment,
                        'Recovered_M'=> $value->Recovered_M,
                        'Recovered_F'=> $value->Recovered_F,
                        'Death_M'=> $value->Death_M,
                        'Death_F'=> $value->Death_F,
                        'Default_M'=> $value->Default_M,
                        'Default_F'=> $value->Default_F,
                        'nonRecovered_M'=> $value->nonRecovered_M,
                        'nonRecovered_F'=> $value->nonRecovered_F,
                        'totalDischarged_M'=> $value->totalDischarged_M,
                        'totalDischarged_F'=> $value->totalDischarged_F,
                        'totalDischarged'=> $value->totalDischarged,
                        'medicalTrnsfer_M'=> $value->medicalTrnsfer_M,
                        'medicalTrnsfer_F'=> $value->medicalTrnsfer_F,
                        'unknown_M'=> $value->unknown_M,
                        'unknown_F'=> $value->unknown_F,
                        'transferSc_M'=> $value->transferSc_M,
                        'transferSc_F'=> $value->transferSc_F,
                        'transfOtherOtp_M'=> $value->transfOtherOtp_M,
                        'transfOtherOtp_F'=> $value->transfOtherOtp_F,
                        'totalExit_M'=> $value->totalExit_M,
                        'totalExit_F'=> $value->totalExit_F,
                        'totalExit'=> $value->totalExit,
                        'totalEndOfMonth_M'=> $value->totalEndOfMonth_M,
                        'totalEndOfMonth_F'=> $value->totalEndOfMonth_F,
                        'totalEndOfMonth'=> $value->totalEndOfMonth,
                        'totalTransferFromOther'=> $value->totalTransferFromOther,
                        'totalCured'=> $value->totalCured,
                        'totalDeath'=> $value->totalDeath,
                        'totalDefault'=> $value->totalDefault,
                        'curedRate'=> $value->curedRate,
                        'deathRate'=> $value->deathRate,
                        'defaultRate'=> $value->defaultRate,
                        'nonRecoveredRate'=> $value->nonRecoveredRate,
                        'totalNewAdmissionCalculated'=> $value->totalNewAdmissionCalculated,
                        'difference'=> $value->difference,
                        'los'=> $value->los,
                        'awg'=> $value->awg,

                    ];
                }

//                dd($insert[0]["date_and_time"]);
//                dd($insert[0]["personnel_id"]);
//                dd($insert[0]["device_name"]);

                $logExists = Matchinelog::where('date_and_time',$insert[0]["date_and_time"])
                    ->where('personnel_id',$insert[0]["personnel_id"])
                    ->exists();
                if($logExists){
                    return redirect('importExport')->withErrors(['error' => 'log Already updated']);
                }


                if(!empty($insert)){
                    DB::table('matchinelogs')->insert($insert);
                    \Session::flash('flash_message','Successfully Stored');
                    return redirect('importExport');
//                    dd('Insert Record successfully.');
                }
            }
        }
        return back();
    }

}
