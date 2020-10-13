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
                    <input class="date-year btn btn" type="text" name="year"
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
                                {{--<td>Month/Year: <strong>{{ date("F Y",strtotime("-1 month")) }}</strong></td>--}}
                                <td>Month/Year:
                                    <strong>{{ date('F', mktime(0, 0, 0, $report['report_month'], 10)).'-'.$report['report_year'] }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>Report prepared by: <strong>ENIM System</strong></td>
                                <td>Organization: <strong>{{ $facility->implementing_partner }}</strong></td>
                                <td>Reporting Duration: <strong>1 Month</strong></td>
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
                            <tr>
                                <td colspan="2"><strong>At the Begining (A)</strong></td>
                                <td><strong>{{$report['begining_balance_23_male']+$report['begining_balance_23_female']+$report['begining_balance_24to59_male']+$report['begining_balance_24to59_female']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['begining_balance_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['begining_balance_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['begining_balance_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['begining_balance_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-1 end                            --}}
{{--block-2 start                            --}}
                            <tr>
                                <td colspan="2"><strong>New Admission MUAC</strong></td>
                                <td><strong>{{$report['new_admission_23_male_muac']+$report['new_admission_23_female_muac']+$report['new_admission_24to59_male_muac']+$report['new_admission_24to59_female_muac']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['new_admission_23_male_muac']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['new_admission_23_female_muac']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['new_admission_24to59_male_muac']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['new_admission_24to59_female_muac']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-2 end                            --}}
{{--block-2 start                            --}}
                            <tr>
                                <td colspan="2"><strong>New Admission WHZ</strong></td>
                                <td><strong>{{$report['new_admission_23_male_zscore']+$report['new_admission_23_female_zscore']+$report['new_admission_24to59_male_zscore']+$report['new_admission_24to59_female_zscore']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['new_admission_23_male_zscore']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['new_admission_23_female_zscore']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['new_admission_24to59_male_zscore']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['new_admission_24to59_female_zscore']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-2 end                            --}}
{{--block-3 start                            --}}
                            <tr>
                                <td colspan="2"><strong>Readmission after being default</strong></td>
                                <td><strong>{{$report['readmission_after_default_23_male']+$report['readmission_after_default_23_female']+$report['readmission_after_default_24to59_male']+$report['readmission_after_default_24to59_female']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['readmission_after_default_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['readmission_after_default_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['readmission_after_default_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['readmission_after_default_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-3 end                            --}}
{{--block-3 start                            --}}
                            <tr>
                                <td colspan="2"><strong>Readmission after Recovery</strong></td>
                                <td><strong>{{$report['readmission_after_recovery_23_male']+$report['readmission_after_recovery_23_female']+$report['readmission_after_recovery_24to59_male']+$report['readmission_after_recovery_24to59_female']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['readmission_after_recovery_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['readmission_after_recovery_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['readmission_after_recovery_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['readmission_after_recovery_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-3 end                            --}}
{{--block-Transfer_in start                            --}}
                            <tr>
                                <td colspan="2"><strong>Transfer-in (from other TSFP)</strong></td>
                                <td><strong>{{$report['transfer_in_from_tsfp_23_male']+$report['transfer_in_from_tsfp_23_female']+$report['transfer_in_from_tsfp_24to59_male']+$report['transfer_in_from_tsfp_24to59_female']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['transfer_in_from_tsfp_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['transfer_in_from_tsfp_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['transfer_in_from_tsfp_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['transfer_in_from_tsfp_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Transfer in end                            --}}
{{--block-Return From start                            --}}
                            <tr>
                                <td colspan="2"><strong>Return From SAM Treatment</strong></td>
                                <td><strong>{{$report['return_from_sam_23_male']+$report['return_from_sam_23_female']+$report['return_from_sam_24to59_male']+$report['return_from_sam_24to59_female']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['return_from_sam_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['return_from_sam_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['return_from_sam_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['return_from_sam_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-return from end                            --}}
{{--block- Total Admission start                            --}}
                            <tr>
                                <td colspan="2"><strong>Total Admission during this period (B)</strong></td>
                                <td><strong>{{$report['total_admission_23_male']+$report['total_admission_23_female']+$report['total_admission_24to59_male']+$report['total_admission_24to59_female']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['total_admission_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['total_admission_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['total_admission_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['total_admission_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Total Admission end                            --}}
{{--block- Discharge start                            --}}
                            <tr>
                                <td colspan="2"><strong>Discharge Cured</strong></td>
                                <td><strong>{{$report['discharge_cured_23_male']+$report['discharge_cured_23_female']+$report['discharge_cured_24to59_male']+$report['discharge_cured_24to59_female']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_cured_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_cured_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_cured_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_cured_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Discharge end                            --}}
{{--block- Defaulter start                            --}}
                            <tr>
                                <td colspan="2"><strong>Defaulted</strong></td>
                                <td><strong>{{$report['discharge_defaulted_23_male']+$report['discharge_defaulted_23_female']+$report['discharge_defaulted_24to59_male']+$report['discharge_defaulted_24to59_female']}}</strong></td>
                            </tr>

{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_defaulted_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_defaulted_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_defaulted_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_defaulted_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Defaulter end                            --}}
{{--block- Death start                            --}}
                            <tr>
                                <td colspan="2"><strong>Death</strong></td>
                                <td><strong>{{$report['discharge_death_23_male']+$report['discharge_death_23_female']+$report['discharge_death_24to59_male']+$report['discharge_death_24to59_female']}}</strong></td>
                            </tr>
{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_death_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_death_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_death_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_death_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Death end                            --}}
{{--block- Death start                            --}}
                            <tr>
                                <td colspan="2"><strong>Non Response (Non Cured)</strong></td>
                                <td><strong>{{$report['discharge_nonresponder_23_male']+$report['discharge_nonresponder_23_female']+$report['discharge_nonresponder_24to59_male']+$report['discharge_nonresponder_24to59_female']}}</strong></td>
                            </tr>
{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_nonresponder_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_nonresponder_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_nonresponder_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_nonresponder_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Death end                            --}}
{{--block- Transfer to SAM Treatment start                            --}}
                            <tr>
                                <td colspan="2"><strong>Transfer to SAM Treatment</strong></td>
                                <td><strong>{{$report['discharge_transfer_to_sam_23_male']+$report['discharge_transfer_to_sam_23_female']+$report['discharge_transfer_to_sam_24to59_male']+$report['discharge_transfer_to_sam_24to59_female']}}</strong></td>
                            </tr>
{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_transfer_to_sam_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_transfer_to_sam_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_transfer_to_sam_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_transfer_to_sam_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Transfer to SAM Treatment end                            --}}
{{--block- Transfer out (to other BSFP) start                            --}}
<tr>
    <td colspan="2"><strong>Transfer out (to other TSFP)</strong></td>
    <td><strong>{{$report['discharge_transfer_to_other_tsfp_23_male']+$report['discharge_transfer_to_other_tsfp_23_female']+$report['discharge_transfer_to_other_tsfp_24to59_male']+$report['discharge_transfer_to_other_tsfp_24to59_female']}}</strong></td>
</tr>
{{--row start--}}
<tr>
    <td rowspan="2">6-23 month</td>
    <td>Male</td>
    <td>{{$report['discharge_transfer_to_other_tsfp_23_male']}}</td>
</tr>
<tr>
    <td>Female</td>
    <td>{{$report['discharge_transfer_to_other_tsfp_23_female']}}</td>
</tr>
{{--row end                            --}}
{{--row start--}}
<tr>
    <td rowspan="2">24-59 month</td>
    <td>Male</td>
    <td>{{$report['discharge_transfer_to_other_tsfp_24to59_male']}}</td>
</tr>
<tr>
    <td>Female</td>
    <td>{{$report['discharge_transfer_to_other_tsfp_24to59_female']}}</td>
</tr>
{{--row end                            --}}
{{--block-Transfer out (to other BSFP) end                            --}}
{{--block- Other start                            --}}
                            <tr>
                                <td colspan="2"><strong>Others</strong></td>
                                <td><strong>{{$report['discharge_others_23_male']+$report['discharge_others_23_female']+$report['discharge_others_24to59_male']+$report['discharge_others_24to59_female']}}</strong></td>
                            </tr>
{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_others_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_others_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['discharge_others_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['discharge_others_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Others end                            --}}
{{--block- Exits start                            --}}
                            <tr>
                                <td colspan="2"><strong>Total exits during this period (C)</strong></td>
                                <td><strong>{{$report['total_exits_23_male']+$report['total_exits_23_female']+$report['total_exits_24to59_male']+$report['total_exits_24to59_female']}}</strong></td>
                            </tr>
{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['total_exits_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['total_exits_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['total_exits_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['total_exits_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-Exits end                            --}}
{{--block- At the  end start                            --}}
                            <tr>
                                <td colspan="2"><strong>At the  end (A+B)-C</strong></td>
                                <td><strong>{{$report['endof_month_23_male']+$report['endof_month_23_female']+$report['endof_month_24to59_male']+$report['endof_month_24to59_female']}}</strong></td>
                            </tr>
{{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report['endof_month_23_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['endof_month_23_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report['endof_month_24to59_male']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report['endof_month_24to59_female']}}</td>
                            </tr>
{{--row end                            --}}
{{--block-At the  end end                            --}}
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

    $(document).ready(function () {
        $("body").toggleClass("mini-navbar");
    });

</script>
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>


@endpush