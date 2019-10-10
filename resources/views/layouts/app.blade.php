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
	<link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
	<link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/steps/jquery.steps.css')}}" rel="stylesheet">
    
	<link href="{{ asset('css/style.css')}}" rel="stylesheet">
	<link href="{{ asset('css/custom.css')}}" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.2.1/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.2.1/mapbox-gl.css' rel='stylesheet' />
	@stack('styles')
</head>
<body class="pace-done">
	<div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element"> 
							<span>
								<a href="{{ route('homepage') }}">
									<img alt="image" src="{{ asset('img/logo-nutrition.png')}}" width="160">
								</a>
							</span>
							<a href="{{ route('homepage') }}">
								<span class="clear" style="color: #ffffff;">
									
									<span class="text-xs block">{{ Auth::user()->name }}</span> 
								</span> 
							</a>
						</div>
						<div class="logo-element">
							<a href="{{ route('homepage') }}" style="color: #fff;">
								ENS
							</a>
						</div>
					</li>
					@if(Auth::user()->role == 'admin')
					<li class="{{ request()->segment(1) == 'user' ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}" style="color: #fff;"><i class="fa fa-users"></i> <span class="nav-label">Manage Users</span></a>
                    </li>
                    <li class="{{ request()->segment(1) == 'facility' ? 'active' : '' }}">
                        <a href="{{ route('facility.index') }}" style="color: #fff;"><i class="fa fa-home"></i> <span class="nav-label">Manage Facilities</span></a>
                    </li>
                    
					@endif
                    <li class="{{ request()->segment(1) == 'user' ? 'active' : '' }}">
                        <a href="{{ route('reports') }}" style="color: #fff;"><i class="fa fa-laptop"></i> <span class="nav-label">Generate Reports</span></a>
                    </li>
                    <li class="{{ request()->segment(1) == 'register' ? 'active' : '' }}">
                        <a href="{{ route('register') }}" style="color: #fff;"><i class="fa fa-id-badge"></i> <span class="nav-label">Register</span></a>
                    </li>
				</ul>

			</div>
		</nav>

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<span class="m-r-sm text-muted welcome-message">Welcome to Emergency Nutrition System.</span>
						</li>

						<li>
							<a href="{{ route('auth.logout') }}">
								<i class="fa fa-sign-out"></i> Log out
							</a>
						</li>
					</ul>

				</nav>
			</div>

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
    
    <!-- Toastr -->
    <script src="/js/plugins/toastr/toastr.min.js"></script>
    <script>
        function printDiv(divName) {
             var printContents = document.getElementById(divName).innerHTML;
             var originalContents = document.body.innerHTML;

             document.body.innerHTML = printContents;

             window.print();

             document.body.innerHTML = originalContents;
        }
    </script>

	@stack('scripts')

</body>
</html>
