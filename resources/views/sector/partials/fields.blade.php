
<div class="form-group"><label class="col-sm-4 control-label">Sector Name</label>
	<div class="col-sm-8"><input type="text" name="name" class="form-control" placeholder="Sector Name" required
		value="{{ isset($sector) ? $sector->name : '' }}"></div>
</div>

<div class="form-group ">
		<label for="pp" class="col-md-4 control-label">Select Program Partner</label>
		<div class="col-md-8">
			<select name="pp[]" id="pp" class="form-control input-circle show-tick selectpicker"
					data-live-search="true" multiple>
				@foreach($pps as $pp)
{{--					<option value="{{ $pp->id }}">{{ $pp->name }}</option>--}}
					<option value="{{ $pp->id }}" {{ (in_array($pp->id,$selected_pp) ) ? ' selected' : '' }}>{{ $pp->name }}</option>

				@endforeach
			</select>
		</div>
</div>

