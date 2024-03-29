<div class="row">
	<div class="col-lg-5">
		<div class="ibox">
			<div class="ibox-title">
				<h5>Anthropometric Measurement</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<div class="form-group row" >
					<div class="col-md-8">
						<label for="">Plan Date</label>
						<input type="hidden" name="facility_id" value="{{ Auth::user()->facility_id }}"/>
						<input type="hidden" name="pregnant_women_id" value="{{ $pregnant_women_id }}"/>
						<input type="date" name="plan_date" class="form-control" value="{{ isset($pregnant_followup) ? $pregnant_followup->plan_date : date('Y-m-d') }}">
					</div>
				</div>
				<div class="form-group row" >
					<div class="col-md-8">
						<label for="">Actual Date</label>
						<input type="date" name="actual_date" class="form-control" value="{{ isset($pregnant_followup) ? $pregnant_followup->actual_date : date('Y-m-d') }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label for="">MUAC (cm)</label>
						<input type="number" name="muac" class="form-control" placeholder="MUAC (cm)" value="{{ isset($pregnant_followup) ? $pregnant_followup->muac : '' }}" min="0" step="0.01">
					</div>
					<div class="col-md-6">
						<label for="">Weight (kg)</label>
						<input type="number" name="weight" class="form-control" placeholder="Weight (kg)" value="{{ isset($pregnant_followup) ? $pregnant_followup->weight : '' }}" min="0" step="0.01">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label for="">Nutrition Status</label>
						<select name="nutritionstatus" class="form-control" id="nutritionstatus"  >
							<option value="" >Nutrition Status</option>
							<option value="MAM"	{{ (isset($facility_followup) && $facility_followup->nutritionstatus == 'MAM') ? ' selected' : '' }}>MAM</option>
							<option value="Normal"	{{ (isset($facility_followup) && $facility_followup->nutritionstatus == 'Normal') ? ' selected' : '' }}>Normal</option>

						</select>
					</div>
					<div class="col-md-6">
						<label for="">Identification Outcome</label>

						<select name="outcome" class="form-control" id="identification-outcome">
							<optgroup label="MAM" id="outcome_mam">
								<option value="New case" >New Case</option>
								<option value="Follow up visit at TSFP" >Follow up visit at TSFP</option>
								<option value="Already admitted at OTP" >Already admitted at OTP</option>
								<option value="Referred to TSFP" >Referred to TSFP</option>
							</optgroup>
							<optgroup label="NORMAL" id="outcome_normal">
								<option value="New case" >New Case</option>
								<option value="Already in Program" >Already in program</option>
								<option value="Referred to BSFP" >Referred to BSFP</option>
								<option value="Follow up visit at BSFP" >Follow up visit at BSFP</option>
							</optgroup>


						</select>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-lg-7">
		<div class="ibox float-e-margins">
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

	<div class="col-lg-6 discharge-criteria-tab discharge-criteria-tabs" id="discharge-criteria-tab">
		<div class="ibox float-e-margins ">
			<div class="ibox-title">
				<h5>Discharge Critera</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<div class="form-group">
					<label for="">Exit</label>
					<select name="discharge_criteria_exit" class="form-control">
						<option value="">Select exit</option>
						<option value="Recovered" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Recovered') ? ' selected' : '' }}>Recovered</option>
						<option value="Age > 59m" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Age > 59m') ? ' selected' : '' }}>Age > 59m</option>
						<option value="Death" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Death') ? ' selected' : '' }}>Death</option>
						<option value="Defaulted" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Defaulted') ? ' selected' : '' }}>Defaulted</option>
						<option value="Non responder" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Non responder') ? ' selected' : '' }}>Non responder </option>
						{{--                                <option value="Medical Transfer" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Medical Transfer') ? ' selected' : '' }}>Medical Transfer </option>--}}
					</select>
				</div>
				<div class="form-group">
					<label for="">Transfer out</label>
					<select name="discharge_criteria_transfer_out" class="form-control">
						<option value="">Select transfer out</option>
						<option value="Transfer to SAM treatment" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to SAM treatment') ? ' selected' : '' }}>Transfer to SAM treatment</option>
						<option value="Transfer to MAM treatment" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to MAM treatment') ? ' selected' : '' }}>Transfer to MAM treatment</option>
						<option value="Transfer to SC" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to SC') ? ' selected' : '' }}>Transfer to SC</option>
						<option value="Transfer to other OTP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other OTP') ? ' selected' : '' }}>Transfer to other OTP</option>
						<option value="Transfer to other TSFP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other TSFP') ? ' selected' : '' }}>Transfer to other TSFP</option>
						<option value="Transfer to other BSFP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other BSFP') ? ' selected' : '' }}>Transfer to other BSFP</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Others</label>
					<select name="discharge_criteria_others" class="form-control">
						<option value="">Select others</option>
						<option value="Medical transfer" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_others == 'Medical transfer') ? ' selected' : '' }}>Medical transfer</option>
						<option value="Unkown" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_others == 'Unkown') ? ' selected' : '' }}>Unkown</option>
					</select>
				</div>
			</div>
		</div>
	</div>

</div>
