<div class="form-group"><label class="col-sm-3 control-label">Facility ID</label>
	<div class="col-sm-9"><input type="text" name="facility_id" class="form-control" placeholder="Example - NS-C1E-XXXX/XXX-XXXX" required value="{{ isset($facility) ? $facility->facility_id : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Sattlement</label>
	<div class="col-sm-9">
		<select name="camp_id" class="form-control" required>
			<option value="">Select camp</option>
			@foreach($camps as $camp)
			<option value="{{ $camp->id }}" {{ (isset($facility) && $facility->camp_id == $camp->id) ? ' selected' : '' }}>{{ $camp->name }}</option>	
			@endforeach
		</select>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Program partner</label>
	<div class="col-sm-9"><input type="text" name="program_partner" class="form-control" placeholder="Program partner" required 
		value="{{ isset($facility) ? $facility->program_partner : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Implementing partner</label>
	<div class="col-sm-9"><input type="text" name="implementing_partner" class="form-control" placeholder="implementing_partner" required value="{{ isset($facility) ? $facility->implementing_partner : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">status</label>
	<div class="col-sm-9">
		<select name="status" class="form-control" required>
			<option value="Closed" {{ (isset($facility) && $facility->status == 'Closed') ? ' selected' : '' }}>Closed</option>
			<option value="Ongoing" {{ (isset($facility) && $facility->status == 'Ongoing') ? ' selected' : '' }}>Ongoing</option>
			<option value="Planned" {{ (isset($facility) && $facility->status == 'Planned') ? ' selected' : '' }}>Planned</option>
			<option value="Removed" {{ (isset($facility) && $facility->status == 'Removed') ? ' selected' : '' }}>Removed</option>
		</select>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Latitude</label>
	<div class="col-sm-9"><input type="text" name="latitude" class="form-control" placeholder="Latitude" required value="{{ isset($facility) ? $facility->latitude : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Longitude</label>
	<div class="col-sm-9"><input type="text" name="longitude" class="form-control" placeholder="Longitude" required value="{{ isset($facility) ? $facility->longitude : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Service type</label>
	<div class="col-sm-9">
		<select name="service_type" class="form-control" required>
			<option value="OTP" {{ (isset($facility) && $facility->service_type == 'OTP') ? ' selected' : '' }}>OTP</option>
			<option value="SC" {{ (isset($facility) && $facility->service_type == 'SC') ? ' selected' : '' }}>SC</option>
			<option value="TSFP/BSFP" {{ (isset($facility) && $facility->service_type == 'TSFP/BSFP') ? ' selected' : '' }}>TSFP/BSFP</option>
		</select>
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Facility reg</label>
	<div class="col-sm-9"><input type="text" name="facility_reg" class="form-control" placeholder="Facility reg" required value="{{ isset($facility) ? $facility->facility_reg : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Community reg</label>
	<div class="col-sm-9"><input type="text" name="community_reg" class="form-control" placeholder="Community reg" required value="{{ isset($facility) ? $facility->community_reg : '' }}"></div>
</div>
