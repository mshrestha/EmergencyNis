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
        $generated_data = DB::table('otp_imports')
            ->select('year', 'month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('import_export/importExport', compact('generated_data'));
    }

    public function importExcel(Request $request)
    {
//        dd($request);
        $path1 = $request->file('import_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
//        Excel::import(new OtpexcelImport(),request()->file('file'));
//        config(['excel.import.startRow' => 2]);
        Excel::import(new OtpexcelImport(), $path);
        return redirect('importExport');
    }

    public function open_dashboard_ym(Request $request)
    {
//        dd($request);
        $db_month_year = DB::table('otp_imports')->where('period', $request->period)->first();
        $program_partners = DB::table('otp_imports')
            ->groupBy('programPartner')
            ->pluck('programPartner')->toArray();
        $partners = DB::table('otp_imports')
            ->groupBy('partner')
            ->pluck('partner')->toArray();
        $camps = DB::table('otp_imports')
            ->groupBy('campSattlement')
            ->pluck('campSattlement')->toArray();
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
        $programPartner = $request->program_partner;
        $partner = $request->partner;
        $camp = $request->camp;

        $line_chart = $this->open_dashboard_linechart_ym($months, $programPartner, $partner,$camp);
        $bar_chart = $this->open_dashboard_barchart_ym($report_month, $report_year, $programPartner, $partner, $camp);
        $doughnut_chart = $this->open_dashboard_doughnut_ym($report_month, $report_year, $programPartner, $partner, $camp);

        return view('homepage.open_dashboard', compact('program_partners', 'partners', 'camps', 'periods', 'cache_data', 'month_year', 'doughnut_chart', 'bar_chart', 'line_chart'));
    }

    public function open_dashboard()
    {
        $program_partners = DB::table('otp_imports')
            ->groupBy('programPartner')
            ->pluck('programPartner')->toArray();
        $partners = DB::table('otp_imports')
            ->groupBy('partner')
            ->pluck('partner')->toArray();
        $camps = DB::table('otp_imports')
            ->groupBy('campSattlement')
            ->pluck('campSattlement')->toArray();
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
//        dd($months);
//        $facility_supervision = FacilitySupervisor::where('user_id', Auth::user()->id)->pluck('facility_id')->toArray();
        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $line_chart = $this->open_dashboard_linechart($months);
        $doughnut_chart = $this->open_dashboard_doughnutchart($report_year, $report_month);
        $bar_chart = $this->open_dashboard_barchart($report_year, $report_month);
//        dd($bar_chart);
        return view('homepage.open_dashboard', compact('program_partners', 'partners', 'camps', 'periods', 'cache_data', 'month_year', 'doughnut_chart', 'bar_chart', 'line_chart'));
    }

    private function open_dashboard_linechart($months)
    {
        $line_chart = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(totalNewEnrolment) as TotalAdmission'))
            ->whereIn('period', $months)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
            ->orderBy('year', 'asc')->orderBy('month', 'asc')
            ->get()->toArray();
        return $line_chart;
    }

    private function open_dashboard_linechart_ym($months, $programPartner, $partner,$camp)
    {
        $line_chart_query = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(totalNewEnrolment) as TotalAdmission'))
            ->whereIn('period', $months);
        if ($programPartner != null && $partner == null && $camp==null) {
            $line_chart = $line_chart_query->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')
                ->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp==null) {
            $line_chart = $line_chart_query->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')
                ->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp==null) {
            $line_chart = $line_chart_query->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')
                ->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp!=null) {
            $line_chart = $line_chart_query->where('partner', $partner)->where('programPartner', $programPartner)->where('campSattlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')
                ->get()->toArray();
        } elseif ($programPartner != null && $partner == null && $camp!=null) {
            $line_chart = $line_chart_query->where('programPartner', $programPartner)->where('campSattlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')
                ->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp!=null) {
            $line_chart = $line_chart_query->where('partner', $partner)->where('campSattlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')
                ->get()->toArray();
        } elseif ($programPartner == null && $partner == null && $camp!=null) {
            $line_chart = $line_chart_query->where('campSattlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')
                ->get()->toArray();
        } else {
            $line_chart = $line_chart_query
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')
                ->get()->toArray();
        }
        return $line_chart;
    }

    private function open_dashboard_doughnut_ym($report_month, $report_year, $programPartner, $partner, $camp)
    {
        if ($programPartner != null && $partner == null && $camp==null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('programPartner', $programPartner)
                ->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('programPartner', $programPartner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('programPartner', $programPartner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;
        } elseif ($programPartner == null && $partner != null && $camp==null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('partner', $partner)
                ->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('partner', $partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('partner', $partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;
        } elseif ($programPartner != null && $partner != null && $camp==null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('programPartner', $programPartner)->where('partner', $partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('programPartner', $programPartner)->where('partner', $partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('programPartner', $programPartner)->where('partner', $partner)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;
        } elseif ($programPartner != null && $partner != null && $camp!=null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSattlement', $camp)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;
        } elseif ($programPartner != null && $partner == null && $camp!=null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSattlement', $camp)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;
        } elseif ($programPartner == null && $partner != null && $camp!=null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSattlement', $camp)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSattlement', $camp)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSattlement', $camp)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSattlement', $camp)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSattlement', $camp)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;
        } elseif ($programPartner == null && $partner == null && $camp!=null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('campSattlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSattlement', $camp)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSattlement', $camp)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSattlement', $camp)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSattlement', $camp)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSattlement', $camp)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSattlement', $camp)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;
        }else{
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->where('age', '6-23 months')->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->where('age', '24-59 months')->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->where('age', '>5 years')->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $doughnut_chart['otp_admit_both'] = 0;
        }
        return $doughnut_chart;
    }

    private function open_dashboard_barchart_ym($report_month, $report_year, $programPartner, $partner, $camp)
    {
        $bar_chart_query = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSattlement'), DB::raw('sum(Recovered_M) as recoveredM'),
                DB::raw('sum(Recovered_F) as recoveredF'), DB::raw('sum(totalDischarged) as totalDischarged'), DB::raw('sum(medicalTrnsfer_M) as medicalTrnsferM'),
                DB::raw('sum(medicalTrnsfer_F) as medicalTrnsferF'), DB::raw('sum(Default_M) as defaultM'), DB::raw('sum(Default_F) as defaultF'),
                DB::raw('sum(totalDeath) as totalDeath'), DB::raw('sum(unknown_M) as unknownM'), DB::raw('sum(nonRecovered_M) as nonRecoveredM'), DB::raw('sum(nonRecovered_F) as nonRecoveredF'))
            ->where('month', $report_month)->where('year', $report_year);
        if ($programPartner != null && $partner == null && $camp==null) {
            $bar_chart2 = $bar_chart_query->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ( $programPartner == null && $partner != null && $camp==null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp==null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp!=null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('programPartner', $programPartner)->where('campSattlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner == null && $camp!=null) {
            $bar_chart2 = $bar_chart_query->where('programPartner', $programPartner)->where('campSattlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp!=null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('campSattlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner == null && $partner == null && $camp!=null) {
            $bar_chart2 = $bar_chart_query->where('campSattlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } else {
            $bar_chart2 = $bar_chart_query
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        }
        $campSattlement = [];
        $curedRate = [];
        $deathRate = [];
        $defaultRate = [];
        $nonRecoveredRate = [];
        foreach ($bar_chart2 as $bc) {
            for ($i = 0; $i < count($bar_chart2); $i++) ;
            $campSattlement[] = $bc->campSattlement;
            $curedRate[] = ($bc->totalDischarged == 0) ? 0 : (($bc->recoveredM + $bc->recoveredF) / $bc->totalDischarged)*100;
            $deathRate[] = ($bc->medicalTrnsferM == 0) ? 0 : $bc->totalDeath / $bc->medicalTrnsferM;
            $defaultRate[] = ($bc->medicalTrnsferF == 0) ? 0 : (($bc->defaultM + $bc->defaultF) / $bc->medicalTrnsferF);
            $nonRecoveredRate[] = ($bc->unknownM == 0) ? 0 : (($bc->nonRecoveredM + $bc->nonRecoveredF) / $bc->unknownM);
        }
        $bar_chart['campSattlement'] = $campSattlement;
        $bar_chart['curedRate'] = $curedRate;
        $bar_chart['deathRate'] = $deathRate;
        $bar_chart['defaultRate'] = $defaultRate;
        $bar_chart['nonRecoveredRate'] = $nonRecoveredRate;
        return $bar_chart;
    }

    private function open_dashboard_doughnutchart($report_year, $report_month)
    {
//        dd($report_month);
        $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->where('age', '6-23 months')->sum('totalNewEnrolment');
        $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->where('age', '24-59 months')->sum('totalNewEnrolment');
        $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->where('age', '>5 years')->sum('totalNewEnrolment');
        $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('totalNewEnrolment_M');
        $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('totalNewEnrolment_F');
        $doughnut_chart['otp_admit_others'] = 0;
        $otp_admit_mucm = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentMuc_M');
        $otp_admit_mucf = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentMuc_F');
        $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
        $otp_admit_wfhm = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentWfh_M');
        $otp_admit_wfhf = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentWfh_F');
        $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
        $doughnut_chart['otp_admit_both'] = 0;
//        dd($doughnut_chart);
        return $doughnut_chart;
    }

    private function open_dashboard_barchart($report_year, $report_month)
    {
        $bar_chart2 = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSattlement'), DB::raw('sum(Recovered_M) as recoveredM'),
                DB::raw('sum(Recovered_F) as recoveredF'), DB::raw('sum(totalDischarged) as totalDischarged'), DB::raw('sum(medicalTrnsfer_M) as medicalTrnsferM'),
                DB::raw('sum(medicalTrnsfer_F) as medicalTrnsferF'), DB::raw('sum(Default_M) as defaultM'), DB::raw('sum(Default_F) as defaultF'),
                DB::raw('sum(totalDeath) as totalDeath'), DB::raw('sum(unknown_M) as unknownM'), DB::raw('sum(nonRecovered_M) as nonRecoveredM'), DB::raw('sum(nonRecovered_F) as nonRecoveredF'))
            ->where('month', $report_month)->where('year', $report_year)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSattlement'))
            ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        $campSattlement = [];
        $curedRate = [];
        $deathRate = [];
        $defaultRate = [];
        $nonRecoveredRate = [];
        foreach ($bar_chart2 as $bc) {
            for ($i = 0; $i < count($bar_chart2); $i++) ;
            $campSattlement[] = $bc->campSattlement;
            $curedRate[] = ($bc->totalDischarged == 0) ? 0 : (($bc->recoveredM + $bc->recoveredF) / $bc->totalDischarged);
            $deathRate[] = ($bc->medicalTrnsferM == 0) ? 0 : $bc->totalDeath / $bc->medicalTrnsferM;
            $defaultRate[] = ($bc->medicalTrnsferF == 0) ? 0 : (($bc->defaultM + $bc->defaultF) / $bc->medicalTrnsferF);
            $nonRecoveredRate[] = ($bc->unknownM == 0) ? 0 : (($bc->nonRecoveredM + $bc->nonRecoveredF) / $bc->unknownM);
        }
        $bar_chart['campSattlement'] = $campSattlement;
        $bar_chart['curedRate'] = $curedRate;
        $bar_chart['deathRate'] = $deathRate;
        $bar_chart['defaultRate'] = $defaultRate;
        $bar_chart['nonRecoveredRate'] = $nonRecoveredRate;
        return $bar_chart;

    }
}
