@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10">
            <h1>Welcome to Emergency Nutrition System Dashboard </h1>
        </div>
        <div class="col-lg-2">
            <div class="btn-group" style="position: absolute; right: 10px; top: 10px; ">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    {{$month_year}}
                    <span class="caret"></span>
                </button>

                <ul class="dropdown-menu pull-right" role="menu">
                    @foreach($cache_data as $month_list)
                        <li>
                            <a href="{{ url('/program-manager_ym/'.$month_list->year.'/'.$month_list->month) }}">{{date('F', mktime(0, 0, 0, $month_list->month, 10)).'-'.$month_list->year}}</a>
                        </li>
                    @endforeach
                        <li class="divider"></li>
                    <li><a href="{{ url('/program-manager')}}">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-12  border-bottom dashboard-header">
            {{--<h2>Welcome to Emergency Nutrition System Dashboard </h2>--}}
            <div class="small pull-left col-md-3 m-l-lg m-t-md">
                <strong>ADMISSION TREND </strong>
                <small> Last 12 months</small>
            </div>
            <div class="small pull-right col-md-6 m-t-md text-right">
                <strong>Each line</strong> represents the admission trend for individual OTP.
            </div>
            <div class="flot-chart-content">
                <canvas id="childAdmission"></canvas>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4">
            <h2>OTP Performance
                
                
            </h2>
            <canvas id="canvas-performance" height="100px"></canvas>
        </div>
        <div class="col-lg-4">
            <h2>OTP Average Weight Gain
                
            </h2>
            <canvas id="canvas-avgweight" height="100px"></canvas>
        </div>
        <div class="col-lg-4">
            <h2>OTP Average Length of Stay
                
            </h2>
            <canvas id="canvas-avglengthofstay" height="100px"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="statistic-box">
                <h3>
                    OTP New Admission By Age
                </h3>
                <p>
                    Admissions for {{$month_year}} by age.
                </p>
                <div class="row text-center">

                    <div class="col-lg-9">
                        <canvas id="doughnutChart" width="280" height="270"
                                style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
                        <h5>Age</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>This chart is an accumulation of new admissions of all the OTPs segregated by Age</small>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="statistic-box">
                <h3>
                    OTP New Admission By Gender
                </h3>
                <p>
                    Admissions for {{$month_year}} by Gender.
                </p>
                <div class="row text-center">
                    <div class="col-lg-9">
                        <canvas id="doughnutChart2" width="280" height="270"
                                style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
                        <h5>Gender</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>This chart is an accumulation of new admissions of all the OTPs segregated by Gender</small>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="statistic-box">
                <h3>
                    OTP New Admission By Anthropometry
                </h3>
                <p>
                    Admissions for {{$month_year}} Anthropometry.
                </p>
                <div class="row text-center">
                    <div class="col-lg-9">
                        <canvas id="doughnutChart3" width="280" height="270"
                                style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
                        <h5>Anthropometry</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>This chart is an accumulation of new admissions of all the OTPs segregated by
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
//Line chart Admission trend start
        var obj = JSON.parse('<?php echo json_encode($line_chart); ?>');
        var ctx = document.getElementById('childAdmission').getContext('2d');

        function getMissing(a, b) {
            var missings = [];
            var matches = false;

            for (var i = 0; i < a.length; i++) {
                matches = false;
                for (var e = 0; e < b.length; e++) {
                    if (a[i] === b[e]) matches = true;
                }
                if (!matches) missings.push(a[i]);
            }
            return missings;
        }

        var all_labels = [];
        var admission = [];
        var datasets = [];
        var labels = [];
        var oos = [];
        var main_data = {};
        for (i = 0; i < obj.length; i++) {
            if (admission.indexOf(obj[i].Facility_name) === -1) {
                
//                admission.push(obj[i].Facility_name.split("/")[1]);
                admission.push(obj[i].Facility_name);
            }
        }
        for (i = 0; i < obj.length; i++) {
            if (all_labels.indexOf(obj[i].Month) === -1) {
                all_labels.push(obj[i].Month);
            }
        }
        admission.forEach(function (admit) {
            var labels = [];
            var oos = [];
            obj.forEach(function (report) {
                if (report.Facility_name === admit) {
                    oos.push(report.TotalAdmission)
                    labels.push(report.Month);
                }
            });
            missing = getMissing(all_labels, labels);
            if (missing) {
                missing.forEach(function (missed) {
                    labels.push(missed);
                    oos.push(0)
                });
            }
            data = {label: admit, data: oos}
            datasets.push(data);
        });
        main_data = {labels: all_labels, datasets: datasets, backgroundColor: "transparent"}
//            console.log(main_data);
        var options = {
//            bezierCurve : false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        precision: 0
                    }
                }]
            },
            elements: {
                line: {
                    tension: 0
                }
            }

//            title: {
//                display: true,
//                text: 'Admission Trend',
//                fontStyle: 'bold',
//                fontColor: 'blue',
//                position: 'top',
//                fontSize: 14
//            }
        };

        myLineChart = new Chart(ctx, {
            type: 'line',
            data: main_data,
            options: options
        });
//End of Line chart Admission trend start


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
        var non_respondent_rate = JSON.parse('<?php echo json_encode($bar_chart['nonrespondent_rate']); ?>');
//        var cure_rate = [90, 87];
//        var default_rate = [7, 9];
//        var death_rate = [3, 4];
        var barChartData = {
//            labels: ['OTP1', 'OTP2'],
            labels: facility_name,
            datasets: [
                {
                    label: 'Non Respondant Rate',
                    backgroundColor: 'rgb(251, 241, 198, 0.5)',
//                    stack: 'Stack 1',
                    data: non_respondent_rate
                },
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
                }
                
            ]
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
                responsive: true,
            }
        });
        
        var avg_length_of_stay = JSON.parse('<?php echo json_encode($bar_chart['avg_length_stay']); ?>');
        var barChartData2 = {
            labels: facility_name,
            datasets: [{
                label: 'Avg Length of Stay',
                backgroundColor: 'rgb(75, 192, 192, 0.5)',
                data: avg_length_of_stay
            }]

        };
        //Bar Data for Avg Length of Stay
        var ctx7 = document.getElementById('canvas-avglengthofstay').getContext('2d');
        new Chart(ctx7, {
            type: 'bar',
            data: barChartData2,
            options: {
                title: {
                    display: false,
                    text: 'Avg Length of Stay'
                },
                responsive: true,
            }
        });

    });


</script>
<!-- Mapping script ends here -->

@endpush

