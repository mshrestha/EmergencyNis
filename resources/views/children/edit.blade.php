@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-6">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Children registration</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<form action="{{ route('children.update', $child->sync_id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
						@csrf
						@method('PATCH')
						@include('children.partials.fields')
						
						<button class="btn btn-primary ">Update</button>
					</form>
				</div> <!-- ibox-content -->
			</div> <!-- ibox -->
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>
<script>
      $(document).ready(function() {
         navigator.geolocation.getCurrentPosition(success, error, options);  
      });

var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) {
  var crd = pos.coords;

  
  $('#currentLongitude').val(crd.longitude);
  $('#currentLatitude').val(crd.latitude);
  
}

function error(err) {
  console.warn(`ERROR(${err.code}): ${err.message}`);
}



</script>
@endpush
