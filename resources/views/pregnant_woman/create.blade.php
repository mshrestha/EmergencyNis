@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Pregnant Woman registration</h5>
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
                        <form action="" class="form-horizontal" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @include('pregnant_woman.partials.fields')

                            
                        </form>
                        <a href="{{ route('pregnant-woman.followup') }}"><button class="btn btn-primary ">Register</button></a>
                    </div> <!-- ibox-content -->
                </div> <!-- ibox -->
            </div> <!-- col -->
            
            
            <div class="col-lg-6">
				<div class="ibox float-e-margins ">
					<div class="ibox-title">
						<h5>Admission criteria</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
					<div class="ibox-content">
						<div class="form-group">
							<label for="">New admission</label>
							<select name="new_admission" class="form-control">
								<option value="">Select new admission</option>
								<option value="MUAC" {{ (isset($facility_followup) && $facility_followup->new_admission == 'MUAC') ? ' selected' : '' }}>MUAC</option>
								<option value="WFH Zscore" {{ (isset($facility_followup) && $facility_followup->new_admission == 'WFH Zscore') ? ' selected' : '' }}>WFH Z score</option>
                                <option value="MUAC and WFH Zscore" {{ (isset($facility_followup) && $facility_followup->new_admission == 'MUAC and WFH Zscore') ? ' selected' : '' }}>MUAC and WFH Zscore</option>
								<option value="Oedema" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Oedema') ? ' selected' : '' }}>Oedema</option>
								<option value="Age 6 to 59m" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Age 6 to 59m') ? ' selected' : '' }}>Age 6 to 59m</option>
                                <option value="Relapse" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Relapse') ? ' selected' : '' }}>Relapse</option>
							</select>
                            
						</div>
                        
						<div class="form-group">
							<label for="">Readmission</label>
							<select name="readmission" class="form-control">
								<option value="">Select readmission</option>
								<option value="Readmission after default" {{ (isset($facility_followup) && $facility_followup->readmission == 'Readmission after default') ? ' selected' : '' }}>Readmission after default</option>
								<option value="Readmission after non recovery" {{ (isset($facility_followup) && $facility_followup->readmission == 'Readmission after non recovery') ? ' selected' : '' }}>Readmission after non recovery</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Transfer in</label>
							<select name="transfer_in" class="form-control">
								<option value="">Select transfer in</option>
								<option value="Transfer in from TSFP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from TSFP') ? ' selected' : '' }}>Transfer in from TSFP</option>
								<option value="Transfer in from SC" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from SC') ? ' selected' : '' }}>Transfer in from SC</option>
								<option value="Transfer in from OTP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from OTP') ? ' selected' : '' }}>Transfer in from OTP</option>
								<option value="Transfer in from BSFP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from BSFP') ? ' selected' : '' }}>Transfer in from BSFP</option>
                                <option value="Transfer in from Medical Center" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from Medical Center') ? ' selected' : '' }}>Transfer in from Medical Center</option>
							</select>
						</div>
						<div class="form-group row">
                        <div class="col-md-5">
                                <label for="refered_by">Referred From</label>
                                <select name="refered_by" class="form-control">
                                    <option value="" >Please Select Referral</option>
                                    <option value="MUAC Assessed at Community" 
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'MUAC Assessed at Community') ? ' selected' : '' }}>
                                        MUAC Assessed at Community
                                    </option>
                                    <option value="Other Service centre" {{ (isset($facility_followup) && $facility_followup->refered_by == 'Other Service centre') ? ' selected' : '' }}>Other Service centre</option>
                                    <option value="Inpatient (SC)" 
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'Inpatient (SC)') ? ' selected' : '' }}>
                                            Inpatient (SC)</option>
                                    <option value="Self" 
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'Self') ? ' selected' : '' }}>
                                            Self</option>
                                    <option value="OTP" 
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'OTP') ? ' selected' : '' }}>
                                            OTP</option>
                                    <option value="TSFP" 
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'TSFP') ? ' selected' : '' }}>
                                            TSFP</option>
                                    <option value="BSFP" 
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'BSFP') ? ' selected' : '' }}>
                                            BSFP</option>
                                    <option value="Health Facility" 
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'Health Facility') ? ' selected' : '' }}>
                                            Health Facility</option>
							     </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <label>Next visit date</label>
                                <input type="date" name="next_visit_date" class="form-control" value="{{ isset($facility_followup) ? $facility_followup->next_visit_date : '' }}">    
						</div>
					</div>
				</div>
			</div>
        </div> <!-- row -->
    </div> <!-- wrapper -->
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>
<script>
    $(document).ready(function () {
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
<script></script>
@endpush
