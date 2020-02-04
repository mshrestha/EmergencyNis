@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>

@endpush


@section('content')

    <h2></h2>

    <div class="row">
        <div class="col-sm-12 ">

            <form action="{{ route('otp_report_admin') }}" class="form-horizontal" method="get">
                <div class="form-group pull-right">
                    <select name="facility_id" class="btn btn show-tick selectpicker"
                            data-live-search="true" required {{(Auth::user()->facility_id)?'disabled':''}}>
                        <option value="">Select Facility</option>
                        @foreach($facilities as $fac)
                            <option value="{{ $fac->id }}" {{ ($fac->id == Auth::user()->facility_id) ? ' selected' : '' }}>{{ $fac->facility_id }}</option>
                        @endforeach
                    </select>
                    <select class="btn btn" name="month">
                        <option value="01" {{($current_month=='01') ? 'selected' : ''}}>January</option>
                        <option value="02" {{($current_month=='02') ? 'selected' : ''}}>February</option>
                        <option value="03" {{($current_month=='03') ? 'selected' : ''}}>March</option>
                        <option value="04" {{($current_month=='04') ? 'selected' : ''}}>April</option>
                        <option value="05" {{($current_month=='05') ? 'selected' : ''}}>May</option>
                        <option value="06" {{($current_month=='06') ? 'selected' : ''}}>June</option>
                        <option value="07" {{($current_month=='07') ? 'selected' : ''}}>July</option>
                        <option value="08" {{($current_month=='08') ? 'selected' : ''}}>August</option>
                        <option value="09" {{($current_month=='09') ? 'selected' : ''}}>September</option>
                        <option value="10" {{($current_month=='10') ? 'selected' : ''}}>October</option>
                        <option value="11" {{($current_month=='11') ? 'selected' : ''}}>November</option>
                        <option value="12" {{($current_month=='12') ? 'selected' : ''}}>December</option>
                    </select>
                    <input class="date-oyear btn btn" type="text" name="year" id="date-oyear"
                           style=" z-index: 9999 !important;"
                           value="{{$current_year}}">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>Search</button>
                </div>
            </form>
            <div class="ibox">
                {{--<table id="example" class="display" style="width:100%">--}}
                <div class="ibox-content">
                    <div class="text-center">
                        <img src="img/logo-1.gif" class="pull-left" height="70px"/>
                        <img src="img/logo-2.gif" height="80px"/>
                        <img src="img/logo-nutrition.png" class="pull-right" height="60px"/>
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
                                <td>Facility ID:
                                    <strong>{{ $facility->facility_id}}</strong>
{{--                                    <strong>{{ substr($facility->facility_id, strpos($facility->facility_id, "/") + 1) }}</strong>--}}
                                </td>
                                <td>Following Expanded Criteria:</td>
                                <td>Name of Camp: <strong>{{ $facility->camp->name }}</strong></td>
                            </tr>
                            <tr>
                                <td>Facility Name: <strong>{{ $facility->facility_id }}</strong></td>
                                <td>Program Partner: <strong>{{ $facility->program_partner }}</strong></td>
                                {{--<td>Month/Year: <strong>{{ date("F Y",strtotime("-1 month")) }}</strong></td>--}}
                                <td>Month/Year:
                                    <strong>{{ date('F', mktime(0, 0, 0, $report['report_month'], 10)).'-'.$report['report_year'] }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>Report prepared by: <strong>ENIS System</strong></td>
                                <td>Organization: <strong>{{ $facility->implementing_partner }}</strong></td>
                                <td>Reporting Duration: <strong>1 Month</strong></td>
                            </tr>
                            </tbody>
                        </table>
                        <table id="otp_data"
                               class="table table-striped table-bordered table-hover dataTables-example x-small small">
                            <thead>
                            <tr>
                                <th rowspan="3">Age Group</th>
                                <th rowspan="2" colspan="3">Total In Care Begining of month [A]</th>
                                <th rowspan="1" colspan="11">New Enrollment [B]</th>

                                <th rowspan="1" colspan="8">Transfer In [C]</th>
                                <th rowspan="2" colspan="3">Total Transfer In [C1 + C2 + C3 + C4]</th>
                                <th rowspan="2" colspan="3">Total Enrollment [D=B+C]</th>

                                <!-- Second Set Starts Here -->
                                <th rowspan="1" colspan="11">Discharge (E)</th>

                                <th rowspan="1" colspan="8">Transfer Out [F]</th>
                                <th rowspan="2" colspan="3">Total Exits [G=E+F]</th>
                                <th rowspan="2" colspan="3">Total End of the month</th>
                            </tr>
                            <tr>
                                <th colspan="2">MUAC &lt; 11.5cm(B1)</th>
                                <th colspan="2">WFH &lt; -3SD (B2)</th>
                                <th colspan="2">Edema (B3)</th>
                                <th colspan="2">Relapse (B4)</th>

                                <th colspan="3">Total New Enrollment</th>

                                <th colspan="2">Return after Default (C1)</th>
                                <th colspan="2">Transfer in from TSFP (C2)</th>
                                <th colspan="2">Transfer in from SC (C3)</th>
                                <th colspan="2">Transfer from other OTP (C4)</th>

                                <!--Second Set Starts Here -->

                                <th colspan="2">Recovered (E1)</th>
                                <th colspan="2">Death (E2)</th>
                                <th colspan="2">Default (E3)</th>
                                <th colspan="2">Non recover (E4)</th>

                                <th colspan="3">Total Discharge</th>

                                <th colspan="2">Medical Transfer (F1)</th>
                                <th colspan="2">Transfer to other OTP (F2)</th>
                                <th colspan="2">Transfer to inpatient (F3)</th>
                                <th colspan="2">Unknown /Other (F4)</th>


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

                                <!-- Second Set Starts here -->
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


                                <!-- Second Set Starts Here -->
                                <td>{{$report['recovered_23_male']}}</td>
                                <td>{{$report['recovered_23_female']}}</td>
                                <td>{{$report['death_23_male']}}</td>
                                <td>{{$report['death_23_female']}}</td>
                                <td>{{$report['defaulted_23_male']}}</td>
                                <td>{{$report['defaulted_23_female']}}</td>
                                <td>{{$report['non_responder_23_male']}}</td>
                                <td>{{$report['non_responder_23_female']}}</td>

                                <td>{{$report['recovered_23_male']+$report['death_23_male']+$report['defaulted_23_male']+$report['non_responder_23_male']}}</td>
                                <td>{{$report['recovered_23_female']+$report['death_23_female']+$report['defaulted_23_female']+$report['non_responder_23_female']}}</td>
                                <td>{{$report['recovered_23_male']+$report['death_23_male']+$report['defaulted_23_male']+$report['non_responder_23_male']+$report['recovered_23_female']+$report['death_23_female']+$report['defaulted_23_female']+$report['non_responder_23_female']}}</td>

                                <td>{{$report['medical_transfer_23_male']}}</td>
                                <td>{{$report['medical_transfer_23_female']}}</td>
                                <td>{{$report['transferout_otp_23_male']}}</td>
                                <td>{{$report['transferout_otp_23_female']}}</td>
                                <td>{{$report['transferout_sc_23_male']}}</td>
                                <td>{{$report['transferout_sc_23_female']}}</td>
                                <td>{{$report['others_unkown_23_male']}}</td>
                                <td>{{$report['others_unkown_23_female']}}</td>

                                <td>{{$report['recovered_23_male']+$report['death_23_male']+$report['defaulted_23_male']+$report['non_responder_23_male']+
                        $report['medical_transfer_23_male']+$report['transferout_otp_23_male']+$report['transferout_sc_23_male']+$report['others_unkown_23_male']}}</td>
                                <td>{{$report['recovered_23_female']+$report['death_23_female']+$report['defaulted_23_female']+$report['non_responder_23_female']+
                        $report['medical_transfer_23_female']+$report['transferout_otp_23_female']+$report['transferout_sc_23_female']+$report['others_unkown_23_female']}}</td>
                                <td>{{$report['recovered_23_male']+$report['death_23_male']+$report['defaulted_23_male']+$report['non_responder_23_male']+
                        $report['recovered_23_female']+$report['death_23_female']+$report['defaulted_23_female']+$report['non_responder_23_female']+
                        $report['medical_transfer_23_male']+$report['transferout_otp_23_male']+$report['transferout_sc_23_male']+$report['others_unkown_23_male']+
                        $report['medical_transfer_23_female']+$report['transferout_otp_23_female']+$report['transferout_sc_23_female']+$report['others_unkown_23_female']}}</td>

                                <td>{{$report['endof_month_23_male']}}</td>
                                <td>{{$report['endof_month_23_female']}}</td>
                                <td>{{$report['endof_month_23_male']+$report['endof_month_23_female']}}</td>

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

                                <!-- Second Set starts here -->
                                <td>{{$report['recovered_24to59_male']}}</td>
                                <td>{{$report['recovered_24to59_female']}}</td>
                                <td>{{$report['death_24to59_male']}}</td>
                                <td>{{$report['death_24to59_female']}}</td>
                                <td>{{$report['defaulted_24to59_male']}}</td>
                                <td>{{$report['defaulted_24to59_female']}}</td>
                                <td>{{$report['non_responder_24to59_male']}}</td>
                                <td>{{$report['non_responder_24to59_female']}}</td>

                                <td>{{$report['recovered_24to59_male']+$report['death_24to59_male']+$report['defaulted_24to59_male']+$report['non_responder_24to59_male']}}</td>
                                <td>{{$report['recovered_24to59_female']+$report['death_24to59_female']+$report['defaulted_24to59_female']+$report['non_responder_24to59_female']}}</td>
                                <td>{{$report['recovered_24to59_male']+$report['death_24to59_male']+$report['defaulted_24to59_male']+$report['non_responder_24to59_male']+$report['recovered_24to59_female']+$report['death_24to59_female']+$report['defaulted_24to59_female']+$report['non_responder_24to59_female']}}</td>

                                <td>{{$report['medical_transfer_24to59_male']}}</td>
                                <td>{{$report['medical_transfer_24to59_female']}}</td>
                                <td>{{$report['transferout_otp_24to59_male']}}</td>
                                <td>{{$report['transferout_otp_24to59_female']}}</td>
                                <td>{{$report['transferout_sc_24to59_male']}}</td>
                                <td>{{$report['transferout_sc_24to59_female']}}</td>
                                <td>{{$report['others_unkown_24to59_male']}}</td>
                                <td>{{$report['others_unkown_24to59_female']}}</td>

                                <td>{{$report['recovered_24to59_male']+$report['death_24to59_male']+$report['defaulted_24to59_male']+$report['non_responder_24to59_male']+
                        $report['medical_transfer_24to59_male']+$report['transferout_otp_24to59_male']+$report['transferout_sc_24to59_male']+$report['others_unkown_24to59_male']}}</td>
                                <td>{{$report['recovered_24to59_female']+$report['death_24to59_female']+$report['defaulted_24to59_female']+$report['non_responder_24to59_female']+
                        $report['medical_transfer_24to59_female']+$report['transferout_otp_24to59_female']+$report['transferout_sc_24to59_female']+$report['others_unkown_24to59_female']}}</td>
                                <td>{{$report['recovered_24to59_male']+$report['death_24to59_male']+$report['defaulted_24to59_male']+$report['non_responder_24to59_male']+
                        $report['recovered_24to59_female']+$report['death_24to59_female']+$report['defaulted_24to59_female']+$report['non_responder_24to59_female']+
                        $report['medical_transfer_24to59_male']+$report['transferout_otp_24to59_male']+$report['transferout_sc_24to59_male']+$report['others_unkown_24to59_male']+
                        $report['medical_transfer_24to59_female']+$report['transferout_otp_24to59_female']+$report['transferout_sc_24to59_female']+$report['others_unkown_24to59_female']}}</td>

                                <td>{{$report['endof_month_24to59_male']}}</td>
                                <td>{{$report['endof_month_24to59_female']}}</td>
                                <td>{{$report['endof_month_24to59_male']+$report['endof_month_24to59_female']}}</td>


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

                                <!-- Second Set Starts Here -->

                                <td>{{$report['recovered_60_male']}}</td>
                                <td>{{$report['recovered_60_female']}}</td>
                                <td>{{$report['death_60_male']}}</td>
                                <td>{{$report['death_60_female']}}</td>
                                <td>{{$report['defaulted_60_male']}}</td>
                                <td>{{$report['defaulted_60_female']}}</td>
                                <td>{{$report['non_responder_60_male']}}</td>
                                <td>{{$report['non_responder_60_female']}}</td>

                                <td>{{$report['recovered_60_male']+$report['death_60_male']+$report['defaulted_60_male']+$report['non_responder_60_male']}}</td>
                                <td>{{$report['recovered_60_female']+$report['death_60_female']+$report['defaulted_60_female']+$report['non_responder_60_female']}}</td>
                                <td>{{$report['recovered_60_male']+$report['death_60_male']+$report['defaulted_60_male']+$report['non_responder_60_male']+$report['recovered_60_female']+$report['death_60_female']+$report['defaulted_60_female']+$report['non_responder_60_female']}}</td>

                                <td>{{$report['medical_transfer_60_male']}}</td>
                                <td>{{$report['medical_transfer_60_female']}}</td>
                                <td>{{$report['transferout_otp_60_male']}}</td>
                                <td>{{$report['transferout_otp_60_female']}}</td>
                                <td>{{$report['transferout_sc_60_male']}}</td>
                                <td>{{$report['transferout_sc_60_female']}}</td>
                                <td>{{$report['others_unkown_60_male']}}</td>
                                <td>{{$report['others_unkown_60_female']}}</td>

                                <td>{{$report['recovered_60_male']+$report['death_60_male']+$report['defaulted_60_male']+$report['non_responder_60_male']+
                        $report['medical_transfer_60_male']+$report['transferout_otp_60_male']+$report['transferout_sc_60_male']+$report['others_unkown_60_male']}}</td>
                                <td>{{$report['recovered_60_female']+$report['death_60_female']+$report['defaulted_60_female']+$report['non_responder_60_female']+
                        $report['medical_transfer_60_female']+$report['transferout_otp_60_female']+$report['transferout_sc_60_female']+$report['others_unkown_60_female']}}</td>
                                <td>{{$report['recovered_60_male']+$report['death_60_male']+$report['defaulted_60_male']+$report['non_responder_60_male']+
                        $report['recovered_60_female']+$report['death_60_female']+$report['defaulted_60_female']+$report['non_responder_60_female']+
                        $report['medical_transfer_60_male']+$report['transferout_otp_60_male']+$report['transferout_sc_60_male']+$report['others_unkown_60_male']+
                        $report['medical_transfer_60_female']+$report['transferout_otp_60_female']+$report['transferout_sc_60_female']+$report['others_unkown_60_female']}}</td>

                                <td>{{$report['endof_month_60_male']}}</td>
                                <td>{{$report['endof_month_60_female']}}</td>
                                <td>{{$report['endof_month_60_male']+$report['endof_month_60_female']}}</td>

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

                                <!--Second Set Starts Here -->
                                <td>{{$report['recovered_23_male']+$report['recovered_24to59_male']+$report['recovered_60_male']}}</td>
                                <td>{{$report['recovered_23_female']+$report['recovered_24to59_female']+$report['recovered_60_female']}}</td>
                                <td>{{$report['death_23_male']+$report['death_24to59_male']+$report['death_60_male']}}</td>
                                <td>{{$report['death_23_female']+$report['death_24to59_female']+$report['death_60_female']}}</td>
                                <td>{{$report['defaulted_23_male']+$report['defaulted_24to59_male']+$report['defaulted_60_male']}}</td>
                                <td>{{$report['defaulted_23_female']+$report['defaulted_24to59_female']+$report['defaulted_60_female']}}</td>
                                <td>{{$report['non_responder_23_male']+$report['non_responder_24to59_male']+$report['non_responder_60_male']}}</td>
                                <td>{{$report['non_responder_23_female']+$report['non_responder_24to59_female']+$report['non_responder_60_female']}}</td>

                                <td>{{$report['recovered_23_male']+$report['death_23_male']+$report['defaulted_23_male']+$report['non_responder_23_male']+
                        $report['recovered_24to59_male']+$report['death_24to59_male']+$report['defaulted_24to59_male']+$report['non_responder_24to59_male']+
                        $report['recovered_60_male']+$report['death_60_male']+$report['defaulted_60_male']+$report['non_responder_60_male']}}</td>

                                <td>{{$report['recovered_23_female']+$report['death_23_female']+$report['defaulted_23_female']+$report['non_responder_23_female']+
                        $report['recovered_24to59_female']+$report['death_24to59_female']+$report['defaulted_24to59_female']+$report['non_responder_24to59_female']+
                        $report['recovered_60_female']+$report['death_60_female']+$report['defaulted_60_female']+$report['non_responder_60_female']}}</td>

                                <td>{{$report['recovered_23_male']+$report['death_23_male']+$report['defaulted_23_male']+$report['non_responder_23_male']+$report['recovered_23_female']+$report['death_23_female']+$report['defaulted_23_female']+$report['non_responder_23_female']+
                        $report['recovered_24to59_male']+$report['death_24to59_male']+$report['defaulted_24to59_male']+$report['non_responder_24to59_male']+$report['recovered_24to59_female']+$report['death_24to59_female']+$report['defaulted_24to59_female']+$report['non_responder_24to59_female']+
                        $report['recovered_60_male']+$report['death_60_male']+$report['defaulted_60_male']+$report['non_responder_60_male']+$report['recovered_60_female']+$report['death_60_female']+$report['defaulted_60_female']+$report['non_responder_60_female']}}</td>

                                <td>{{$report['medical_transfer_23_male']+$report['medical_transfer_24to59_male']+$report['medical_transfer_60_male']}}</td>
                                <td>{{$report['medical_transfer_23_female']+$report['medical_transfer_24to59_female']+$report['medical_transfer_60_female']}}</td>
                                <td>{{$report['transferout_otp_23_male']+$report['transferout_otp_24to59_male']+$report['transferout_otp_60_male']}}</td>
                                <td>{{$report['transferout_otp_23_female']+$report['transferout_otp_24to59_female']+$report['transferout_otp_60_female']}}</td>
                                <td>{{$report['transferout_sc_23_male']+$report['transferout_sc_24to59_male']+$report['transferout_sc_60_male']}}</td>
                                <td>{{$report['transferout_sc_23_female']+$report['transferout_sc_24to59_female']+$report['transferout_sc_60_female']}}</td>
                                <td>{{$report['others_unkown_23_male']+$report['others_unkown_24to59_male']+$report['others_unkown_60_male']}}</td>
                                <td>{{$report['others_unkown_23_female']+$report['others_unkown_24to59_female']+$report['others_unkown_60_female']}}</td>

                                <td>{{$report['recovered_23_male']+$report['death_23_male']+$report['defaulted_23_male']+$report['non_responder_23_male']+
                        $report['recovered_24to59_male']+$report['death_24to59_male']+$report['defaulted_24to59_male']+$report['non_responder_24to59_male']+
                        $report['recovered_60_male']+$report['death_60_male']+$report['defaulted_60_male']+$report['non_responder_60_male']+
                        $report['medical_transfer_23_male']+$report['medical_transfer_24to59_male']+$report['medical_transfer_60_male']+
                        $report['transferout_otp_23_male']+$report['transferout_otp_24to59_male']+$report['transferout_otp_60_male']+
                        $report['transferout_sc_23_male']+$report['transferout_sc_24to59_male']+$report['transferout_sc_60_male']+
                        $report['others_unkown_23_male']+$report['others_unkown_24to59_male']+$report['others_unkown_60_male']}}</td>

                                <td>{{$report['recovered_23_female']+$report['death_23_female']+$report['defaulted_23_female']+$report['non_responder_23_female']+
                        $report['recovered_24to59_female']+$report['death_24to59_female']+$report['defaulted_24to59_female']+$report['non_responder_24to59_female']+
                        $report['recovered_60_female']+$report['death_60_female']+$report['defaulted_60_female']+$report['non_responder_60_female']+
                        $report['medical_transfer_23_female']+$report['medical_transfer_24to59_female']+$report['medical_transfer_60_female']+
                        $report['transferout_otp_23_female']+$report['transferout_otp_24to59_female']+$report['transferout_otp_60_female']+
                        $report['transferout_sc_23_female']+$report['transferout_sc_24to59_female']+$report['transferout_sc_60_female']+
                        $report['others_unkown_23_female']+$report['others_unkown_24to59_female']+$report['others_unkown_60_female']}}</td>

                                <td>{{$report['recovered_23_male']+$report['death_23_male']+$report['defaulted_23_male']+$report['non_responder_23_male']+$report['recovered_23_female']+$report['death_23_female']+$report['defaulted_23_female']+$report['non_responder_23_female']+
                        $report['recovered_24to59_male']+$report['death_24to59_male']+$report['defaulted_24to59_male']+$report['non_responder_24to59_male']+$report['recovered_24to59_female']+$report['death_24to59_female']+$report['defaulted_24to59_female']+$report['non_responder_24to59_female']+
                        $report['recovered_60_male']+$report['death_60_male']+$report['defaulted_60_male']+$report['non_responder_60_male']+$report['recovered_60_female']+$report['death_60_female']+$report['defaulted_60_female']+$report['non_responder_60_female']+
                        $report['medical_transfer_23_male']+$report['medical_transfer_24to59_male']+$report['medical_transfer_60_male']+
                        $report['transferout_otp_23_male']+$report['transferout_otp_24to59_male']+$report['transferout_otp_60_male']+
                        $report['transferout_sc_23_male']+$report['transferout_sc_24to59_male']+$report['transferout_sc_60_male']+
                        $report['others_unkown_23_male']+$report['others_unkown_24to59_male']+$report['others_unkown_60_male']+
                        $report['medical_transfer_23_female']+$report['medical_transfer_24to59_female']+$report['medical_transfer_60_female']+
                        $report['transferout_otp_23_female']+$report['transferout_otp_24to59_female']+$report['transferout_otp_60_female']+
                        $report['transferout_sc_23_female']+$report['transferout_sc_24to59_female']+$report['transferout_sc_60_female']+
                        $report['others_unkown_23_female']+$report['others_unkown_24to59_female']+$report['others_unkown_60_female']}}</td>

                                <td>{{$report['endof_month_23_male']+$report['endof_month_24to59_male']+$report['endof_month_60_male']}}</td>
                                <td>{{$report['endof_month_23_female']+$report['endof_month_24to59_female']+$report['endof_month_60_female']}}</td>
                                <td>{{$report['endof_month_23_male']+$report['endof_month_24to59_male']+$report['endof_month_60_male']+$report['endof_month_23_female']+$report['endof_month_24to59_female']+$report['endof_month_60_female']}}</td>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- Second Table -->
                        {{--<div class="full-height-scroll"></div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#otp_data').DataTable({
            "paging": false,
            "searching": false,
            "info": false,
            responsive: true,
            dom: '<"html5buttons"B>lTfgtip',
            buttons: [
                {extend: 'excel', title: 'otp_report'},
                {extend: 'pdf', title: 'otp_report'},
            ]
        });
    });
</script>

<script src="js/plugins/dataTables/datatables.min.js"></script>

<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script type="text/javascript">


//    $(document).ready(function() {
//            $('.date-oyear').datepicker({
//                minViewMode: 2,
//                format: 'yyyy'
//            });

//        $("#date-oyear").datepicker({
//            format: " yyyy",
//            viewMode: "years",
//            minViewMode: "years"
//        });
//    });


</script>


@endpush
