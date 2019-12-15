@extends('layouts.app_opendashboard')
@push('styles')
<style>
    .modal {
        border: 1px solid black;
        background-color: rgba(255, 255, 255, 1.0);
    }
</style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12 border-bottom">
            <div class="col-lg-9 ">
                <div class="col-lg-12 center">
                    <h1>Welcome to Emergency Nutrition System </h1>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('open_dashboard_ym') }}" class="form-horizontal" method="get">

                        <div class="form-group">
                            <select name="program_partner" class="btn btn">
                                <option value="">Program Partner</option>
                                @foreach($program_partners as $pp)
                                    <option value="{{ $pp }}">{{ $pp }}</option>
                                @endforeach
                            </select>
                            <select name="partner" class="btn btn">
                                <option value="">Implementing Partner</option>
                                @foreach($partners as $p)
                                    <option value="{{ $p }}">{{ $p }}</option>
                                @endforeach
                            </select>
                            <select name="camp" class="btn btn">
                                <option value="">Camp</option>
                                @foreach($camps as $c)
                                    <option value="{{ $c }}">{{ $c }}</option>
                                @endforeach
                            </select>
                            <select name="period" required class="btn ">
                                {{--<option value="">Period</option>--}}
                                @foreach($periods as $month_list)
                                    <option value="{{ $month_list }}">{{ $month_list }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn "><i class="fa fa-search"></i>Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-3 ">
                <div class=" pull-right">
                    <img src="./img/logo-nutrition.png" width="200px"/>
                </div>
            </div>

        </div>
        <div class="row">{{$filter_message}}
        <div class="pull-right">
            @if (Auth::check())
                <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Log out</a>
            @else
                <a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Log in</a>
            @endif
        </div>
        </div>


    </div>
    <div class="row ">
        <div class="col-lg-12  border-bottom dashboard-header">
            {{--<h2>Welcome to Emergency Nutrition System Dashboard </h2>--}}
            <div class="small pull-left col-md-3 m-l-lg m-t-md">
                <strong>ADMISSION TREND </strong>
            </div>
            <button id = 'btn' class= 'btn btn-info pull-right'>
                {{--Zoom View <i class="fa fa-window-maximize" aria-hidden="true"></i>--}}
                Zoom View <i class="icon-zoom-in"></i>
            </button>


            <div class="flot-chart-content">
                <canvas id="childAdmission"></canvas>
            </div>
        </div>

        <div id = "myModal" class="modal">
            <div class="modalContent">
                <span class = "close"> &times; </span>
                <canvas id="childAdmissionModal"></canvas>
            </div>
        </div>
        </body>
    </div>

    <div class="row border-bottom">
        <div class="col-lg-10">
            <h2>OTP Performance
                <small> for {{$month_year}}</small>
            </h2>
            <canvas id="canvas-performance" height="100px"></canvas>
        </div>
        <div class="col-lg-2">
            <h4>Cumulative Rate</h4>
            <ul class="stat-list">
                <li>
                    <small>Non Respondant Rate</small>
                    <div class="stat-percent" id="cumulative_nonRecoveredRate"> </div>
                    <div class="progress progress-mini">
                        <div id="cumulative_nonRecoveredRate_bar" class="progress-bar"></div>
                    </div>
                </li>
                <li>
                    <small> Death rate</small>
                    <div class="stat-percent" id="cumulative_deathRate"> </div>
                    <div class="progress progress-mini">
                        <div id="cumulative_deathRate_bar" class="progress-bar"></div>
                    </div>
                </li>
                <li class="">
                    <small>Default Rate</small>
                    <div class="stat-percent" id="cumulative_defaultRate"> </div>
                    <div class="progress progress-mini">
                        <div id="cumulative_defaultRate_bar" class="progress-bar"></div>
                    </div>
                </li>
                <li class="">
                    <small>Cure Rate</small>
                    <div class="stat-percent" id="cumulative_curedRate"> </div>
                    <div class="progress progress-mini">
                        <div id="cumulative_curedRate_bar"  class="progress-bar"></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-lg-10">
            <h2>TSFP Performance
                <small> for {{$month_year}}</small>
            </h2>
            <canvas id="canvas-tsfp-performance" height="100px"></canvas>
        </div>
        <div class="col-lg-2">
            <h4>Cumulative Rate</h4>
            <ul class="stat-list">
                <li>
                    <small>Non Respondant Rate</small>
                    <div class="stat-percent" id="tsfpcumulative_nonRecoveredRate"> </div>
                    <div class="progress progress-mini">
                        <div id="tsfpcumulative_nonRecoveredRate_bar" class="progress-bar"></div>
                    </div>
                </li>
                <li>
                    <small> Death rate</small>
                    <div class="stat-percent" id="tsfpcumulative_deathRate"> </div>
                    <div class="progress progress-mini">
                        <div id="tsfpcumulative_deathRate_bar" class="progress-bar"></div>
                    </div>
                </li>
                <li class="">
                    <small>Default Rate</small>
                    <div class="stat-percent" id="tsfpcumulative_defaultRate"> </div>
                    <div class="progress progress-mini">
                        <div id="tsfpcumulative_defaultRate_bar" class="progress-bar"></div>
                    </div>
                </li>
                <li class="">
                    <small>Cure Rate</small>
                    <div class="stat-percent" id="tsfpcumulative_curedRate"> </div>
                    <div class="progress progress-mini">
                        <div id="tsfpcumulative_curedRate_bar"  class="progress-bar"></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="row border-bottom">
        <h2>OTP New Admission
            <small> for {{$month_year}}</small>
        </h2>
        <div class="col-md-4">
            <div class="statistic-box">
                <h3>
                    By Age
                </h3>
                {{--<p>--}}
                {{--for {{$month_year}} by age.--}}
                {{--</p>--}}
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
                    By Gender
                </h3>
                {{--<p>--}}
                {{--for {{$month_year}} by Gender.--}}
                {{--</p>--}}
                <div class="row text-center">
                    <div class="col-lg-9">
                        <canvas id="doughnutChart2" width="280" height="270"
                                style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
                        <h5>Gender</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>This chart is an accumulation of new admissions of all the OTPs segregated by Gender
                    </small>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="statistic-box">
                <h3>
                    By Anthropometry
                </h3>
                {{--<p>--}}
                {{--for {{$month_year}} Anthropometry.--}}
                {{--</p>--}}
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
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    borderDash: [5, 5],
                    borderWidth: 2,
                    fill: false,
//                    lineTension: 0
                },
                    {
                        label: 'BSFP',
                        data: obj_bsfp.reverse(),
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'TSFP-Child',
                        data: obj_tsfp.reverse(),
                        backgroundColor: window.chartColors.orange,
                        borderColor: window.chartColors.orange,
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'TSFP-PLW',
                        data: obj_tsfp_plw.reverse(),
                        backgroundColor: window.chartColors.green,
                        borderColor: window.chartColors.green,
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'SC',
                        data: obj_sc.reverse(),
                        backgroundColor: window.chartColors.purple,
                        borderColor: window.chartColors.purple,
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
        var ctx_modal = document.getElementById('childAdmissionModal').getContext('2d');
        var myChartModal = new Chart(ctx_modal, {
            type: 'line',
            data: {
                labels: months.reverse(),
                datasets: [{
                    label: 'OTP',
                    data: obj_otp.reverse(),
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    borderDash: [5, 5],
                    borderWidth: 2,
                    fill: false,
                    lineTension: 0
                },
                    {
                        label: 'BSFP',
                        data: obj_bsfp.reverse(),
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false,
                        lineTension: 0
                    },
                    {
                        label: 'TSFP-Child',
                        data: obj_tsfp.reverse(),
                        backgroundColor: window.chartColors.orange,
                        borderColor: window.chartColors.orange,
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false,
                        lineTension: 0
                    },
                    {
                        label: 'TSFP-PLW',
                        data: obj_tsfp_plw.reverse(),
                        backgroundColor: window.chartColors.green,
                        borderColor: window.chartColors.green,
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false,
                        lineTension: 0
                    },
                    {
                        label: 'SC',
                        data: obj_sc.reverse(),
                        backgroundColor: window.chartColors.purple,
                        borderColor: window.chartColors.purple,
                        borderDash: [5, 5],
                        borderWidth: 2,
                        fill: false,
                        lineTension: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                bezierCurve : false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
//                animation: {
//                    duration: 1,
//                    onComplete: function() {
//                        var chartInstance = this.chart,
//                            ctx = chartInstance.ctx;
//
//                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
//                        ctx.textAlign = 'center';
//                        ctx.textBaseline = 'bottom';
//
//                        this.data.datasets.forEach(function(dataset, i) {
//                            var meta = chartInstance.controller.getDatasetMeta(i);
//                            meta.data.forEach(function(line, index) {
//                                if (dataset.data[index] > 0) {
//                                    var data = dataset.data[index];
//                                    ctx.fillText(data, line._model.x, line._model.y);
//                                }
//                            });
//                        });
//                    }
//                }
            }
        });

        var modal = document.getElementById("myModal");
        var btn = document.getElementById("btn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function () {
            modal.style.display = 'block';
            renderChart();
        }

        span.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }


//End of Line chart Admission trend
        //Doughnut charts starts here
        var child23 = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_23']); ?>');
        var child24 = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_24']); ?>');
        var child60 = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_60']); ?>');
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

        var male = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_male']); ?>');
        var female = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_female']); ?>');
        var others = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_others']); ?>');
        var doughnutData = {
            labels: ["Male", "Female"],
            datasets: [{

                data: [male, female],
                backgroundColor: ["#9CC3DA", "#a3e1d4"]

            }]
        };

        var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});

        var muac = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_muc']); ?>');
        var whz = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_wfh']); ?>');
        var both = JSON.parse('<?php echo json_encode($doughnut_chart['otp_admit_both']); ?>');

        var doughnutData = {
            labels: ["MUAC", "WHZ", "Both"],
            datasets: [{
                data: [muac, whz, both],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
            }]
        };

        var ctx4 = document.getElementById("doughnutChart3").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});


    });

    var facility_name = JSON.parse('<?php echo json_encode($bar_chart['campSettlement']); ?>');
    var cure_rate = JSON.parse('<?php echo json_encode($bar_chart['curedRate']); ?>');
    var death_rate = JSON.parse('<?php echo json_encode($bar_chart['deathRate']); ?>');
    var default_rate = JSON.parse('<?php echo json_encode($bar_chart['defaultRate']); ?>');
    var non_respondent_rate = JSON.parse('<?php echo json_encode($bar_chart['nonRecoveredRate']); ?>');

    var cumulative_curedRate = JSON.parse('<?php echo json_encode($bar_chart['cumulative_curedRate']); ?>');
    var cumulative_deathRate = JSON.parse('<?php echo json_encode($bar_chart['cumulative_deathRate']); ?>');
    var cumulative_defaultRate = JSON.parse('<?php echo json_encode($bar_chart['cumulative_defaultRate']); ?>');
    var cumulative_nonRecoveredRate = JSON.parse('<?php echo json_encode($bar_chart['cumulative_nonRecoveredRate']); ?>');

    document.getElementById('cumulative_curedRate').innerHTML = cumulative_curedRate.toFixed(2)+'%';
    document.getElementById('cumulative_curedRate_bar').style.width = cumulative_curedRate.toFixed(2)+'%';
    document.getElementById('cumulative_deathRate').innerHTML = cumulative_deathRate.toFixed(2)+'%';
    document.getElementById('cumulative_deathRate_bar').style.width = cumulative_deathRate.toFixed(2)+'%';
    document.getElementById('cumulative_defaultRate').innerHTML = cumulative_defaultRate.toFixed(2)+'%';
    document.getElementById('cumulative_defaultRate_bar').style.width = cumulative_defaultRate.toFixed(2)+'%';
    document.getElementById('cumulative_nonRecoveredRate').innerHTML = cumulative_nonRecoveredRate.toFixed(2)+'%';
    document.getElementById('cumulative_nonRecoveredRate_bar').style.width = cumulative_nonRecoveredRate.toFixed(2)+'%';
    var barChartData = {
        labels: facility_name,
        datasets: [
            {
                label: 'Non Respondant Rate',
                backgroundColor: 'rgb(0, 48, 143, 0.9)',
//                    stack: 'Stack 1',

                data: non_respondent_rate,

            },
            {
                label: 'Death Rate',
                backgroundColor: 'rgb(255, 0, 0, 0.9)',
//                    stack: 'Stack 0',
                data: death_rate
            },
            {
                label: 'Default Rate',
                backgroundColor: 'rgb(233, 214, 107, 0.9)',
//                    stack: 'Stack 0',
                data: default_rate
            },
            {
                label: 'Cure Rate',
                backgroundColor: 'rgb(0, 106, 78, 0.9)',
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
            maintainAspectRatio: false,
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
    //Stacked Bar data for OTP Performance end

    //Bar chart for TSFP Performance Start
    var tsfpfacility_name = JSON.parse('<?php echo json_encode($bar_chart_tsfp['campSettlement']); ?>');
    var tsfpcure_rate = JSON.parse('<?php echo json_encode($bar_chart_tsfp['curedRate']); ?>');
    var tsfpdeath_rate = JSON.parse('<?php echo json_encode($bar_chart_tsfp['deathRate']); ?>');
    var tsfpdefault_rate = JSON.parse('<?php echo json_encode($bar_chart_tsfp['defaultRate']); ?>');
    var tsfpnon_respondent_rate = JSON.parse('<?php echo json_encode($bar_chart_tsfp['nonRecoveredRate']); ?>');

    var tsfpcumulative_curedRate = JSON.parse('<?php echo json_encode($bar_chart_tsfp['cumulative_curedRate']); ?>');
    var tsfpcumulative_deathRate = JSON.parse('<?php echo json_encode($bar_chart_tsfp['cumulative_deathRate']); ?>');
    var tsfpcumulative_defaultRate = JSON.parse('<?php echo json_encode($bar_chart_tsfp['cumulative_defaultRate']); ?>');
    var tsfpcumulative_nonRecoveredRate = JSON.parse('<?php echo json_encode($bar_chart_tsfp['cumulative_nonRecoveredRate']); ?>');

    document.getElementById('tsfpcumulative_curedRate').innerHTML = tsfpcumulative_curedRate.toFixed(2)+'%';
    document.getElementById('tsfpcumulative_curedRate_bar').style.width = tsfpcumulative_curedRate.toFixed(2)+'%';
    document.getElementById('tsfpcumulative_deathRate').innerHTML = tsfpcumulative_deathRate.toFixed(2)+'%';
    document.getElementById('tsfpcumulative_deathRate_bar').style.width = tsfpcumulative_deathRate.toFixed(2)+'%';
    document.getElementById('tsfpcumulative_defaultRate').innerHTML = tsfpcumulative_defaultRate.toFixed(2)+'%';
    document.getElementById('tsfpcumulative_defaultRate_bar').style.width = tsfpcumulative_defaultRate.toFixed(2)+'%';
    document.getElementById('tsfpcumulative_nonRecoveredRate').innerHTML = tsfpcumulative_nonRecoveredRate.toFixed(2)+'%';
    document.getElementById('tsfpcumulative_nonRecoveredRate_bar').style.width = tsfpcumulative_nonRecoveredRate.toFixed(2)+'%';
    var tsfpbarChartData = {
        labels: facility_name,
        datasets: [
            {
                label: 'Non Respondant Rate',
                backgroundColor: 'rgb(0, 48, 143, 0.9)',
//                    stack: 'Stack 1',
                data: tsfpnon_respondent_rate,
            },
            {
                label: 'Death Rate',
                backgroundColor: 'rgb(255, 0, 0, 0.9)',
//                    stack: 'Stack 0',
                data: tsfpdeath_rate
            },
            {
                label: 'Default Rate',
                backgroundColor: 'rgb(233, 214, 107, 0.9)',
//                    stack: 'Stack 0',
                data: tsfpdefault_rate
            },
            {
                label: 'Cure Rate',
                backgroundColor: 'rgb(0, 106, 78, 0.9)',
//                    stack: 'Stack 1',
                data: tsfpcure_rate
            }
        ]
    };

    var ctx5 = document.getElementById('canvas-tsfp-performance').getContext('2d');
    new Chart(ctx5, {
        type: 'bar',
        data: tsfpbarChartData,
        options: {
            title: {
                display: false,
                text: 'TSFP Performance'
            },
//                tooltips: {
//                    mode: 'index',
//                    intersect: true
//                },
            responsive: true,
            maintainAspectRatio: false,
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

    window.chartColors = {
        red: 'rgb(255, 99, 132, 0.7)',
        orange: 'rgb(255, 159, 64, 0.7)',
        yellow: 'rgb(255, 205, 86, 0.7)',
        green: 'rgb(75, 192, 192, 0.7)',
        blue: 'rgb(54, 162, 235, 0.7)',
        purple: 'rgb(153, 102, 255, 0.7)',
        grey: 'rgb(201, 203, 207, 0.7)'
    };


</script>
<!-- Mapping script ends here -->

@endpush

