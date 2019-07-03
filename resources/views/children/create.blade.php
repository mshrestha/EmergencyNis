@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
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
					<form method="get">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>MNR No.</label>
									<input type="text" name="mnr_no" class="form-control" placeholder="MNR No.">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>MRC No.</label>
									<input type="text" name="mrc_no" class="form-control" placeholder="MRC No.">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Date</label>
									<input type="date" name="date" class="form-control">
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
						<h5>Household information</h5>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Sub block no.</label>
									<input type="text" name="sub_block_no" class="form-control" placeholder="Sub block no">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>HH No.</label>
									<input type="text" name="hh_no" class="form-control" placeholder="HH no">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>GPS Coordinates</label>
									<input type="text" name="gps_coordinates" class="form-control" placeholder="GPS Coordinates">
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
						
						<h5>Family information</h5>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Family Count No.</label>
									<input type="text" name="family_count_no" class="form-control" placeholder="Family Count No">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Mothers/Caregiver name</label>
									<input type="text" name="mother_caregiver_name" class="form-control" placeholder="Mothers/Caregiver name">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Fathers name</label>
									<input type="text" name="fathers_name" class="form-control" placeholder="Fathers name">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Block leader name</label>
									<input type="text" name="block_leader_name" class="form-control" placeholder="Block leader name">
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>

						<h5>Child information</h5>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Children Name</label>
									<input type="text" name="children_name" class="form-control" placeholder="Children name">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Date of birth</label>
									<input date="date_of_birth" name="date_of_birth" class="form-control">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Age</label>
									<input type="text" name="fathers_name" class="form-control" placeholder="Fathers name">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Sex</label>
									<select name="sex" class="form-control">
										<option value="male">Male</option>
										<option value="female">Female</option>
									</select>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>

						<button class="btn btn-success">Save</button>
					</form>
				</div> <!-- ibox-content -->
			</div> <!-- ibox -->
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>
<script></script>
@endsection
