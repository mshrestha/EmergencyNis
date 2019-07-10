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
	<link href="{{ asset('css/style.css')}}" rel="stylesheet">
	<link href="{{ asset('css/custom.css')}}" rel="stylesheet">
	@stack('styles')
</head>
<body>
	<div id="wrapper">
		<div class="navbar-header">
			<a class=" minimalize-styl-2 btn btn-primary"><i class="fa fa-bars"></i> </a>
		</div>
		<!-- Right Side Of Navbar -->
		<ul class="navbar-nav ml-auto">
			<!-- Authentication Links -->
			@guest
			<li class="nav-item">
				<a class="nav-link" href="{{ route('auth.login') }}">{{ __('Login') }}</a>
			</li>
			@if (Route::has('register'))
			<li class="nav-item">
				<a class="nav-link" href="{{ route('auth.register') }}">{{ __('Register') }}</a>
			</li>
			@endif
			@else
			<li class="nav-item dropdown">
				<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('auth.logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					{{ __('Logout') }}
				</a>

				<form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</li>
		@endguest
	</ul>

	<div id="page-wrapper" class="gray-bg">
		@yield('content')
		<!---- CONTENT GOES HERE -->
		<div class="footer">
			<div class="pull-right">
				Beta Version 1.0
			</div>
			<div>
				<strong>Copyright</strong> UNICEF Bangladesh &copy; 2019
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

@stack('scripts')

</body>
</html>
