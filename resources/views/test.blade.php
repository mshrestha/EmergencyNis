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
    var ctx = document.getElementById("myChart").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60'],
            datasets: [
                {
                    label: '-3Z',
                    data: [45,49,52,55,57,60,62,64,65,66,67,68,69,70,71,72,73,74,75,75,76,77,78,78.5,79,79,80,80,80.5,81,
                           81.25,81.5,82,82.5,83,83.5,84,84.5,85,85.5,86,86.5,87,87,88,88.5,89,89,90,91,91,92,92,93,93,94,94,95,95,96,96],
                    backgroundColor: [
                        'rgba(230, 126, 34, .5)',
                    ],
                    borderColor: [
                        'rgba(55, 59, 64, .2)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '-2Z',
                    data: [46,51,54,57,59,62,64,65,66,67,68,70,71,72,73,74,75,76,77,78,78.5,79,80,81,82,83,83.5,84,84.5,85,
                        85.5,86,86.5,87,87.5,88,89,90,90.5,91,92,92.5,93,93.5,94,94.5,95,95.5,96,96.5,97,97.5,97.75,98.25,98.5,99,99.25,99.5,100,100.5,101],
                    backgroundColor: [
                        'rgba(255, 255, 126, 1)',
                    ],
                    borderColor: [
                        'rgba(55, 59, 64, .2)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '-1Z',
                    data: [48.5,53,57,59,62,64,65,67,68.5,70,71,72.5,74,75,76,77,78,79,80,81,82,83,83.5,84,85,85.5,86,87,88,
                           89,89.5,90,90.5,91,91.5,92,93,94,94.5,95,95.5,96,96.5,97,97.5,98,98.5,99,99.5,100,100.5,101,102,102,103,103,104,104.25,104.5,105,105.5],
                    backgroundColor: [
                        'rgba(240, 255, 0, 1)',
                    ],
                    borderColor: [
                        'rgba(55, 59, 64, .2)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Medium',
                    data: [50,54,59,61,64,66,67,69,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,91.5,
                        92,93,94,93.5,94,95,96,96.5,97,98,99,99.5,100,101,101.5,102,102.5,103,104,104.5,105,105.5,106,106.5,107,107.5,108,108.5,109,109.5,110],
                    backgroundColor: [
                        'rgba(77, 175, 124, 1)'
                    ],
                    borderColor: [
                        'rgba(55, 59, 64, .2)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '+1Z',
                    data: [52,57,60,64,66,68,70,71.5,73,74,75.5,77,78,79,81,82,83,84,85,86,87,88,89,90,91,92,93,93.5,94,95,95.5,
                        96,96.5,97,98,99,99.5,100,100.5,101,102,103,104,104.5,105,105.5,106,106.25,106.5,107,107.5,108,108.5,109,109.5,110,111,111.5,112,113,114],
                    backgroundColor: [
                        'rgba(77, 175, 124, .8)'
                    ],
                    borderColor: [
                        'rgba(55, 59, 64, .2)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '+2Z',
                    data: [54,59,62,66,68,70,72,74,75,77,78,79,80,82,83,84.5,86,87,88,89,90,91,92,93,94,95,96,97,97.5,98,
                        99,100,100.5,101,102,103,104,104.5,105,105.5,106,106.5,107,108,108.5,109,110,110.5,111,112,113,113.5,114,114.5,115,115.5,116,117,118,118.5,119],
                    backgroundColor: [
                        'rgba(77, 175, 124, .5)',
                    ],
                    borderColor: [
                        'rgba(55, 59, 64, .2)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '+3Z',
                    data: [55,60,65,67,70,71,73,75,77,78,80,81,82,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,
                        102,103,103.5,104,105,106,107,108,108.5,109,110,111,111.5,112,113,114,114.5,115,115.5,116,117,118,118.5,119,120,120.5,121,122,123,124],
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
            maintainAspectRatio: true,
            bezierCurve: false,
            title: {
                display: true,
            },

            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }

    });
</script>

@endpush