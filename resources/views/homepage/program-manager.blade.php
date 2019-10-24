@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h1></h1>
        </div>

    </div>
    <div class="row ">
        <div class="col-lg-12  border-bottom dashboard-header">
            <h2>Welcome to Emergency Nutrition System Dashboard </h2>
            <div class="small pull-left col-md-3 m-l-lg m-t-md">
                <strong>ADMISSION TREND</strong>
            </div>
            <div class="small pull-right col-md-6 m-t-md text-right">
                <strong>Each line</strong> represents the admission trend for individual OTP.
            </div>
            <div class="flot-chart m-b-xl">
                <div class="flot-chart-content" id="flot-dashboard5-chart"></div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h2>OTP Admissions</h2>
            <canvas id="canvas-performance" height="100px"></canvas>
        </div>
        <div class="col-lg-6">
            <h2>OTP Average Weight Gain</h2>
            <canvas id="canvas-avgweight" height="100px"></canvas>
        </div>
    </div>



    <div class="row">
        <div class="col-md-4">
            <div class="statistic-box">
                <h3>
                    OTP New Admission By Age
                </h3>
                <p>
                    Admissions for this month by age.
                </p>
                <div class="row text-center">

                    <div class="col-lg-9">
                        <canvas id="doughnutChart" width="280" height="270"
                                style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
                        <h5>Age</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>This chart is an accumulation of new addmissions of all the OTPs segregated by Age</small>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="statistic-box">
                <h3>
                    OTP New Admission By Gender
                </h3>
                <p>
                    Admissions for this month by Gender.
                </p>
                <div class="row text-center">
                    <div class="col-lg-9">
                        <canvas id="doughnutChart2" width="280" height="270"
                                style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
                        <h5>Gender</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>This chart is an accumulation of new addmissions of all the OTPs segregated by Gender</small>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="statistic-box">
                <h3>
                    OTP New Admission By Anthropometry
                </h3>
                <p>
                    Admissions for this month by Anthropometry.
                </p>
                <div class="row text-center">
                    <div class="col-lg-9">
                        <canvas id="doughnutChart3" width="280" height="270"
                                style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
                        <h5>Anthropometry</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>This chart is an accumulation of new addmissions of all the OTPs segregated by
                        Anthropometry
                    </small>
                </div>

            </div>
        </div>
        <div class="col-lg-6">


        </div>
    </div>


@endsection

@push('scripts')
<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.spline.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script src="js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="js/plugins/flot/jquery.flot.time.js"></script>
<script src="js/plugins/flot/curvedLines.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>

<!-- Peity -->
<script src="js/plugins/peity/jquery.peity.min.js"></script>
<script src="js/demo/peity-demo.js"></script>

<!-- Jvectormap -->
{{--<script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>--}}
{{--<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}

<!-- EayPIE -->
<script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="js/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
{{--<script src="js/plugins/chartJs/Chart.min.js"></script>--}}
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<script>
    $('#btn-sync-now').on('click', function () {
        $(this).hide();
        $('#syncing-msg').html('Syncing ...');
        $('#syncing-msg').show();

        sync_children();
    });

    $(document).ready(function () {

        //Data and options for OTP Admissions Line Graph
        var data1 = [[0, 4], [1, 8], [2, 5], [3, 10], [4, 4], [5, 16], [6, 5], [7, 11], [8, 6], [9, 11]];
        var data2 = [[0, 0], [1, 2], [2, 7], [3, 4], [4, 11], [5, 4], [6, 2], [7, 5], [8, 11], [9, 5]];
        var data3 = [[0, 5], [1, 7], [2, 12], [3, 9], [4, 16], [5, 9], [6, 7], [7, 10], [8, 16], [9, 10]];

        $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [data1, data2, data3],
            {
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        steps: false,
                    },
                    curvedLines: {
                        active: true,
                        monotonicFit: true
                    },
                    points: {
                        radius: 5,
                        show: true
                    },
                    shadowSize: false
                },
                legend: {
                    show: true,
                    labelFormatter: null, // or (fn: string, series object -> string)
                    labelBoxBorderColor: "#eeeeee",
                    noColumns: 3,
                    position: "ne",
                    margin: [10, 10],
                    backgroundColor: "#cc0000",
                    backgroundOpacity: 1,
                    container: null,
                },
                grid: {
                    hoverable: true,
                    clickable: true,

                    borderWidth: 0,
                    color: '#cccccc'
                },
                colors: ["#a3e1d4", "#9CC3DA", "#dedede"],
                xaxis: {
                    show: true,
                    ticks: [[1, "Jan"], [2, "Feb"], [3, "Mar"], [4, "Apr"], [5, "May"], [6, "Jun"], [7, "Jul"], [8, "Aug"], [9, "Sep"]],
                    min: 1,
                    max: 12
                },
                yaxis: {
                    show: true
                },
                tooltip: true
            }
        );

        //Doughnut charts starts here
        var child23 = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_23m + $doughnut_chart[0]->otp_admit_23f); ?>');
        var child24 = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_24m + $doughnut_chart[0]->otp_admit_24f); ?>');
        var child60 = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_60m + $doughnut_chart[0]->otp_admit_60f); ?>');
        var doughnutData = {
            labels: ["6-23m", "24-59m", ">59m"],
            datasets: [{
                data: [child23, child24, child60],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
            }]
        };
        var doughnutOptions = {
            responsive: false,
            legend: {
                display: true
            }
        };


        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});

        var male = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_male); ?>');
        var female = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_female); ?>');
        var others = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_others); ?>');
        var doughnutData = {
            labels: ["Male", "Female", "Other"],
            datasets: [{
                data: [male, female, others],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
            }]
        };

        var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});

        var muac = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_muac); ?>');
        var whz = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_whz); ?>');
        var both = JSON.parse('<?php echo json_encode($doughnut_chart[0]->otp_admit_both); ?>');

        var doughnutData = {
            labels: ["MUAC", "WHZ", "Both"],
            datasets: [{
                data: [muac, whz, both],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
            }]
        };

        var ctx4 = document.getElementById("doughnutChart3").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});


        var facility_name = JSON.parse('<?php echo json_encode($bar_chart['facility_id']); ?>');
        var cure_rate = JSON.parse('<?php echo json_encode($bar_chart['cure_rate']); ?>');
        var death_rate = JSON.parse('<?php echo json_encode($bar_chart['death_rate']); ?>');
        var default_rate = JSON.parse('<?php echo json_encode($bar_chart['default_rate']); ?>');
//        var cure_rate = [90, 87];
//        var default_rate = [7, 9];
//        var death_rate = [3, 4];
        var barChartData = {
//            labels: ['OTP1', 'OTP2'],
            labels: facility_name,
            datasets: [
                {
                    label: 'Death Rate',
                    backgroundColor: 'rgb(255, 99, 132, 0.5)',
//                    stack: 'Stack 0',
                    data: death_rate
                },
                {
                    label: 'Default Rate',
                    backgroundColor: 'rgb(54, 162, 235, 0.5)',
//                    stack: 'Stack 0',
                    data: default_rate
                },
                {
                    label: 'Cure Rate',
                    backgroundColor: 'rgb(75, 192, 192, 0.5)',
//                    stack: 'Stack 1',
                    data: cure_rate
                }]
        };

        var ctx5 = document.getElementById('canvas-performance').getContext('2d');
        new Chart(ctx5, {
            type: 'bar',
            data: barChartData,
            options: {
                title: {
                    display: false,
                    text: 'OTP Performance'
                },
//                tooltips: {
//                    mode: 'index',
//                    intersect: true
//                },
                responsive: true,
//                scales: {
//                    xAxes: [{
//                        stacked: true,
//                    }],
//                    yAxes: [{
//                        stacked: true
//                    }]
//                }
            }

        });


        //Stacked Bar data for OTP Performance
        var avg_weight_gain = JSON.parse('<?php echo json_encode($bar_chart['avg_weight_gain']); ?>');
        var barChartData2 = {
//			labels: ['OTP1', 'OTP2', 'OTP3', 'OTP4', 'OTP5', 'OTP6'],
            labels: facility_name,
            datasets: [{
                label: 'Avg Weight Gain',
                backgroundColor: 'rgb(75, 192, 192, 0.5)',
//                stack: 'Stack 1',
                data: avg_weight_gain
            }]

        };
        //Bar Data for Avg Weight Performance
        var ctx6 = document.getElementById('canvas-avgweight').getContext('2d');
        new Chart(ctx6, {
            type: 'bar',
            data: barChartData2,
            options: {
                title: {
                    display: false,
                    text: 'OTP Performance'
                },
//                tooltips: {
//                    mode: 'index',
//                    intersect: false
//                },
                responsive: true,

//                scales: {
//                    xAxes: [{
//                        stacked: true,
//                    }],
//                    yAxes: [{
//                        stacked: true
//                    }]
//                }
            }
        });

    });


</script>
<!-- Mapping script ends here -->

@endpush

