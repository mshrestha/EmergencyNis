<div class="row">
	<div class="col-lg-6">
		<div class="ibox ">
			<div class="ibox-title">
				<h5>Woman registration</h5>
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
				<div class="form-group"><label class="col-sm-3 control-label"></label>
					<div class="col-sm-9">
						<input type="radio" name="type" value="pregnant" {{ (isset($pregnant_women) && $pregnant_women->type == 'pregnant') ? ' checked' : '' }}> Pregnant
						<input type="radio" name="type" value="lactating" {{ (isset($pregnant_women) && $pregnant_women->type == 'lactating') ? ' checked' : '' }}> Lactating
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Registration ID</label>
					<div class="col-sm-9">
						<input type="text" name="registration_id" class="form-control" placeholder="Registration ID" 
						value="{{ isset($pregnant_women) ? $pregnant_women->registration_id : '' }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Camp</label>
					<div class="col-sm-9">
						<select name="camp_id" class="form-control" required>
							<option value="">Select Camp</option>
							@foreach($camps as $camp)
								<option value="{{ $camp->id }}"
										@if ( $camp->id === $facility->camp->id )
										selected
										@endif {{ (isset($pregnant_women) && $pregnant_women->camp_id == $camp->id) ? ' selected' : '' }}  >{{ $camp->name }} </option>
							@endforeach

						</select>
					</div>
				</div>
				<div class="hr-line-dashed"></div>

				<div class="form-group"><label class="col-sm-3 control-label">Block Number</label>
					<div class="col-sm-9"><input type="text" name="block_no" class="form-control" placeholder="Block Number"
						value="{{ isset($pregnant_women) ? $pregnant_women->block_no : '' }}" required>
					</div>
				</div>

				<div class="form-group"><label class="col-sm-3 control-label">Household Number/FCN</label>
					<div class="col-sm-9"><input type="text" name="household_no" class="form-control" placeholder="Household Number" 
						value="{{ isset($pregnant_women) ? $pregnant_women->household_no : '' }}" >
					</div>
				</div>

				<div class="hr-line-dashed"></div>

				<div class="form-group"><label class="col-sm-3 control-label">Name of PLW</label>
					<div class="col-sm-9"><input type="text" class="form-control" name="pregnant_women_name" placeholder="Name of PLW"
						value="{{ isset($pregnant_women) ? $pregnant_women->pregnant_women_name : '' }}" required>
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Husband's Name</label>
					<div class="col-sm-9"><input type="text" class="form-control" name="husbands_name" placeholder="Husband's Name" 
						value="{{ isset($pregnant_women) ? $pregnant_women->husbands_name : '' }}" required>
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Father's Name</label>
					<div class="col-sm-9"><input type="text" class="form-control" name="fathers_name" placeholder="Father's Name" 
						value="{{ isset($pregnant_women) ? $pregnant_women->fathers_name : '' }}" required>
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Age</label>
					<div class="col-sm-9"><input type="number" class="form-control" style="width:100px" name="age" placeholder="Age" 
						value="{{ isset($pregnant_women) ? $pregnant_women->age : '' }}" ><span class="small">(Years)</span>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="form-group"><label class="col-sm-3 control-label">Month of Pregnancy or Lactation</label>
					<div class="col-sm-9"><input type="number" class="form-control" name="pregnancy_month" placeholder="Pregnancy or Lactation Month" 
						value="{{ isset($pregnant_women) ? $pregnant_women->pregnancy_month : '' }}" >(month)
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Expected Delivery Date</label>
					<div class="col-sm-9"><input type="date" name="expected_delivery_date" class="form-control" value="{{ isset($pregnant_women) ? $pregnant_women->expected_delivery_date : '' }}">
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Actual date of delivery</label>
					<div class="col-sm-9"><input type="date" name="actual_date_of_delivery" class="form-control" value="{{ isset($pregnant_women) ? $pregnant_women->actual_date_of_delivery : '' }}">
					</div>
				</div>
				<div class="hr-line-dashed"></div>
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
					<label class="col-sm-3 control-label">New admission</label>
					<div class="col-sm-9">
						<select name="new_admission" class="form-control">
							<option value="">Select new admission</option>
							<option value="MUAC" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'MUAC') ? ' selected' : '' }}>MUAC</option>
							<option value="WFH Zscore" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'WFH Zscore') ? ' selected' : '' }}>WFH Z score</option>
							<option value="MUAC and WFH Zscore" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'MUAC and WFH Zscore') ? ' selected' : '' }}>MUAC and WFH Zscore</option>
							<option value="Oedema" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'Oedema') ? ' selected' : '' }}>Oedema</option>
							<option value="Age 6 to 59m" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'Age 6 to 59m') ? ' selected' : '' }}>Age 6 to 59m</option>
							<option value="Relapse" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'Relapse') ? ' selected' : '' }}>Relapse</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Readmission</label>
					<div class="col-sm-9">
						<select name="readmission" class="form-control">
							<option value="">Select readmission</option>
							<option value="Readmission after default" {{ (isset($pregnant_women) && $pregnant_women->readmission == 'Readmission after default') ? ' selected' : '' }}>Readmission after default</option>
							<option value="Readmission after non recovery" {{ (isset($pregnant_women) && $pregnant_women->readmission == 'Readmission after non recovery') ? ' selected' : '' }}>Readmission after non recovery</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Transfer in</label>
					<div class="col-sm-9">
						<select name="transfer_in_from" class="form-control">
							<option value="">Select transfer in</option>
							<option value="Transfer in from TSFP" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from TSFP') ? ' selected' : '' }}>Transfer in from TSFP</option>
							<option value="Transfer in from SC" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from SC') ? ' selected' : '' }}>Transfer in from SC</option>
							<option value="Transfer in from OTP" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from OTP') ? ' selected' : '' }}>Transfer in from OTP</option>
							<option value="Transfer in from BSFP" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from BSFP') ? ' selected' : '' }}>Transfer in from BSFP</option>
							<option value="Transfer in from Medical Center" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from Medical Center') ? ' selected' : '' }}>Transfer in from Medical Center</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Referred From</label>
					<div class="col-sm-9">
						<select name="referred_from" class="form-control">
							<option value="" >Please Select Referral</option>
							<option value="MUAC Assessed at Community" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'MUAC Assessed at Community') ? ' selected' : '' }}>
								MUAC Assessed at Community
							</option>
							<option value="Other Service centre" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'Other Service centre') ? ' selected' : '' }}>
								Other Service centre
							</option>
							<option value="Inpatient (SC)" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'Inpatient (SC)') ? ' selected' : '' }}>
								Inpatient (SC)
							</option>
							<option value="Self" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'Self') ? ' selected' : '' }}>
								Self
							</option>
							<option value="OTP" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'OTP') ? ' selected' : '' }}>
								OTP
							</option>
							<option value="TSFP" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'TSFP') ? ' selected' : '' }}>
								TSFP
							</option>
							<option value="BSFP" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'BSFP') ? ' selected' : '' }}>
								BSFP
							</option>
							<option value="Health Facility" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'Health Facility') ? ' selected' : '' }}>
								Health Facility
							</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Next visit date</label>
					<div class="col-sm-9">
						<input type="date" name="next_visit_date" class="form-control" value="{{ isset($pregnant_women) ? $pregnant_women->next_visit_date : '' }}">
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- row -->