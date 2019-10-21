@extends('layouts.app')

@section('content')

 <div class="row">
    <div class="col-lg-8">
        <h2>Admissions</h2>
        <div class="small pull-left col-md-3 m-l-lg m-t-md">
            <strong>ADMISSION TREND</strong> 
        </div>
        <div class="small pull-right col-md-3 m-t-md text-right">
            <strong>Each line</strong> represents the admission trend for individual OTP.
        </div>
        <div class="flot-chart m-b-xl">
            <div class="flot-chart-content" id="flot-dashboard5-chart"></div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-8">
		<h2>OTP Performance</h2>
        <div id="content">
            <div class="flot-chart m-b-xl">
                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
            </div>
        </div>
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
        $(document).ready(function() {
            var sparklineCharts = function(){
                $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline2").sparkline([32, 11, 25, 37, 41, 32, 34, 42], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline3").sparkline([34, 22, 24, 41, 10, 18, 16,8], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1C84C6',
                    fillColor: "transparent"
                });
            };

            var sparkResize;

            $(window).resize(function(e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineCharts, 500);
            });

            sparklineCharts();




             var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,20],[11,10],[12,13]
            ];
            var data2 = [
                [0,0],[1,2],[2,7],[3,4],[4,11],[5,4],[6,2],[7,5],[8,11],[9,5],[10,4],[11,1],[12,5]
            ];
            $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [ data1, data2],
                    {
                        series: {
                            lines: {
                                show: true,
                                fill: false,
                                steps: false
                            },
                            
                            points: {
                                radius: 2,
                                show: true
                            },
                            shadowSize: 1
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
                            //sorted: null/false, true, "ascending", "descending", "reverse", or a comparator
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,

                            borderWidth: 0,
                            color: '#cccccc'
                        },
                        colors: ["#FF8C00", "#1C84C6"],
                        xaxis:{
                            show: true
                        },
                        yaxis: {
                            show:true
                        },
                        tooltip: true
                    }
            );
            
            
            
            
            //SECOND STACKED BARS STARTS HERE
            var data3 = [
                [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
                [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
                [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
                [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
                [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
                [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
                [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
                [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
            ];

            var data = [
                [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
                [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
                [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
                [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
                [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
                [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
                [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
                [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
            ];


            var dataset = [
                {
                    label: "Cure Rate",
                    data: data,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, 
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

        });
   



    
    


</script>
<!-- Mapping script ends here -->

@endpush