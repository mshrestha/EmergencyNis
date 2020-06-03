@extends('monthly_mail.app_opendashboard')
@push('styles')
@endpush
@section('content')
    <?php
    ?>
    <div class="row">
        <div class="col-lg-12 border-bottom">
            <div class="col-lg-9 ">
                <div class="col-lg-12 center">
                    <h1>Welcome to Emergency Nutrition System </h1>
                </div>
                <div class="col-lg-12">
                </div>
            </div>

            <div class="col-lg-3 ">
                <div class=" pull-right">
                    {{--<img src="./img/logo-nutrition.png" width="200px"/>--}}
                </div>
            </div>

        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-12 col-sm-12 col-xl-12 col-md-12 border-bottom dashboard-header">
            <div class="small pull-left col-md-3 m-l-lg m-t-md">
                <strong>ADMISSION TREND </strong>
            </div>
            <div class="row text-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12" style="width:1200px;height:300px;">
                    <canvas id="childAdmission"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row border-bottom">
        <h2>OTP New Admission
{{--            <small> for {{'January-2020'}}</small>--}}
        </h2>
        <table class="col-md-12">
            <tr>
                <td class="col-md-4"><h3>By Age</h3></td>
                <td class="col-md-4"><h3>By Gender</h3></td>
                <td class="col-md-4"><h3>By Anthropometry</h3></td>
            </tr>
            <tr>
                <td>
                    <canvas id="doughnutChart" width="400" height="400"
                    ></canvas>
                </td>
                <td>
                    <canvas id="doughnutChart2" width="400" height="400"
                    ></canvas>

                </td>
                <td>
                    <canvas id="doughnutChart3" width="400" height="400"
                    ></canvas>

                </td>
            </tr>
            <tr>
                <td style="text-align: center">Age</td>
                <td style="text-align: center">Gender</td>
                <td style="text-align: center">Anthropometry</td>
            </tr>
        </table>
    </div>



@endsection

@push('scripts')
<!-- ChartJS-->
{{--<script src="js/plugins/chartJs/Chart.min.js"></script>--}}
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<script>

    $(document).ready(function () {
//Line chart Admission trend start
//        var months = JSON.parse('["Dec-19","Nov-19","Oct-19","Sep-19","Aug-19","Jul-19","Jun-19","May-19","Apr-19","Mar-19","Feb-19","Jan-19"]');
//        var obj_otp = JSON.parse('["927","1625","2757","2466","1544","2373","2406","2593","2179","1715","1742","2528"]');
//        var obj_bsfp = JSON.parse('["7096","8612","12731","10541","8554","13620","5195","3111","4299","2997","3598","6482"]');
//        var obj_tsfp = JSON.parse('["2476","3833","4428","4621","3081","4984","3537","3478","3092","2264","2039","3059"]');
//        var obj_tsfp_plw = JSON.parse('["78","176","264","241","175","199","115","398","404","60","97","124"]');
//        var obj_sc = JSON.parse('["14","30","29","44","16","34","23","37","54","42","31","48"]');
        var months = JSON.parse('<?php echo json_encode($months); ?>');
        var obj_otp = JSON.parse('<?php echo json_encode($line_chart['otp']); ?>');
        var obj_bsfp = JSON.parse('<?php echo json_encode($line_chart['bsfp']); ?>');
        var obj_tsfp = JSON.parse('<?php echo json_encode($line_chart['tsfp']); ?>');
        var obj_tsfp_plw = JSON.parse('<?php echo json_encode($line_chart['tsfp_plw']); ?>');
        var obj_sc = JSON.parse('<?php echo json_encode($line_chart['sc']); ?>');

        var ctx = document.getElementById('childAdmission').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months.reverse(),
                datasets: [{
                    label: 'OTP',
                    data: obj_otp.reverse(),
                    backgroundColor: '#ff0000',
                    borderColor: '#ff0000',
                    borderDash: [5, 5],
                    borderWidth: 2,
                    fill: false,
//                    lineTension: 0
                },
                    {
                        label: 'BSFP',
                        data: obj_bsfp.reverse(),
//                        backgroundColor: window.chartColors.blue,
                        backgroundColor: '#0000FF',
                        borderColor: '#0000FF',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'TSFP-Child',
                        data: obj_tsfp.reverse(),
                        backgroundColor: '#008000',
                        borderColor: '#008000',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'TSFP-PLW',
                        data: obj_tsfp_plw.reverse(),
                        backgroundColor: '#ffff00',
                        borderColor: '#ffff00',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'SC',
                        data: obj_sc.reverse(),
                        backgroundColor: '#800080',
                        borderColor: '#800080',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
//                bezierCurve : false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

// Doughnut charts starts here
//        var child23 = JSON.parse('["30"]');
//        var child24 = JSON.parse('["24"]');
//        var child60 = JSON.parse('["34"]');
        var child23 = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_23']); ?>');
        var child24 = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_24']); ?>');
        var child60 = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_60']); ?>');
        var doughnutData1 = {
            labels: ["6-23m", "24-59m", ">59m"],
            datasets: [{
                data: [child23, child24, child60],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
            }]
        };
        var ctxd1 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctxd1, {type: 'doughnut', data: doughnutData1, options: doughnutOptions});

//        var male = JSON.parse('["14"]');
//        var female = JSON.parse('["20"]');
//        var others = JSON.parse('["10"]');
        var male = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_male']); ?>');
        var female = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_female']); ?>');
        var others = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_others']); ?>');
        var doughnutData2 = {
            labels: ["Male", "Female"],
            datasets: [{

                data: [male, female],
                backgroundColor: ["#9CC3DA", "#a3e1d4"]

            }]
        };
        var ctxd2 = document.getElementById("doughnutChart2").getContext("2d");
        new Chart(ctxd2, {type: 'doughnut', data: doughnutData2, options: doughnutOptions});

//        var muac = JSON.parse('["29"]');
//        var whz = JSON.parse('["24"]');
//        var both = JSON.parse('["10"]');
        var muac = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_muc']); ?>');
        var whz = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_wfh']); ?>');
        var edema = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_edema']); ?>');
        var relapse = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_relapse']); ?>');
        var doughnutData3 = {
            labels: ["MUAC", "WHZ", "Edema", "Relapse"],
            datasets: [{
                data: [muac, whz, edema, relapse],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA", "#1CFFDA", "#5C00DA"]
            }]
        };
        var ctxd3 = document.getElementById("doughnutChart3").getContext("2d");
        new Chart(ctxd3, {type: 'doughnut', data: doughnutData3, options: doughnutOptions});

        var doughnutOptions = {
            responsive: false,
            legend: {
                display: true
            }
        };
    });
//End of Line chart Admission trend
</script>
<!-- Mapping script ends here -->

@endpush


