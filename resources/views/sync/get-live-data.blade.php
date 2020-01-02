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
	<style>
		#processing {
			font-weight: bold;
			margin-left: 5px;
		}

		body {
			background-color: #f3f3f4;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<div class="gray-bg">
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Get Live Data</h5>
							</div>
							<div class="ibox-content">
								<div>
									<h3 class="text-danger">Note</h3>
									<p>First sync all local data to live server. Unsynced data will be lost.</p>
									<p>Don't close this window while processing.</p>
								</div>

								<button class="btn btn-danger get-live-data">GET LIVE DATA</button>
								<span id="processing"></span>
							</div> <!-- ibox-content -->
						</div> <!-- ibox -->
					</div> <!-- col -->
				</div> <!-- row -->
			</div> <!-- wrapper -->
			<!---- CONTENT GOES HERE -->
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
		$('.get-live-data').on('click', function () {
			$('#processing').html('Processing, Please wait ...');
			$.ajax({
				type: 'get',
				url: '/sync/retrieve-live-data',
				success: function(res) {
					$('#processing').html('Completed');
				},
				error: function(e) {
					$('#processing').html('Failed to sync live data, try again.');
				}
			});
		});	
	</script>
</body>
</html>