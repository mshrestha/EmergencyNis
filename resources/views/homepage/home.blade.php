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
                            <span class="label label-success pull-right">Monthly</span>
                            <h5>Admissions</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ count($children)}}</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>children</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">Normal</span>
                            <h5>Cure Rate</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">96%</h1>
                            <div class="stat-percent font-bold text-info">2% <i class="fa fa-level-up"></i></div>
                            <small>August</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Normal</span>
                            <h5>Death Rate</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">1%</h1>
                            <div class="stat-percent font-bold text-danger">0.5% <i class="fa fa-level-down"></i></div>
                            <small>August</small>
                        </div>
                    </div>
                </div>
                <!--Second Line -->

                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">High</span>
                            <h5>Default Rate</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">16%</h1>
                            <div class="stat-percent font-bold text-success">0.5% <i class="fa fa-bolt"></i></div>
                            <small>August</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">High</span>
                            <h5>Non Respondent Rate</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">1%</h1>
                            <div class="stat-percent font-bold text-success">0.5% <i class="fa fa-bolt"></i></div>
                            <small>August</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Normal</span>
                            <h5>Average Weight Gain</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">6.2</h1>
                            <div class="stat-percent font-bold text-info">5% <i class="fa fa-level-up"></i></div>
                            <small>Kgs</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Normal</span>
                            <h5>Avg. Length of Stay</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">50</h1>
                            <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                            <small>days</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>ADMISSIONS</h5>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-white active">Today</button>
                                    <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                    <button type="button" class="btn btn-xs btn-white">Annual</button>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins">376</h2>
                                            <small>Total admissions</small>
                                            <div class="stat-percent">3% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">370</h2>
                                            <small>Cured this month</small>
                                            <div class="stat-percent">96% <i class="fa fa-level-down text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">5</h2>
                                            <small>Deaths this month</small>
                                            <div class="stat-percent">1% <i class="fa fa-bolt text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar"></div>
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
            <div id="map" style="width:500px; height:750px;"></div>
        </div>
        

        
    </div><!-- End of First Row -->
    <div class="row">
        
    </div>
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
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <script>    
    $(document).ready(function() {
        

           

        $('.dataTables').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'RegisteredChildren'},
                    {extend: 'pdf', title: 'RegisteredChildren'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

    ///FLOT CHART STARTS HERE
    



            var data2 = [
                [gd(2012, 1, 1), 7], [gd(2012, 2, 1), 6], [gd(2012, 3, 1), 4], [gd(2012, 4, 1), 8],
                [gd(2012, 5, 1), 9], [gd(2012, 6, 1), 7], [gd(2012, 7, 1), 5], [gd(2012, 8, 1), 4],
                [gd(2012, 9, 1), 7], [gd(2012, 10, 1), 8], [gd(2012, 11, 1), 9], [gd(2012, 12, 1), 6]
            ];

            var data3 = [
                [gd(2012, 1, 1), 8], [gd(2012, 2, 1), 5], [gd(2012, 3, 1), 6], [gd(2012, 4, 1), 7],
                [gd(2012, 5, 1), 5], [gd(2012, 6, 1), 4], [gd(2012, 7, 1), 8], [gd(2012, 8, 1), 5],
                [gd(2012, 9, 1), 4], [gd(2012, 10, 1), 8], [gd(2012, 11, 1), 6], [gd(2012, 12, 1), 7]
            ];
        
        
         var data2 = [
                [gd(2012, 8, 1), 7], [gd(2012, 8, 2), 6], [gd(2012, 8, 3), 4], [gd(2012, 8, 4), 8],
                [gd(2012, 8, 5), 9], [gd(2012, 8, 6), 7], [gd(2012, 8, 7), 5], [gd(2012, 8, 8), 4],
                [gd(2012, 8, 9), 7], [gd(2012, 8, 10), 8], [gd(2012, 8, 11), 9], [gd(2012, 8, 12), 6],
                [gd(2012, 8, 13), 4], [gd(2012, 8, 14), 5], [gd(2012, 8, 15), 11], [gd(2012, 8, 16), 8],
                [gd(2012, 8, 17), 8], [gd(2012, 8, 18), 11], [gd(2012, 8, 19), 11], [gd(2012, 8, 20), 6],
                [gd(2012, 8, 21), 6], [gd(2012, 8, 22), 8], [gd(2012, 8, 23), 11], [gd(2012, 8, 24), 13],
                [gd(2012, 8, 25), 7], [gd(2012, 8, 26), 9], [gd(2012, 8, 27), 9], [gd(2012, 8, 28), 8],
                [gd(2012, 8, 29), 5], [gd(2012, 8, 30), 8], [gd(2012, 8, 31), 25]
            ];

            var data3 = [
                [gd(2012, 8, 1), 800], [gd(2012, 8, 2), 500], [gd(2012, 8, 3), 600], [gd(2012, 8, 4), 700],
                [gd(2012, 8, 5), 500], [gd(2012, 8, 6), 456], [gd(2012, 8, 7), 800], [gd(2012, 8, 8), 589],
                [gd(2012, 8, 9), 467], [gd(2012, 8, 10), 876], [gd(2012, 8, 11), 689], [gd(2012, 8, 12), 700],
                [gd(2012, 8, 13), 500], [gd(2012, 8, 14), 600], [gd(2012, 8, 15), 700], [gd(2012, 8, 16), 786],
                [gd(2012, 8, 17), 345], [gd(2012, 8, 18), 888], [gd(2012, 8, 19), 888], [gd(2012, 8, 20), 888],
                [gd(2012, 8, 21), 987], [gd(2012, 8, 22), 444], [gd(2012, 8, 23), 999], [gd(2012, 8, 24), 567],
                [gd(2012, 8, 25), 786], [gd(2012, 8, 26), 666], [gd(2012, 8, 27), 888], [gd(2012, 8, 28), 900],
                [gd(2012, 8, 29), 178], [gd(2012, 8, 30), 555], [gd(2012, 8, 31), 993]
            ];




            var dataset = [
                {
                    label: "Admissions",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Cured",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });

    
            

    });//END OF ONREADY

    function load_child(child) {
        $.ajax({
            url: '/child-info/'+ child,
            type: 'get',
            success: function(res) {
                $('#child-info').html(res);
            }
        });
    }

    $('.children-client').on('click', function() {
        var child = $(this).data('child-id');
        $('#child-info').html('Loading ...');

        load_child(child);
    });

    function load_facility(facility) {
        $.ajax({
            url: '/facility-info/'+ facility,
            type: 'get',
            success: function(res) {
                $('#child-info').html(res);
            }
        })
    }

    $('.facility-client').on('click', function() {
        var facility = $(this).data('facility-id');

        $('#child-info').html('Loading ...');
        load_facility(facility);
    });
</script>





<!-- Mapping Script starts here -->
<script>
mapboxgl.accessToken = 'pk.eyJ1Ijoia2F6aXN0dWRpb3MiLCJhIjoiY2luZnA2bjNhMTIyOXYwa3Z0djlhOXAwdiJ9.Vj88y39TP7LtFJ4uozO_bQ';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/light-v10',
zoom: 11,
center: [-122.204303, 37.730574]
//center: [91.924089, 21.647142]
});
var nav = new mapboxgl.NavigationControl();
map.addControl(nav, 'bottom-left');
    
map.on('load', function () {

map.addLayer({
    'id': 'population',
    'type': 'circle',
    'source': {
        type: 'vector',
        url: 'mapbox://examples.8fgz4egr'
    },
    'source-layer': 'sf2010',
    'paint': {
        // make circles larger as the user zooms from z12 to z22
        'circle-radius': {
            'base': 1.75,
            'stops': [[12, 2], [22, 180]]
        },
        // color circles by ethnicity, using a match expression
        // https://docs.mapbox.com/mapbox-gl-js/style-spec/#expressions-match
        'circle-color': [
            'match',
            ['get', 'ethnicity'],
            'White', '#fbb03b',
            'Black', '#223b53',
            'Hispanic', '#e55e5e',
            'Asian', '#3bb2d0',
            /* other */ '#ccc'
            ]
        }
    });
});
</script>
<!-- Mapping script ends here -->
@endpush