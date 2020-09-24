
<div class="form-group"><label class="col-sm-4 control-label">Program Partner Name</label>
	<div class="col-sm-8"><input type="text" name="name" class="form-control" placeholder="Program partner Name" required
		value="{{ isset($pp) ? $pp->name : '' }}"></div>
</div>

<div class="form-group ">
	<label for="ip" class="col-md-4 control-label">Select Implementing Partner</label>
	<div class="col-md-8">
		<select name="ip[]" id="ip" class="form-control input-circle show-tick selectpicker"
				data-live-search="true" multiple>
			@foreach($ips as $ip)
				<option value="{{ $ip->id }}" >{{ $ip->name }}</option>
			@endforeach
		</select>


	</div>
</div>

