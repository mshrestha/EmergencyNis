<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MonthlyMailController extends Controller
{
    public function preview()
    {
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
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }
//dd($months);
//        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $line_chart = \App\Http\Controllers\OtpImportController::open_dashboard_linechart($months);
        $doughnut_chart = \App\Http\Controllers\OtpImportController::open_dashboard_doughnutchart($report_year, $report_month);
//        $doughnut_chartTsfp = $this->open_dashboard_doughnutchart_tsfp($report_year, $report_month);
        $bar_chart = \App\Http\Controllers\OtpImportController::open_dashboard_barchart($report_year, $report_month);
//        $bar_chart_tsfp = $this->open_dashboard_barchart_tsfp($report_year, $report_month);

//dd($line_chart);

        return view('monthly_mail.open_dashboard',compact('months','line_chart','bar_chart','doughnut_chart'));
    }

    // function to generate PDF
    public function generatePDF()
    {
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
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }
        $line_chart = \App\Http\Controllers\OtpImportController::open_dashboard_linechart($months);
        $pdf = \PDF::loadView('monthly_mail.test',compact('months','line_chart'));
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->download('open_dashboard.pdf');

    }

    public function generatePDF1()
    {
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
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }
//dd($months);
//        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $line_chart = \App\Http\Controllers\OtpImportController::open_dashboard_linechart($months);
        $doughnut_chart = \App\Http\Controllers\OtpImportController::open_dashboard_doughnutchart($report_year, $report_month);
//        $doughnut_chartTsfp = $this->open_dashboard_doughnutchart_tsfp($report_year, $report_month);
        $bar_chart = \App\Http\Controllers\OtpImportController::open_dashboard_barchart($report_year, $report_month);
//        $bar_chart_tsfp = $this->open_dashboard_barchart_tsfp($report_year, $report_month);

//dd($line_chart);

        $pdf = \PDF::loadView('monthly_mail.open_dashboard',compact('months','line_chart','bar_chart','doughnut_chart'));
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->download('open_dashboard.pdf');
    }

    public function sendmail(Request $request)
    {
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
        $months = array();
        for ($i = 0; $i < 12; $i++) {
            $months[] = date("M-y", strtotime(date($report_year . '-' . $report_month . '-01') . " -$i months"));
        }
//dd($months);
//        $month_year = date('F', mktime(0, 0, 0, $report_month, 10)) . '-' . $report_year;
        $line_chart = \App\Http\Controllers\OtpImportController::open_dashboard_linechart($months);
        $doughnut_chart = \App\Http\Controllers\OtpImportController::open_dashboard_doughnutchart($report_year, $report_month);
//        $doughnut_chartTsfp = $this->open_dashboard_doughnutchart_tsfp($report_year, $report_month);
        $bar_chart = \App\Http\Controllers\OtpImportController::open_dashboard_barchart($report_year, $report_month);
//        $bar_chart_tsfp = $this->open_dashboard_barchart_tsfp($report_year, $report_month);

//dd($line_chart);


        $data["email"] = ['shrestha@gmail.com','musiddique@unicef.org','rihasan.engr@gmail.com'];
        $data["client_name"] = ['Manish','Siddique','Hasan'];
        $data["subject"] = 'PDF mail test from Local Server';
//        $data["email"]=$request->get("email");
//        $data["client_name"]=$request->get("client_name");
//        $data["subject"]=$request->get("subject");
        $pdf = \PDF::loadView('monthly_mail.open_dashboard',compact('months','line_chart','bar_chart','doughnut_chart'));
        try {
            \Mail::send('test', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "fourwd.pdf");
            });
        } catch (\JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (\Mail::failures()) {
            $this->statusdesc = "Error sending mail";
            $this->statuscode = "0";
        } else {
            $this->statusdesc = "Message sent Succesfully";
            $this->statuscode = "1";
        }
        return response()->json(compact('this'));
    }

}
