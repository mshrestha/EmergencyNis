<div class="form-group"><label class="col-sm-3 control-label">Volunteer Name</label>
	<div class="col-sm-9"><input type="text" name="name" class="form-control" placeholder="Name of Volunteer" required value="{{ isset($volunteer) ? $volunteer->name : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Settlement</label>
	<div class="col-sm-9">
		{{ html()->select('camp_id', $camps)->class('form-control')->placeholder('Select camp')->required() }}
	</div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Block</label>
	<div class="col-sm-9"><input type="text" name="block" class="form-control" placeholder="Block" required
		value="{{ isset($volunteer) ? $volunteer->block : '' }}"></div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Sub Block</label>
	<div class="col-sm-9"><input type="text" name="subblock" class="form-control" placeholder="Sub Block" required
		value="{{ isset($volunteer) ? $volunteer->subblock : '' }}"></div>
</div>
