@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <h1></h1>
    </div>
    
</div>
 <div class="row ">
    <div class="col-lg-6  border-bottom dashboard-header">
        <h2>Monthly New Admissions </h2>
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
     <div class="col-lg-6">
		<h2>OTP Performance</h2>
        <div id="content">
            <div class="flot-chart m-b-xl">
                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-4">
        <div class="statistic-box">
        <h2>
            OTP New Admission By Age
        </h2>
        <p>
            Admissions for this month by age.
        </p>
            <div class="row text-center">
                
                <div class="col-lg-9">
                    <canvas id="doughnutChart" width="280" height="270" style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
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
        <h2>
            OTP New Admission By Gender
        </h2>
        <p>
            Admissions for this month by Gender.
        </p>
            <div class="row text-center">
                <div class="col-lg-9">
                    <canvas id="doughnutChart2" width="280" height="270" style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
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
        <h2>
            OTP New Admission By Anthropometry
        </h2>
        <p>
            Admissions for this month by Anthropometry.
        </p>
            <div class="row text-center">
                <div class="col-lg-9">
                    <canvas id="doughnutChart3" width="280" height="270" style="margin: 18px auto 0px; display: block; width: 80px; height: 80px;"></canvas>
                    <h5>Anthropometry</h5>
                </div>
            </div>
            <div class="m-t">
                <small>This chart is an accumulation of new addmissions of all the OTPs segregated by Anthropometry</small>
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
            var data3 = [
                [0,5],[1,7],[2,12],[3,9],[4,16],[5,9],[6,7],[7,10],[8,16],[9,10],[10,9],[11,6],[12,10]
            ];
            $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [ data1, data2, data3],
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
                            //sorted: null/false, true, "ascending", "descending", "reverse", or a comparator
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,

                            borderWidth: 0,
                            color: '#cccccc'
                        },
                        colors: ["#a3e1d4", "#9CC3DA", "#dedede"],
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
            

            var data = [
                [1, 80], [2, 87], [3, 92], [4, 88],[5, 90], [6, 95], [7, 80]
            ];
            var dataDefaultRate = [
                [1, 1], [2, 1], [3, 3], [4, 7], [5, 2], [6, 2], [7, 1]
            ];
            var dataDeathRate = [
                [1, 0], [2, 3], [3, 1], [4, 4], [5, 2], [6, 1], [7, 0]
            ];
           

            var dataset = [
                {
                    label: "Cure Rate",
                    data: data,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "left",
                        //barWidth: 24 * 60 * 60 * 100,
                        barWidth: 0.5,
                        lineWidth:0
                    }

                },
                
                {
                    label: "Default Rate",
                    data: dataDefaultRate,
                    color: "#cc0000",
                    bars: {
                        show: true,
                        align: "left",
                        barWidth: 0.5,
                        lineWidth:0
                    }
                },
                {
                    label: "Death Rate",
                    data: dataDeathRate,
                    color: "#1C84C6",
                    bars: {
                        show: true,
                        align: "left",
                        barWidth: 0.5,
                        lineWidth:0
                    }

                }
                
            ];


            var options = {
                xaxis: {
                    mode: null,
                    //tickSize: [2, "day"],
                    //tickLength: 0,
                    axisLabel: "Label",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Helvetica',
                    axisLabelPadding: 100,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 100,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 5
                }, {
                    position: "left",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 10
                },
                        
                ],
                tooltip: true,
                legend: {
                    noColumns: 5,
                    labelBoxBorderColor: "transparent",
                    position: "nw"
                },
                grid: {
                    hoverable: true,
                    borderWidth: 0
                }
            };
            
            
            var newData = [
                { label: "Money Spent", data: [ ["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9] ] },
                { label: "Money Earned", data: [ ["January", 20], ["February", 30], ["March", 5], ["April", 6], ["May", 9], ["June", 9] ] }
            ];
            
            var newOptions = {
                series: {
                    bars: {
                        show: true,
                        barWidth: 0.2,
                        lineWidth: 0,
                        order: 1,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        }
                    }
                },
                xaxis: {
                    mode: "categories"
                },
                grid: {
                    borderWidth: 0
                },
                colors: ["#3F48CC", "#ED1C24"]
            }

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);
            
            var doughnutData = {
                labels: ["6-23m","24-59m",">59m" ],
                datasets: [{
                    data: [77,22,1],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: true
                }
            };


            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            var doughnutData = {
                labels: ["Male","Female","Other" ],
                datasets: [{
                    data: [43,57,0],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;

            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});
            
            
            var doughnutData = {
                labels: ["MUAC","WHZ","Both" ],
                datasets: [{
                    data: [5,30,65],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;

            var ctx4 = document.getElementById("doughnutChart3").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });
   
    


</script>
<!-- Mapping script ends here -->

@endpush