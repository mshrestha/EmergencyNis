@extends('layouts.app')
@push('styles')
<style>
    .FixedHeightContainer {
        float: right;
        height: 250px;
        width: 250px;
        overflow: auto;
    }
</style>
@endpush
@section('content')
    <div class="wrapper wrapper-content  animated fadeInRight">


        <div class="row">
            <div class="col-md-8">
                <h1>DASHBOARD- Admin Dashboard ({{$month_year}})</h1>
            </div>
            <div class="btn-group pull-right" style="padding-bottom: 15px">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    {{$month_year}}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right FixedHeightContainer" role="menu">
                    @foreach($monthList as $month_list)
                        <li>
                            <a href="{{ url('/admin_ym/'.$month_list->year.'/'.$month_list->month) }}">{{$month_list->new_date}}</a>
                        </li>
                    @endforeach
                    <li class="divider"></li>
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6" style="background-color: #FECEC3">
                        <div class="row">
                            <h1 style="padding-left: 15px"><strong>OTP</strong></h1>

                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <span class="label label-info pull-right">Children</span>
                                        <h5>Admissions</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ $otp_dashboard['new_admission_total']}}

                                        </h1>
                                        <div class="stat-percent font-bold text-{{($otp_dashboard['new_admission_total']-$otp_dashboard_previous_month['new_admission_total']>=0)?'success':'danger'}}">{{ abs($otp_dashboard_previous_month['new_admission_total']-$otp_dashboard['new_admission_total'])}}
                                            <i class="fa fa-level-{{($otp_dashboard['new_admission_total']-$otp_dashboard_previous_month['new_admission_total']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Cure Rate</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($otp_dashboard['cure_rate'],2) }}
                                            %</h1>
                                        <div class="stat-percent font-bold text-{{($otp_dashboard['cure_rate']-$otp_dashboard_previous_month['cure_rate']>=0)?'success':'danger'}}">{{ abs($otp_dashboard_previous_month['cure_rate']-$otp_dashboard['cure_rate'])}}
                                            %
                                            <i class="fa fa-level-{{($otp_dashboard['cure_rate']-$otp_dashboard_previous_month['cure_rate']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Death Rate</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($otp_dashboard['death_rate'],2) }}
                                            %</h1>
                                        <div class="stat-percent font-bold text-{{($otp_dashboard['death_rate']-$otp_dashboard_previous_month['death_rate']>=0)?'success':'danger'}}">{{ abs($otp_dashboard_previous_month['death_rate']-$otp_dashboard['death_rate'])}}
                                            %
                                            <i class="fa fa-level-{{($otp_dashboard['death_rate']-$otp_dashboard_previous_month['death_rate']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">

                                        <h5>Admission Criteria</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <canvas id="doughnutChartOtp" width="200" height="225"
                                                style="margin: 18px auto 0"></canvas>

                                    </div>
                                </div>
                            </div>

                            <!--Second Line -->

                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Default Rate</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($otp_dashboard['default_rate'],2) }}
                                            %</h1>
                                        <div class="stat-percent font-bold text-{{($otp_dashboard['default_rate']-$otp_dashboard_previous_month['default_rate']>=0)?'success':'danger'}}">{{ abs($otp_dashboard_previous_month['default_rate']-$otp_dashboard['default_rate'])}}
                                            %
                                            <i class="fa fa-level-{{($otp_dashboard['default_rate']-$otp_dashboard_previous_month['default_rate']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Non Respondent Rate</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($otp_dashboard['nonrecover_rate'],2) }}
                                            %</h1>
                                        <div class="stat-percent font-bold text-{{($otp_dashboard['nonrecover_rate']-$otp_dashboard_previous_month['nonrecover_rate']>=0)?'success':'danger'}}">{{ abs($otp_dashboard_previous_month['nonrecover_rate']-$otp_dashboard['nonrecover_rate'])}}
                                            %
                                            <i class="fa fa-level-{{($otp_dashboard['nonrecover_rate']-$otp_dashboard_previous_month['nonrecover_rate']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Average Weight Gain</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($otp_dashboard['average_weight_gain'],2) }}
                                            <small>g/kg/day</small>
                                        </h1>
                                        <div class="stat-percent font-bold text-{{($otp_dashboard['average_weight_gain']-$otp_dashboard_previous_month['average_weight_gain']>=0)?'success':'danger'}}">{{ abs($otp_dashboard_previous_month['average_weight_gain']-$otp_dashboard['average_weight_gain'])}}
                                            %
                                            <i class="fa fa-level-{{($otp_dashboard['average_weight_gain']-$otp_dashboard_previous_month['average_weight_gain']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Avg. Length of Stay</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($otp_dashboard['average_length_of_stay'],2) }}
                                            <small>Days</small>
                                        </h1>
                                        <div class="stat-percent font-bold text-{{($otp_dashboard['average_length_of_stay']-$otp_dashboard_previous_month['average_length_of_stay']>=0)?'success':'danger'}}">{{ abs($otp_dashboard_previous_month['average_length_of_stay']-$otp_dashboard['average_length_of_stay'])}}
                                            %
                                            <i class="fa fa-level-{{($otp_dashboard['average_length_of_stay']-$otp_dashboard_previous_month['average_length_of_stay']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>OTP ADMISSIONS
                                    <small>{{$month_year}}</small>
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="flot-chart">
                                            {{--<div class="flot-chart-content" >--}}
                                            <canvas id="otpChildAdmission" class="flot-chart-content"></canvas>
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <ul class="stat-list">
                                            <li>
                                                <h2 class="no-margins ">{{ $otp_dashboard['new_admission_total']}}</h2>
                                                <small> Enrolled {{$month_year}}</small>
                                                {{--<div class="stat-percent"> <i class="fa fa-level-down text-navy"></i></div>--}}
                                                <div class="progress progress-mini">
                                                    <div style="width: 100%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins ">{{$otp_dashboard['discharge_criteria_exit_recovered']}}</h2>
                                                <small>Cured {{$month_year}}</small>
                                                {{--<div class="stat-percent">0% <i class="fa fa-bolt text-navy"></i></div>--}}
                                                <div class="progress progress-mini">
                                                    <div style="width: 100%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins ">{{$otp_dashboard['discharge_criteria_exit_death']}}</h2>
                                                <small>Death {{$month_year}}</small>
                                                {{--<div class="stat-percent">0% <i class="fa fa-bolt text-navy"></i></div>--}}
                                                <div class="progress progress-mini">
                                                    <div style="width: 100%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6" style="background-color: #FDFCE3">
                        <div class="row">
                            <h1 style="padding-left: 15px"><strong>TSFP</strong></h1>

                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <span class="label label-info pull-right">Children</span>
                                        <h5>Admissions</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ $tsfp_dashboard['total_admission']}}

                                        </h1>
                                        <div class="stat-percent font-bold text-{{($tsfp_dashboard['total_admission']-$tsfp_dashboard_previous_month['total_admission']>=0)?'success':'danger'}}">{{ abs($tsfp_dashboard_previous_month['total_admission']-$tsfp_dashboard['total_admission'])}}
                                            <i class="fa fa-level-{{($tsfp_dashboard['total_admission']-$tsfp_dashboard_previous_month['total_admission']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Cure Rate</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($tsfp_dashboard['cure_rate'],2) }}
                                            %</h1>
                                        <div class="stat-percent font-bold text-{{($tsfp_dashboard['cure_rate']-$tsfp_dashboard_previous_month['cure_rate']>=0)?'success':'danger'}}">{{ abs($tsfp_dashboard_previous_month['cure_rate']-$tsfp_dashboard['cure_rate'])}}
                                            %
                                            <i class="fa fa-level-{{($tsfp_dashboard['cure_rate']-$tsfp_dashboard_previous_month['cure_rate']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Death Rate</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($tsfp_dashboard['death_rate'],2) }}
                                            %</h1>
                                        <div class="stat-percent font-bold text-{{($tsfp_dashboard['death_rate']-$tsfp_dashboard_previous_month['death_rate']>=0)?'success':'danger'}}">{{ abs($tsfp_dashboard_previous_month['death_rate']-$tsfp_dashboard['death_rate'])}}
                                            %
                                            <i class="fa fa-level-{{($tsfp_dashboard['death_rate']-$tsfp_dashboard_previous_month['death_rate']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">

                                        <h5>Admission Criteria</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <canvas id="doughnutChartTsfp" width="200" height="225"
                                                style="margin: 18px auto 0"></canvas>

                                    </div>
                                </div>
                            </div>

                            <!--Second Line -->

                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Default Rate</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($tsfp_dashboard['default_rate'],2) }}
                                            %</h1>
                                        <div class="stat-percent font-bold text-{{($tsfp_dashboard['default_rate']-$tsfp_dashboard_previous_month['default_rate']>=0)?'success':'danger'}}">{{ abs($tsfp_dashboard_previous_month['default_rate']-$tsfp_dashboard['default_rate'])}}
                                            %
                                            <i class="fa fa-level-{{($tsfp_dashboard['default_rate']-$tsfp_dashboard_previous_month['default_rate']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Non Respondent Rate</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($tsfp_dashboard['nonrecover_rate'],2) }}
                                            %</h1>
                                        <div class="stat-percent font-bold text-{{($tsfp_dashboard['nonrecover_rate']-$tsfp_dashboard_previous_month['nonrecover_rate']>=0)?'success':'danger'}}">{{ abs($tsfp_dashboard_previous_month['nonrecover_rate']-$tsfp_dashboard['nonrecover_rate'])}}
                                            %
                                            <i class="fa fa-level-{{($tsfp_dashboard['nonrecover_rate']-$tsfp_dashboard_previous_month['nonrecover_rate']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Average Weight Gain</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($tsfp_dashboard['average_weight_gain'],2) }}
                                            <small>g/kg/day</small>
                                        </h1>
                                        <div class="stat-percent font-bold text-{{($tsfp_dashboard['average_weight_gain']-$tsfp_dashboard_previous_month['average_weight_gain']>=0)?'success':'danger'}}">{{ abs($tsfp_dashboard_previous_month['average_weight_gain']-$tsfp_dashboard['average_weight_gain'])}}
                                            %
                                            <i class="fa fa-level-{{($tsfp_dashboard['average_weight_gain']-$tsfp_dashboard_previous_month['average_weight_gain']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{--<span class="label label-success pull-right">Normal</span>--}}
                                        <h5>Avg. Length of Stay</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">{{ number_format($tsfp_dashboard['average_length_of_stay'],2) }}
                                            <small>Days</small>
                                        </h1>
                                        <div class="stat-percent font-bold text-{{($tsfp_dashboard['average_length_of_stay']-$tsfp_dashboard_previous_month['average_length_of_stay']>=0)?'success':'danger'}}">{{ abs($tsfp_dashboard_previous_month['average_length_of_stay']-$tsfp_dashboard['average_length_of_stay'])}}
                                            %
                                            <i class="fa fa-level-{{($tsfp_dashboard['average_length_of_stay']-$tsfp_dashboard_previous_month['average_length_of_stay']>=0)?'up':'down'}}"></i>
                                        </div>
                                        <small>{{$month_year}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>TSFP ADMISSIONS
                                    <small>{{$month_year}}</small>
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="flot-chart">
                                            {{--<div class="flot-chart-content" >--}}
                                            <canvas id="tsfpChildAdmission" class="flot-chart-content"></canvas>
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <ul class="stat-list">
                                            <li>
                                                <h2 class="no-margins ">{{ $tsfp_dashboard['total_admission']}}</h2>
                                                <small> Enrolled {{$month_year}}</small>
                                                {{--<div class="stat-percent"> <i class="fa fa-level-down text-navy"></i></div>--}}
                                                <div class="progress progress-mini">
                                                    <div style="width: 100%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins ">{{$tsfp_dashboard['discharge_cured']}}</h2>
                                                <small>Cured {{$month_year}}</small>
                                                {{--<div class="stat-percent">0% <i class="fa fa-bolt text-navy"></i></div>--}}
                                                <div class="progress progress-mini">
                                                    <div style="width: 100%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins ">{{$tsfp_dashboard['discharge_death']}}</h2>
                                                <small>Death {{$month_year}}</small>
                                                {{--<div class="stat-percent">0% <i class="fa fa-bolt text-navy"></i></div>--}}
                                                <div class="progress progress-mini">
                                                    <div style="width: 100%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- END OF INNER ROW -->
            </div>
        </div><!-- End of First Row -->
        <div class="row">
            <div class="col-lg-8" style="background-color: #dff0d8">
                <div class="row">
                    <h1 style="padding-left: 15px">BSFP</h1>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>BSFP Child</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{$other_dashboard['bsfp_new_admission']}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>BSFP PLW</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{$other_dashboard['bsfp_plw_new_admission']}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="background-color: #facc87">
                <div class="row">
                    <h1 style="padding-left: 15px">TSFP PLW</h1>
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>TSFP PLW</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{$other_dashboard['tsfp_plw_new_admission']}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row"></div>
    </div> <!-- wrapper -->
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<script>

    var otp_muac = JSON.parse('<?php echo json_encode($otp_dashboard['new_admission_muac']); ?>');
    var otp_whz = JSON.parse('<?php echo json_encode($otp_dashboard['new_admission_zscore']); ?>');
    var otp_oedema = JSON.parse('<?php echo json_encode($otp_dashboard['new_admission_oedema']); ?>');
    var otp_relapse = JSON.parse('<?php echo json_encode($otp_dashboard['new_admission_relapse']); ?>');

    var doughnutDataOtp = {
        labels: ["MUAC", "Z-Score", "Oedema", "Relapse"],
        datasets: [{
            data: [otp_muac, otp_whz, otp_oedema, otp_relapse],
            backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA", "#fedefe"]
        }]
    };

    var doughnutOptions = {
        responsive: true,
        legend: {
            display: true,

            labels: {
                boxWidth: 10
            }
        }
    };

    var tsfp_muac = JSON.parse('<?php echo json_encode($tsfp_dashboard['new_admission_muac']); ?>');
    var tsfp_whz = JSON.parse('<?php echo json_encode($tsfp_dashboard['new_admission_zscore']); ?>');
    var tsfp_oedema = JSON.parse('<?php echo json_encode($tsfp_dashboard['new_admission_oedema']); ?>');
    var tsfp_relapse = JSON.parse('<?php echo json_encode($tsfp_dashboard['new_admission_relapse']); ?>');

    var doughnutDataTsfp = {
        labels: ["MUAC", "Z-Score", "Oedema", "Relapse"],
        datasets: [{
            data: [tsfp_muac, tsfp_whz, tsfp_oedema, tsfp_relapse],
            backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA", "#fedefe"]
        }]
    };

    var ctxOtp = document.getElementById("doughnutChartOtp").getContext("2d");
        var ctxTsfp = document.getElementById("doughnutChartTsfp").getContext("2d");
    new Chart(ctxOtp, {type: 'doughnut', data: doughnutDataOtp, options: doughnutOptions});
        new Chart(ctxTsfp, {type: 'doughnut', data: doughnutDataTsfp, options: doughnutOptions});


</script>
<script>
    var ctxOtpBarchart = document.getElementById('otpChildAdmission').getContext('2d');
    var otpArraycount = JSON.parse('<?php echo json_encode($otp_dashboard['barchart_count']); ?>');
    var otpArraydate = JSON.parse('<?php echo json_encode($otp_dashboard['barchart_date']); ?>');
    var otpChildAdmission = new Chart(ctxOtpBarchart, {
        type: 'bar',
        data: {
            labels: otpArraydate,
            datasets: [{
                label: 'Admission',
                data: otpArraycount,
                backgroundColor: 'rgba(0, 128, 0, 0.6)',
                borderColor: 'rgba(200, 129, 214, 0.6)',
                pointBackgroundColor: 'rgba(20, 12, 21, 0.6)',
                borderWidth: 1
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            }
        }
    });

    var ctxTsfpBarchart = document.getElementById('tsfpChildAdmission').getContext('2d');
    var tsfpArraycount = JSON.parse('<?php echo json_encode($tsfp_dashboard['barchart_count']); ?>');
    var tsfpArraydate = JSON.parse('<?php echo json_encode($tsfp_dashboard['barchart_date']); ?>');
    var tsfpChildAdmission = new Chart(ctxTsfpBarchart, {
        type: 'bar',
        data: {
            labels: tsfpArraydate,
            datasets: [{
                label: 'Admission',
                data: tsfpArraycount,
                backgroundColor: 'rgba(0, 128, 0, 0.6)',
                borderColor: 'rgba(200, 129, 214, 0.6)',
                pointBackgroundColor: 'rgba(20, 12, 21, 0.6)',
                borderWidth: 1
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            }
        }
    });


</script>

@endpush