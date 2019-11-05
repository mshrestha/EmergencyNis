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
        $generated_data=DB::table('otp_imports')
            ->select('year','month')
            ->groupBy('year','month')
            ->orderBy('year','desc')
            ->orderBy('month','desc')
            ->get();

        return view('import_export/importExport',compact('generated_data'));
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

    public function open_dashboard_ym(Request $request){
        $db_month_year=DB::table('otp_imports')->where('period',$request->period)->first();
        $program_partners = DB::table('otp_imports')
            ->groupBy('programPartner')
            ->pluck('programPartner')->toArray();
        $partners = DB::table('otp_imports')
            ->groupBy('partner')
            ->pluck('partner')->toArray();
        $periods = DB::table('otp_imports')
            ->groupBy('period')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->pluck('period')->toArray();
        $report_month = $db_month_year->month;
        $report_year = $db_month_year->year;
        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }
        if($request->partner==null && $request->program_partner!=null) {
            $line_chart = DB::table('otp_imports')
                ->select('period as Month', 'totalNewEnrolment as TotalAdmission', 'campSattlement as Facility_name')
                ->whereIn('period', $months)
                ->where('programPartner', $request->program_partner)
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get()
                ->toArray();
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','6-23 months')->where('programPartner', $request->program_partner)
                ->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','24-59 months')->where('programPartner', $request->program_partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','>5 years')->where('programPartner', $request->program_partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $request->program_partner)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $request->program_partner)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $request->program_partner)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $request->program_partner)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm+$otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $request->program_partner)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $request->program_partner)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm+$otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;

            $bar_chart1 = DB::table('otp_imports')
                ->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $request->program_partner)
                ->select('campSattlement','curedRate', 'deathRate', 'defaultRate', 'nonRecoveredRate')
                ->get()
                ->toArray();
            $bar_chart['facility_id'] = array_column($bar_chart1, 'campSattlement');
            $bar_chart['cure_rate'] = array_column($bar_chart1, 'curedRate');
            $bar_chart['death_rate'] = array_column($bar_chart1, 'deathRate');
            $bar_chart['default_rate'] = array_column($bar_chart1, 'defaultRate');
            $bar_chart['nonrespondent_rate'] = array_column($bar_chart1, 'nonRecoveredRate');


        }
        elseif ($request->program_partner==null && $request->partner!=null) {
            $line_chart = DB::table('otp_imports')
                ->select('period as Month', 'totalNewEnrolment as TotalAdmission', 'campSattlement as Facility_name')
                ->whereIn('period', $months)
                ->where('partner', $request->partner)
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get()
                ->toArray();
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','6-23 months')->where('partner', $request->partner)
                ->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','24-59 months')->where('partner', $request->partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','>5 years')->where('partner', $request->partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $request->partner)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $request->partner)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $request->partner)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $request->partner)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm+$otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $request->partner)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $request->partner)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm+$otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;

            $bar_chart1 = DB::table('otp_imports')
                ->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $request->partner)
                ->select('campSattlement','curedRate', 'deathRate', 'defaultRate', 'nonRecoveredRate')
                ->get()
                ->toArray();
            $bar_chart['facility_id'] = array_column($bar_chart1, 'campSattlement');
            $bar_chart['cure_rate'] = array_column($bar_chart1, 'curedRate');
            $bar_chart['death_rate'] = array_column($bar_chart1, 'deathRate');
            $bar_chart['default_rate'] = array_column($bar_chart1, 'defaultRate');
            $bar_chart['nonrespondent_rate'] = array_column($bar_chart1, 'nonRecoveredRate');

        }
        else{
            $line_chart = DB::table('otp_imports')
                ->select('period as Month', 'totalNewEnrolment as TotalAdmission', 'campSattlement as Facility_name')
                ->whereIn('period', $months)
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get()
                ->toArray();
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','6-23 months')
                ->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','24-59 months')->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age','>5 years')->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm+$otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm+$otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;

            $bar_chart1 = DB::table('otp_imports')
                ->where('month', $report_month)->where('year', $report_year)
                ->select('campSattlement','curedRate', 'deathRate', 'defaultRate', 'nonRecoveredRate')
                ->get()
                ->toArray();
            $bar_chart['facility_id'] = array_column($bar_chart1, 'campSattlement');
            $bar_chart['cure_rate'] = array_column($bar_chart1, 'curedRate');
            $bar_chart['death_rate'] = array_column($bar_chart1, 'deathRate');
            $bar_chart['default_rate'] = array_column($bar_chart1, 'defaultRate');
            $bar_chart['nonrespondent_rate'] = array_column($bar_chart1, 'nonRecoveredRate');

        }


        return view('homepage.open_dashboard_ym', compact('program_partners','partners','periods','cache_data', 'month_year', 'doughnut_chart', 'bar_chart', 'line_chart'));
    }
    public function open_dashboard()
    {
        $program_partners = DB::table('otp_imports')
            ->groupBy('programPartner')
            ->pluck('programPartner')->toArray();
        $partners = DB::table('otp_imports')
            ->groupBy('partner')
            ->pluck('partner')->toArray();
        $periods = DB::table('otp_imports')
            ->groupBy('period')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->pluck('period')->toArray();
//        dd($partner);
        $cache_data = DB::table('otp_imports')
            ->select('year', 'month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()->toArray();
//        dd($cache_data);
        if (empty($cache_data)) {
            if (date('n') == 1) {
                $report_month = 12;
                $report_year = date('Y') - 1;
            } else {
                $report_month = date('n') - 1;
                $report_year = date('Y');
            }
        } else {
            $report_month = $cache_data[0]->month;
            $report_year = $cache_data[0]->year;
        }

        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date('Y-m-01') . " -$i months"));
        }
//        $facility_supervision = FacilitySupervisor::where('user_id', Auth::user()->id)->pluck('facility_id')->toArray();
        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $line_chart = $this->open_dashboard_linechart($months);
        $doughnut_chart = $this->open_dashboard_doughnutchart($report_year, $report_month);
        $bar_chart = $this->open_dashboard_barchart($report_year, $report_month);

        return view('homepage.open_dashboard', compact('program_partners','partners','periods','cache_data', 'month_year', 'doughnut_chart', 'bar_chart', 'line_chart'));
    }

    private function open_dashboard_linechart($months)
    {

        $line_chart = DB::table('otp_imports')
            ->select('period as Month', 'totalNewEnrolment as TotalAdmission' ,'campSattlement as Facility_name')
//            select('period as Month', 'totalNewEnrolment as TotalAdmission' ,DB::raw('CONCAT("otp_imports.partner","otp_imports.campSattlement") as Facility_name'))
            ->whereIn('period', $months)
//            ->whereIn('campSattlement', ['9','10','11'])
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->toArray();
//        dd($line_chart);
        return $line_chart;
    }

    private function open_dashboard_doughnutchart($report_year, $report_month)
    {
//        dd($report_month);
        $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->where('age','6-23 months')->sum('totalNewEnrolment');
        $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->where('age','24-59 months')->sum('totalNewEnrolment');
        $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->where('age','>5 years')->sum('totalNewEnrolment');
        $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('totalNewEnrolment_M');
        $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('totalNewEnrolment_F');
        $doughnut_chart['otp_admit_others'] = 0;
        $otp_admit_mucm = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentMuc_M');
        $otp_admit_mucf = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentMuc_F');
        $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm+$otp_admit_mucf;
        $otp_admit_wfhm = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentWfh_M');
        $otp_admit_wfhf = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentWfh_F');
        $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm+$otp_admit_wfhf;
        $doughnut_chart['otp_admit_both'] = 0;
//        dd($doughnut_chart);
        return $doughnut_chart;
    }

    private function open_dashboard_barchart($report_year, $report_month)
    {
        $bar_chart1 = DB::table('otp_imports')
//            ->join('facilities', 'facilities.id', '=', 'monthly_dashboards.facility_id')
            ->where('month', $report_month)->where('year', $report_year)->where('age','6-23 months')
            ->select('campSattlement','curedRate', 'deathRate', 'defaultRate', 'nonRecoveredRate')
            ->get()
            ->toArray();
//        $facilities = array_column($bar_chart, 'campSattlement');
        $bar_chart['facility_id'] = array_column($bar_chart1, 'campSattlement');
        $bar_chart['cure_rate'] = array_column($bar_chart1, 'curedRate');
        $bar_chart['death_rate'] = array_column($bar_chart1, 'deathRate');
        $bar_chart['default_rate'] = array_column($bar_chart1, 'defaultRate');
        $bar_chart['nonrespondent_rate'] = array_column($bar_chart1, 'nonRecoveredRate');
//dd($bar_chart);
        return $bar_chart;

    }



}
