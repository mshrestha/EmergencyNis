@extends('layouts.app_opendashboard')
@push('styles')
<style>
    .modal {
        border: 1px solid black;
        background-color: rgba(255, 255, 255, 1.0);
    }

    #tabid {
        width: 0;
        display: block;
        visibility: hidden;
        height: 0;
    }

    #tabid.active {
        width: 100%;
        height: 100%;
        visibility: visible;
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
                <div class="row ">
                    <div class="col-lg-12  border-bottom dashboard-header">
                        {{--<h2>Welcome to Emergency Nutrition System Dashboard </h2>--}}
                        <div class="small pull-left col-md-3 m-l-lg m-t-md">
                            <strong>ADMISSION TREND </strong>
                        </div>
                        <button id='zoombtn' class='btn btn-info pull-right'>
                            {{--Zoom View <i class="fa fa-window-maximize" aria-hidden="true"></i>--}}
                            Zoom View <i class="icon-zoom-in"></i>
                        </button>


                        <div class="flot-chart-content">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
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
    var ctx = document.getElementById('myChart').getContext('2d');
            var actual_weight = JSON.parse('<?php echo json_encode($gmp['weight']); ?>');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['0', '1', '2', '3', '4', '5','6','7','8','9','10','11', '12', '13', '14', '15','16','17','18','19','20','21','22','23','24', '25','26','27','28','29','30', '31', '32', '33', '34', '35','36','37','38','39','40', '41', '42', '43', '44', '45','46','47','48','49','50', '51', '52', '53', '54', '55','56','57','58','59','60'],
            datasets: [
                {
                    label: 'Child Weight',
                    data: actual_weight,
                    backgroundColor: ['rgba(255, 99, 132, 1)' ],
                    borderColor: ['rgba(255, 99, 132, 1)'],
                    borderWidth: 2,
                    fill: false,
                },
                {
                label: '-3Z',
                data: [2, 3, 3.9, 4.5, 5, 5.3,5.6,6,6.2,6.5,6.6,6.8,7,7.1,7.25,7.4,7.6,7.75,7.8,8,8.2,8.25,8.4,8.5,8.6,
                8.8,8.9,9,9.1,9.25,9.4,9.5,9.6,9.75,9.8,9.9,10,10.1,10.25,10.35,10.4,10.5,10.6,10.75,10.8,10.9,11,11.15,11.25,11.3,11.4,11.5,11.6,11.75,11.8,11.9,12,12.1,12.25,12.4,12.5],
                backgroundColor: [
                    'rgba(230, 126, 34, .5)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, .2)',
                ],
                borderWidth: 1
            },
                {
                    label: '-2Z',
                    data: [2.5, 3.5, 4.4, 5, 5.6, 6, 6.4,6.6,7,7.2,7.4,7.6,7.75,8,8.1,8.4,8.5,8.6,8.8,9,9.1,9.25,9.4,9.5,9.75,
                    9.9,10,10.1,10.25,10.4,10.5,10.6,10.75,10.9,11,11.1,11.25,11.4,11.5,11.6,11.75,11.9,12,12.1,12.25,12.4,12.5,12.6,12.75,12.9,13,13.1,13.2,13.3,13.4,13.5,13.6,13.7,13.8,13.9,14],
                    backgroundColor: [
                        'rgba(255, 255, 126, 1)',
                    ],
                    borderColor: [
//                        'rgba(255, 206, 86, .2)',
                    ],
                    borderWidth: 1
                },
                {
                    label: '-1Z',
                    data: [3, 4, 5, 5.75, 6.25, 6.75,7.2,7.5,7.75,8,8.25,8.5,8.75,8.9,9,9.2,9.4,9.6,9.8,10,10.1,10.35,10.5,10.7,10.8,
                    11,11.2,11.3,11.5,11.7,11.8,12,12.1,12.3,12.4,12.5,12.75,12.9,13,13.1,13.25,13.4,13.5,13.6,13.75,13.85,14,14.1,14.3,14.4,14.5,14.6,14.8,15,15.1,15.25,15.4,15.6,15.75,15.9,16],
                    backgroundColor: [
                        'rgba(240, 255, 0, 1)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, .2)',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Medium',
                    data: [3.5, 4.5, 5.5, 6.5, 7, 7.5,8,8.25,8.6,9,9.25,9.5,9.75,10,10.25,10.4,10.6,10.75,11,11.25,11.4,11.6,11.8,12,12.25,
                    12.4,12.5,12.7,12.9,13.1,13.3,13.5,13.7,13.9,14,14.2,14.4,14.5,14.7,14.9,15,15.2,15.4,15.5,15.6,15.8,16,16.25,16.4,16.5,16.6,16.8,17,17.25,17.4,17.5,17.65,17.8,18,18.25,18.4],
                    backgroundColor: [
                        'rgba(77, 175, 124, .5)',
                    ],
                    borderColor: [
//                        'rgba(153, 102, 255, .2)',
                    ],
                    borderWidth: 1
                },
                {
                    label: '+1Z',
                    data: [4, 5.25, 6.4, 7.25, 7.9, 8.4,8.9,9.25,9.6,10,10.25,10.5,10.8,11.1,11.4,11.5,11.75,12,12.25,12.5,12.75,13,13.25,13.5,13.75,
                    13.9,14.1,14.3,14.5,14.75,15,15.25,15.4,15.6,15.8,16,16.2,16.4,16.6,16.75,17,17.25,17.4,17.6,17.75,18,18.25,18.4,18.6,18.9,19,19.25,19.4,19.6,19.9,20,20.25,20.4,20.6,20.8,21],
                    backgroundColor: [
                        'rgba(77, 175, 124, .8)'
                    ],
                    borderColor: [
//                        'rgba(255, 159, 64, .2)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '+2Z',
                    data: [4.5, 6, 7, 8, 8.75, 9.25,9.75,10.4,10.75,11,11.4,11.75,12,12.3,12.6,12.8,13.1,13.4,13.75,14,14.25,14.5,14.75,15,15.25,
                    15.5,15.75,16,16.25,16.5,16.8,17,17.4,17.6,17.8,18.1,18.25,18.5,18.75,19,19.25,19.5,19.75,20,20.25,20.5,20.75,21,21.25,21.4,21.6,22,22.25,22.4,22.6,22.9,23.1,23.4,23.6,23.9,24.25],
                    backgroundColor: [
                        'rgba(77, 175, 124, 1)'
                    ],
                    borderColor: [
                        'rgba(155, 159, 64, .2)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '+3Z',
                    data: [5,6.5, 8, 9,10,10.5,11,11.5,12,12.5,12.75,13,13.25,13.5,14,14.25,14.5,15,15.25,15.5,15.75,16.25,16.5,16.75,17,
                    17.5,17.75,18,18.4,18.7,19,19.25,19.5,19.75,20,20.4,20.6,21,21.25,21.25,21.5,21.75,22,22.75,23,23.25,23.5,23.9,24.2,24.5,24.9,25.1,25.4,25.6,26,26.3,26.5,27,27.25,27.5,28],
                    backgroundColor: [
                        'rgba(236, 236, 236, .5)'
                    ],
                    borderColor: [
                        'rgba(55, 59, 64, .2)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            responsive: true,

            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            elements: {
                point:{
                    radius: 1
                }
            }
        }
    });


</script>
@endpush