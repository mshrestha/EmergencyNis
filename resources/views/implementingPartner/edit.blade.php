@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-6">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Implementing Partner</h5>
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
					<form action="{{ route('implementingPartner.update', $ip->id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
						@csrf
						@method('PATCH')
						@include('implementingPartner.partials.fields')

						<button class="btn btn-success">Save</button>
					</form>
				</div> <!-- ibox-content -->
			</div> <!-- ibox -->
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>

@endpush

