<div class="ibox float-e-margins">
	<div class="ibox-title">
		<div class="ibox-tools">
			<a class="collapse-link">
				<i class="fa fa-chevron-up"></i>
			</a>

			<a class="close-link">
				<i class="fa fa-times"></i>
			</a>
		</div>
		<h2>General Information</h2>
	</div>
	<div class="ibox-content">
		<div class="form-group" id="data_1"><label class="col-sm-3 control-label">Next visit date</label>
			<div class="col-sm-9">
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="date" name="next_visit_date" class="form-control" value="{{ isset($community_followup) ? $community_followup->next_visit_date : '' }}" style="width:200px !important" >
				</div>
			</div>
		</div>
		<div class="form-group"><label class="col-sm-3 control-label">Age</label>
			<div class="col-sm-9">
				<input type="number" name="age" class="form-control" placeholder="Age" value="{{ isset($community_followup) ? $community_followup->age : '' }}" style="width:240px !important">
			</div>
		</div>

		<div class="form-group"><label class="col-sm-3 control-label">Exclusive Breastfeeding</label>
			<div class="col-sm-9">
				<input type="checkbox" name="exclusive_breastfeeding" class="js-switch" 
					{{ (isset($community_followup) && $community_followup->exclusive_breastfeeding == 1) ? ' checked' : '' }}
				style="display: none;" data-switchery="true" value="1">
			</div>
		</div>
		<div class="form-group"><label class="col-sm-3 control-label">Continued Breastfeeding</label>
			<div class="col-sm-9">
				<input type="checkbox" name="continued_breastfeeding" class="js-switch_2" 
					{{ (isset($community_followup) && $community_followup->continued_breastfeeding == 1) ? ' checked' : '' }}
				style="display: none;" data-switchery="true" value="1">
			</div>
		</div>

		<div class="hr-line-dashed"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Received all EPI vaccinations as per schedule</label>
			<div class="col-sm-9">
				<input type="checkbox" name="received_all_epi_vaccination" class="js-switch_3" 
					{{ (isset($community_followup) && $community_followup->received_all_epi_vaccination == 1) ? ' checked' : '' }}
				style="display: none;" data-switchery="true" value="1">
			</div>
		</div>
	</div>
</div>
<div class="ibox float-e-margins">
	<div class="ibox-title">
		<div class="ibox-tools">
			<a class="collapse-link">
				<i class="fa fa-chevron-up"></i>
			</a>

			<a class="close-link">
				<i class="fa fa-times"></i>
			</a>
		</div>
		<h2>Complementary Feeding</h2>
	</div>
	<div class="ibox-content">
		<div class="form-group">
			<label class="col-sm-3 control-label">Introduction time (Age)</label>
			<div class="col-sm-9">
				<div class="radio radio-success">
					<input type="radio" id="inlineRadio1" value="less_than_6_months" name="introduction_time"
						{{ (isset($community_followup) && $community_followup->introduction_time == 'less_than_6_months') ? ' checked' : '' }}
					>
					<label for="inlineRadio1">Less than 6 Months</label><br />
					<input type="radio" id="inlineRadio2" value="6_months" name="introduction_time"
						{{ (isset($community_followup) && $community_followup->introduction_time == '6_months') ? ' checked' : '' }}
					>
					<label for="inlineRadio2"> 6 months </label><br />
					<input type="radio" id="inlineRadio3" value="more_than_6_months" name="introduction_time"
						{{ (isset($community_followup) && $community_followup->introduction_time == 'more_than_6_months') ? ' checked' : '' }}
					>
					<label for="inlineRadio3"> More than 6 months </label>
				</div>
				<div class="radio radio-inline">
				</div>
			</div>
		</div>
		<div class="form-group"><label class="col-sm-3 control-label">Frequency</label>
			<div class="col-sm-9">
				<select name="frequency" class="form-control" >
					<option value="less_than_2" {{ (isset($community_followup) && $community_followup->frequency == 'less_than_2') ? ' selected' : '' }}>Less than 2</option>
					<option value="2" {{ (isset($community_followup) && $community_followup->frequency == '2') ? ' selected' : '' }}>2</option>
					<option value="3" {{ (isset($community_followup) && $community_followup->frequency == '3') ? ' selected' : '' }}>3</option>
					<option value="more_than_3" {{ (isset($community_followup) && $community_followup->frequency == 'more_than_3') ? ' selected' : '' }}>More than 3</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Number of food groups</label>
			<div class="col-sm-9">
				<select name="no_of_food_groups" class="form-control" >
					<option value="4" {{ (isset($community_followup) && $community_followup->no_of_food_groups == '4') ? ' selected' : '' }}>4</option>
					<option value="more_than_4" {{ (isset($community_followup) && $community_followup->no_of_food_groups == 'more_than_4') ? ' selected' : '' }}>More than 4</option>
					<option value="less_than_4" {{ (isset($community_followup) && $community_followup->no_of_food_groups == 'less_than_4') ? ' selected' : '' }}>Less than 4</option>
				</select>
			</div>

		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Quantity of food given</label>
			<div class="col-sm-9">
				<select name="quantity_of_food" class="form-control" >
					<option value="<125ml" {{ (isset($community_followup) && $community_followup->quantity_of_food == '<125ml') ? ' selected' : '' }}><125ml</option>
					<option value="=>125 ml" {{ (isset($community_followup) && $community_followup->quantity_of_food == '=>125 ml') ? ' selected' : '' }}><=>125 ml</option>
					<option value=">125ml to <250ml" {{ (isset($community_followup) && $community_followup->quantity_of_food == '>125ml to <250ml') ? ' selected' : '' }}>>125ml to <250ml</option>
					<option value="=>250ml" {{ (isset($community_followup) && $community_followup->quantity_of_food == '=>250ml') ? ' selected' : '' }}>=>250ml</option>
				</select>
			</div>
		</div>
	</div>
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>

				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
			<h2>Anthropometric Information</h2>
		</div>
		<div class="ibox-content">
			<div class="form-group"><label class="col-sm-3 control-label">MUAC</label>
				<div class="col-sm-9">
					<input type="text" name="muac" id="ionrange_2" value="{{ isset($community_followup) ? $community_followup->muac : '' }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Edema</label>
				<div class="col-sm-9">
					<input type="checkbox" name="edema" class="js-switch_4" 
						{{ (isset($community_followup) && $community_followup->edema == 1) ? ' checked' : '' }}
					style="display: none;" data-switchery="true" value="1">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Nutritional Status</label>
				<div class="col-sm-9">
					<select name="nutritional_status" class="form-control form-nutritional-status">
						<option value="SAM (<11.5cm)" {{ (isset($community_followup) && $community_followup->nutritional_status == 'SAM (<11.5cm)') ? ' selected' : '' }}>SAM (<11.5cm)</option>
						<option value="MAM (11.5 to <12.5cm)" {{ (isset($community_followup) && $community_followup->nutritional_status == 'MAM (11.5 to <12.5cm)') ? ' selected' : '' }}>MAM (11.5 to <12.5cm)</option>
						<option value="At Risk (12.5 to <13.5cm)" {{ (isset($community_followup) && $community_followup->nutritional_status == 'At Risk (12.5 to <13.5cm)') ? ' selected' : '' }}>At Risk (12.5 to <13.5cm)</option>
						<option value="Normal (MAUC =>13.5cm)" {{ (isset($community_followup) && $community_followup->nutritional_status == 'Normal (MAUC =>13.5cm)') ? ' selected' : '' }}>Normal (MAUC =>13.5cm)</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Referred type</label>
				<div class="col-sm-9">
					<select name="refered_to_facility" class="form-control" >
						<option value="bsfp" {{ (isset($community_followup) && $community_followup->refered_to_facility == 'bsfp') ? ' selected' : '' }}>BSFP</option>
						<option value="otp" {{ (isset($community_followup) && $community_followup->refered_to_facility == 'otp') ? ' selected' : '' }}>OTP</option>
						<option value="tsfp" {{ (isset($community_followup) && $community_followup->refered_to_facility == 'tsfp') ? ' selected' : '' }}>TSFP</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Facility</label>
				<div class="col-sm-9">
					<select name="facility_id" class="form-control" >
						<option value="">Select Facility</option>
						@foreach($facilities as $facility)
						<option value="{{ $facility->id }}"
							{{ (isset($community_followup) && $community_followup->facility_id == $facility->id) ? ' selected' : '' }}
						>{{ $facility->facility_id }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Referral ID</label>
				<div class="col-sm-9">
					<input type="text" name="referel_slip_no" class="form-control" placeholder="Referral ID" value="{{ isset($community_followup) ? $community_followup->referel_slip_no : '' }}">
				</div>
			</div>
		</div>
	</div>
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>

				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
			<h2>Nutritional Supplement</h2>
		</div>
		<div class="ibox-content">
			<div class="form-group">
				<label class="col-sm-3 control-label">Distribution of MNP Sachet</label>
				<div class="col-sm-9">
					<input type="text" name="distribution_mnp_sachet" class="form-control" placeholder="Distribution of MNP Sachet" value="{{ isset($community_followup) ? $community_followup->distribution_mnp_sachet : '' }}" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Vitamin A</label>
				<div class="col-sm-9">
					<input type="text" name="vitamin_a" class="form-control" placeholder="Vitamin A" value="{{ isset($community_followup) ? $community_followup->vitamin_a : '' }}" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Deworming</label>
				<div class="col-sm-9">
					<input type="text" name="deworming" class="form-control" placeholder="Deworming" value="{{ isset($community_followup) ? $community_followup->deworming : '' }}" >
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" style="margin-left: 20px;" type="submit">Save</button>
	</div>
</div>

@push('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>

<script>
	var elem = document.querySelector('.js-switch');
	var switchery = new Switchery(elem, { color: '#0099FF' });

	var elem_2 = document.querySelector('.js-switch_2');
	var switchery_2 = new Switchery(elem_2, { color: '#0099FF' });
	var elem_3 = document.querySelector('.js-switch_3');
	var switchery_3 = new Switchery(elem_3, { color: '#0099FF' });
	var elem_4 = document.querySelector('.js-switch_4');
	var switchery_4 = new Switchery(elem_4, { color: '#0099FF' });

	$("#ionrange_2").ionRangeSlider({
		min: 0,
		max: 20,
		type: 'single',
		step: 0.1,
		postfix: " cms",
		prettify: false,
		hasGrid: true,
		onChange: function (data) {
            var value = data.fromNumber;

            if(value < 11.5) {
            	$('.form-nutritional-status').val('SAM (<11.5cm)');
            } else if (value >= 11.5 && value < 12.5) {
            	$('.form-nutritional-status').val('MAM (11.5 to <12.5cm)');
            } else if (value >= 12.5 && value < 13.5) {
            	$('.form-nutritional-status').val('At Risk (12.5 to <13.5cm)');
            } else if (value >= 13.5) {
            	$('.form-nutritional-status').val('Normal (MAUC =>13.5cm)');
            }
        }
	});
</script>
@endpush
