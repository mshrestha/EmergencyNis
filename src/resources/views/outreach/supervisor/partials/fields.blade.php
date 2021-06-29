<div class="form-group">
	{{ html()->text('name')->class('form-control')->placeholder('Name')->required() }}
</div>

<div class="form-group">
	<label>Camps</label>
	{{ html()->select('camp_id', $camps)->class('form-control')->placeholder('Select camp')->required() }}
</div>