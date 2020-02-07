@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-6">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Outreach supervisor registration</h5>
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
					{{-- <form action="{{ route('community.store') }}" class="form-horizontal"> --}}
					{{ html()->form('POST', route('outreach-supervisor.store'))->open() }}
						@csrf
						@include('outreach.supervisor.partials.fields')

						<button class="btn btn-success">Save</button>
					{{ html()->form()->close() }}
				</div> <!-- ibox-content -->
			</div> <!-- ibox -->
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>
@endsection
