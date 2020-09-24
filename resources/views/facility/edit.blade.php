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
					<h5>Facility</h5>
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
					<form action="{{ route('facility.update', $facility->id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
						@csrf
						@method('PATCH')
{{--						@include('facility.partials.fields')--}}
						<div class="form-group">
							<label class="col-sm-3 control-label">Facility Name</label>
							<div class="col-sm-9"><input type="text" name="name" class="form-control"
														 placeholder="Facility Name"
														 value="{{ isset($facility) ? $facility->name : '' }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Facility ID</label>
							<div class="col-sm-9"><input type="text" name="facility_id" class="form-control"
														 placeholder="Example - NS-C1E-XXXX/XXX-XXXX" required
														 value="{{ isset($facility) ? $facility->facility_id : '' }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">SSID</label>
							<div class="col-sm-9"><input type="text" name="ssid" class="form-control"
														 placeholder="SSID"
														 value="{{ isset($facility) ? $facility->ssid : '' }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Sector</label>
							<div class="col-sm-9">
								<select name="sector_id" class="form-control" id="sector_id">
									<option value="">Select Sector</option>
									@foreach($sectors as $sector)
										<option value="{{ $sector->id }}" {{ (isset($facility) && $facility->sector_id == $sector->id) ? ' selected' : '' }}>{{ $sector->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Program Partner</label>
							<div class="col-sm-9">
								<select name="pp_id" class="form-control" id="pp_id">
									<option value="">Select Program Partner</option>
									@foreach($pps as $pp)
{{--										<option value="{{ $pp->id }}" >{{ $pp->name }}</option>--}}
										<option value="{{ $pp->id }}" {{ (isset($facility) && $facility->pp_id == $pp->id) ? ' selected' : '' }}>{{ $pp->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Implementing Partner</label>
							<div class="col-sm-9">
								<select name="ip_id" class="form-control" id="implementing_partner" required>
									{{--<option value="">Select Implementing Partner</option>--}}
									@foreach($ips as $ip)
										<option value="{{ $ip->id }}" {{ (isset($facility) && $facility->ip_id == $ip->id) ? ' selected' : '' }}>{{ $ip->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group"><label class="col-sm-3 control-label">Settlement</label>
							<div class="col-sm-9">
								<select name="camp_id" class="form-control" id="camp" required >
									{{--<option value="">Select Camp</option>--}}
									@foreach($camps as $camp)
										<option value="{{ $camp->id }}" {{ (isset($facility) && $facility->camp_id == $camp->id) ? ' selected' : '' }}>{{ $camp->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group"><label class="col-sm-3 control-label">status</label>
							<div class="col-sm-9">
								<select name="status" class="form-control" required>
									<option value="Closed" {{ (isset($facility) && $facility->status == 'Closed') ? ' selected' : '' }}>Closed
									</option>
									<option value="Ongoing" {{ (isset($facility) && $facility->status == 'Ongoing') ? ' selected' : '' }}>
										Ongoing
									</option>
									<option value="Planned" {{ (isset($facility) && $facility->status == 'Planned') ? ' selected' : '' }}>
										Planned
									</option>
									<option value="Removed" {{ (isset($facility) && $facility->status == 'Removed') ? ' selected' : '' }}>
										Removed
									</option>
								</select>
							</div>
						</div>
						<div class="form-group"><label class="col-sm-3 control-label">Latitude</label>
							<div class="col-sm-9"><input type="text" name="latitude" class="form-control" placeholder="Latitude" required
														 value="{{ isset($facility) ? $facility->latitude : '' }}"></div>
						</div>
						<div class="form-group"><label class="col-sm-3 control-label">Longitude</label>
							<div class="col-sm-9"><input type="text" name="longitude" class="form-control" placeholder="Longitude" required
														 value="{{ isset($facility) ? $facility->longitude : '' }}"></div>
						</div>
						<div class="form-group"><label class="col-sm-3 control-label">Service type</label>
							<div class="col-sm-9">
								{{--<select name="service_type" class="form-control" required>--}}
									{{--<option value="OTP" {{ (isset($facility) && $facility->service_type == 'OTP') ? ' selected' : '' }}>OTP--}}
									{{--</option>--}}
									{{--<option value="SC" {{ (isset($facility) && $facility->service_type == 'SC') ? ' selected' : '' }}>SC--}}
									{{--</option>--}}
									{{--<option value="TSFP/BSFP" {{ (isset($facility) && $facility->service_type == 'BSFP') ? ' selected' : '' }}>--}}
										{{--BSFP--}}
									{{--</option>--}}
									{{--<option value="TSFP/BSFP" {{ (isset($facility) && $facility->service_type == 'TSFP') ? ' selected' : '' }}>--}}
										{{--TSFP--}}
									{{--</option>--}}
								{{--</select>--}}
								<select name="service[]" id="service" class="form-control input-circle show-tick selectpicker"
										data-live-search="true" multiple required>
									@foreach($services as $service)
										<option value="{{ $service->id }}" {{ (in_array($service->id,$selected_service) ) ? ' selected' : '' }}>{{ $service->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group"><label class="col-sm-3 control-label">Facility reg</label>
							<div class="col-sm-9"><input type="text" name="facility_reg" class="form-control" placeholder="Facility reg"
														 required value="{{ isset($facility) ? $facility->facility_reg : '' }}"></div>
						</div>
						<div class="form-group"><label class="col-sm-3 control-label">Community reg</label>
							<div class="col-sm-9"><input type="text" name="community_reg" class="form-control" placeholder="Community reg"
														 required value="{{ isset($facility) ? $facility->community_reg : '' }}"></div>
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
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>

{{--<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>--}}
{{--<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>--}}
<script>
    $("select[name='sector_id']").change(function () {

        var sector_id = $(this).val();
        var token = $("input[name='_token']").val();
//            console.log(pp_id);
        $.ajax({
            url: "<?php echo route('select-pp') ?>",
            method: 'POST',
            data: {sector_id: sector_id, _token: token},
            success: function (data) {
//                    console.log(data);
                $("select[name='pp_id']").html('');
                $("select[name='pp_id']").html(data.options);
            }
        });
    });

    $("select[name='pp_id']").change(function () {

        var pp_id = $(this).val();
        var token = $("input[name='_token']").val();
//            console.log(pp_id);
        $.ajax({
            url: "<?php echo route('select-ip') ?>",
            method: 'POST',
            data: {pp_id: pp_id, _token: token},
            success: function (data) {
//                    console.log(data);
                $("select[name='ip_id']").html('');
                $("select[name='ip_id']").html(data.options);
            }
        });
    });
    $("select[name='ip_id']").change(function () {

        var ip_id = $(this).val();
        var token = $("input[name='_token']").val();
        console.log(ip_id);
        $.ajax({
            url: "<?php echo route('select-camp') ?>",
            method: 'POST',
            data: {ip_id: ip_id, _token: token},
            success: function (data) {
                console.log(data);
                $("select[name='camp_id']").html('');
                $("select[name='camp_id']").html(data.options);
            }
        });
    });
</script>
@endpush
