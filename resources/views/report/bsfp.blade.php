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

            <form action="{{ route('bsfp_report_admin') }}" class="form-horizontal" method="get">
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
                                <option value="{{$month_list->new_date}}" >{{$month_list->new_date}}</option>
                            </li>
                        @endforeach
                    </select>
                    <h5 style="display: inline-block">To</h5>
                    <select class="btn btn" name="monthTo" required>
                        @foreach($monthList as $month_list)
                            <li>
                                <option value="{{$month_list->new_date}}" >{{$month_list->new_date}}</option>
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
                            <th class="text-center">BSFP Monthly Report</th>
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
                                <td>Report prepared by: <strong>ENIS System</strong></td>
                                <td>Organization: <strong>{{ $facility->implementing_partner }}</strong></td>
                                <td>Report To Date: {{\Carbon\Carbon::parse($reportEnd)->format(' d-M-Y')}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-hover dataTables-example x-small small">
                            <tbody>
                            {{--block-1 start                            --}}
                            <tr style="background-color: #dff0d8">
                                <td colspan="2"><strong>At the Begining (A)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['begining_balance_total']+$report_male_24to59['begining_balance_total']+$report_female_6to23['begining_balance_total']+$report_female_24to59['begining_balance_total']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['begining_balance_total']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['begining_balance_total']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['begining_balance_total']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['begining_balance_total']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-1 end                            --}}
                            {{--block-2 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>New Admission</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['new_admission']+$report_male_24to59['new_admission']+$report_female_6to23['new_admission']+$report_female_24to59['new_admission']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['new_admission']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['new_admission']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['new_admission']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['new_admission']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-2 end                            --}}
                            {{--block-3 start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Readmission after being default</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['readmission']+$report_male_24to59['readmission']+$report_female_6to23['readmission']+$report_female_24to59['readmission']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['readmission']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['readmission']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['readmission']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['readmission']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-3 end                            --}}
                            {{--block-Transfer_in start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Transfer-in (from other BSFP)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['transfer_in']+$report_male_24to59['transfer_in']+$report_female_6to23['transfer_in']+$report_female_24to59['transfer_in']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['transfer_in']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['transfer_in']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['transfer_in']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['transfer_in']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Transfer in end                            --}}
                            {{--block-Return From start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Return From MAM Treatment(from other BSFP)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['return_from']+$report_male_24to59['return_from']+$report_female_6to23['return_from']+$report_female_24to59['return_from']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['return_from']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['return_from']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['return_from']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['return_from']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-return from end                            --}}
                            {{--block- Total Admission start                            --}}
                            <tr style="background-color: #b8daff">
                                <td colspan="2"><strong>Total Admission during this period (B)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['this_period_total_enrollment']+$report_male_24to59['this_period_total_enrollment']+$report_female_6to23['this_period_total_enrollment']+$report_female_24to59['this_period_total_enrollment']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['this_period_total_enrollment']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['this_period_total_enrollment']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['this_period_total_enrollment']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['this_period_total_enrollment']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Total Admission end                            --}}
                            {{--block- Discharge start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Discharge (Age > 59 months & Get minimum 6 months support)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_age>59']+$report_male_24to59['discharge_age>59']+$report_female_6to23['discharge_age>59']+$report_female_24to59['discharge_age>59']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['discharge_age>59']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['discharge_age>59']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['discharge_age>59']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['discharge_age>59']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Discharge end                            --}}
                            {{--block- Defaulter start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Defaulted</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_defaulted']+$report_male_24to59['discharge_defaulted']+$report_female_6to23['discharge_defaulted']+$report_female_24to59['discharge_defaulted']}}</strong>
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
                            {{--block-Defaulter end                            --}}
                            {{--block- Death start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Death</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['discharge_death']+$report_male_24to59['discharge_death']+$report_female_6to23['discharge_death']+$report_female_24to59['discharge_death']}}</strong>
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
                            {{--block-Death end                            --}}
                            {{--block- Transfer out (to other BSFP) start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Transfer out (to other BSFP)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['transfer_out']+$report_male_24to59['transfer_out']+$report_female_6to23['transfer_out']+$report_female_24to59['transfer_out']}}</strong>
                                </td>
                            </tr>

                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['transfer_out']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['transfer_out']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['transfer_out']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['transfer_out']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Transfer out (to other BSFP) end                            --}}
                            {{--block- Transfer to SAM Treatment start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Transfer to SAM Treatment</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['transfer_to_sam']+$report_male_24to59['transfer_to_sam']+$report_female_6to23['transfer_to_sam']+$report_female_24to59['transfer_to_sam']}}</strong>
                                </td>
                            </tr>
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['transfer_to_sam']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['transfer_to_sam']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['transfer_to_sam']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['transfer_to_sam']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Transfer to SAM Treatment end                            --}}
                            {{--block- Transfer to MAM Treatment start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Transfer to MAM Treatment</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['transfer_to_mam']+$report_male_24to59['transfer_to_mam']+$report_female_6to23['transfer_to_mam']+$report_female_24to59['transfer_to_mam']}}</strong>
                                </td>
                            </tr>
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['transfer_to_mam']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['transfer_to_mam']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['transfer_to_mam']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['transfer_to_mam']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Transfer to MAM Treatment end                            --}}
                            {{--block- Other start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Others</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['others']+$report_male_24to59['others']+$report_female_6to23['others']+$report_female_24to59['others']}}</strong>
                                </td>
                            </tr>
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['others']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['others']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['others']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['others']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Others end                            --}}
                            {{--block- Exits start                            --}}
                            <tr style="background-color: #1cc09f">
                                <td colspan="2"><strong>Total exits during this period (C)</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['this_period_total_exit']+$report_male_24to59['this_period_total_exit']+$report_female_6to23['this_period_total_exit']+$report_female_24to59['this_period_total_exit']}}</strong>
                                </td>
                            </tr>
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['this_period_total_exit']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['this_period_total_exit']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['this_period_total_exit']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['this_period_total_exit']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-Exits end                            --}}
                            {{--block- At the  end start                            --}}
                            <tr style="background-color: #77ee77">
                                <td colspan="2"><strong>At the end (A+B)-C</strong></td>
                                <td>
                                    <strong>{{$report_male_6to23['end_of_month_total']+$report_male_24to59['end_of_month_total']+$report_female_6to23['end_of_month_total']+$report_female_24to59['end_of_month_total']}}</strong>
                                </td>
                            </tr>
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">6-23 month</td>
                                <td>Male</td>
                                <td>{{$report_male_6to23['end_of_month_total']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_6to23['end_of_month_total']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--row start--}}
                            <tr>
                                <td rowspan="2">24-59 month</td>
                                <td>Male</td>
                                <td>{{$report_male_24to59['end_of_month_total']}}</td>
                            </tr>
                            <tr>
                                <td>Female</td>
                                <td>{{$report_female_24to59['this_period_total_exit']}}</td>
                            </tr>
                            {{--row end                            --}}
                            {{--block-At the  end end                            --}}
                            </tbody>
                        </table>
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