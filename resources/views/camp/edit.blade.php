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
					<h5>Camp</h5>
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
					<form action="{{ route('camp.update', $camp->id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
						@csrf
						@method('PATCH')

						<div class="form-group"><label class="col-sm-4 control-label">Camp Name</label>
							<div class="col-sm-8"><input type="text" name="name" class="form-control" placeholder="Camp Name" required
														 value="{{ isset($camp) ? $camp->name : '' }}"></div>
						</div>
						<div class="form-group"><label class="col-sm-4 control-label">Block</label>
							<div class="col-sm-8"><input type="text" name="block_letter" class="form-control" placeholder="Camp Block" required
														 value="{{ isset($camp) ? $camp->block_letter : '' }}"></div>
						</div>


						<div class="form-group ">
							<label for="ip" class="col-md-4 control-label">Select Implementing Partner</label>
							<div class="col-md-8">
								<select name="ip[]" id="ip" class="form-control input-circle show-tick selectpicker"
										data-live-search="true" multiple>
									@foreach($ips as $ip)
										<option value="{{ $ip->id }}" {{ (in_array($ip->id,$selected_ip) ) ? ' selected' : '' }}>{{ $ip->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
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

