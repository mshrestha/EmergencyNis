@extends('layouts.app')

@section('content')

<h2></h2>

<div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                
                <div class="ibox-content">                    
                    <div class="text-center">
                        <img src="img/logo-1.gif" class="pull-left" height="70px" />
                        <img src="img/logo-2.gif" height="80px"/>
                        <img src="img/logo-nutrition.png" class="pull-right" height="60px" />
                    </div>
                    <div class="clients-list">
                        <table class="table table-marginless table-striped table-bordered table-hover">
                            <thead>
                                <th class="text-center">OUT Patient Therapeutic Program (OTP) Monthly Report</th>
                            </thead>
                        </table>
                        <table class="table table-marginless table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>Facility ID: <strong>{{ substr($facility->facility_id, strpos($facility->facility_id, "/") + 1) }}</strong> </td>
                                    <td>Following Expanded Criteria: </td>
                                    <td>Name of Camp: <strong>{{ $facility->camp->name }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Facility Name: <strong>{{ $facility->facility_id }}</strong></td>
                                    <td>Program Partner: <strong>{{ $facility->program_partner }}</strong></td>
                                    {{--<td>Month/Year: <strong>{{ date("F Y",strtotime("-1 month")) }}</strong></td>--}}
                                    <td>Month/Year: <strong>{{ date('F', mktime(0, 0, 0, $report['report_month'], 10)).'-'.$report['report_year'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Report prepared by: <strong>ENIS System</strong> </td>
                                    <td>Organization: <strong>{{ $facility->implementing_partner }}</strong></td>
                                    <td>Reporting Duration: <strong>1 Month</strong></td>
                                </tr>
                            </tbody>
                        </table>
                         <table class="table table-striped table-bordered table-hover dataTables-example x-small small" >
                    <thead>
                    <tr>
                        <th rowspan="3">Age Group</th>
                        <th rowspan="2" colspan="3">Total In Care Begining of month [A]</th>
                        <th rowspan="1" colspan="8">New Enrollment [B]</th>
                        <th rowspan="2" colspan="3">Total New Enrollment</th>
                        <th rowspan="1" colspan="8">Transfer In [C]</th>
                        <th rowspan="2" colspan="3">Total Transfer In [C1+C2+C3+C4]</th>
                        <th rowspan="2" colspan="3">Total Enrollment [D=B+C]</th>
                    </tr>
                    <tr>
                        <th colspan="2">MUAC &lt; 11.5cm(B1)</th>
                        <th colspan="2">WFH &lt; -3SD (B2)</th>
                        <th colspan="2">Edema (B3)</th>
                        <th colspan="2">Relapse (B4)</th>
                        
                        <th colspan="2">Return after Default (C1)</th>
                        <th colspan="2">Transfer in from TSFP (C2)</th>
                        <th colspan="2">Transfer in from SC (C3)</th>
                        <th colspan="2">Transfer from other OTP (C4)</th>
                    </tr>
                    <tr>
                        <!-- Total in Care begining of month A -->
                        <th>M</th>
                        <th>F</th>
                        <th>T</th>
                        
                        <!-- B1 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- B2 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- B3 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- B4 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- Total new enrollment -->
                        <th>M</th>
                        <th>F</th>
                        <th>T</th>
                        
                        <!-- C1 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- C2 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- C3 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- C4 -->
                        <th>M</th>
                        <th>F</th>
                        
                        <!-- Total Transfer In -->
                        <th>M</th>
                        <th>F</th>
                        <th>T</th>
                        
                        <!-- This is for D Total Enrollment -->
                        <th>M</th>
                        <th>F</th>
                        <th>T</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="gradeX">
                        <td>6-23 mnths</td>

                        <td>{{$report['begining_balance_23_male']}}</td>
                        <td>{{$report['begining_balance_23_female']}}</td>
                        <td>{{$report['begining_balance_23_male']+$report['begining_balance_23_female']}}</td>

                        <td>{{$report['muac_23_male']}}</td>
                        <td>{{$report['muac_23_female']}}</td>
                        <td>{{$report['zscore_23_male']}}</td>
                        <td>{{$report['zscore_23_female']}}</td>
                        <td>{{$report['oedema_23_male']}}</td>
                        <td>{{$report['oedema_23_female']}}</td>
                        <td>{{$report['relapse_23_male']}}</td>
                        <td>{{$report['relapse_23_female']}}</td>

                        <td>{{$report['muac_23_male']+$report['zscore_23_male']+$report['oedema_23_male']+$report['relapse_23_male']}}</td>
                        <td>{{$report['muac_23_female']+$report['zscore_23_female']+$report['oedema_23_female']+$report['relapse_23_female']}}</td>
                        <td>{{$report['muac_23_male']+$report['zscore_23_male']+$report['oedema_23_male']+$report['relapse_23_male']+$report['muac_23_female']+$report['zscore_23_female']+$report['oedema_23_female']+$report['relapse_23_female']}}</td>

                        <td>{{$report['return_default_23_male']}}</td>
                        <td>{{$report['return_default_23_female']}}</td>
                        <td>{{$report['transferin_tsfp_23_male']}}</td>
                        <td>{{$report['transferin_tsfp_23_female']}}</td>
                        <td>{{$report['transferin_sc_23_male']}}</td>
                        <td>{{$report['transferin_sc_23_female']}}</td>
                        <td>{{$report['transferin_otp_23_male']}}</td>
                        <td>{{$report['transferin_otp_23_female']}}</td>

                        <td>{{$report['return_default_23_male']+$report['transferin_tsfp_23_male']+$report['transferin_sc_23_male']+$report['transferin_otp_23_male']}}</td>
                        <td>{{$report['return_default_23_female']+$report['transferin_tsfp_23_female']+$report['transferin_sc_23_female']+$report['transferin_otp_23_female']}}</td>
                        <td>{{$report['return_default_23_male']+$report['transferin_tsfp_23_male']+$report['transferin_sc_23_male']+$report['transferin_otp_23_male']+$report['return_default_23_female']+$report['transferin_tsfp_23_female']+$report['transferin_sc_23_female']+$report['transferin_otp_23_female']}}</td>

                        <td>{{$report['muac_23_male']+$report['zscore_23_male']+$report['oedema_23_male']+$report['relapse_23_male']+$report['return_default_23_male']+$report['transferin_tsfp_23_male']+$report['transferin_sc_23_male']+$report['transferin_otp_23_male']}}</td>
                        <td>{{$report['muac_23_female']+$report['zscore_23_female']+$report['oedema_23_female']+$report['relapse_23_female']+$report['return_default_23_female']+$report['transferin_tsfp_23_female']+$report['transferin_sc_23_female']+$report['transferin_otp_23_female']}}</td>
                        <td>{{$report['muac_23_male']+$report['zscore_23_male']+$report['oedema_23_male']+$report['relapse_23_male']+$report['muac_23_female']+$report['zscore_23_female']+$report['oedema_23_female']+$report['relapse_23_female']+$report['return_default_23_male']+$report['transferin_tsfp_23_male']+$report['transferin_sc_23_male']+$report['transferin_otp_23_male']+$report['return_default_23_female']+$report['transferin_tsfp_23_female']+$report['transferin_sc_23_female']+$report['transferin_otp_23_female']}}</td>

                    </tr>
                    <tr class="gradeX">
                        <td>24-59 mnths</td>
                        <td>{{$report['begining_balance_24to59_male']}}</td>
                        <td>{{$report['begining_balance_24to59_female']}}</td>
                        <td>{{$report['begining_balance_24to59_male']+$report['begining_balance_24to59_female']}}</td>

                        <td>{{$report['muac_24to59_male']}}</td>
                        <td>{{$report['muac_24to59_female']}}</td>
                        <td>{{$report['zscore_24to59_male']}}</td>
                        <td>{{$report['zscore_24to59_female']}}</td>
                        <td>{{$report['oedema_24to59_male']}}</td>
                        <td>{{$report['oedema_24to59_female']}}</td>
                        <td>{{$report['relapse_24to59_male']}}</td>
                        <td>{{$report['relapse_24to59_female']}}</td>

                        <td>{{$report['muac_24to59_male']+$report['zscore_24to59_male']+$report['oedema_24to59_male']+$report['relapse_24to59_male']}}</td>
                        <td>{{$report['muac_24to59_female']+$report['zscore_24to59_female']+$report['oedema_24to59_female']+$report['relapse_24to59_female']}}</td>
                        <td>{{$report['muac_24to59_male']+$report['zscore_24to59_male']+$report['oedema_24to59_male']+$report['relapse_24to59_male']+$report['muac_24to59_female']+$report['zscore_24to59_female']+$report['oedema_24to59_female']+$report['relapse_24to59_female']}}</td>

                        <td>{{$report['return_default_24to59_male']}}</td>
                        <td>{{$report['return_default_24to59_female']}}</td>
                        <td>{{$report['transferin_tsfp_24to59_male']}}</td>
                        <td>{{$report['transferin_tsfp_24to59_female']}}</td>
                        <td>{{$report['transferin_sc_24to59_male']}}</td>
                        <td>{{$report['transferin_sc_24to59_female']}}</td>
                        <td>{{$report['transferin_otp_24to59_male']}}</td>
                        <td>{{$report['transferin_otp_24to59_female']}}</td>

                        <td>{{$report['return_default_24to59_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_sc_24to59_male']+$report['transferin_otp_24to59_male']}}</td>
                        <td>{{$report['return_default_24to59_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_sc_24to59_female']+$report['transferin_otp_24to59_female']}}</td>
                        <td>{{$report['return_default_24to59_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_sc_24to59_male']+$report['transferin_otp_24to59_male']+$report['return_default_24to59_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_sc_24to59_female']+$report['transferin_otp_24to59_female']}}</td>

                        <td>{{$report['muac_24to59_male']+$report['zscore_24to59_male']+$report['oedema_24to59_male']+$report['relapse_24to59_male']+$report['return_default_24to59_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_sc_24to59_male']+$report['transferin_otp_24to59_male']}}</td>
                        <td>{{$report['muac_24to59_female']+$report['zscore_24to59_female']+$report['oedema_24to59_female']+$report['relapse_24to59_female']+$report['return_default_24to59_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_sc_24to59_female']+$report['transferin_otp_24to59_female']}}</td>
                        <td>{{$report['muac_24to59_male']+$report['zscore_24to59_male']+$report['oedema_24to59_male']+$report['relapse_24to59_male']+$report['muac_24to59_female']+$report['zscore_24to59_female']+$report['oedema_24to59_female']+$report['relapse_24to59_female']+$report['return_default_24to59_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_sc_24to59_male']+$report['transferin_otp_24to59_male']+$report['return_default_24to59_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_sc_24to59_female']+$report['transferin_otp_24to59_female']}}</td>

                    </tr>
                    <tr class="gradeX">
                        <td>> 5 yrs</td>

                        <td>{{$report['begining_balance_60_male']}}</td>
                        <td>{{$report['begining_balance_60_female']}}</td>
                        <td>{{$report['begining_balance_60_male']+$report['begining_balance_60_female']}}</td>

                        <td>{{$report['muac_60_male']}}</td>
                        <td>{{$report['muac_60_female']}}</td>
                        <td>{{$report['zscore_60_male']}}</td>
                        <td>{{$report['zscore_60_female']}}</td>
                        <td>{{$report['oedema_60_male']}}</td>
                        <td>{{$report['oedema_60_female']}}</td>
                        <td>{{$report['relapse_60_male']}}</td>
                        <td>{{$report['relapse_60_female']}}</td>

                        <td>{{$report['muac_60_male']+$report['zscore_60_male']+$report['oedema_60_male']+$report['relapse_60_male']}}</td>
                        <td>{{$report['muac_60_female']+$report['zscore_60_female']+$report['oedema_60_female']+$report['relapse_60_female']}}</td>
                        <td>{{$report['muac_60_male']+$report['zscore_60_male']+$report['oedema_60_male']+$report['relapse_60_male']+$report['muac_60_female']+$report['zscore_60_female']+$report['oedema_60_female']+$report['relapse_60_female']}}</td>

                        <td>{{$report['return_default_60_male']}}</td>
                        <td>{{$report['return_default_60_female']}}</td>
                        <td>{{$report['transferin_tsfp_60_male']}}</td>
                        <td>{{$report['transferin_tsfp_60_female']}}</td>
                        <td>{{$report['transferin_sc_60_male']}}</td>
                        <td>{{$report['transferin_sc_60_female']}}</td>
                        <td>{{$report['transferin_otp_60_male']}}</td>
                        <td>{{$report['transferin_otp_60_female']}}</td>

                        <td>{{$report['return_default_60_male']+$report['transferin_tsfp_60_male']+$report['transferin_sc_60_male']+$report['transferin_otp_60_male']}}</td>
                        <td>{{$report['return_default_60_female']+$report['transferin_tsfp_60_female']+$report['transferin_sc_60_female']+$report['transferin_otp_60_female']}}</td>
                        <td>{{$report['return_default_60_male']+$report['transferin_tsfp_60_male']+$report['transferin_sc_60_male']+$report['transferin_otp_60_male']+$report['return_default_60_female']+$report['transferin_tsfp_60_female']+$report['transferin_sc_60_female']+$report['transferin_otp_60_female']}}</td>

                        <td>{{$report['muac_60_male']+$report['zscore_60_male']+$report['oedema_60_male']+$report['relapse_60_male']+$report['return_default_60_male']+$report['transferin_tsfp_60_male']+$report['transferin_sc_60_male']+$report['transferin_otp_60_male']}}</td>
                        <td>{{$report['muac_60_female']+$report['zscore_60_female']+$report['oedema_60_female']+$report['relapse_60_female']+$report['return_default_60_female']+$report['transferin_tsfp_60_female']+$report['transferin_sc_60_female']+$report['transferin_otp_60_female']}}</td>
                        <td>{{$report['muac_60_male']+$report['zscore_60_male']+$report['oedema_60_male']+$report['relapse_60_male']+$report['muac_60_female']+$report['zscore_60_female']+$report['oedema_60_female']+$report['relapse_60_female']+$report['return_default_60_male']+$report['transferin_tsfp_60_male']+$report['transferin_sc_60_male']+$report['transferin_otp_60_male']+$report['return_default_60_female']+$report['transferin_tsfp_60_female']+$report['transferin_sc_60_female']+$report['transferin_otp_60_female']}}</td>

                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <td>{{$report['begining_balance_23_male']+$report['begining_balance_24to59_male']+$report['begining_balance_60_male']}}</td>
                        <td>{{$report['begining_balance_23_female']+$report['begining_balance_24to59_female']+$report['begining_balance_60_female']}}</td>
                        <td>{{$report['begining_balance_23_male']+$report['begining_balance_24to59_male']+$report['begining_balance_60_male']+$report['begining_balance_23_female']+$report['begining_balance_24to59_female']+$report['begining_balance_60_female']}}</td>

                        <td>{{$report['muac_23_male']+$report['muac_24to59_male']+$report['muac_60_male']}}</td>
                        <td>{{$report['muac_23_female']+$report['muac_24to59_female']+$report['muac_60_female']}}</td>
                        <td>{{$report['zscore_23_male']+$report['zscore_24to59_male']+$report['zscore_60_male']}}</td>
                        <td>{{$report['zscore_23_female']+$report['zscore_24to59_female']+$report['zscore_60_female']}}</td>
                        <td>{{$report['oedema_23_male']+$report['oedema_24to59_male']+$report['oedema_60_male']}}</td>
                        <td>{{$report['oedema_23_female']+$report['oedema_24to59_female']+$report['oedema_60_female']}}</td>
                        <td>{{$report['relapse_23_male']+$report['relapse_24to59_male']+$report['relapse_60_male']}}</td>
                        <td>{{$report['relapse_23_female']+$report['relapse_24to59_female']+$report['relapse_60_female']}}</td>

                        <td>{{$report['muac_23_male']+$report['zscore_23_male']+$report['oedema_23_male']+$report['relapse_23_male']+
                            $report['muac_24to59_male']+$report['zscore_24to59_male']+$report['oedema_24to59_male']+$report['relapse_24to59_male']+
                            $report['muac_60_male']+$report['zscore_60_male']+$report['oedema_60_male']+$report['relapse_60_male']}}</td>

                        <td>{{$report['muac_23_female']+$report['zscore_23_female']+$report['oedema_23_female']+$report['relapse_23_female']+
                            $report['muac_24to59_female']+$report['zscore_24to59_female']+$report['oedema_24to59_female']+$report['relapse_24to59_female']+
                            $report['muac_60_female']+$report['zscore_60_female']+$report['oedema_60_female']+$report['relapse_60_female']}}</td>

                        <td>{{$report['muac_23_male']+$report['zscore_23_male']+$report['oedema_23_male']+$report['relapse_23_male']+$report['muac_23_female']+$report['zscore_23_female']+$report['oedema_23_female']+$report['relapse_23_female']+
                            $report['muac_24to59_male']+$report['zscore_24to59_male']+$report['oedema_24to59_male']+$report['relapse_24to59_male']+$report['muac_24to59_female']+$report['zscore_24to59_female']+$report['oedema_24to59_female']+$report['relapse_24to59_female']+
                            $report['muac_60_male']+$report['zscore_60_male']+$report['oedema_60_male']+$report['relapse_60_male']+$report['muac_60_female']+$report['zscore_60_female']+$report['oedema_60_female']+$report['relapse_60_female']}}</td>

                        <td>{{$report['return_default_23_male']+$report['return_default_24to59_male']+$report['return_default_60_male']}}</td>
                        <td>{{$report['return_default_23_female']+$report['return_default_24to59_female']+$report['return_default_60_female']}}</td>
                        <td>{{$report['transferin_tsfp_23_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_tsfp_60_male']}}</td>
                        <td>{{$report['transferin_tsfp_23_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_tsfp_60_female']}}</td>
                        <td>{{$report['transferin_sc_23_male']+$report['transferin_sc_24to59_male']+$report['transferin_sc_60_male']}}</td>
                        <td>{{$report['transferin_sc_23_female']+$report['transferin_sc_24to59_female']+$report['transferin_sc_60_female']}}</td>
                        <td>{{$report['transferin_otp_23_male']+$report['transferin_otp_24to59_male']+$report['transferin_otp_60_male']}}</td>
                        <td>{{$report['transferin_otp_23_female']+$report['transferin_otp_24to59_female']+$report['transferin_otp_60_female']}}</td>

                        <td>{{$report['return_default_23_male']+$report['transferin_tsfp_23_male']+$report['transferin_sc_23_male']+$report['transferin_otp_23_male']+
                            $report['return_default_24to59_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_sc_24to59_male']+$report['transferin_otp_24to59_male']+
                            $report['return_default_60_male']+$report['transferin_tsfp_60_male']+$report['transferin_sc_60_male']+$report['transferin_otp_60_male']}}</td>

                        <td>{{$report['return_default_23_female']+$report['transferin_tsfp_23_female']+$report['transferin_sc_23_female']+$report['transferin_otp_23_female']+
                            $report['return_default_24to59_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_sc_24to59_female']+$report['transferin_otp_24to59_female']+
                            $report['return_default_60_female']+$report['transferin_tsfp_60_female']+$report['transferin_sc_60_female']+$report['transferin_otp_60_female']}}</td>

                        <td>{{$report['return_default_23_male']+$report['transferin_tsfp_23_male']+$report['transferin_sc_23_male']+$report['transferin_otp_23_male']+$report['return_default_23_female']+$report['transferin_tsfp_23_female']+$report['transferin_sc_23_female']+$report['transferin_otp_23_female']+
                            $report['return_default_24to59_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_sc_24to59_male']+$report['transferin_otp_24to59_male']+$report['return_default_24to59_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_sc_24to59_female']+$report['transferin_otp_24to59_female']+
                            $report['return_default_60_male']+$report['transferin_tsfp_60_male']+$report['transferin_sc_60_male']+$report['transferin_otp_60_male']+$report['return_default_60_female']+$report['transferin_tsfp_60_female']+$report['transferin_sc_60_female']+$report['transferin_otp_60_female']}}</td>

                        <td>{{$report['muac_23_male']+$report['zscore_23_male']+$report['oedema_23_male']+$report['relapse_23_male']+$report['return_default_23_male']+$report['transferin_tsfp_23_male']+$report['transferin_sc_23_male']+$report['transferin_otp_23_male']+
                        $report['muac_24to59_male']+$report['zscore_24to59_male']+$report['oedema_24to59_male']+$report['relapse_24to59_male']+$report['return_default_24to59_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_sc_24to59_male']+$report['transferin_otp_24to59_male']+
                        $report['muac_60_male']+$report['zscore_60_male']+$report['oedema_60_male']+$report['relapse_60_male']+$report['return_default_60_male']+$report['transferin_tsfp_60_male']+$report['transferin_sc_60_male']+$report['transferin_otp_60_male']}}</td>

                        <td>{{$report['muac_23_female']+$report['zscore_23_female']+$report['oedema_23_female']+$report['relapse_23_female']+$report['return_default_23_female']+$report['transferin_tsfp_23_female']+$report['transferin_sc_23_female']+$report['transferin_otp_23_female']+
                        $report['muac_24to59_female']+$report['zscore_24to59_female']+$report['oedema_24to59_female']+$report['relapse_24to59_female']+$report['return_default_24to59_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_sc_24to59_female']+$report['transferin_otp_24to59_female']+
                        $report['muac_60_female']+$report['zscore_60_female']+$report['oedema_60_female']+$report['relapse_60_female']+$report['return_default_60_female']+$report['transferin_tsfp_60_female']+$report['transferin_sc_60_female']+$report['transferin_otp_60_female']}}</td>

                        <td>{{$report['muac_23_male']+$report['zscore_23_male']+$report['oedema_23_male']+$report['relapse_23_male']+$report['muac_23_female']+$report['zscore_23_female']+$report['oedema_23_female']+$report['relapse_23_female']+$report['return_default_23_male']+$report['transferin_tsfp_23_male']+$report['transferin_sc_23_male']+$report['transferin_otp_23_male']+$report['return_default_23_female']+$report['transferin_tsfp_23_female']+$report['transferin_sc_23_female']+$report['transferin_otp_23_female']+
                        $report['muac_24to59_male']+$report['zscore_24to59_male']+$report['oedema_24to59_male']+$report['relapse_24to59_male']+$report['muac_24to59_female']+$report['zscore_24to59_female']+$report['oedema_24to59_female']+$report['relapse_24to59_female']+$report['return_default_24to59_male']+$report['transferin_tsfp_24to59_male']+$report['transferin_sc_24to59_male']+$report['transferin_otp_24to59_male']+$report['return_default_24to59_female']+$report['transferin_tsfp_24to59_female']+$report['transferin_sc_24to59_female']+$report['transferin_otp_24to59_female']+
                        $report['muac_60_male']+$report['zscore_60_male']+$report['oedema_60_male']+$report['relapse_60_male']+$report['muac_60_female']+$report['zscore_60_female']+$report['oedema_60_female']+$report['relapse_60_female']+$report['return_default_60_male']+$report['transferin_tsfp_60_male']+$report['transferin_sc_60_male']+$report['transferin_otp_60_male']+$report['return_default_60_female']+$report['transferin_tsfp_60_female']+$report['transferin_sc_60_female']+$report['transferin_otp_60_female']}}</td>
                    </tr>
                    </tfoot>
                    </table>                            
                                <div class="full-height-scroll">
                  
                                    
                                </div>
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@push('scripts')

    
    <script src="js/plugins/dataTables/datatables.min.js"></script>

  
<script>
    
    $(document).ready(function() {
            
    });
    
</script>
@endpush