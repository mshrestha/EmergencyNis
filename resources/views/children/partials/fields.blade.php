<!-- div class="form-group"><label class="col-sm-3 control-label">Unique ID</label>
	<div class="col-sm-9"><input type="text" name="mnr_no" class="form-control" placeholder="ID Number" 
		value="{{ isset($child) ? $child->mnr_no : '' }}" required>
	</div>
</div -->
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


<div class="form-group"><label class="col-sm-3 control-label">Block Number</label>
	<div class="col-sm-9"><input type="text" name="sub_block_no" class="form-control" placeholder="Block Number"
		value="{{ isset($child) ? $child->sub_block_no : '' }}" required>
	</div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Household Number</label>
	<div class="col-sm-9"><input type="text" name="hh_no" class="form-control" placeholder="Household Number" 
		value="{{ isset($child) ? $child->hh_no : '' }}" required>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Lat/Lng</label>
	<div class="col-sm-3"><input type="text" name="gps_coordinates_lat" class="form-control" placeholder="Lat"
		value="@if(isset($child)){{ isset($child) ? $child->gps_coordinates_lat : '' }} @else {{$facility->latitude}} @endif" disabled>
	</div><div class="col-sm-3"><input type="text" name="gps_coordinates_lng" class="form-control" placeholder="Lng" 
		value="@if(isset($child)){{ isset($child) ? $child->gps_coordinates_lng : '' }} @else {{$facility->longitude}} @endif" disabled>
	</div>
</div>
<div class="hr-line-dashed"></div>
<!-- div class="form-group"><label class="col-sm-3 control-label">Family Count</label>
	<div class="col-sm-9"><input type="number" class="form-control" name="family_count_no" placeholder="Family Count" 
		value="{{ isset($child) ? $child->family_count_no : '' }}" >
	</div>
</div -->
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
		value="{{ isset($child) ? $child->block_leader_name : '' }}" required>
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
		value="{{ isset($child) ? $child->age : '' }}" ><span class="small">(months)</span>
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