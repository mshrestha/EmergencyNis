@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
<style>
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        padding: 0px;
        margin: 0px;
        height: 0px;
    !important;
        text-align: center;
        /*line-height: 1.42857;*/

    }
</style>
@endpush


@section('content')

    <h2></h2>

    <div class="row">
        <div class="col-sm-12 ">

            <form action="{{ route('tsfp_report_admin') }}" class="form-horizontal" method="get">
                <div class="form-group pull-right">
                    <select name="facility_id" class="btn btn show-tick selectpicker"
                            data-live-search="true" required {{(Auth::user()->facility_id)?'disabled':''}}>
                        <option value="">Select Facility</option>
                        @foreach($facilities as $fac)
                            <option value="{{ $fac->id }}" {{ ($fac->id == Auth::user()->facility_id) ? ' selected' : '' }}>{{ $fac->facility_id }}</option>
                        @endforeach
                    </select>

                    <h5 style="display: inline-block">From</h5>
                    <select class="btn btn" name="monthFrom" required>
                        @foreach($monthList as $month_list)
                            <li>
                                <option value="{{$month_list->new_date}}">{{$month_list->new_date}}</option>
                            </li>
                        @endforeach
                    </select>
                    <h5 style="display: inline-block">To</h5>
                    <select class="btn btn" name="monthTo" required>
                        @foreach($monthList as $month_list)
                            <li>
                                <option value="{{$month_list->new_date}}">{{$month_list->new_date}}</option>
                            </li>
                        @endforeach
                    </select>

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
                            <th class="text-center">TSFP Monthly Report</th>
                            </thead>
                        </table>
                        <table class="table table-marginless table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td>Facility ID:
                                    <strong>{{ $facility->facility_id }}</strong>
                                </td>
                                <td></td>
                                <td>Name of Camp: <strong>{{ $facility->camp->name }}</strong></td>
                            </tr>
                            <tr>
                                <td>Facility Name: <strong>{{ $facility->facility_id }}</strong></td>
                                <td>Program Partner: <strong>{{ $facility->program_partner }}</strong></td>
                                <td>Report From Date: {{\Carbon\Carbon::parse($reportStart)->format(' d-M-Y')}}
                                </td>
                            </tr>
                            <tr>
                                <td>Report prepared by: <strong>ENIM System</strong></td>
                                <td>Organization: <strong>{{ $facility->implementing_partner }}</strong></td>
                                <td>Report To Date: {{\Carbon\Carbon::parse($reportEnd)->format(' d-M-Y')}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-hover dataTables-example x-small small">
                            {{--<thead>--}}
                            {{--<tr>--}}
                            {{--<td >Age Group</td>--}}
                            {{--<td>Indicator</td>--}}
                            {{--<td> Sex</td>--}}
                            {{--<td> </td>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            <tbody>
                            {{--block-1 start                            --}}
                            <tr style="background-color: #1aca7d">
                                <td rowspan="86"><strong>Targeted<br/>supplementary<br/>Feeding<br/>for 6-59<br/>months<br/>Children
                                    </strong></td>
                            </tr>
                            <tr style="background-color: #dff0d8">
                                <td colspan="2"><strong>At the Begining (A)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['begining_balance_total_enrollment']+$report_male_24to59['begining_balance_total_enrollment']+$report_female_6to23['begining_balance_total_enrollment']+$report_female_24to59['begining_balance_total_enrollment']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['begining_balance_total_enrollment']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['begining_balance_total_enrollment']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['begining_balance_total_enrollment']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['begining_balance_total_enrollment']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-1 end                            --}}
                            {{--block-2 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>New Admission MUAC</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['new_admission_muac']+$report_female_6to23['new_admission_muac']+$report_male_24to59['new_admission_muac']+$report_female_24to59['new_admission_muac']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['new_admission_muac']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['new_admission_muac']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['new_admission_muac']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['new_admission_muac']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-2 end                            --}}
                            {{--block-3 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>New Admission WHZ</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['new_admission_zscore']+$report_female_6to23['new_admission_zscore']+$report_male_24to59['new_admission_zscore']+$report_female_24to59['new_admission_zscore']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['new_admission_zscore']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['new_admission_zscore']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['new_admission_zscore']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['new_admission_zscore']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-3 end                            --}}
                            {{--block-4 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Readmission after being default</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['readmission_after_default']+$report_female_6to23['readmission_after_default']+$report_male_24to59['readmission_after_default']+$report_female_24to59['readmission_after_default']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['readmission_after_default']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['readmission_after_default']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['readmission_after_default']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['readmission_after_default']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-4 end                            --}}
                            {{--block-5 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Readmission after Recovery</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['readmission_after_recovery']+$report_female_6to23['readmission_after_recovery']+$report_male_24to59['readmission_after_recovery']+$report_female_24to59['readmission_after_recovery']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['readmission_after_recovery']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['readmission_after_recovery']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['readmission_after_recovery']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['readmission_after_recovery']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-5 end                            --}}
                            {{--block-6 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Transfer-in (from other TSFP)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['transfer_in_from_tsfp']+$report_female_6to23['transfer_in_from_tsfp']+$report_male_24to59['transfer_in_from_tsfp']+$report_female_24to59['transfer_in_from_tsfp']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['transfer_in_from_tsfp']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['transfer_in_from_tsfp']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['transfer_in_from_tsfp']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['transfer_in_from_tsfp']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-6 end                            --}}
                            {{--block-7 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Return From SAM Treatment</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['return_from_sam']+$report_female_6to23['return_from_sam']+$report_male_24to59['return_from_sam']+$report_female_24to59['return_from_sam']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['return_from_sam']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['return_from_sam']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['return_from_sam']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['return_from_sam']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-7 end                            --}}
                            {{--block-7 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Total Admission during this period (B)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['total_admission_report_month']+$report_female_6to23['total_admission_report_month']+$report_male_24to59['total_admission_report_month']+$report_female_24to59['total_admission_report_month']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['total_admission_report_month']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['total_admission_report_month']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['total_admission_report_month']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['total_admission_report_month']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Total Admission end                            --}}
                            {{--block-Discharge Cured start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Discharge Cured</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_cured']+$report_female_6to23['discharge_cured']+$report_male_24to59['discharge_cured']+$report_female_24to59['discharge_cured']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['discharge_cured']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['discharge_cured']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['discharge_cured']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['discharge_cured']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Discharge Cured end                            --}}
                            {{--block-Discharge Defaulted start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Discharge Defaulted</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_defaulted']+$report_female_6to23['discharge_defaulted']+$report_male_24to59['discharge_defaulted']+$report_female_24to59['discharge_defaulted']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['discharge_defaulted']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['discharge_defaulted']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['discharge_defaulted']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['discharge_defaulted']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Discharge  Defaulted end                            --}}
                            {{--block-Discharge Death start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Discharge Death</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_death']+$report_female_6to23['discharge_death']+$report_male_24to59['discharge_death']+$report_female_24to59['discharge_death']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['discharge_death']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['discharge_death']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['discharge_death']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['discharge_death']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Discharge Deathe end                            --}}
                            {{--block- discharge_nonresponder start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Discharge Non Responder</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_nonresponder']+$report_female_6to23['discharge_nonresponder']+$report_male_24to59['discharge_nonresponder']+$report_female_24to59['discharge_nonresponder']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['discharge_nonresponder']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['discharge_nonresponder']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['discharge_nonresponder']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['discharge_nonresponder']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block- discharge_nonresponder end                            --}}
                            {{--block- discharge_transfer_to_sam start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Transfer to SAM Treatment</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_transfer_to_sam']+$report_female_6to23['discharge_transfer_to_sam']+$report_male_24to59['discharge_transfer_to_sam']+$report_female_24to59['discharge_transfer_to_sam']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['discharge_transfer_to_sam']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['discharge_transfer_to_sam']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['discharge_transfer_to_sam']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['discharge_transfer_to_sam']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block- discharge_transfer_to_sam end                            --}}
                            {{--block- discharge_transfer_to_other_tsfp start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Transfer out (to other TSFP)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_transfer_to_other_tsfp']+$report_female_6to23['discharge_transfer_to_other_tsfp']+$report_male_24to59['discharge_transfer_to_other_tsfp']+$report_female_24to59['discharge_transfer_to_other_tsfp']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['discharge_transfer_to_other_tsfp']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['discharge_transfer_to_other_tsfp']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['discharge_transfer_to_other_tsfp']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['discharge_transfer_to_other_tsfp']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block- discharge_transfer_to_other_tsfp end                            --}}
                            {{--block- discharge_others start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Others</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_others']+$report_female_6to23['discharge_others']+$report_male_24to59['discharge_others']+$report_female_24to59['discharge_others']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['discharge_others']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['discharge_others']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['discharge_others']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['discharge_others']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block- discharge_others end                            --}}
                            {{--block- total_exits_report_month start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Total exits during this period (C)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['total_exits_report_month']+$report_female_6to23['total_exits_report_month']+$report_male_24to59['total_exits_report_month']+$report_female_24to59['total_exits_report_month']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['total_exits_report_month']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['total_exits_report_month']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['total_exits_report_month']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['total_exits_report_month']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block- total_exits_report_month end                            --}}
                            {{--block- end_of_month start                            --}}
                            <tr style="background-color: #77ee77">
                                <td colspan="2"><strong>At the end (A+B)-C</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['end_of_month']+$report_female_6to23['end_of_month']+$report_male_24to59['end_of_month']+$report_female_24to59['end_of_month']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['end_of_month']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['end_of_month']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['end_of_month']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['end_of_month']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block- end_of_month end                            --}}
                            <tr style="background-color: #bacf7d">
                                <td rowspan="19"><strong>Targeted<br/>supplementary<br/>Feeding<br/>for <br/>Pregnant <br/>and
                                    <br/>Lactating <br/>Women
                                    </strong></td>
                            </tr>

                            {{--block- plw new admission start                            --}}
                            <tr style="background-color: #eacf7d">
                                <td colspan="2"><strong>At the beginning (A) TSFP-PLW</strong></td>
                                <td><strong>{{$report_tsfp_plw['begining_balance_total']}}</strong></td>
                            </tr>
                            <tr style="background-color: #facf7d">
                                <td rowspan="5"><strong>Admission </strong></td>
                            </tr>
                            <tr>
                                <td>New admission</td>
                                <td>{{$report_tsfp_plw['this_period_new_admission']}}</td>
                            </tr>
                            <tr>
                                <td>Readmission after being default</td>
                                <td>{{$report_tsfp_plw['this_period_readmission_after_default']}}</td>
                            </tr>
                            <tr>
                                <td>Refer from BSFP</td>
                                <td>{{$report_tsfp_plw['this_period_transfer_in']}}</td>
                            </tr>
                            <tr>
                                <td>Transfer-in from other TSFP</td>
                                <td>{{$report_tsfp_plw['this_period_return_from']}}</td>
                            </tr>
                            <tr style="background-color: #eacf7d">
                                <td colspan="2"><strong>Total admissions during this period (B)</strong></td>
                                <td><strong>{{$report_tsfp_plw['this_period_total_enrollment']}}</strong></td>
                            </tr>
                            <tr style="background-color: #facf7d">
                                <td rowspan="9"><strong>Exit </strong></td>
                            </tr>
                            <tr>
                                <td>Discharge cured-PLW to BSFP</td>
                                <td>{{$report_tsfp_plw['this_period_discharge_cured_plw2bsfp']}}</td>
                            </tr>
                            <tr>
                                <td>Discharge cured-other</td>
                                <td>{{$report_tsfp_plw['this_period_discharge_cured_other']}}</td>
                            </tr>
                            <tr>
                                <td>Discharge- Child become 6 month old</td>
                                <td>{{$report_tsfp_plw['this_period_discharge_child_become6']}}</td>
                            </tr>
                            <tr>
                                <td>Transfer-out to other TSFP</td>
                                <td>{{$report_tsfp_plw['this_period_discharge_transfer_out']}}</td>
                            </tr>
                            <tr>
                                <td>Defaulter</td>
                                <td>{{$report_tsfp_plw['this_period_discharge_defaulted']}}</td>
                            </tr>
                            <tr>
                                <td>Death</td>
                                <td>{{$report_tsfp_plw['this_period_discharge_death']}}</td>
                            </tr>
                            <tr>
                                <td>Unexpected Discontinuation of Pregnancy</td>
                                <td>{{$report_tsfp_plw['this_period_discharge_unexpected']}}</td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td>{{$report_tsfp_plw['this_period_discharge_other']}}</td>
                            </tr>
                            <tr style="background-color: #eacf7d">
                                <td colspan="2"><strong>Total exits during this period (C)</strong></td>
                                <td><strong>{{$report_tsfp_plw['this_period_total_exit']}}</strong></td>
                            </tr>
                            <tr style="background-color: #55ca7d">
                                <td colspan="2"><strong>At the  end (A+B)-C</strong></td>
                                <td><strong>{{$report_tsfp_plw['end_of_month']}}</strong></td>
                            </tr>
                            {{--block- plw  end                            --}}
                            </tbody>
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


<script>

    //    $(document).ready(function () {
    //        $("body").toggleClass("mini-navbar");
    //    });

</script>
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>


@endpush