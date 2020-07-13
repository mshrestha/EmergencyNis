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
    public function importHome()
    {
        return view('import_export/importHome');
    }
    public function importExportOtp()
    {
        $generated_data = DB::table('otp_imports')
            ->select('year', 'month', DB::raw('count(campSettlement) as camp_count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
//        dd($generated_data);

        return view('import_export/importExportOtp', compact('generated_data'));
    }

    public function importOtp(Request $request)
    {
//        dd($request);
        $path1 = $request->file('import_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
//        Excel::import(new OtpexcelImport(),request()->file('file'));
//        config(['excel.import.startRow' => 2]);
        Excel::import(new OtpexcelImport(), $path);
        return redirect('importExportOtp');
    }

    public function destroy($period)
    {
        $ym=explode("_", $period);
        DB::table('otp_imports')->where('year',$ym[0])->where('month',$ym[1])->delete();
        return redirect()->route('importExportOtp')->with([
            'notify_message' => 'Successfully Deleted',
            'notify_type' => 'success'
        ]);
    }


    public function open_dashboard_ym(Request $request)
    {
        if (Input::get('program_partner') != null)
            $program_partner = Input::get('program_partner');
        else $program_partner = '';
        if (Input::get('partner') != null)
            $partner = Input::get('partner');
        else $partner = '';
        if (Input::get('camp')!=null)
        $camp = Input::get('camp');
        else $camp='';
        if (Input::get('period')!=null)
        $period = Input::get('period');
        else $period = '';
        $filter_message = "Result for " . (($program_partner != null) ? 'Program Partner is ' . $program_partner : '')
            . (($partner != null) ? ' Partner is ' . $partner : '')
            . (($camp != null) ? ' Camp is ' . $camp : '')
            . (($period != null) ? ' Period is ' . $period : '');
//        dd($filter_message);
//        $db_month_year = DB::table('otp_imports')->where('period', $request->period)->first();
        $program_partners = ['ACF', 'IAID', 'MULTI', 'PAPIL', 'UNHCR', 'UNICEF', 'WFP'];
//            DB::table('otp_imports')
//            ->groupBy('programPartner')
//            ->pluck('programPartner')->toArray();
        $partners = ['ACF', 'BRAC', 'CWW', 'SARPV', 'SCI', 'SHED', 'TDH', 'WC', 'WFP', 'WVI'];
//            DB::table('otp_imports')
//            ->groupBy('partner')
//            ->pluck('partner')->toArray();
        $camps = ['3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27',
            '1E', '1W', '20EX', '2E', '2W', '4EX', '8E', '8W', 'KRC', 'KTP', 'KTP RC', 'NRC'];
//            DB::table('otp_imports')
//            ->groupBy('campSettlement')
//            ->pluck('campSettlement')->toArray();
        $periods = DB::table('otp_imports')
            ->groupBy('period')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->pluck('period')->toArray();
//dd($request->period);
        $pieces = explode("-", $request->period);

        $report_month = date('m', strtotime($pieces[0]));
        $report_year = '20' . $pieces[1];
        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }
        $programPartner = $request->program_partner;
        $partner = $request->partner;
        $camp = $request->camp;

        $line_chart = $this->open_dashboard_linechart_ym($months, $programPartner, $partner, $camp);
//        dd($line_chart);
        $bar_chart = $this->open_dashboard_barchart_ym($report_month, $report_year, $programPartner, $partner, $camp);
        $bar_chart_tsfp = $this->open_dashboard_barchart_tsfp_ym($report_month, $report_year, $programPartner, $partner, $camp);
        $doughnut_chart = $this->open_dashboard_doughnut_ym($report_month, $report_year, $programPartner, $partner, $camp);
        $doughnut_chartTsfp = $this->open_dashboard_doughnut_tsfp_ym($report_month, $report_year, $programPartner, $partner, $camp);
        $target_reached = $this->target_reached($report_year);
//        dd($target_reached);
        return view('homepage.open_dashboard', compact('program_partners', 'partners', 'camps', 'periods',
            'cache_data', 'month_year', 'doughnut_chart','doughnut_chartTsfp', 'bar_chart','bar_chart_tsfp', 'line_chart',
            'months','filter_message','target_reached','report_year'));
    }

    public function open_dashboard()
    {
        $filter_message='';
        $program_partners = ['ACF', 'IAID', 'MULTI', 'PAPIL', 'UNHCR', 'UNICEF', 'WFP'];
        $partners = ['ACF', 'BRAC', 'CWW', 'SARPV', 'SCI', 'SHED', 'TDH', 'WC', 'WFP', 'WVI'];
        $camps = ['3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27',
            '1E', '1W', '20EX', '2E', '2W', '4EX', '8E', '8W', 'KRC', 'KTP', 'KTP RC', 'NRC'];
        $periods = DB::table('otp_imports')
            ->groupBy('period')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->pluck('period')->toArray();
//        dd($periods);

        $cache_data = DB::table('otp_imports')
            ->select('year', 'month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()->toArray();
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
//dd($report_year);


        //
//        $months = array();
//        for ($i = 0; $i < 12; $i++) {
//            $months[] = date("M-y", strtotime(date('Y-m-01') . " -$i months"));
//        }
//        $db_month_year = DB::table('otp_imports')->where('period', $request->period)->first();
//        $report_month = $db_month_year->month;
//        $report_year = $db_month_year->year;
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }

        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $line_chart = $this->open_dashboard_linechart($months);
        $doughnut_chart = $this->open_dashboard_doughnutchart($report_year, $report_month);
        $doughnut_chartTsfp = $this->open_dashboard_doughnutchart_tsfp($report_year, $report_month);
        $bar_chart = $this->open_dashboard_barchart($report_year, $report_month);
        $bar_chart_tsfp = $this->open_dashboard_barchart_tsfp($report_year, $report_month);
        $target_reached = $this->target_reached($report_year);
//        dd($target_reached);
        return view('homepage.open_dashboard', compact('program_partners', 'partners', 'camps', 'periods',
            'cache_data', 'month_year', 'doughnut_chart','doughnut_chartTsfp', 'bar_chart','bar_chart_tsfp', 'line_chart',
            'months','filter_message','target_reached','report_year'));
    }

    private function target_reached($report_year){
//        dd($report_year);
        $sam_target_reached=DB::table('target_reacheds')->where('data_year',$report_year)->where('indicator_id',1)->first();
//        dd($sam_target_reached);
        if ($sam_target_reached == null) {
            $tr['sam_target']=0;
            $tr['sam_reached']=0;
            $tr['sam_per']=0;
        }
        else {
            $tr['sam_target'] = $sam_target_reached->target;
            if($sam_target_reached->use_this=='Use system generated reached data'){
                $tr['sam_reached'] = DB::table('otp_imports')
                    ->where('year', $report_year)
                    ->sum('totalNewEnrolment');
            }else {
                $tr['sam_reached'] = $sam_target_reached->reached;
            }
            $tr['sam_per']=round(($tr['sam_reached']/$tr['sam_target'])*100,1);

        }
        $mam_target_reached=DB::table('target_reacheds')->where('data_year',$report_year)->where('indicator_id',2)->first();
        if ($mam_target_reached == null) {
            $tr['mam_target']=0;
            $tr['mam_reached']=0;
            $tr['mam_per']=0;
        }
        else {
            $tr['mam_target'] = $mam_target_reached->target;
            if($mam_target_reached->use_this=='Use system generated reached data'){
                $tr['mam_reached'] = DB::table('tsfp_imports')
                    ->where('year', $report_year)
                    ->sum('newAdmissionTotal');
            }else {
                $tr['mam_reached'] = $mam_target_reached->reached;
            }
            $tr['mam_per']=round(($tr['mam_reached']/$tr['mam_target'])*100,1);

        }
        $bsfp_target_reached=DB::table('target_reacheds')->where('data_year',$report_year)->where('indicator_id',3)->first();
        if ($bsfp_target_reached == null) {
            $tr['bsfp_target']=0;
            $tr['bsfp_reached']=0;
            $tr['bsfp_per']=0;
        }
        else {
            $tr['bsfp_target'] = $bsfp_target_reached->target;
            if($bsfp_target_reached->use_this=='Use system generated reached data'){
                $tr['bsfp_reached'] = DB::table('bsfp_imports')
                    ->where('year', $report_year)
                    ->sum('newEnrolmentTotal');
            }else{
                $tr['bsfp_reached'] =$bsfp_target_reached->reached;
            }
            $tr['bsfp_per']=round(($tr['bsfp_reached']/$tr['bsfp_target'])*100,1);
        }
        $iycf_target_reached=DB::table('target_reacheds')->where('data_year',$report_year)->where('indicator_id',4)->first();
        if ($iycf_target_reached == null) {
            $tr['iycf_target']=0;
            $tr['iycf_reached']=0;
            $tr['iycf_per']=0;
        }
        else {
            $tr['iycf_target'] = $iycf_target_reached->target;
            if($iycf_target_reached->use_this=='Use system generated reached data'){
                $tr['iycf_reached'] = 0;
            }else{
                $tr['iycf_reached'] =$iycf_target_reached->reached;
            }
            $tr['iycf_per']=round(($tr['iycf_reached']/$tr['iycf_target'])*100,1);
        }
        $vitamina_target_reached=DB::table('target_reacheds')->where('data_year',$report_year)->where('indicator_id',5)->first();
        if ($vitamina_target_reached == null) {
            $tr['vitamina_target']=0;
            $tr['vitamina_reached']=0;
            $tr['vitamina_per']=0;
        }
        else {
            $tr['vitamina_target'] = $vitamina_target_reached->target;
            if($vitamina_target_reached->use_this=='Use system generated reached data'){
                $tr['vitamina_reached'] = 0;
            }else {
                $tr['vitamina_reached'] = $vitamina_target_reached->reached;
            }
            $tr['vitamina_per']=round(($tr['vitamina_reached']/$tr['vitamina_target'])*100,1);
        }
        $vitamina_green_target_reached=DB::table('target_reacheds')->where('data_year',$report_year)->where('indicator_id',6)->first();
        if ($vitamina_green_target_reached == null) {
            $tr['vitamina_green_target']=0;
            $tr['vitamina_green_reached']=0;
            $tr['vitamina_green_per']=0;
        }
        else {
            $tr['vitamina_green_target'] = $vitamina_green_target_reached->target;
            if($vitamina_green_target_reached->use_this=='Use system generated reached data'){
                $tr['vitamina_green_reached'] = 0;
            }else {
                $tr['vitamina_green_reached'] = $vitamina_green_target_reached->reached;
            }
            $tr['vitamina_green_per']=round(($tr['vitamina_green_reached']/$tr['vitamina_green_target'])*100,1);
        }
        $bsfpplw_target_reached=DB::table('target_reacheds')->where('data_year',$report_year)->where('indicator_id',7)->first();
        if ($bsfpplw_target_reached == null) {
            $tr['bsfpplw_target']=0;
            $tr['bsfpplw_reached']=0;
            $tr['bsfpplw_per']=0;
        }
        else {
            $tr['bsfpplw_target'] = $bsfpplw_target_reached->target;
            if($bsfpplw_target_reached->use_this=='Use system generated reached data'){
                $tr['bsfpplw_reached'] = DB::table('bsfp_imports')
                    ->where('year', $report_year)
                    ->sum('newAdmissionPlw');
            }else{
                $tr['bsfpplw_reached'] =$bsfpplw_target_reached->reached;
            }
            $tr['bsfpplw_per']=round(($tr['bsfpplw_reached']/$tr['bsfpplw_target'])*100,1);
        }
        $tsfpplw_target_reached=DB::table('target_reacheds')->where('data_year',$report_year)->where('indicator_id',8)->first();
        if ($tsfpplw_target_reached == null) {
            $tr['tsfpplw_target']=0;
            $tr['tsfpplw_reached']=0;
            $tr['tsfpplw_per']=0;
        }
        else {
            $tr['tsfpplw_target'] = $tsfpplw_target_reached->target;
            if($tsfpplw_target_reached->use_this=='Use system generated reached data'){
                $tr['tsfpplw_reached'] = DB::table('tsfp_imports')
                    ->where('year', $report_year)
                    ->sum('newAdmissionPlw');
            }else{
                $tr['tsfpplw_reached'] =$tsfpplw_target_reached->reached;
            }
            $tr['tsfpplw_per']=round(($tr['tsfpplw_reached']/$tr['tsfpplw_target'])*100,1);
        }

//        dd($tr);
        return $tr;

    }
    static function open_dashboard_linechart($months)
    {
//        $total_tsfp=DB::table('tsfp_imports')
//            ->select(DB::raw('sum(newAdmissionTotal) as TotalAdmission'))->get();
//            dd($total_tsfp);
        $line_chart['otp'] = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(totalNewEnrolment) as TotalAdmission'))
            ->whereIn('period', $months)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
            ->orderBy('year', 'desc')->orderBy('month', 'desc')
            ->get()->toArray();
        $line_chart['bsfp'] = DB::table('bsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(newEnrolmentTotal) as TotalAdmission'))
            ->whereIn('period', $months)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
            ->orderBy('year', 'desc')->orderBy('month', 'desc')
            ->get()->toArray();
        $line_chart['tsfp'] = DB::table('tsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(newAdmissionTotal) as TotalAdmission'))
            ->whereIn('period', $months)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
            ->orderBy('year', 'desc')->orderBy('month', 'desc')
            ->get()->toArray();
        $line_chart['tsfp_plw'] = DB::table('tsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(newAdmissionPlw) as TotalAdmission'))
            ->whereIn('period', $months)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
            ->orderBy('year', 'desc')->orderBy('month', 'desc')
            ->get()->toArray();
        $line_chart['sc'] = DB::table('sc_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(totalNewAdmission) as TotalAdmission'))
            ->whereIn('period', $months)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
            ->orderBy('year', 'desc')->orderBy('month', 'desc')
            ->get()->toArray();
//        dd($months);
//        dd($line_chart['sc']);
        $otp_period = [];
        $otp_admission = [];
        $lc['otp'] = [];
        for ($i = 0; $i < count($months); $i++) {
            foreach ($line_chart['otp'] as $otp) {
                $otp_period[] = $otp->MonthYear;
                $otp_admission[] = $otp->TotalAdmission;
            }
            if (in_array($months[$i], $otp_period)) {
                $ii = array_search($months[$i], $otp_period);
                $lc['otp'][] = $otp_admission[$ii];

            } else
                $lc['otp'][] = 0;
        }
//        dd(array_sum($lc['otp']));
        $bsfp_period = [];
        $bsfp_admission = [];
        $lc['bsfp'] = [];

        for ($j = 0; $j < count($months); $j++) {
            foreach ($line_chart['bsfp'] as $bsfp) {
                $bsfp_period[] = $bsfp->MonthYear;
                $bsfp_admission[] = $bsfp->TotalAdmission;
            }
            if (in_array($months[$j], $bsfp_period)) {
                $jj = array_search($months[$j], $bsfp_period);
                $lc['bsfp'][] = $bsfp_admission[$jj];
            } else
                $lc['bsfp'][] = 0;
        }
        $tsfp_period = [];
        $tsfp_admission = [];
        $lc['tsfp'] = [];
        for ($k = 0; $k < count($months); $k++) {
            foreach ($line_chart['tsfp'] as $tsfp) {
                $tsfp_period[] = $tsfp->MonthYear;
                $tsfp_admission[] = $tsfp->TotalAdmission;
            }
            if (in_array($months[$k], $tsfp_period)) {
                $kk = array_search($months[$k], $tsfp_period);
                $lc['tsfp'][] = $tsfp_admission[$kk];
            } else
                $lc['tsfp'][] = 0;
        }
        $tsfp_plw_period = [];
        $tsfp_plw_admission = [];
        $lc['tsfp_plw'] = [];
        for ($m = 0; $m < count($months); $m++) {
            foreach ($line_chart['tsfp_plw'] as $tsfp_plw) {
                $tsfp_plw_period[] = $tsfp_plw->MonthYear;
                $tsfp_plw_admission[] = $tsfp_plw->TotalAdmission;
            }
            if (in_array($months[$m], $tsfp_plw_period)) {
                $mm = array_search($months[$m], $tsfp_plw_period);
                $lc['tsfp_plw'][] = $tsfp_plw_admission[$mm];
            } else
                $lc['tsfp_plw'][] = 0;
        }
        $sc_period = [];
        $sc_admission = [];
        $lc['sc'] = [];
        for ($l = 0; $l < count($months); $l++) {
            foreach ($line_chart['sc'] as $sc) {
                $sc_period[] = $sc->MonthYear;
                $sc_admission[] = $sc->TotalAdmission;
            }
            if (in_array($months[$l], $sc_period)) {
                $ll = array_search($months[$l], $sc_period);
                $lc['sc'][] = $sc_admission[$ll];
            } else
                $lc['sc'][] = 0;
        }
        return $lc;
    }

    private function open_dashboard_linechart_ym($months, $programPartner, $partner, $camp)
    {

//        dd($months);
        $line_chart_query = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(totalNewEnrolment) as TotalAdmission'))
            ->whereIn('period', $months);
        $line_chart_query_bsfp = DB::table('bsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(newEnrolmentTotal) as TotalAdmission'))
            ->whereIn('period', $months);
        $line_chart_query_tsfp = DB::table('tsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(newAdmissionTotal) as TotalAdmission'))
            ->whereIn('period', $months);
        $line_chart_query_tsfp_plw = DB::table('tsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(newAdmissionPlw) as TotalAdmission'))
            ->whereIn('period', $months);
        $line_chart_query_sc = DB::table('sc_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period as MonthYear'), DB::raw('sum(totalNewAdmission) as TotalAdmission'))
            ->whereIn('period', $months);
        if ($programPartner != null && $partner == null && $camp == null) {
            $line_chart['otp'] = $line_chart_query->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['bsfp'] = $line_chart_query_bsfp->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp'] = $line_chart_query_tsfp->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp_plw'] = $line_chart_query_tsfp_plw->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['sc'] = $line_chart_query_sc->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp == null) {
            $line_chart['otp'] = $line_chart_query->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['bsfp'] = $line_chart_query_bsfp->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp'] = $line_chart_query_tsfp->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp_plw'] = $line_chart_query_tsfp_plw->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['sc'] = $line_chart_query_sc->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp == null) {
            $line_chart['otp'] = $line_chart_query->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['bsfp'] = $line_chart_query_bsfp->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp'] = $line_chart_query_tsfp->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp_plw'] = $line_chart_query_tsfp_plw->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['sc'] = $line_chart_query_sc->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp != null) {
            $line_chart['otp'] = $line_chart_query->where('partner', $partner)->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['bsfp'] = $line_chart_query_bsfp->where('partner', $partner)->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp'] = $line_chart_query_tsfp->where('partner', $partner)->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp_plw'] = $line_chart_query_tsfp_plw->where('partner', $partner)->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['sc'] = $line_chart_query_sc->where('partner', $partner)->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
        } elseif ($programPartner != null && $partner == null && $camp != null) {
            $line_chart['otp'] = $line_chart_query->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['bsfp'] = $line_chart_query_bsfp->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp'] = $line_chart_query_tsfp->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp_plw'] = $line_chart_query_tsfp_plw->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['sc'] = $line_chart_query_sc->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp != null) {
            $line_chart['otp'] = $line_chart_query->where('partner', $partner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['bsfp'] = $line_chart_query_bsfp->where('partner', $partner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp'] = $line_chart_query_tsfp->where('partner', $partner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp_plw'] = $line_chart_query_tsfp_plw->where('partner', $partner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['sc'] = $line_chart_query_sc->where('partner', $partner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
        } elseif ($programPartner == null && $partner == null && $camp != null) {
            $line_chart['otp'] = $line_chart_query->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['bsfp'] = $line_chart_query_bsfp->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp'] = $line_chart_query_tsfp->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp_plw'] = $line_chart_query_tsfp_plw->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['sc'] = $line_chart_query_sc->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
        } else {
            $line_chart['otp'] = $line_chart_query
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['bsfp'] = $line_chart_query_bsfp
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp'] = $line_chart_query_tsfp
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['tsfp_plw'] = $line_chart_query_tsfp_plw
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
            $line_chart['sc'] = $line_chart_query_sc
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))
                ->orderBy('year', 'desc')->orderBy('month', 'desc')
                ->get()->toArray();
        }
//dd($months);
//dd($line_chart['bsfp']);
        $otp_period = [];
        $otp_admission = [];
        $lc['otp'] = [];
        for ($i = 0; $i < count($months); $i++) {
            foreach ($line_chart['otp'] as $otp) {
                $otp_period[] = $otp->MonthYear;
                $otp_admission[] = $otp->TotalAdmission;
            }
            if (in_array($months[$i], $otp_period)) {
                $ii = array_search($months[$i], $otp_period);
                $lc['otp'][] = $otp_admission[$ii];
            } else
                $lc['otp'][] = 0;
        }
        $lc['cumulative_otp']=array_sum($lc['otp']);

        $bsfp_period = [];
        $bsfp_admission = [];
        $lc['bsfp'] = [];
        for ($j = 0; $j < count($months); $j++) {
            foreach ($line_chart['bsfp'] as $bsfp) {
                $bsfp_period[] = $bsfp->MonthYear;
                $bsfp_admission[] = $bsfp->TotalAdmission;
            }
            if (in_array($months[$j], $bsfp_period)) {
                $jj = array_search($months[$j], $bsfp_period);
                $lc['bsfp'][] = $bsfp_admission[$jj];
            } else
                $lc['bsfp'][] = 0;
//            dd($lc['bsfp']);
        }
        $lc['cumulative_bsfp']=array_sum($lc['bsfp']);
        $tsfp_period = [];
        $tsfp_admission = [];
        $lc['tsfp'] = [];
        for ($k = 0; $k < count($months); $k++) {
            foreach ($line_chart['tsfp'] as $tsfp) {
                $tsfp_period[] = $tsfp->MonthYear;
                $tsfp_admission[] = $tsfp->TotalAdmission;
            }
            if (in_array($months[$k], $tsfp_period)) {
                $kk = array_search($months[$k], $tsfp_period);
                $lc['tsfp'][] = $tsfp_admission[$kk];
            } else
                $lc['tsfp'][] = 0;
        }
        $lc['cumulative_tsfp']=array_sum($lc['tsfp']);
        $tsfp_plw_period = [];
        $tsfp_plw_admission = [];
        $lc['tsfp_plw'] = [];
        for ($m = 0; $m < count($months); $m++) {
            foreach ($line_chart['tsfp_plw'] as $tsfp_plw) {
                $tsfp_plw_period[] = $tsfp_plw->MonthYear;
                $tsfp_plw_admission[] = $tsfp_plw->TotalAdmission;
            }
            if (in_array($months[$m], $tsfp_plw_period)) {
                $mm = array_search($months[$m], $tsfp_plw_period);
                $lc['tsfp_plw'][] = $tsfp_plw_admission[$mm];
            } else
                $lc['tsfp_plw'][] = 0;
        }
        $sc_period = [];
        $sc_admission = [];
        $lc['sc'] = [];
        for ($l = 0; $l < count($months); $l++) {
            foreach ($line_chart['sc'] as $sc) {
                $sc_period[] = $sc->MonthYear;
                $sc_admission[] = $sc->TotalAdmission;
            }
            if (in_array($months[$l], $sc_period)) {
                $ll = array_search($months[$l], $sc_period);
                $lc['sc'][] = $sc_admission[$ll];
            } else
                $lc['sc'][] = 0;
        }
        $lc['cumulative_sc']=array_sum($lc['sc']);
//        dd($lc);
        return $lc;
    }

    private function open_dashboard_doughnut_ym($report_month, $report_year, $programPartner, $partner, $camp)
    {
        if ($programPartner != null && $partner == null && $camp == null) {
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

            $otp_admit_edemam = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('enrolmentEdema_M');
            $otp_admit_edemaf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('enrolmentEdema_F');
            $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
            $otp_admit_relapsem = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('enrolmentRelapse_M');
            $otp_admit_relapsef = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->sum('enrolmentRelapse_F');
            $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;
        } elseif ($programPartner == null && $partner != null && $camp == null) {
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

            $otp_admit_edemam = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('enrolmentEdema_M');
            $otp_admit_edemaf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('enrolmentEdema_F');
            $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
            $otp_admit_relapsem = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('enrolmentRelapse_M');
            $otp_admit_relapsef = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->sum('enrolmentRelapse_F');
            $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;
        } elseif ($programPartner != null && $partner != null && $camp == null) {
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

            $otp_admit_edemam = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('enrolmentEdema_M');
            $otp_admit_edemaf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('enrolmentEdema_F');
            $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
            $otp_admit_relapsem = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('enrolmentRelapse_M');
            $otp_admit_relapsef = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->sum('enrolmentRelapse_F');
            $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;
        } elseif ($programPartner != null && $partner != null && $camp != null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;

            $otp_admit_edemam = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentEdema_M');
            $otp_admit_edemaf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentEdema_F');
            $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
            $otp_admit_relapsem = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentRelapse_M');
            $otp_admit_relapsef = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentRelapse_F');
            $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;
        } elseif ($programPartner != null && $partner == null && $camp != null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $otp_admit_edemam = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('enrolmentEdema_M');
            $otp_admit_edemaf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('enrolmentEdema_F');
            $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
            $otp_admit_relapsem = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('enrolmentRelapse_M');
            $otp_admit_relapsef = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('programPartner', $programPartner)->where('campSettlement', $camp)->sum('enrolmentRelapse_F');
            $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;
        } elseif ($programPartner == null && $partner != null && $camp != null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $otp_admit_edemam = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentEdema_M');
            $otp_admit_edemaf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentEdema_F');
            $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
            $otp_admit_relapsem = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentRelapse_M');
            $otp_admit_relapsef = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('partner', $partner)->where('campSettlement', $camp)->sum('enrolmentRelapse_F');
            $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;
//            $doughnut_chart['otp_admit_both'] = 0;
        } elseif ($programPartner == null && $partner == null && $camp != null) {
            $doughnut_chart['otp_admit_23'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '6-23 months')->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_24'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '24-59 months')->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_60'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('age', '>5 years')->where('campSettlement', $camp)->sum('totalNewEnrolment');
            $doughnut_chart['otp_admit_male'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSettlement', $camp)->sum('totalNewEnrolment_M');
            $doughnut_chart['otp_admit_female'] = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSettlement', $camp)->sum('totalNewEnrolment_F');
            $doughnut_chart['otp_admit_others'] = 0;
            $otp_admit_mucm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSettlement', $camp)->sum('enrolmentMuc_M');
            $otp_admit_mucf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSettlement', $camp)->sum('enrolmentMuc_F');
            $doughnut_chart['otp_admit_muc'] = $otp_admit_mucm + $otp_admit_mucf;
            $otp_admit_wfhm = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSettlement', $camp)->sum('enrolmentWfh_M');
            $otp_admit_wfhf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)
                ->where('campSettlement', $camp)->sum('enrolmentWfh_F');
            $doughnut_chart['otp_admit_wfh'] = $otp_admit_wfhm + $otp_admit_wfhf;
            $otp_admit_edemam = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->where('campSettlement', $camp)->sum('enrolmentEdema_M');
            $otp_admit_edemaf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->where('campSettlement', $camp)->sum('enrolmentEdema_F');
            $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
            $otp_admit_relapsem = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->where('campSettlement', $camp)->sum('enrolmentRelapse_M');
            $otp_admit_relapsef = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->where('campSettlement', $camp)->sum('enrolmentRelapse_F');
            $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;

            //            $doughnut_chart['otp_admit_both'] = 0;
        } else {
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
//            $doughnut_chart['otp_admit_both'] = 0;
            $otp_admit_edemam = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('enrolmentEdema_M');
            $otp_admit_edemaf = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('enrolmentEdema_F');
            $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
            $otp_admit_relapsem = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('enrolmentRelapse_M');
            $otp_admit_relapsef = DB::table('otp_imports')->where('month', $report_month)->where('year', $report_year)->sum('enrolmentRelapse_F');
            $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;
        }
        return $doughnut_chart;
    }

    private function open_dashboard_barchart_ym($report_month, $report_year, $programPartner, $partner, $camp)
    {
        $bar_chart_query = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSettlement'),
                DB::raw('sum(totalDischarged) as totalDischarged'), DB::raw('sum(totalCured) as totalCured'),
                DB::raw('sum(totalDefault) as totalDefault'), DB::raw('sum(totalDeath) as totalDeath'),
                DB::raw('sum(totalNonRecovered) as totalNonRecovered'))
            ->where('month', $report_month)->where('year', $report_year);
        if ($programPartner != null && $partner == null && $camp == null) {
            $bar_chart2 = $bar_chart_query->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp == null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp == null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp != null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner == null && $camp != null) {
            $bar_chart2 = $bar_chart_query->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp != null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner == null && $partner == null && $camp != null) {
            $bar_chart2 = $bar_chart_query->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } else {
            $bar_chart2 = $bar_chart_query
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        }
//        dd(count($bar_chart2));
        $campSettlement = [];
        $curedRate = [];
        $deathRate = [];
        $defaultRate = [];
        $nonRecoveredRate = [];
        $total_cured =0;
        $total_discharged =0;
        $total_death =0;
        $total_default =0;
        $total_nonRecovered =0;
        foreach ($bar_chart2 as $bc) {
            for ($i = 0; $i < count($bar_chart2); $i++) ;
            $campSettlement[] = $bc->campSettlement;
            $curedRate[] = ($bc->totalDischarged == 0) ? 0 : round((($bc->totalCured / $bc->totalDischarged) * 100),1);
            $deathRate[] = ($bc->totalDischarged == 0) ? 0 : round((($bc->totalDeath / $bc->totalDischarged) * 100),1);
            $defaultRate[] = ($bc->totalDischarged == 0) ? 0 : round((($bc->totalDefault / $bc->totalDischarged) * 100),1);
            $nonRecoveredRate[] = ($bc->totalDischarged == 0) ? 0 : round((($bc->totalNonRecovered / $bc->totalDischarged) * 100),1);
            $total_cured+=$bc->totalCured;
            $total_discharged+=$bc->totalDischarged;
            $total_death+=$bc->totalDeath;
            $total_default+=$bc->totalDefault;
            $total_nonRecovered+=$bc->totalNonRecovered;
        }
//        dd($total_cured);
        array_multisort($curedRate, $campSettlement, $deathRate, $defaultRate, $nonRecoveredRate);
        $bar_chart['campSettlement'] = $campSettlement;
        $bar_chart['curedRate'] = $curedRate;
        $bar_chart['deathRate'] = $deathRate;
        $bar_chart['defaultRate'] = $defaultRate;
        $bar_chart['nonRecoveredRate'] = $nonRecoveredRate;
        $bar_chart['cumulative_curedRate'] =($total_discharged==0)?0 : round(($total_cured/$total_discharged)*100,1);
        $bar_chart['cumulative_deathRate'] = ($total_discharged==0)?0 : round(($total_death/$total_discharged)*100,1);
        $bar_chart['cumulative_defaultRate'] = ($total_discharged==0)?0 : round(($total_default/$total_discharged)*100,1);
        $bar_chart['cumulative_nonRecoveredRate'] = ($total_discharged==0)?0 : round(($total_nonRecovered/$total_discharged)*100,1);
        return $bar_chart;
    }

    static function open_dashboard_doughnutchart($report_year, $report_month)
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
        $otp_admit_edemam = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentEdema_M');
        $otp_admit_edemaf = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentEdema_F');
        $doughnut_chart['otp_admit_edema'] = $otp_admit_edemam + $otp_admit_edemaf;
        $otp_admit_relapsem = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentRelapse_M');
        $otp_admit_relapsef = DB::table('otp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('enrolmentRelapse_F');
        $doughnut_chart['otp_admit_relapse'] = $otp_admit_relapsem + $otp_admit_relapsef;
//        $doughnut_chart['otp_admit_both'] = 0;
//        dd($doughnut_chart);
        return $doughnut_chart;
    }

    private function open_dashboard_doughnut_tsfp_ym($report_month, $report_year, $programPartner, $partner, $camp)
    {
        if ($programPartner != null && $partner == null && $camp == null) {

            $tsfp_admit_6to23M = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
            $tsfp_admit_6to23F = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
            $tsfp_admit_24to59M = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
            $tsfp_admit_24to59F = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
            $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
            $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

            $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
            $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

            $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
            $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
            $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
            $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)
                ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');

        } elseif ($programPartner == null && $partner != null && $camp == null) {
            $tsfp_admit_6to23M = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
            $tsfp_admit_6to23F = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
            $tsfp_admit_24to59M = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
            $tsfp_admit_24to59F = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
            $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
            $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

            $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
            $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

            $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
            $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
            $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
            $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');

        } elseif ($programPartner != null && $partner != null && $camp == null) {
            $tsfp_admit_6to23M = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
            $tsfp_admit_6to23F = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
            $tsfp_admit_24to59M = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
            $tsfp_admit_24to59F = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
            $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
            $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

            $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
            $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

            $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
            $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
            $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
            $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)
                ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');

        } elseif ($programPartner != null && $partner != null && $camp != null) {
            $tsfp_admit_6to23M = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
            $tsfp_admit_6to23F = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
            $tsfp_admit_24to59M = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
            $tsfp_admit_24to59F = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
            $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
            $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

            $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
            $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

            $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
            $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
            $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
            $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');

        } elseif ($programPartner != null && $partner == null && $camp != null) {
            $tsfp_admit_6to23M = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
            $tsfp_admit_6to23F = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
            $tsfp_admit_24to59M = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
            $tsfp_admit_24to59F = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
            $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
            $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

            $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
            $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

            $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
            $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
            $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
            $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');

        } elseif ($programPartner == null && $partner != null && $camp != null) {
            $tsfp_admit_6to23M = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
            $tsfp_admit_6to23F = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
            $tsfp_admit_24to59M = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
            $tsfp_admit_24to59F = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
            $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
            $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

            $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
            $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

            $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
            $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
            $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
            $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')->where('partner', $partner)->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');

        } elseif ($programPartner == null && $partner == null && $camp != null) {
            $tsfp_admit_6to23M = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
            $tsfp_admit_6to23F = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
            $tsfp_admit_24to59M = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
            $tsfp_admit_24to59F = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
            $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
            $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

            $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
            $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

            $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
            $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
            $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
            $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')->where('campSettlement', $camp)
                ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');

        } else {
            $tsfp_admit_6to23M = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
            $tsfp_admit_6to23F = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
            $tsfp_admit_24to59M = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
            $tsfp_admit_24to59F = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
            $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
            $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

            $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
            $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

            $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
            $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
            $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
            $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')
                ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');
        }
        return $doughnut_chartTsfp;
    }

    private function open_dashboard_doughnutchart_tsfp($report_year, $report_month)
    {
        $tsfp_admit_6to23M = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23M');
        $tsfp_admit_6to23F = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission23F');
        $tsfp_admit_24to59M = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59M');
        $tsfp_admit_24to59F = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmission59F');
        $doughnut_chartTsfp['tsfp_admit_23'] =$tsfp_admit_6to23M+$tsfp_admit_6to23F;
        $doughnut_chartTsfp['tsfp_admit_59'] =$tsfp_admit_24to59M+$tsfp_admit_24to59F;

        $doughnut_chartTsfp['tsfp_admit_male'] = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionM');
        $doughnut_chartTsfp['tsfp_admit_female'] = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('tsfpChildNewAdmissionF');

        $doughnut_chartTsfp['tsfp_admit_muac'] = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentMuacTotal');
        $doughnut_chartTsfp['tsfp_admit_wfh'] = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('newEnrolmentWfhTotal');
        $doughnut_chartTsfp['tsfp_readmission'] = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('readmissionAfterRecoveryTotal');
        $doughnut_chartTsfp['tsfp_returnFromSam'] = DB::table('tsfp_imports')
            ->where('month', $report_month)->where('year', $report_year)->sum('returnFromSamTotal');

//        dd($doughnut_chartTsfp);
        return $doughnut_chartTsfp;
    }

    static function open_dashboard_barchart($report_year, $report_month)
    {
        $bar_chart2 = DB::table('otp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSettlement'),
                DB::raw('sum(totalDischarged) as totalDischarged'), DB::raw('sum(totalCured) as totalCured'),
                DB::raw('sum(totalDefault) as totalDefault'), DB::raw('sum(totalDeath) as totalDeath'),
                DB::raw('sum(totalNonRecovered) as totalNonRecovered'))
            ->where('month', $report_month)->where('year', $report_year)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
            ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        $campSettlement = [];
        $curedRate = [];
        $deathRate = [];
        $defaultRate = [];
        $nonRecoveredRate = [];
        $total_cured =0;
        $total_discharged =0;
        $total_death =0;
        $total_default =0;
        $total_nonRecovered =0;
        foreach ($bar_chart2 as $bc) {
            for ($i = 0; $i < count($bar_chart2); $i++) ;
            $campSettlement[] = $bc->campSettlement;
            $curedRate[] = ($bc->totalDischarged == 0) ? 0 : round((($bc->totalCured / $bc->totalDischarged) * 100),1);
            $deathRate[] = ($bc->totalDischarged == 0) ? 0 : round((($bc->totalDeath / $bc->totalDischarged) * 100),1);
            $defaultRate[] = ($bc->totalDischarged == 0) ? 0 : round((($bc->totalDefault / $bc->totalDischarged) * 100),1);
            $nonRecoveredRate[] = ($bc->totalDischarged == 0) ? 0 : round((($bc->totalNonRecovered / $bc->totalDischarged) * 100),1);
            $total_cured+=$bc->totalCured;
            $total_discharged+=$bc->totalDischarged;
            $total_death+=$bc->totalDeath;
            $total_default+=$bc->totalDefault;
            $total_nonRecovered+=$bc->totalNonRecovered;

        }
        array_multisort($curedRate, $campSettlement, $deathRate, $defaultRate, $nonRecoveredRate);
        $bar_chart['campSettlement'] = $campSettlement;
        $bar_chart['curedRate'] = $curedRate;
        $bar_chart['deathRate'] = $deathRate;
        $bar_chart['defaultRate'] = $defaultRate;
        $bar_chart['nonRecoveredRate'] = $nonRecoveredRate;
        $bar_chart['cumulative_curedRate'] =($total_discharged==0)?0 : round(($total_cured/$total_discharged)*100,1);
        $bar_chart['cumulative_deathRate'] = ($total_discharged==0)?0 : round(($total_death/$total_discharged)*100,1);
        $bar_chart['cumulative_defaultRate'] = ($total_discharged==0)?0 : round(($total_default/$total_discharged)*100,1);
        $bar_chart['cumulative_nonRecoveredRate'] = ($total_discharged==0)?0 : round(($total_nonRecovered/$total_discharged)*100,1);
//dd($bar_chart);
        return $bar_chart;

    }
    private function open_dashboard_barchart_tsfp($report_year, $report_month)
    {
        $bar_chart2 = DB::table('tsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSettlement'),
                DB::raw('sum(dischargeCuredToBsfpTotal) as totalCured'),DB::raw('sum(defaultTotal) as totalDefault'),
                DB::raw('sum(deathTotal) as totalDeath'),DB::raw('sum(nonResponseTotal) as totalNonRecovered'))
            ->where('month', $report_month)->where('year', $report_year)
            ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
            ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        $campSettlement = [];
        $curedRate = [];
        $deathRate = [];
        $defaultRate = [];
        $nonRecoveredRate = [];
        $total_cured =0;
        $total_death =0;
        $total_default =0;
        $total_nonRecovered =0;
        foreach ($bar_chart2 as $bc) {
            for ($i = 0; $i < count($bar_chart2); $i++) ;
            $campSettlement[] = $bc->campSettlement;
            $curedRate[] = ($bc->totalCured == 0) ? 0 : ($bc->totalCured / ($bc->totalCured+$bc->totalDefault+$bc->totalDeath+$bc->totalNonRecovered))*100;
            $deathRate[] = ($bc->totalDeath == 0) ? 0 : ($bc->totalDeath / ($bc->totalCured+$bc->totalDefault+$bc->totalDeath+$bc->totalNonRecovered))*100;
            $defaultRate[] = ($bc->totalDefault == 0) ? 0 : ($bc->totalDefault / ($bc->totalCured+$bc->totalDefault+$bc->totalDeath+$bc->totalNonRecovered))*100;
            $nonRecoveredRate[] = ($bc->totalNonRecovered == 0) ? 0 : ($bc->totalNonRecovered / ($bc->totalCured+$bc->totalDefault+$bc->totalDeath+$bc->totalNonRecovered))*100;
            $total_cured+=$bc->totalCured;
            $total_death+=$bc->totalDeath;
            $total_default+=$bc->totalDefault;
            $total_nonRecovered+=$bc->totalNonRecovered;
        }
//        dd($total_nonRecovered);
        array_multisort($curedRate, $campSettlement, $deathRate, $defaultRate, $nonRecoveredRate);
        $bar_chart_tsfp['campSettlement'] = $campSettlement;
        $bar_chart_tsfp['curedRate'] = $curedRate;
        $bar_chart_tsfp['deathRate'] = $deathRate;
        $bar_chart_tsfp['defaultRate'] = $defaultRate;
        $bar_chart_tsfp['nonRecoveredRate'] = $nonRecoveredRate;
        $bar_chart_tsfp['cumulative_curedRate'] =($total_cured==0)?0 : ($total_cured/($total_cured+$total_death+$total_default+$total_nonRecovered))*100;
        $bar_chart_tsfp['cumulative_deathRate'] = ($total_death==0)?0 : ($total_death/($total_cured+$total_death+$total_default+$total_nonRecovered))*100;
        $bar_chart_tsfp['cumulative_defaultRate'] = ($total_default==0)?0 : ($total_default/($total_cured+$total_death+$total_default+$total_nonRecovered))*100;
        $bar_chart_tsfp['cumulative_nonRecoveredRate'] = ($total_nonRecovered==0)?0 : ($total_nonRecovered/($total_cured+$total_death+$total_default+$total_nonRecovered))*100;
        return $bar_chart_tsfp;

    }

    private function open_dashboard_barchart_tsfp_ym($report_month, $report_year, $programPartner, $partner, $camp)
    {
        $bar_chart_query = DB::table('tsfp_imports')
            ->select(DB::raw('year'), DB::raw('month'), DB::raw('period'), DB::raw('campSettlement'),
                DB::raw('sum(dischargeCuredToBsfpTotal) as totalCured'),DB::raw('sum(defaultTotal) as totalDefault'),
                DB::raw('sum(deathTotal) as totalDeath'),DB::raw('sum(nonResponseTotal) as totalNonRecovered'))
            ->where('month', $report_month)->where('year', $report_year);
        if ($programPartner != null && $partner == null && $camp == null) {
            $bar_chart2 = $bar_chart_query->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp == null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp == null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('programPartner', $programPartner)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner != null && $camp != null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner != null && $partner == null && $camp != null) {
            $bar_chart2 = $bar_chart_query->where('programPartner', $programPartner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner == null && $partner != null && $camp != null) {
            $bar_chart2 = $bar_chart_query->where('partner', $partner)->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } elseif ($programPartner == null && $partner == null && $camp != null) {
            $bar_chart2 = $bar_chart_query->where('campSettlement', $camp)
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        } else {
            $bar_chart2 = $bar_chart_query
                ->groupBy(DB::raw('year'))->groupBy(DB::raw('month'))->groupBy(DB::raw('campSettlement'))
                ->orderBy('year', 'asc')->orderBy('month', 'asc')->get()->toArray();
        }
//        dd(count($bar_chart2));
        $campSettlement = [];
        $curedRate = [];
        $deathRate = [];
        $defaultRate = [];
        $nonRecoveredRate = [];
        $total_cured =0;
//        $total_discharged =0;
        $total_death =0;
        $total_default =0;
        $total_nonRecovered =0;
        foreach ($bar_chart2 as $bc) {
            for ($i = 0; $i < count($bar_chart2); $i++) ;
            $campSettlement[] = $bc->campSettlement;
            $curedRate[] = ($bc->totalCured == 0) ? 0 : ($bc->totalCured / ($bc->totalCured+$bc->totalDefault+$bc->totalDeath+$bc->totalNonRecovered))*100;
            $deathRate[] = ($bc->totalDeath == 0) ? 0 : ($bc->totalDeath / ($bc->totalCured+$bc->totalDefault+$bc->totalDeath+$bc->totalNonRecovered))*100;
            $defaultRate[] = ($bc->totalDefault == 0) ? 0 : ($bc->totalDefault / ($bc->totalCured+$bc->totalDefault+$bc->totalDeath+$bc->totalNonRecovered))*100;
            $nonRecoveredRate[] = ($bc->totalNonRecovered == 0) ? 0 : ($bc->totalNonRecovered / ($bc->totalCured+$bc->totalDefault+$bc->totalDeath+$bc->totalNonRecovered))*100;
            $total_cured+=$bc->totalCured;
            $total_death+=$bc->totalDeath;
            $total_default+=$bc->totalDefault;
            $total_nonRecovered+=$bc->totalNonRecovered;
        }
//        dd($total_nonRecovered);
        array_multisort($curedRate, $campSettlement, $deathRate, $defaultRate, $nonRecoveredRate);
        $bar_chart_tsfp['campSettlement'] = $campSettlement;
        $bar_chart_tsfp['curedRate'] = $curedRate;
        $bar_chart_tsfp['deathRate'] = $deathRate;
        $bar_chart_tsfp['defaultRate'] = $defaultRate;
        $bar_chart_tsfp['nonRecoveredRate'] = $nonRecoveredRate;
        $bar_chart_tsfp['cumulative_curedRate'] =($total_cured==0)?0 : ($total_cured/($total_cured+$total_death+$total_default+$total_nonRecovered))*100;
        $bar_chart_tsfp['cumulative_deathRate'] = ($total_death==0)?0 : ($total_death/($total_cured+$total_death+$total_default+$total_nonRecovered))*100;
        $bar_chart_tsfp['cumulative_defaultRate'] = ($total_default==0)?0 : ($total_default/($total_cured+$total_death+$total_default+$total_nonRecovered))*100;
        $bar_chart_tsfp['cumulative_nonRecoveredRate'] = ($total_nonRecovered==0)?0 : ($total_nonRecovered/($total_cured+$total_death+$total_default+$total_nonRecovered))*100;
        return $bar_chart_tsfp;
    }

    public function fourW()
    {
        $filter_message='';
        $program_partners = ['ACF', 'IAID', 'MULTI', 'PAPIL', 'UNHCR', 'UNICEF', 'WFP'];
        $partners = ['ACF', 'BRAC', 'CWW', 'SARPV', 'SCI', 'SHED', 'TDH', 'WC', 'WFP', 'WVI'];
        $camps = ['3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27',
            '1E', '1W', '20EX', '2E', '2W', '4EX', '8E', '8W', 'KRC', 'KTP', 'KTP RC', 'NRC'];
        $periods = DB::table('otp_imports')
            ->groupBy('period')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->pluck('period')->toArray();
//        dd($periods);

        $cache_data = DB::table('otp_imports')
            ->select('year', 'month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()->toArray();
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
//
//        $months = array();
//        for ($i = 0; $i < 12; $i++) {
//            $months[] = date("M-y", strtotime(date('Y-m-01') . " -$i months"));
//        }
//        $db_month_year = DB::table('otp_imports')->where('period', $request->period)->first();
//        $report_month = $db_month_year->month;
//        $report_year = $db_month_year->year;
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }

        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $line_chart = $this->open_dashboard_linechart($months);
        $doughnut_chart = $this->open_dashboard_doughnutchart($report_year, $report_month);
        $doughnut_chartTsfp = $this->open_dashboard_doughnutchart_tsfp($report_year, $report_month);
        $bar_chart = $this->open_dashboard_barchart($report_year, $report_month);
        $bar_chart_tsfp = $this->open_dashboard_barchart_tsfp($report_year, $report_month);
        return view('homepage.fourWdashboard', compact('program_partners', 'partners', 'camps', 'periods', 'cache_data', 'month_year', 'doughnut_chart', 'bar_chart','bar_chart_tsfp', 'line_chart', 'months','filter_message','doughnut_chartTsfp'));
    }

    public function fourW_ym(Request $request)
    {
        if (Input::get('program_partner') != null)
            $program_partner = Input::get('program_partner');
        else $program_partner = '';
        if (Input::get('partner') != null)
            $partner = Input::get('partner');
        else $partner = '';
        if (Input::get('camp')!=null)
            $camp = Input::get('camp');
        else $camp='';
        if (Input::get('period')!=null)
            $period = Input::get('period');
        else $period = '';
        $filter_message = "Result for " . (($program_partner != null) ? 'Program Partner is ' . $program_partner : '')
            . (($partner != null) ? ' Partner is ' . $partner : '')
            . (($camp != null) ? ' Camp is ' . $camp : '')
            . (($period != null) ? ' Period is ' . $period : '');
//        dd($filter_message);
//        $db_month_year = DB::table('otp_imports')->where('period', $request->period)->first();
        $program_partners = ['ACF', 'IAID', 'MULTI', 'PAPIL', 'UNHCR', 'UNICEF', 'WFP'];
//            DB::table('otp_imports')
//            ->groupBy('programPartner')
//            ->pluck('programPartner')->toArray();
        $partners = ['ACF', 'BRAC', 'CWW', 'SARPV', 'SCI', 'SHED', 'TDH', 'WC', 'WFP', 'WVI'];
//            DB::table('otp_imports')
//            ->groupBy('partner')
//            ->pluck('partner')->toArray();
        $camps = ['3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27',
            '1E', '1W', '20EX', '2E', '2W', '4EX', '8E', '8W', 'KRC', 'KTP', 'KTP RC', 'NRC'];
//            DB::table('otp_imports')
//            ->groupBy('campSettlement')
//            ->pluck('campSettlement')->toArray();
        $periods = DB::table('otp_imports')
            ->groupBy('period')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->pluck('period')->toArray();
//dd($request->period);
        $pieces = explode("-", $request->period);

        $report_month = date('m', strtotime($pieces[0]));
        $report_year = '20' . $pieces[1];
        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }
        $programPartner = $request->program_partner;
        $partner = $request->partner;
        $camp = $request->camp;

        $line_chart = $this->open_dashboard_linechart_ym($months, $programPartner, $partner, $camp);
//        dd($line_chart);
        $bar_chart = $this->open_dashboard_barchart_ym($report_month, $report_year, $programPartner, $partner, $camp);
        $bar_chart_tsfp = $this->open_dashboard_barchart_tsfp_ym($report_month, $report_year, $programPartner, $partner, $camp);
        $doughnut_chart = $this->open_dashboard_doughnut_ym($report_month, $report_year, $programPartner, $partner, $camp);
        $doughnut_chartTsfp = $this->open_dashboard_doughnut_tsfp_ym($report_month, $report_year, $programPartner, $partner, $camp);

        return view('homepage.fourWdashboard', compact('program_partners', 'partners', 'camps', 'periods', 'cache_data', 'month_year', 'doughnut_chart', 'bar_chart','bar_chart_tsfp', 'line_chart', 'months','filter_message','doughnut_chartTsfp'));
    }


}
