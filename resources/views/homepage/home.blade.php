@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{ route('register') }}">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">

                                    <h2 class="font-bold">REGISTER</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">Children</span>
                            <h5>Admissions</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $dashboard_data['admission_reportmonth'] }}</h1>
                            {{--<div class="stat-percent font-bold text-success">0% <i class="fa fa-bolt"></i></div>--}}
                            <small>{{$dashboard_data['month_year']}}</small>
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
                            <h1 class="no-margins">{{ number_format($dashboard['cureRate'],2) }}%</h1>
                            {{--<div class="stat-percent font-bold text-info">2% <i class="fa fa-level-up"></i></div>--}}
                            <small>{{$dashboard_data['month_year']}}</small>
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
                            <h1 class="no-margins">{{ number_format($dashboard['deathRate'],2) }}%</h1>
                            {{--<div class="stat-percent font-bold text-danger">1% <i class="fa fa-level-down"></i></div>--}}
                            <small>{{$dashboard_data['month_year']}}</small>
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
                            {{--<h1 class="no-margins">{{ $dashboard['defaultRate'] }}%</h1>--}}
                            <h1 class="no-margins">{{ number_format($dashboard['defaultRate'] , 2)}}%</h1>
                            {{--<div class="stat-percent font-bold text-danger">1% <i class="fa fa-level-down"></i></div>--}}
                            <small>{{$dashboard_data['month_year']}}</small>
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
                            <h1 class="no-margins">{{ number_format($dashboard['nonRespondantRate'],2) }}%</h1>
                            {{--<div class="stat-percent font-bold text-success">0% <i class="fa fa-bolt"></i></div>--}}
                            <small>{{$dashboard_data['month_year']}}</small>
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
                            <h1 class="no-margins">{{number_format($dashboard_data['weight_gain'],2)}} <small>Kgs</small></h1>
                            {{--<div class="stat-percent font-bold text-info">0% <i class="fa fa-level-up"></i></div>--}}
                            <small>{{$dashboard_data['month_year']}}</small>
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
                            <h1 class="no-margins">{{number_format($dashboard_data['length_of_stay'],2)}}<small> days</small></h1>
                            {{--<div class="stat-percent font-bold text-danger">2 days <i class="fa fa-level-down"></i></div>--}}
                            <small>{{$dashboard_data['month_year']}}</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">

                            <h5>Admission Criteria</h5>
                        </div>
                        <div class="ibox-content">

                            <canvas id="doughnutChart" width="200" height="150"
                            style="margin: 18px auto 0"></canvas>
                            <div class="m-t">
                                <small>{{$dashboard_data['month_year']}} </small>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>ADMISSIONS (Last 30 days)</h5>
                            {{--<div class="pull-right">--}}
                                {{--<div class="btn-group">--}}
                                    {{--<button type="button" class="btn btn-xs btn-white active">Today</button>--}}
                                    {{--<button type="button" class="btn btn-xs btn-white">Monthly</button>--}}
                                    {{--<button type="button" class="btn btn-xs btn-white">Annual</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        {{--<div class="flot-chart-content" >--}}
                                            <canvas id="childAdmission" class="flot-chart-content" ></canvas>
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins">{{ $dashboard_data['admission_total'] }}</h2>
                                            <small>Total Admission</small>
                                            {{--<div class="stat-percent">0% <i class="fa fa-level-up text-navy"></i></div>--}}
                                            <div class="progress progress-mini">
                                                <div style="width: 100%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">{{ $dashboard_data['admission_reportmonth'] }}</h2>
                                            <small>Enrolled of {{$dashboard_data['month_year']}}</small>
                                            {{--<div class="stat-percent">0% <i class="fa fa-level-down text-navy"></i></div>--}}
                                            <div class="progress progress-mini">
                                                <div style="width: 100%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">{{$dashboard_data['death_reportmonth']}}</h2>
                                            <small>Deaths of {{$dashboard_data['month_year']}}</small>
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
        <div class="col-lg-4">
            <div class="btn-group pull-right" style="padding-bottom: 15px" >
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    {{$dashboard_data['month_year']}}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    @foreach($cache_data as $month_list)
                        <li>
                            <a href="{{ url('/admin_ym/'.$month_list->year.'/'.$month_list->month) }}">{{date('F', mktime(0, 0, 0, $month_list->month, 10)).'-'.$month_list->year}}</a>
                        </li>
                    @endforeach
                    <li class="divider"></li>
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                </ul>
            </div>

        @if(!env('LIVE_SERVER'))
            <div class="sync-wrapper">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Sync to live server</h5>
                    </div>
                    <div class="ibox-content">
                        <p>Children data sync : {{ $children_sync_count }}</p>
                        <p>Facility Followup data sync : {{ $facility_followup_sync_count }}</p>
                        <button class="btn btn-primary" id="btn-sync-now">Sync</button>
                        <div id="syncing-msg" style="display: none;">Syncing ... </div>
                    </div>
                </div>
            </div>
            @endif

            <div id="map" style="width:100%; height:750px;"></div>
        </div>
    </div><!-- End of First Row -->

    <div class="row"></div>
</div> <!-- wrapper -->
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
    $('#btn-sync-now').on('click', function() {
        $(this).hide();
        $('#syncing-msg').html('Syncing ...');
        $('#syncing-msg').show();

        sync_children();
    });

    function sync_children() {
        $.ajax({
            type: 'get',
            url: '/sync/children',
            success: function (res) {
                // update_progress_bar();

                if(res.has_more == true) {
                    sync_children();
                } else {
                    sync_facility_followup();
                }
            }, error: function (err) {
                // $('.unemploy_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_facility_followup() {
        $.ajax({
            type: 'get',
            url: '/sync/facility-followup',
            success: function (res) {
                // update_progress_bar();

                if(res.has_more == true) {
                    sync_facility_followup();
                } else {
                    $('#syncing-msg').html('All data synced.');
                    $('#btn-sync-now').show();
                }
            }, error: function (err) {
                // $('.unemploy_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }
</script>

<script>
    $(document).ready(function () {

        $('.dataTables').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'RegisteredChildren'},
            {extend: 'pdf', title: 'RegisteredChildren'},

            {
                extend: 'print',
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
                }
            }
            ]

        });

    });//END OF ONREADY



function load_child(child) {
    $.ajax({
        url: '/child-info/' + child,
        type: 'get',
        success: function (res) {
            $('#child-info').html(res);
        }
    });
}

$('.children-client').on('click', function () {
    var child = $(this).data('child-id');
    $('#child-info').html('Loading ...');

    load_child(child);
});

function load_facility(facility) {
    $.ajax({
        url: '/facility-info/' + facility,
        type: 'get',
        success: function (res) {
            $('#child-info').html(res);
        }
    })
}

$('.facility-client').on('click', function () {
    var facility = $(this).data('facility-id');

    $('#child-info').html('Loading ...');
    load_facility(facility);
});
{{--</script>--}}


<!-- Mapping Script starts here -->
    //<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoia2F6aXN0dWRpb3MiLCJhIjoiY2luZnA2bjNhMTIyOXYwa3Z0djlhOXAwdiJ9.Vj88y39TP7LtFJ4uozO_bQ';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/kazistudios/cjl5hbcc36in92sp9uzflvcsf',
        zoom: 10,
//center: [-122.204303, 37.730574]
center: [92.146278, 21.226305]
});
    var nav = new mapboxgl.NavigationControl();
    map.addControl(nav, 'bottom-left');

    map.on('load', function () {
    });

    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.warning('', 'Welcome to Emergency Nutrition');

    }, 1300);

    var chart_data = JSON.parse('<?php echo json_encode($chart_doughnut_value); ?>');
    //        JSON.parse($chart_doughnut);
    var doughnutData = {
        labels: ["MUAC", "Z-Score", "Both"],
        datasets: [{
//            data: [73, 22, 5],
data: chart_data,
backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
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
var ctx4 = document.getElementById("doughnutChart").getContext("2d");
new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});


</script>
<!-- Mapping script ends here -->
<script>
    var ctx = document.getElementById('childAdmission').getContext('2d');
    var jsArraycount = JSON.parse('<?php echo json_encode($admin_barchart['count']); ?>');
    var jsArraydate = JSON.parse('<?php echo json_encode($admin_barchart['date']); ?>');
    var childAdmission = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: jsArraydate,
            datasets: [{
                label: 'Admission',
                data: jsArraycount,
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