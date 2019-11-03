<div class="form-group"><label class="col-sm-3 control-label"></label>
	<div class="col-sm-9">
        
		<input type="radio" name="sex" value="male" {{ (isset($child) && $child->sex == 'male') ? ' checked' : '' }}> Pregnant
		<input type="radio" name="sex" value="female" {{ (isset($child) && $child->sex == 'female') ? ' checked' : '' }}> Lactating
		
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Registration ID</label>
	<div class="col-sm-9"><input type="text" name="mnr_no" class="form-control" placeholder="Registration ID" 
		value="{{ isset($child) ? $child->mnr_no : '' }}">
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


<div class="form-group"><label class="col-sm-3 control-label">Block Number</label>
	<div class="col-sm-9"><input type="text" name="sub_block_no" class="form-control" placeholder="Block Number"
		value="{{ isset($child) ? $child->sub_block_no : '' }}" required>
	</div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Household Number/FCN</label>
	<div class="col-sm-9"><input type="text" name="hh_no" class="form-control" placeholder="Household Number" 
		value="{{ isset($child) ? $child->hh_no : '' }}" >
	</div>
</div>

<div class="hr-line-dashed"></div>
<!-- div class="form-group"><label class="col-sm-3 control-label">Family Count</label>
	<div class="col-sm-9"><input type="number" class="form-control" name="family_count_no" placeholder="Family Count" 
		value="{{ isset($child) ? $child->family_count_no : '' }}" >
	</div>
</div -->
<div class="form-group"><label class="col-sm-3 control-label">Name of P and L Woman</label>
	<div class="col-sm-9"><input type="text" class="form-control" name="mother_caregiver_name" placeholder="Mother's Name" 
		value="{{ isset($child) ? $child->mother_caregiver_name : '' }}" required>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Husband's Name</label>
	<div class="col-sm-9"><input type="text" class="form-control" name="fathers_name" placeholder="Husband's Name" 
		value="{{ isset($child) ? $child->fathers_name : '' }}" required>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Father's Name</label>
	<div class="col-sm-9"><input type="text" class="form-control" name="fathers_name" placeholder="Father's Name" 
		value="{{ isset($child) ? $child->fathers_name : '' }}" required>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Age</label>
	<div class="col-sm-9"><input type="number" class="form-control" style="width:100px" name="age" placeholder="Age" 
		value="{{ isset($child) ? $child->age : '' }}" ><span class="small">(Years)</span>
	</div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group"><label class="col-sm-3 control-label">Month of Pregnancy or Lactation</label>
	<div class="col-sm-9"><input type="text" class="form-control" name="age" placeholder="Pregnancy or Lactation Month" 
		value="" >(month)
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Expected Delivery Date</label>
	<div class="col-sm-9"><input type="date" name="next_visit_date" class="form-control" value="{{ isset($facility_followup) ? $facility_followup->next_visit_date : '' }}">
	</div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Actual date of delivery</label>
	<div class="col-sm-9"><input type="date" name="next_visit_date" class="form-control" value="{{ isset($facility_followup) ? $facility_followup->next_visit_date : '' }}">
	</div>
</div>
<div class="hr-line-dashed"></div>





