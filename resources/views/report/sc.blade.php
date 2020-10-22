
@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
<style>
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        padding: 0px;
    !important;
        text-align: center;
        /*line-height: 1.42857;*/
        /*line-height: 1.42857;*/
        border-top: 1px solid #e7ecf1;
    }

    .table-responsive {
        overflow-x: hidden;
    }

</style>

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
                            <th class="text-center">Stabilization Centre (SC) Monthly Report</th>
                            </thead>
                        </table>
                        <table class="table table-marginless table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td>Facility ID:
                                    <strong>{{ $facility->facility_id}}</strong>
                                    {{--                                    <strong>{{ substr($facility->facility_id, strpos($facility->facility_id, "/") + 1) }}</strong>--}}
                                </td>
                                <td></td>
                                <td>Name of Camp: <strong>{{ $facility->camp->name }}</strong></td>
                            </tr>
                            <tr>
                                <td>Facility Name: <strong>{{ $facility->facility_id }}</strong></td>
                                <td>Program Partner: <strong>{{ $facility->program_partner }}</strong></td>
                                {{--<td>Month/Year: <strong>{{ date("F Y",strtotime("-1 month")) }}</strong></td>--}}
                                <td>Month/Year:
                                    <strong>{{ date('F', mktime(0, 0, 0, $current_month, 10)).'-'.$current_year }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>Report prepared by: <strong>ENIS System</strong></td>
                                <td>Organization: <strong>{{ $facility->implementing_partner }}</strong></td>
                                <td>Reporting Duration: <strong>1 Month</strong></td>
                            </tr>
                            </tbody>
                        </table>
                        <table
                               class="table table-striped table-bordered table-hover dataTables-example x-small small">
                            <thead>
                            <tr>
                                <th rowspan="3" >Age Group</th>
                                <th rowspan="2" colspan="3" style="background-color: #FCDDAE">Total In Care Begining of month [A]</th>
                                <th rowspan="1" colspan="11">New Admission [B]</th>

                                <th rowspan="1" colspan="4">Transfer In [C]</th>
                                {{--<th rowspan="2" colspan="3" style="background-color: #F6FCCD">Total Transfer In [C1 + C2]</th>--}}
                                <th rowspan="2" colspan="3" style="background-color: #D9FB9C">Total Enrollment [D=B+C]</th>

                                <!-- Second Set Starts Here -->
                                <th rowspan="1" colspan="8">Discharge (E)</th>

                                <th rowspan="1" colspan="6">Transfer Out [F]</th>
                                <th rowspan="2" colspan="3" style="background-color: #CDECFC">Total Exits [G=E+F]</th>
                                <th rowspan="2" colspan="3">Total End of the month</th>
                            </tr>
                            <tr>
                                <th colspan="2">MUAC <11.5cm (B1)</th>
                                <th colspan="2">WFH <-3SD (B2)</th>
                                <th colspan="2">Edema (B3)</th>
                                <th colspan="2">Relapse (B4)</th>

                                <th colspan="3" style="background-color: #F6FCCD">Total New Enrollment</th>

                                <th colspan="2">Re-admission after defaulter (C1)</th>
                                {{--<th colspan="2">Transfer in from TSFP (C2)</th>--}}
                                {{--<th colspan="2">Transfer in from SC (C3)</th>--}}
                                <th colspan="2">Transfer from other OTP (C2)</th>

                                <!--Second Set Starts Here -->

                                <th colspan="2">Recovered (E1)</th>
                                <th colspan="2">Death (E2)</th>
                                <th colspan="2">Default (E3)</th>
                                <th colspan="2">Non recover (E4)</th>

                                {{--<th colspan="3" style="background-color: #CDECFC">Total Discharge</th>--}}

                                <th colspan="2">Medical Transfer (F1)</th>
                                <th colspan="2">Unknown /Other (F2)</th>
                                {{--<th colspan="2">Transfer to inpatient (F3)</th>--}}
                                <th colspan="2">Transfer to other OTP (F3)</th>



                            </tr>
                            <tr>
                                <!-- Total in Care begining of month A -->
                                <th style="background-color: #FCDDAE">M</th>
                                <th style="background-color: #FCDDAE">F</th>
                                <th style="background-color: #FCDDAE">T</th>

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
                                <th style="background-color: #F6FCCD">M</th>
                                <th style="background-color: #F6FCCD">F</th>
                                <th style="background-color: #F6FCCD">T</th>

                                <!-- C1 -->
                                <th>M</th>
                                <th>F</th>

                                <!-- C2 -->
                                <th>M</th>
                                <th>F</th>

                                {{--<!-- C3 -->--}}
                                {{--<th>M</th>--}}
                                {{--<th>F</th>--}}

                                {{--<!-- C4 -->--}}
                                {{--<th>M</th>--}}
                                {{--<th>F</th>--}}

                                <!-- Total Transfer In -->
                                {{--<th style="background-color: #F6FCCD">M</th>--}}
                                {{--<th style="background-color: #F6FCCD">F</th>--}}
                                {{--<th style="background-color: #F6FCCD">T</th>--}}

                                <!-- This is for D Total Enrollment -->
                                <th style="background-color: #D9FB9C">M</th>
                                <th style="background-color: #D9FB9C">F</th>
                                <th style="background-color: #D9FB9C">T</th>

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

                                <!-- Total exit -->
                                {{--<th style="background-color: #CDECFC">M</th>--}}
                                {{--<th style="background-color: #CDECFC">F</th>--}}
                                {{--<th style="background-color: #CDECFC">T</th>--}}

                                <!-- C1 -->
                                <th>M</th>
                                <th>F</th>

                                <!-- C2 -->
                                <th>M</th>
                                <th>F</th>

                                <!-- C3 -->
                                {{--<th>M</th>--}}
                                {{--<th>F</th>--}}

                                <!-- C4 -->
                                <th>M</th>
                                <th>F</th>

                                <!-- Total Transfer In -->
                                <th style="background-color: #CDECFC">M</th>
                                <th style="background-color: #CDECFC">F</th>
                                <th style="background-color: #CDECFC">T</th>

                                <!-- This is for D Total Enrollment -->
                                <th>M</th>
                                <th>F</th>
                                <th>T</th>


                            </tr>
                            </thead>
                            <tbody>
                            <tr class="gradeX">
                                <td> Under 6 months</td>

                                <td style="background-color: #FCDDAE">{{$report_male_under6['begining_balance_total']}}</td>
                                <td style="background-color: #FCDDAE">{{$report_female_under6['begining_balance_total']}}</td>
                                <td style="background-color: #FCDDAE">{{$report_male_under6['begining_balance_total']+$report_female_under6['begining_balance_total']}}</td>

                                <td>{{$report_male_under6['new_admission_muac']}}</td>
                                <td>{{$report_female_under6['new_admission_muac']}}</td>
                                <td>{{$report_male_under6['new_admission_zscore']}}</td>
                                <td>{{$report_female_under6['new_admission_zscore']}}</td>
                                <td>{{$report_male_under6['new_admission_oedema']}}</td>
                                <td>{{$report_female_under6['new_admission_oedema']}}</td>
                                <td>{{$report_male_under6['new_admission_relapse']}}</td>
                                <td>{{$report_female_under6['new_admission_relapse']}}</td>

                                <td style="background-color: #F6FCCD">{{$report_male_under6['this_period_new_admission_total']}}</td>
                                <td style="background-color: #F6FCCD">{{$report_female_under6['this_period_new_admission_total']}}</td>
                                <td style="background-color: #F6FCCD">{{$report_male_under6['this_period_new_admission_total']+$report_female_under6['this_period_new_admission_total']}}</td>


                                <td>{{$report_male_under6['readmission_after_default']}}</td>
                                <td>{{$report_female_under6['readmission_after_default']}}</td>
                                {{--<td>{{$report_male_under6['transfer_in_from_tsfp']}}</td>--}}
                                {{--<td>{{$report_female_under6['transfer_in_from_tsfp']}}</td>--}}
                                {{--<td>{{$report_male_under6['transfer_in_from_sc']}}</td>--}}
                                {{--<td>{{$report_female_under6['transfer_in_from_sc']}}</td>--}}
                                <td>{{$report_male_under6['transfer_in_from_otp']}}</td>
                                <td>{{$report_female_under6['transfer_in_from_otp']}}</td>

                                {{--<td style="background-color: #F6FCCD">{{$report_male_under6['this_period_transfer_in_total']}}</td>--}}
                                {{--<td style="background-color: #F6FCCD">{{$report_female_under6['this_period_transfer_in_total']}}</td>--}}
                                {{--<td style="background-color: #F6FCCD">{{$report_male_under6['this_period_transfer_in_total']+$report_female_under6['this_period_transfer_in_total']}}</td>--}}

                                <td style="background-color: #D9FB9C">{{$report_male_under6['this_period_enrollment_total']}}</td>
                                <td style="background-color: #D9FB9C">{{$report_female_under6['this_period_enrollment_total']}}</td>
                                <td style="background-color: #D9FB9C">{{$report_male_under6['this_period_enrollment_total']+$report_female_under6['this_period_enrollment_total']}}</td>

                                {{--<!-- Second Set Starts Here -->--}}
                                <td>{{$report_male_under6['discharge_criteria_exit_recovered']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_exit_recovered']}}</td>
                                <td>{{$report_male_under6['discharge_criteria_exit_death']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_exit_death']}}</td>
                                <td>{{$report_male_under6['discharge_criteria_exit_defaulted']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_exit_defaulted']}}</td>
                                <td>{{$report_male_under6['discharge_criteria_exit_nonrecovered']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_exit_nonrecovered']}}</td>

                                {{--<td style="background-color: #CDECFC">{{$report_male_under6['discharge_criteria_exit_total']}}</td>--}}
                                {{--<td style="background-color: #CDECFC">{{$report_female_under6['discharge_criteria_exit_total']}}</td>--}}
                                {{--<td style="background-color: #CDECFC">{{$report_male_under6['discharge_criteria_exit_total']+$report_female_under6['discharge_criteria_exit_total']}}</td>--}}

                                <td>{{$report_male_under6['discharge_criteria_others_medical_transfer']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_others_medical_transfer']}}</td>
                                <td>{{$report_male_under6['discharge_criteria_others_unkown']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_others_unkown']}}</td>
                                {{--<td>{{$report_male_under6['discharge_criteria_transfer_out_sc']}}</td>--}}
                                {{--<td>{{$report_female_under6['discharge_criteria_transfer_out_sc']}}</td>--}}
                                <td>{{$report_male_under6['discharge_criteria_transfer_out_otp']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_transfer_out_otp']}}</td>

                                {{--<td>{{$report_male_under6['discharge_criteria_transfer_out_total']}}</td>--}}
                                {{--<td>{{$report_female_under6['discharge_criteria_transfer_out_total']}}</td>--}}
                                {{--<td>{{$report_male_under6['discharge_criteria_transfer_out_total']+$report_female_under6['discharge_criteria_transfer_out_total']}}</td>--}}

                                <td style="background-color: #CDECFC">{{$report_male_under6['this_period_exit_total']}}</td>
                                <td style="background-color: #CDECFC">{{$report_female_under6['this_period_exit_total']}}</td>
                                <td style="background-color: #CDECFC">{{$report_male_under6['this_period_exit_total']+$report_female_under6['this_period_exit_total']}}</td>

                                <td>{{$report_male_under6['end_of_month']}}</td>
                                <td>{{$report_female_under6['end_of_month']}}</td>
                                <td>{{$report_male_under6['end_of_month']+$report_female_under6['end_of_month']}}</td>

                            </tr>

                            <tr class="gradeX">
                                <td>6-59 months</td>

                                <td style="background-color: #FCDDAE">{{$report_male_6to59['begining_balance_total_enrolled']}}</td>
                                <td style="background-color: #FCDDAE">{{$report_female_6to59['begining_balance_total_enrolled']}}</td>
                                <td style="background-color: #FCDDAE">{{$report_male_6to59['begining_balance_total_enrolled']+$report_female_6to59['begining_balance_total_enrolled']}}</td>

                                <td>{{$report_male_6to59['new_admission_muac']}}</td>
                                <td>{{$report_female_6to59['new_admission_muac']}}</td>
                                <td>{{$report_male_6to59['new_admission_zscore']}}</td>
                                <td>{{$report_female_6to59['new_admission_zscore']}}</td>
                                <td>{{$report_male_6to59['new_admission_oedema']}}</td>
                                <td>{{$report_female_6to59['new_admission_oedema']}}</td>
                                <td>{{$report_male_6to59['new_admission_relapse']}}</td>
                                <td>{{$report_female_6to59['new_admission_relapse']}}</td>

                                <td style="background-color: #F6FCCD">{{$report_male_6to59['this_period_new_admission_total']}}</td>
                                <td style="background-color: #F6FCCD">{{$report_female_6to59['this_period_new_admission_total']}}</td>
                                <td style="background-color: #F6FCCD">{{$report_male_6to59['this_period_new_admission_total']+$report_female_6to59['this_period_new_admission_total']}}</td>


                                <td>{{$report_male_6to59['readmission_after_default']}}</td>
                                <td>{{$report_female_6to59['readmission_after_default']}}</td>
                                {{--<td>{{$report_male_6to59['transfer_in_from_tsfp']}}</td>--}}
                                {{--<td>{{$report_female_6to59['transfer_in_from_tsfp']}}</td>--}}
                                {{--<td>{{$report_male_6to59['transfer_in_from_sc']}}</td>--}}
                                {{--<td>{{$report_female_6to59['transfer_in_from_sc']}}</td>--}}
                                <td>{{$report_male_6to59['transfer_in_from_otp']}}</td>
                                <td>{{$report_female_6to59['transfer_in_from_otp']}}</td>

                                {{--<td style="background-color: #F6FCCD">{{$report_male_6to59['this_period_transfer_in_total']}}</td>--}}
                                {{--<td style="background-color: #F6FCCD">{{$report_female_6to59['this_period_transfer_in_total']}}</td>--}}
                                {{--<td style="background-color: #F6FCCD">{{$report_male_6to59['this_period_transfer_in_total']+$report_female_6to59['this_period_transfer_in_total']}}</td>--}}

                                <td style="background-color: #D9FB9C">{{$report_male_6to59['this_period_enrollment_total']}}</td>
                                <td style="background-color: #D9FB9C">{{$report_female_6to59['this_period_enrollment_total']}}</td>
                                <td style="background-color: #D9FB9C">{{$report_male_6to59['this_period_enrollment_total']+$report_female_6to59['this_period_enrollment_total']}}</td>

                                {{--<!-- Second Set Starts Here -->--}}
                                <td>{{$report_male_6to59['discharge_criteria_exit_recovered']}}</td>
                                <td>{{$report_female_6to59['discharge_criteria_exit_recovered']}}</td>
                                <td>{{$report_male_6to59['discharge_criteria_exit_death']}}</td>
                                <td>{{$report_female_6to59['discharge_criteria_exit_death']}}</td>
                                <td>{{$report_male_6to59['discharge_criteria_exit_defaulted']}}</td>
                                <td>{{$report_female_6to59['discharge_criteria_exit_defaulted']}}</td>
                                <td>{{$report_male_6to59['discharge_criteria_exit_nonrecovered']}}</td>
                                <td>{{$report_female_6to59['discharge_criteria_exit_nonrecovered']}}</td>

                                {{--<td style="background-color: #CDECFC"> {{$report_male_6to59['discharge_criteria_exit_total']}}</td>--}}
                                {{--<td style="background-color: #CDECFC">{{$report_female_6to59['discharge_criteria_exit_total']}}</td>--}}
                                {{--<td style="background-color: #CDECFC">{{$report_male_6to59['discharge_criteria_exit_total']+$report_female_6to59['discharge_criteria_exit_total']}}</td>--}}

                                <td>{{$report_male_6to59['discharge_criteria_others_medical_transfer']}}</td>
                                <td>{{$report_female_6to59['discharge_criteria_others_medical_transfer']}}</td>
                                <td>{{$report_male_6to59['discharge_criteria_others_unkown']}}</td>
                                <td>{{$report_female_6to59['discharge_criteria_others_unkown']}}</td>
                                {{--<td>{{$report_male_6to59['discharge_criteria_transfer_out_sc']}}</td>--}}
                                {{--<td>{{$report_female_6to59['discharge_criteria_transfer_out_sc']}}</td>--}}
                                <td>{{$report_male_6to59['discharge_criteria_transfer_out_otp']}}</td>
                                <td>{{$report_female_6to59['discharge_criteria_transfer_out_otp']}}</td>

                                {{--<td>{{$report_male_6to59['discharge_criteria_transfer_out_total']}}</td>--}}
                                {{--<td>{{$report_female_6to59['discharge_criteria_transfer_out_total']}}</td>--}}
                                {{--<td>{{$report_male_6to59['discharge_criteria_transfer_out_total']+$report_female_6to59['discharge_criteria_transfer_out_total']}}</td>--}}

                                <td style="background-color: #CDECFC">{{$report_male_6to59['this_period_exit_total']}}</td>
                                <td style="background-color: #CDECFC">{{$report_female_6to59['this_period_exit_total']}}</td>
                                <td style="background-color: #CDECFC">{{$report_male_6to59['this_period_exit_total']+$report_female_6to59['this_period_exit_total']}}</td>

                                <td>{{$report_male_6to59['end_of_month']}}</td>
                                <td>{{$report_female_6to59['end_of_month']}}</td>
                                <td>{{$report_male_6to59['end_of_month']+$report_female_6to59['end_of_month']}}</td>

                            </tr>
                            <tr class="gradeX">
                                <td> Over 5 Years </td>

                                <td style="background-color: #FCDDAE">{{$report_male_60up['begining_balance_total_enrolled']}}</td>
                                <td style="background-color: #FCDDAE">{{$report_female_60up['begining_balance_total_enrolled']}}</td>
                                <td style="background-color: #FCDDAE">{{$report_male_60up['begining_balance_total_enrolled']+$report_female_60up['begining_balance_total_enrolled']}}</td>

                                <td>{{$report_male_60up['new_admission_muac']}}</td>
                                <td>{{$report_female_60up['new_admission_muac']}}</td>
                                <td>{{$report_male_60up['new_admission_zscore']}}</td>
                                <td>{{$report_female_60up['new_admission_zscore']}}</td>
                                <td>{{$report_male_60up['new_admission_oedema']}}</td>
                                <td>{{$report_female_60up['new_admission_oedema']}}</td>
                                <td>{{$report_male_60up['new_admission_relapse']}}</td>
                                <td>{{$report_female_60up['new_admission_relapse']}}</td>

                                <td style="background-color: #F6FCCD">{{$report_male_60up['this_period_new_admission_total']}}</td>
                                <td style="background-color: #F6FCCD">{{$report_female_60up['this_period_new_admission_total']}}</td>
                                <td style="background-color: #F6FCCD">{{$report_male_60up['this_period_new_admission_total']+$report_female_60up['this_period_new_admission_total']}}</td>


                                <td>{{$report_male_60up['readmission_after_default']}}</td>
                                <td>{{$report_female_60up['readmission_after_default']}}</td>
                                {{--<td>{{$report_male_60up['transfer_in_from_tsfp']}}</td>--}}
                                {{--<td>{{$report_female_60up['transfer_in_from_tsfp']}}</td>--}}
                                {{--<td>{{$report_male_60up['transfer_in_from_sc']}}</td>--}}
                                {{--<td>{{$report_female_60up['transfer_in_from_sc']}}</td>--}}
                                <td>{{$report_male_60up['transfer_in_from_otp']}}</td>
                                <td>{{$report_female_60up['transfer_in_from_otp']}}</td>

                                {{--<td style="background-color: #F6FCCD">{{$report_male_60up['this_period_transfer_in_total']}}</td>--}}
                                {{--<td style="background-color: #F6FCCD">{{$report_female_60up['this_period_transfer_in_total']}}</td>--}}
                                {{--<td style="background-color: #F6FCCD">{{$report_male_60up['this_period_transfer_in_total']+$report_female_60up['this_period_transfer_in_total']}}</td>--}}

                                <td style="background-color: #D9FB9C">{{$report_male_60up['this_period_enrollment_total']}}</td>
                                <td style="background-color: #D9FB9C">{{$report_female_60up['this_period_enrollment_total']}}</td>
                                <td style="background-color: #D9FB9C">{{$report_male_60up['this_period_enrollment_total']+$report_female_60up['this_period_enrollment_total']}}</td>

                                {{--<!-- Second Set Starts Here -->--}}
                                <td>{{$report_male_60up['discharge_criteria_exit_recovered']}}</td>
                                <td>{{$report_female_60up['discharge_criteria_exit_recovered']}}</td>
                                <td>{{$report_male_60up['discharge_criteria_exit_death']}}</td>
                                <td>{{$report_female_60up['discharge_criteria_exit_death']}}</td>
                                <td>{{$report_male_60up['discharge_criteria_exit_defaulted']}}</td>
                                <td>{{$report_female_60up['discharge_criteria_exit_defaulted']}}</td>
                                <td>{{$report_male_60up['discharge_criteria_exit_nonrecovered']}}</td>
                                <td>{{$report_female_60up['discharge_criteria_exit_nonrecovered']}}</td>

                                {{--<td style="background-color: #CDECFC">{{$report_male_60up['discharge_criteria_exit_total']}}</td>--}}
                                {{--<td style="background-color: #CDECFC">{{$report_female_60up['discharge_criteria_exit_total']}}</td>--}}
                                {{--<td style="background-color: #CDECFC">{{$report_male_60up['discharge_criteria_exit_total']+$report_female_60up['discharge_criteria_exit_total']}}</td>--}}

                                <td>{{$report_male_60up['discharge_criteria_others_medical_transfer']}}</td>
                                <td>{{$report_female_60up['discharge_criteria_others_medical_transfer']}}</td>
                                <td>{{$report_male_60up['discharge_criteria_others_unkown']}}</td>
                                <td>{{$report_female_60up['discharge_criteria_others_unkown']}}</td>
                                {{--<td>{{$report_male_60up['discharge_criteria_transfer_out_sc']}}</td>--}}
                                {{--<td>{{$report_female_60up['discharge_criteria_transfer_out_sc']}}</td>--}}
                                <td>{{$report_male_60up['discharge_criteria_transfer_out_otp']}}</td>
                                <td>{{$report_female_60up['discharge_criteria_transfer_out_otp']}}</td>

                                {{--<td>{{$report_male_60up['discharge_criteria_transfer_out_total']}}</td>--}}
                                {{--<td>{{$report_female_60up['discharge_criteria_transfer_out_total']}}</td>--}}
                                {{--<td>{{$report_male_60up['discharge_criteria_transfer_out_total']+$report_female_60up['discharge_criteria_transfer_out_total']}}</td>--}}

                                <td style="background-color: #CDECFC">{{$report_male_60up['this_period_exit_total']}}</td>
                                <td style="background-color: #CDECFC">{{$report_female_60up['this_period_exit_total']}}</td>
                                <td style="background-color: #CDECFC">{{$report_male_60up['this_period_exit_total']+$report_female_60up['this_period_exit_total']}}</td>

                                <td>{{$report_male_60up['end_of_month']}}</td>
                                <td>{{$report_female_60up['end_of_month']}}</td>
                                <td>{{$report_male_60up['end_of_month']+$report_female_60up['end_of_month']}}</td>

                            </tr>
                            <tr class="gradeX" style="background-color: #b8daff">
                                <td>Total</td>
                                <td style="background-color: #FCDDAE">{{$report_male_under6['begining_balance_total_enrolled']+$report_male_6to59['begining_balance_total_enrolled']+$report_male_60up['begining_balance_total_enrolled']}}</td>
                                <td style="background-color: #FCDDAE">{{$report_female_under6['begining_balance_total_enrolled']+$report_female_6to59['begining_balance_total_enrolled']+$report_female_60up['begining_balance_total_enrolled']}}</td>
                                <td style="background-color: #FCDDAE">{{$report_male_under6['begining_balance_total_enrolled']+$report_male_6to59['begining_balance_total_enrolled']+$report_male_60up['begining_balance_total_enrolled']+$report_female_under6['begining_balance_total_enrolled']+$report_female_6to59['begining_balance_total_enrolled']+$report_female_60up['begining_balance_total_enrolled']}}</td>

                                <td>{{$report_male_under6['new_admission_muac']+$report_male_6to59['new_admission_muac']+$report_male_60up['new_admission_muac']}}</td>
                                <td>{{$report_female_under6['new_admission_muac']+$report_female_6to59['new_admission_muac']+$report_female_60up['new_admission_muac']}}</td>
                                <td>{{$report_male_under6['new_admission_zscore']+$report_male_6to59['new_admission_zscore']+$report_male_60up['new_admission_zscore']}}</td>
                                <td>{{$report_female_under6['new_admission_zscore']+$report_female_6to59['new_admission_zscore']+$report_female_60up['new_admission_zscore']}}</td>
                                <td>{{$report_male_under6['new_admission_oedema']+$report_male_6to59['new_admission_oedema']+$report_male_60up['new_admission_oedema']}}</td>
                                <td>{{$report_female_under6['new_admission_oedema']+$report_female_6to59['new_admission_oedema']+$report_female_60up['new_admission_oedema']}}</td>
                                <td>{{$report_male_under6['new_admission_relapse']+$report_male_6to59['new_admission_relapse']+$report_male_60up['new_admission_relapse']}}</td>
                                <td>{{$report_female_under6['new_admission_relapse']+$report_female_6to59['new_admission_relapse']+$report_female_60up['new_admission_relapse']}}</td>

                                <td style="background-color: #F6FCCD">{{$report_male_under6['this_period_new_admission_total']+$report_male_6to59['this_period_new_admission_total']+$report_male_60up['this_period_new_admission_total']}}</td>
                                <td style="background-color: #F6FCCD">{{$report_female_under6['this_period_new_admission_total']+$report_female_6to59['this_period_new_admission_total']+$report_female_60up['this_period_new_admission_total']}}</td>
                                <td style="background-color: #F6FCCD">{{$report_male_under6['this_period_new_admission_total']+$report_male_6to59['this_period_new_admission_total']+$report_male_60up['this_period_new_admission_total']+$report_female_under6['this_period_new_admission_total']+$report_female_6to59['this_period_new_admission_total']+$report_female_60up['this_period_new_admission_total']}}</td>

                                <td>{{$report_male_under6['readmission_after_default']+$report_male_6to59['readmission_after_default']+$report_male_60up['readmission_after_default']}}</td>
                                <td>{{$report_female_under6['readmission_after_default']+$report_female_6to59['readmission_after_default']+$report_female_60up['readmission_after_default']}}</td>
                                {{--<td>{{$report_male_under6['transfer_in_from_tsfp']+$report_male_6to59['transfer_in_from_tsfp']+$report_male_60up['transfer_in_from_tsfp']}}</td>--}}
                                {{--<td>{{$report_female_under6['transfer_in_from_tsfp']+$report_female_6to59['transfer_in_from_tsfp']+$report_female_60up['transfer_in_from_tsfp']}}</td>--}}
                                {{--<td>{{$report_male_under6['transfer_in_from_sc']+$report_male_6to59['transfer_in_from_sc']+$report_male_60up['transfer_in_from_sc']}}</td>--}}
                                {{--<td>{{$report_female_under6['transfer_in_from_sc']+$report_female_6to59['transfer_in_from_sc']+$report_female_60up['transfer_in_from_sc']}}</td>--}}
                                <td>{{$report_male_under6['transfer_in_from_otp']+$report_male_6to59['transfer_in_from_otp']+$report_male_60up['transfer_in_from_otp']}}</td>
                                <td>{{$report_female_under6['transfer_in_from_otp']+$report_female_6to59['transfer_in_from_otp']+$report_female_60up['transfer_in_from_otp']}}</td>

                                {{--<td style="background-color: #F6FCCD">{{$report_male_under6['transfer_in_total']+$report_male_6to59['transfer_in_total']+$report_male_60up['transfer_in_total']}}</td>--}}
                                {{--<td style="background-color: #F6FCCD">{{$report_female_under6['transfer_in_total']+$report_female_6to59['transfer_in_total']+$report_female_60up['transfer_in_total']}}</td>--}}
                                {{--<td style="background-color: #F6FCCD">{{$report_male_under6['transfer_in_total']+$report_male_6to59['transfer_in_total']+$report_male_60up['transfer_in_total']+$report_female_under6['transfer_in_total']+$report_female_6to59['transfer_in_total']+$report_female_60up['transfer_in_total']}}</td>--}}

                                <td style="background-color: #D9FB9C">{{$report_male_under6['this_period_enrollment_total']+$report_male_6to59['this_period_enrollment_total']+$report_male_60up['this_period_enrollment_total']}}</td>
                                <td style="background-color: #D9FB9C">{{$report_female_under6['this_period_enrollment_total']+$report_female_6to59['this_period_enrollment_total']+$report_female_60up['this_period_enrollment_total']}}</td>
                                <td style="background-color: #D9FB9C">{{$report_male_under6['this_period_enrollment_total']+$report_male_6to59['this_period_enrollment_total']+$report_male_60up['this_period_enrollment_total']+$report_female_under6['this_period_enrollment_total']+$report_female_6to59['this_period_enrollment_total']+$report_female_60up['this_period_enrollment_total']}}</td>

                                <td>{{$report_male_under6['discharge_criteria_exit_recovered']+$report_male_6to59['discharge_criteria_exit_recovered']+$report_male_60up['discharge_criteria_exit_recovered']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_exit_recovered']+$report_female_6to59['discharge_criteria_exit_recovered']+$report_female_60up['discharge_criteria_exit_recovered']}}</td>
                                <td>{{$report_male_under6['discharge_criteria_exit_death']+$report_male_6to59['discharge_criteria_exit_death']+$report_male_60up['discharge_criteria_exit_death']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_exit_death']+$report_female_6to59['discharge_criteria_exit_death']+$report_female_60up['discharge_criteria_exit_death']}}</td>
                                <td>{{$report_male_under6['discharge_criteria_exit_defaulted']+$report_male_6to59['discharge_criteria_exit_defaulted']+$report_male_60up['discharge_criteria_exit_defaulted']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_exit_defaulted']+$report_female_6to59['discharge_criteria_exit_defaulted']+$report_female_60up['discharge_criteria_exit_defaulted']}}</td>
                                <td>{{$report_male_under6['discharge_criteria_exit_nonrecovered']+$report_male_6to59['discharge_criteria_exit_nonrecovered']+$report_male_60up['discharge_criteria_exit_nonrecovered']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_exit_nonrecovered']+$report_female_6to59['discharge_criteria_exit_nonrecovered']+$report_female_60up['discharge_criteria_exit_nonrecovered']}}</td>

                                {{--<td style="background-color: #CDECFC">{{$report_male_under6['discharge_criteria_exit_total']+$report_male_6to59['discharge_criteria_exit_total']+$report_male_60up['discharge_criteria_exit_total']}}</td>--}}
                                {{--<td style="background-color: #CDECFC">{{$report_female_under6['discharge_criteria_exit_total']+$report_female_6to59['discharge_criteria_exit_total']+$report_female_60up['discharge_criteria_exit_total']}}</td>--}}
                                {{--<td style="background-color: #CDECFC">{{$report_male_under6['discharge_criteria_exit_total']+$report_male_6to59['discharge_criteria_exit_total']+$report_male_60up['discharge_criteria_exit_total']+$report_female_under6['discharge_criteria_exit_total']+$report_female_6to59['discharge_criteria_exit_total']+$report_female_60up['discharge_criteria_exit_total']}}</td>--}}

                                <td>{{$report_male_under6['discharge_criteria_others_medical_transfer']+$report_male_6to59['discharge_criteria_others_medical_transfer']+$report_male_60up['discharge_criteria_others_medical_transfer']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_others_medical_transfer']+$report_female_6to59['discharge_criteria_others_medical_transfer']+$report_female_60up['discharge_criteria_others_medical_transfer']}}</td>
                                <td>{{$report_male_under6['discharge_criteria_others_unkown']+$report_male_6to59['discharge_criteria_others_unkown']+$report_male_60up['discharge_criteria_others_unkown']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_others_unkown']+$report_female_6to59['discharge_criteria_others_unkown']+$report_female_60up['discharge_criteria_others_unkown']}}</td>
                                {{--<td>{{$report_male_under6['discharge_criteria_transfer_out_sc']+$report_male_6to59['discharge_criteria_transfer_out_sc']+$report_male_60up['discharge_criteria_transfer_out_sc']}}</td>--}}
                                {{--<td>{{$report_female_under6['discharge_criteria_transfer_out_sc']+$report_female_6to59['discharge_criteria_transfer_out_sc']+$report_female_60up['discharge_criteria_transfer_out_sc']}}</td>--}}
                                <td>{{$report_male_under6['discharge_criteria_transfer_out_otp']+$report_male_6to59['discharge_criteria_transfer_out_otp']+$report_male_60up['discharge_criteria_transfer_out_otp']}}</td>
                                <td>{{$report_female_under6['discharge_criteria_transfer_out_otp']+$report_female_6to59['discharge_criteria_transfer_out_otp']+$report_female_60up['discharge_criteria_transfer_out_otp']}}</td>

                                <td style="background-color: #CDECFC">{{$report_male_under6['this_period_exit_total']+$report_male_6to59['this_period_exit_total']+$report_male_60up['this_period_exit_total']}}</td>
                                <td style="background-color: #CDECFC">{{$report_female_under6['this_period_exit_total']+$report_female_6to59['this_period_exit_total']+$report_female_60up['this_period_exit_total']}}</td>
                                <td style="background-color: #CDECFC">{{$report_male_under6['this_period_exit_total']+$report_male_6to59['this_period_exit_total']+$report_male_60up['this_period_exit_total']+$report_female_under6['this_period_exit_total']+$report_female_6to59['this_period_exit_total']+$report_female_60up['this_period_exit_total']}}</td>

                                <td>{{$report_male_under6['end_of_month']+$report_male_6to59['end_of_month']+$report_male_60up['end_of_month']}}</td>
                                <td>{{$report_female_under6['end_of_month']+$report_female_6to59['end_of_month']+$report_female_60up['end_of_month']}}</td>
                                <td>{{$report_male_under6['end_of_month']+$report_male_6to59['end_of_month']+$report_male_60up['end_of_month']+$report_female_under6['end_of_month']+$report_female_6to59['end_of_month']+$report_female_60up['end_of_month']}}</td>
                            </tr>
                            <tr style="background-color: #dff0d8">
                                <td colspan="22" >Performance</td>
                                <td colspan="2">{{($report_male_6to59['this_period_exit_total']==0)?'0%':((($report_male_6to59['discharge_criteria_exit_recovered']+$report_male_6to59['discharge_criteria_exit_recovered'])/$report_male_6to59['this_period_exit_total'])*100).'%'}}</td>
                                <td colspan="2">{{($report_male_6to59['this_period_exit_total']==0)?'0%':((($report_male_6to59['discharge_criteria_exit_death']+$report_male_6to59['discharge_criteria_exit_death'])/$report_male_6to59['this_period_exit_total'])*100).'%'}}</td>
                                <td colspan="2">{{($report_male_6to59['this_period_exit_total']==0)?'0%':((($report_male_6to59['discharge_criteria_exit_defaulted']+$report_male_6to59['discharge_criteria_exit_defaulted'])/$report_male_6to59['this_period_exit_total'])*100).'%'}}</td>
                                <td colspan="2">{{($report_male_6to59['this_period_exit_total']==0)?'0%':((($report_male_6to59['discharge_criteria_exit_nonrecovered']+$report_male_6to59['discharge_criteria_exit_nonrecovered'])/$report_male_6to59['this_period_exit_total'])*100).'%'}}</td>
                                <td colspan="12"></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@push('scripts')


{{--<script src="js/plugins/dataTables/datatables.min.js"></script>--}}

<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>

@endpush

