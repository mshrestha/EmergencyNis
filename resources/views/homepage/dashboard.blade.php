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
                <h1><strong>DASHBOARD -
                        {{ Auth::user()->facility->facility_id.' ('.Auth::user()->facility->name.')' }}
                    </strong></h1>
            </div>
            <div class="btn-group pull-right" style="padding-bottom: 15px">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Select Month
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right FixedHeightContainer" role="menu">
                    @foreach($monthList as $month_list)
                        <li>
                            <a href="{{ url('/program-user_ym/'.$month_list->year.'/'.$month_list->month) }}">{{$month_list->new_date}}</a>
                        </li>
                    @endforeach
                    <li class="divider"></li>
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6" style="background-color: #FECEC3">
                    <div class="row">
                        <h1 style="padding-left: 15px">OTP</h1>

                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">Children</span>
                                    <h5>Admissions</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ $otp_dashboard['new_admission_total']}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Cure Rate</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($otp_dashboard['cure_rate'],2) }}
                                        %</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Death Rate</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($otp_dashboard['death_rate'],2) }}
                                        %</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Admission Criteria</h5>
                                </div>
                                <div class="ibox-content">
                                    <canvas id="doughnutChartOtp" width="200" height="190"
                                            style="margin: 18px auto 0"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Default Rate</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($otp_dashboard['default_rate'],2) }}
                                        %</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Non Respondent Rate</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($otp_dashboard['nonrecover_rate'],2) }}
                                        %</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Average Weight Gain</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($otp_dashboard['average_weight_gain'],2) }}
                                        <small>g/kg/day</small>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Avg. Length of Stay</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($otp_dashboard['average_length_of_stay'],2) }}
                                        Days</h1>
                                </div>
                            </div>
                        </div>
                    </div><!-- END OF INNER ROW -->
                </div>
                <div class="col-lg-6" style="background-color: #FDFCE3">
                    <div class="row">
                        <h1 style="padding-left: 15px">TSFP</h1>

                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">Children</span>
                                    <h5>Admissions</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ $tsfp_dashboard['total_admission']}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Cure Rate</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($tsfp_dashboard['cure_rate'],2) }}
                                        %</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Death Rate</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($tsfp_dashboard['death_rate'],2) }}
                                        %</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Admission Criteria</h5>
                                </div>
                                <div class="ibox-content">
                                    <canvas id="doughnutChartTsfp" width="200" height="190"
                                            style="margin: 18px auto 0"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Default Rate</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($tsfp_dashboard['default_rate'],2) }}
                                        %</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Non Respondent Rate</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($tsfp_dashboard['nonrecover_rate'],2) }}
                                        %</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Average Weight Gain</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($tsfp_dashboard['average_weight_gain'],2) }}
                                        <small>g/kg/day</small>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Avg. Length of Stay</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">{{ number_format($tsfp_dashboard['average_length_of_stay'],2) }}
                                        Days</h1>
                                </div>
                            </div>
                        </div>
                    </div><!-- END OF INNER ROW -->
                </div>
            </div>
        </div><!-- End of First Row -->

        <div class="row"></div>
    </div> <!-- wrapper -->
@endsection

@push('scripts')
<!-- ChartJS-->
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<script>

    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.warning('', 'Welcome to Emergency Nutrition');

    }, 1300);

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

    var doughnutOptions = {
        responsive: true,
        legend: {
            display: true,

            labels: {
                boxWidth: 10
            }
        }
    };
    var ctxOtp = document.getElementById("doughnutChartOtp").getContext("2d");
    var ctxTsfp = document.getElementById("doughnutChartTsfp").getContext("2d");
    new Chart(ctxOtp, {type: 'doughnut', data: doughnutDataOtp, options: doughnutOptions});
    new Chart(ctxTsfp, {type: 'doughnut', data: doughnutDataTsfp, options: doughnutOptions});
</script>


@endpush
