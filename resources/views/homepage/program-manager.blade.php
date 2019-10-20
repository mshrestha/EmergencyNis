@extends('layouts.app')

@section('content')

 <div class="row">
    <div class="col-lg-12">
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



<div id="header">
		<h2>Stacking</h2>
	</div>

	<div id="content">

		<div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
		</div>

		<p>With the stack plugin, you can have Flot stack the series. This is useful if you wish to display both a total and the constituents it is made of. The only requirement is that you provide the input sorted on x.</p>

		<p class="stackControls">
			<button>With stacking</button>
			<button>Without stacking</button>
		</p>

		<p class="graphControls">
			<button>Bars</button>
			<button>Lines</button>
			<button>Lines with steps</button>
		</p>

	</div>

	<div id="footer">
		Copyright &copy; 2007 - 2014 IOLA and Ole Laursen
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
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,20],[11,10],[12,13],[13,4],[14,7],[15,8],[16,12]
            ];
            var data2 = [
                [0,0],[1,2],[2,7],[3,4],[4,11],[5,4],[6,2],[7,5],[8,11],[9,5],[10,4],[11,1],[12,5],[13,2],[14,5],[15,2],[16,0]
            ];
            $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [
                        data1,  data2
                    ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true,
                                steps: false
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 2,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,

                            borderWidth: 2,
                            color: 'transparent'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                        },
                        tooltip: true
                    }
            );

        });
   



    
    $(function() {

		var d1 = [];
		for (var i = 0; i <= 10; i += 1) {
			d1.push([i, parseInt(Math.random() * 30)]);
		}

		var d2 = [];
		for (var i = 0; i <= 10; i += 1) {
			d2.push([i, parseInt(Math.random() * 30)]);
		}

		var d3 = [];
		for (var i = 0; i <= 10; i += 1) {
			d3.push([i, parseInt(Math.random() * 30)]);
		}

		var stack = 0,
			bars = true,
			lines = false,
			steps = false;

		function plotWithOptions() {
			$.plot("#placeholder", [ d1, d2, d3 ], {
				series: {
					stack: stack,
					lines: {
						show: lines,
						fill: true,
						steps: steps
					},
					bars: {
						show: bars,
						barWidth: 0.6
					}
				},
                yaxis: {
                    autoScale:"exact"
                }
			});
		}

		plotWithOptions();

		$(".stackControls button").click(function (e) {
			e.preventDefault();
			stack = $(this).text() == "With stacking" ? true : null;
			plotWithOptions();
		});

		$(".graphControls button").click(function (e) {
			e.preventDefault();
			bars = $(this).text().indexOf("Bars") != -1;
			lines = $(this).text().indexOf("Lines") != -1;
			steps = $(this).text().indexOf("steps") != -1;
			plotWithOptions();
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});


</script>
<!-- Mapping script ends here -->

@endpush