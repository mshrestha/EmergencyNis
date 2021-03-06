@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
  <h1><strong>{{ Auth::user()->facility->facility_id }}</strong> </h1>
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{ route('register') }}">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">

                                    <h2 class="font-bold">Child</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ url('pregnant-women') }}">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">

                                    <h2 class="font-bold">Women</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('iycf_session_home') }}">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">

                                    <h2 class="font-bold">MIYCN</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('supply.index') }}">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">

                                    <h2 class="font-bold">Supply</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('dashboard') }}">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">

                                    <h2 class="font-bold">Dashboard</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('reports') }}">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">

                                    <h2 class="font-bold">Reports</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('community.index') }}">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">

                                    <h2 class="font-bold">Community</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


            </div><!-- END OF INNER ROW -->
        </div>

        <div class="col-lg-3">
            @include('homepage.partials.sync')
            <a href="{{ url('myprofile') }}">
                <div class="widget style1 blue-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-user-circle fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">

                            <h2 class="font-bold">Profile</h2>
                        </div>
                    </div>
                </div>
            </a>
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

    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.warning('', 'Welcome to Emergency Nutrition');

    }, 1300);



</script>
<!-- Mapping script ends here -->

@endpush
