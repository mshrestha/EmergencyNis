<div class="form-group"><label class="col-sm-3 control-label">Registration Date</label>
	<div class="col-sm-9"><input type="date" name="registration_date" class="form-control" value="{{ isset($pregnant_women) ? $pregnant_women->registration_date : date('Y-m-d') }}">
	</div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">MOHA ID</label>
	<div class="col-sm-9"><input type="text" name="moha_id" class="form-control" placeholder="Moha ID"
		value="{{ isset($child) ? $child->moha_id : '' }}">
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Progress ID</label>
	<div class="col-sm-9"><input type="text" name="progress_id" class="form-control" placeholder="Progress ID"
		value="{{ isset($child) ? $child->progress_id : '' }}">
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Family Count Number (FCN)</label>
	<div class="col-sm-9"><input type="text" name="family_count_no" class="form-control" placeholder="Family Count Number"
								 value="{{ isset($child) ? $child->family_count_no : '' }}" >
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">SCOPE ID</label>
	<div class="col-sm-9"><input type="text" name="scope_no" class="form-control" placeholder="SCOPE ID"
								 value="{{ isset($child) ? $child->scope_no : '' }}" >
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Camp</label>
	<div class="col-sm-9">
		<select name="camp_id" class="form-control" required>
			<option value="">Select Camp</option>
			@foreach($camps as $camp)
            
			<option value="{{ $camp->id }}" 
                    @if ( $camp->id === $facility->camp->id ) 
                        selected 
                    @endif {{ (isset($child) && $child->camp_id == $camp->id) ? ' selected' : '' }}  >{{ $camp->name }} </option>
			@endforeach
		</select>
	</div>
</div>
<div class="hr-line-dashed"></div>



<div class="form-group"><label class="col-sm-3 control-label">Household Number</label>
	<div class="col-sm-9"><input type="text" name="hh_no" class="form-control" placeholder="Household Number"
		value="{{ isset($child) ? $child->hh_no : '' }}" >
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Block</label>
	<div class="col-sm-9"><input type="text" name="block" class="form-control" placeholder="Block"
		value="{{ isset($child) ? $child->block : '' }}" >
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Sub Block</label>
	<div class="col-sm-9"><input type="text" name="sub_block_no" class="form-control" placeholder="Sub Block"
		value="{{ isset($child) ? $child->sub_block_no : '' }}" >
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Lat/Lng</label>
	<div class="col-sm-3"><input id="currentLatitude" type="text" name="gps_coordinates_lat" class="form-control" placeholder="Lat"
		value="@if(isset($child)){{ isset($child) ? $child->gps_coordinates_lat : '' }} @else {{$facility->latitude}} @endif" >
	</div><div class="col-sm-3"><input id="currentLongitude" type="text" name="gps_coordinates_lng" class="form-control" placeholder="Lng" 
		value="@if(isset($child)){{ isset($child) ? $child->gps_coordinates_lng : '' }} @else {{$facility->longitude}} @endif" >
	</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group" >
	<label class="col-sm-3 control-label">Mother's FCN Number</label>
	<div class="col-sm-9">
		<select name="mother_moha_id" class="form-control show-tick selectpicker"
				data-live-search="true">
			<option value="">Select Mother</option>
			@foreach($mothers as $mother)
				<option value="{{ $mother->sync_id }}" {{ (in_array($mother->sync_id, $selected_mother)) ? ' selected' : '' }}>{{ $mother->family_count_no.' '.$mother->pregnant_women_name }}</option>
			@endforeach
		</select>
	</div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Mother's Name / Caregiver Name</label>
	<div class="col-sm-9"><input type="text" class="form-control" name="mother_caregiver_name" placeholder="Mother's Name" 
		value="{{ isset($child) ? $child->mother_caregiver_name : '' }}" required>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Father's Name</label>
	<div class="col-sm-9"><input type="text" class="form-control" name="fathers_name" placeholder="Father's Name" 
		value="{{ isset($child) ? $child->fathers_name : '' }}" required>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Block Leader</label>
	<div class="col-sm-9"><input type="text" class="form-control" name="block_leader_name" placeholder="Block Leader" 
		value="{{ isset($child) ? $child->block_leader_name : '' }}" >
	</div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group"><label class="col-sm-3 control-label">Child Name</label>
	<div class="col-sm-9"><input type="text" class="form-control" name="children_name" placeholder="Child Name" 
		value="{{ isset($child) ? $child->children_name : '' }}" required>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Date of Birth</label>
	<div class="col-sm-9"><input type="date" class="form-control" name="date_of_birth" 
		value="{{ isset($child) ? $child->date_of_birth : '' }}" >
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Age</label>
	<div class="col-sm-9"><input type="number" class="form-control" style="width:100px" name="age" placeholder="Age" 
		value="{{ isset($child) ? $child->age : '' }}" required><span class="small">(months)</span>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Age Group (Months)</label>
	<div class="col-sm-9">
		<input type="radio" name="age_group" value="0to6m" {{ (isset($child) && $child->age_group == '0to5m') ? ' checked' : '' }}> 0 to 5
		<input type="radio" name="age_group" value="6to11m" {{ (isset($child) && $child->age_group == '6to11m') ? ' checked' : '' }}> 6 to 11
		<input type="radio" name="age_group" value="12to23m" {{ (isset($child) && $child->age_group == '12to23m') ? ' checked' : '' }}> 12 to 23
		<input type="radio" name="age_group" value="24to59m" {{ (isset($child) && $child->age_group == '24to59m') ? ' checked' : '' }}> 24 to 59
		<input type="radio" name="age_group" value="others" {{ (isset($child) && $child->age_group == 'others') ? ' checked' : '' }}> Others
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Sex</label>
	<div class="col-sm-9">
		<input type="radio" name="sex" value="male" {{ (isset($child) && $child->sex == 'male') ? ' checked' : '' }}> Male
		<input type="radio" name="sex" value="female" {{ (isset($child) && $child->sex == 'female') ? ' checked' : '' }}> Female
		<input type="radio" name="sex" value="other" {{ (isset($child) && $child->sex == 'other') ? ' checked' : '' }}> Other
	</div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Picture</label>
	<div class="col-sm-9">
		<button type="button" style="display:block; height:30px;" onclick="document.getElementById('getPicture').click()">
			{{ (isset($child) && $child->picture) ? $child->picture : 'Select image' }}
		</button>
		<input type="file" class="form-control" name="picture" id="getPicture" style="display: none;">
	</div>
</div>