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
                            <h5>Total Admissions</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $total_admission}}</h1>
                            {{--                                <div class="stat-percent font-bold text-{{($report_month_dashboard['total_admit']-$previous_month_dashboard['total_admit']>=0)?'success':'danger'}}">{{ abs($previous_month_dashboard['total_admit']-$report_month_dashboard['total_admit'])}} <i class="fa fa-level-{{($report_month_dashboard['total_admit']-$previous_month_dashboard['total_admit']>=0)?'up':'down'}}"></i></div>--}}
                            {{--<small>{{$month_year}}</small>--}}
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
                            <h1 class="no-margins">{{ number_format($report_month_dashboard['cure_rate'],2) }}%</h1>
                            {{--                                <div class="stat-percent font-bold text-{{($report_month_dashboard['cure_rate']-$previous_month_dashboard['cure_rate']>=0)?'success':'danger'}}">{{ abs($previous_month_dashboard['cure_rate']-$report_month_dashboard['cure_rate'])}}% <i class="fa fa-level-{{($report_month_dashboard['cure_rate']-$previous_month_dashboard['cure_rate']>=0)?'up':'down'}}"></i></div>--}}
                            {{--<small>{{$month_year}}</small>--}}
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
                            <h1 class="no-margins">{{ number_format($report_month_dashboard['death_rate'],2) }}%</h1>
                            {{--                                <div class="stat-percent font-bold text-{{($report_month_dashboard['death_rate']-$previous_month_dashboard['death_rate']>=0)?'success':'danger'}}">{{ abs($previous_month_dashboard['death_rate']-$report_month_dashboard['death_rate'])}}% <i class="fa fa-level-{{($report_month_dashboard['death_rate']-$previous_month_dashboard['death_rate']>=0)?'up':'down'}}"></i></div>--}}
                            {{--<small>{{$month_year}}</small>--}}
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
                            <h1 class="no-margins">{{ number_format($report_month_dashboard['default_rate'],2) }}%</h1>
                            {{--                                <div class="stat-percent font-bold text-{{($report_month_dashboard['default_rate']-$previous_month_dashboard['default_rate']>=0)?'success':'danger'}}">{{ abs($previous_month_dashboard['default_rate']-$report_month_dashboard['default_rate'])}}% <i class="fa fa-level-{{($report_month_dashboard['default_rate']-$previous_month_dashboard['default_rate']>=0)?'up':'down'}}"></i></div>--}}
                            {{--<small>{{$month_year}}</small>--}}
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
                            <h1 class="no-margins">{{ number_format($report_month_dashboard['nonrespondent_rate'],2) }}%</h1>
                            {{--                                <div class="stat-percent font-bold text-{{($report_month_dashboard['nonrespondent_rate']-$previous_month_dashboard['nonrespondent_rate']>=0)?'success':'danger'}}">{{ abs($previous_month_dashboard['nonrespondent_rate']-$report_month_dashboard['nonrespondent_rate'])}}% <i class="fa fa-level-{{($report_month_dashboard['nonrespondent_rate']-$previous_month_dashboard['nonrespondent_rate']>=0)?'up':'down'}}"></i></div>--}}
                            {{--<small>{{$month_year}}</small>--}}
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
                            <h1 class="no-margins">{{ number_format($report_month_dashboard['avg_weight_gain'],2) }} <small>g/kg/day</small></h1>
                            {{--                                <div class="stat-percent font-bold text-{{($report_month_dashboard['avg_weight_gain']-$previous_month_dashboard['avg_weight_gain']>=0)?'success':'danger'}}">{{ abs($previous_month_dashboard['avg_weight_gain']-$report_month_dashboard['avg_weight_gain'])}}% <i class="fa fa-level-{{($report_month_dashboard['avg_weight_gain']-$previous_month_dashboard['avg_weight_gain']>=0)?'up':'down'}}"></i></div>--}}
                            {{--<small>{{$month_year}}</small>--}}
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
                            <h1 class="no-margins">{{ number_format($report_month_dashboard['avg_length_stay'],2) }} Days</h1>
                            {{--                                <div class="stat-percent font-bold text-{{($report_month_dashboard['avg_length_stay']-$previous_month_dashboard['avg_length_stay']>=0)?'success':'danger'}}">{{ abs($previous_month_dashboard['avg_length_stay']-$report_month_dashboard['avg_length_stay'])}}% <i class="fa fa-level-{{($report_month_dashboard['avg_length_stay']-$previous_month_dashboard['avg_length_stay']>=0)?'up':'down'}}"></i></div>--}}
                            {{--<small>{{$month_year}}</small>--}}
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

                        </div>
                    </div>
                </div>
            </div><!-- END OF INNER ROW -->
        </div>
        <div class="col-lg-4">
            <div class="btn-group pull-right" style="padding-bottom: 15px" >
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Select Month
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    @foreach($cache_data as $month_list)
                    <li>
                        <a href="{{ url('/program-user_ym/'.$month_list->year.'/'.$month_list->month) }}">{{date('F', mktime(0, 0, 0, $month_list->month, 10)).'-'.$month_list->year}}</a>
                    </li>
                    @endforeach
                    <li class="divider"></li>
                    <li><a href="{{ url('/homepage') }}">Dashboard</a></li>
                </ul>
            </div>

            @include('homepage.partials.sync')

            {{--<div id="map" style="width:100%; height:750px;"></div>--}}
        </div>
    </div><!-- End of First Row -->

    <div class="row"></div>
</div> <!-- wrapper -->
@endsection

@push('scripts')
<!-- Flot -->
<script src="{{ asset('js/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.spline.js')}}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.resize.js')}}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.pie.js')}}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.symbol.js')}}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.time.js')}}"></script>
<script src="{{ asset('js/plugins/flot/curvedLines.js')}}"></script>
<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>

<!-- Peity -->
<script src="{{ asset('js/plugins/peity/jquery.peity.min.js')}}"></script>
<script src="{{ asset('js/demo/peity-demo.js')}}"></script>

<!-- EayPIE -->
<script src="{{ asset('js/plugins/easypiechart/jquery.easypiechart.js')}}"></script>

<!-- Sparkline -->
<script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('js/demo/sparkline-demo.js')}}"></script>

<!-- ChartJS-->
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>

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


    // function load_child(child) {
    //     $.ajax({
    //         url: '/child-info/' + child,
    //         type: 'get',
    //         success: function (res) {
    //             $('#child-info').html(res);
    //         }
    //     });
    // }

    // $('.children-client').on('click', function () {
    //     var child = $(this).data('child-id');
    //     $('#child-info').html('Loading ...');

    //     load_child(child);
    // });

    // function load_facility(facility) {
    //     $.ajax({
    //         url: '/facility-info/' + facility,
    //         type: 'get',
    //         success: function (res) {
    //             $('#child-info').html(res);
    //         }
    //     })
    // }

    // $('.facility-client').on('click', function () {
    //     var facility = $(this).data('facility-id');

    //     $('#child-info').html('Loading ...');
    //     load_facility(facility);
    // });
</script>


<!-- Mapping Script starts here -->
<script>
//    mapboxgl.accessToken = 'pk.eyJ1Ijoia2F6aXN0dWRpb3MiLCJhIjoiY2luZnA2bjNhMTIyOXYwa3Z0djlhOXAwdiJ9.Vj88y39TP7LtFJ4uozO_bQ';
//    var map = new mapboxgl.Map({
//        container: 'map',
//        style: 'mapbox://styles/kazistudios/cjl5hbcc36in92sp9uzflvcsf',
//        zoom: 10,
//        center: [92.146278, 21.226305]
//    });
//    var nav = new mapboxgl.NavigationControl();
//    map.addControl(nav, 'bottom-left');
//
//    map.on('load', function () {
//    });

    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.warning('', 'Welcome to Emergency Nutrition');

    }, 1300);

    var muac = JSON.parse('<?php echo json_encode($report_month_dashboard['otp_admit_muac']); ?>');
    var whz = JSON.parse('<?php echo json_encode($report_month_dashboard['otp_admit_whz']); ?>');
    var both = JSON.parse('<?php echo json_encode($report_month_dashboard['otp_admit_both']); ?>');

    var doughnutData = {
        labels: ["MUAC", "Z-Score", "Both"],
        datasets: [{
            data: [muac, whz, both],
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

@endpush