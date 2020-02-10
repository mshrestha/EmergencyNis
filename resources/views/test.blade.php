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
            datasets: [{
                label: 'Bar Dataset',
                data: [10, 20, 30, 40],
                // this dataset is drawn below
                order: 1
            }, {
                label: 'Line Dataset',
                data: [0, 0, 30, 20],
                type: 'line',
                pointBackgroundColor: 'black',
                pointRadius: [0, 0, 8, 8],
                fill: false,
                showLine: false, //<- set this
                order: 2
            }],
            labels: ['January', 'February', 'March', 'April']
        }
//        options: options
    });
</script>

@endpush