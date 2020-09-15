
<div class="form-group"><label class="col-sm-4 control-label">Camp Name</label>
	<div class="col-sm-8"><input type="text" name="name" class="form-control" placeholder="Camp Name" required
		value="{{ isset($camp) ? $camp->name : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-4 control-label">Block</label>
	<div class="col-sm-8"><input type="text" name="block_letter" class="form-control" placeholder="Camp Block" required
		value="{{ isset($camp) ? $camp->block_letter : '' }}"></div>
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

