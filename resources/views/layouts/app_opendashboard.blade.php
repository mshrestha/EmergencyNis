<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Emergency Nutrition System</title>

    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/switchery/switchery.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{ asset('custom/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/steps/jquery.steps.css')}}" rel="stylesheet">

    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/custom.css')}}" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.2.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.2.1/mapbox-gl.css' rel='stylesheet'/>
    @stack('styles')
</head>
<body class="pace-done">
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="logo-element">
                        <a href="{{ route('open_dashboard') }}" style="color: #fff;">
                            ENS
                        </a>
                    </div>
                </li>
                @if (Auth::check())
                    <li>
                        @if(Auth::user()->role=='manager' )
                            <a href="{{ route('program-manager') }}" style="color: #fff;" data-toggle="tooltip"
                               title="Dashboard"
                               class="btn btn-success"><i class="fa fa-home"></i><span class="nav-label">Dashboard</span></a>
                        @else
                            <a href="{{ route('homepage') }}" style="color: #fff;" data-toggle="tooltip"
                               title="Dashboard"
                               class="btn btn-success"><i class="fa fa-home"></i><span class="nav-label">Dashboard</span></a>
                        @endif
                    </li>
                        @else
                     <li>
                         <a href="{{ route('auth.login') }}" style="color: #fff;" data-toggle="tooltip"
                               title="Log-In"
                               class="btn btn-danger">
                                <i class="fa fa-sign-in"></i><span
                                        class="nav-label">Log In</span>
                            </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>


    <div id="page-wrapper" class="gray-bg">

    @include('layouts.partials.alert')

    @yield('content')
    <!---- CONTENT GOES HERE -->
        <div class="footer">
            <div class="pull-right">
                Version 1.0
            </div>
            <div>
                <strong>Copyright</strong> UNICEF Bangladesh &copy; {{ date('Y') }}
            </div>
        </div>
    </div>
</div>


<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('js/inspinia.js')}}"></script>
<script src="{{ asset('js/plugins/pace/pace.min.js')}}"></script>
<script src="{{ asset('custom/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>


<!-- Toastr -->
<script src="{{ asset('js/plugins/toastr/toastr.min.js')}}"></script>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<script>

    $(document).ready(function () {
        $("body").toggleClass("mini-navbar");
    });

</script>

@stack('scripts')

</body>
</html>
