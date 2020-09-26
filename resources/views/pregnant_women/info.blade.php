<div class="row m-b-lg m-l-md">
	<div class="col-lg-12">
		<strong>{{ $pregnant_women->pregnant_women_name }}</strong>
		<p>
			{{ $pregnant_women->registration_id}}<br />
			{{ $pregnant_women->age }} years old<br />
			Block {{ $pregnant_women->block_no }}, Household {{ $pregnant_women->household_no }} <br />
		</p>

		<a href="{{ route('pregnant-women.edit', $pregnant_women->sync_id) }}" class="edit-btn">
			<button class="btn btn-info btn-circle" type="button"><i class="fa fa-pencil"></i></button>
		</a>

		<a href="{{ route('pregnant-women-followup.show', $pregnant_women->sync_id) }}" class="edit-btn">
			<button class="btn btn-default btn-circle" type="button" title="Followup"><i
						class="fa fa-plus"></i></button>
		</a>
		<form action="{{ route('pregnant-women.destroy', $pregnant_women->sync_id) }}" method="post" class="delete-form" style="margin-left: 10px;">
			@csrf
			@method('DELETE')
			<button  class="btn btn-danger btn-circle" type="submit" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></button>
		</form>
	</div>
</div>

<div class="client-detail">
	<div class="full-height-scroll">
		<div id="followup-1" class="tab-pane active">
			<div style="margin-top: 10px;">
				<strong>Followups</strong>
				<div id="vertical-timeline" class="vertical-container dark-timeline">
					@foreach($pregnant_women->followups as $followup)
					<div class="vertical-timeline-block">
						<div class="vertical-timeline-icon gray-bg">
							<i class="fa fa-briefcase"></i>
						</div>
						<div class="vertical-timeline-content">
							<span class="vertical-date small text-muted"> {{ $followup->date }} </span><br />
							<p>Visited {{ $followup->facility->facility_id }}</p>

							<strong>MUAC: </strong> {{ $followup['muac'] }} cm <br />							
							<strong>Weight: </strong> {{ $followup['weight'] }} kg <br />
							
							<form action="{{ route('pregnant-women-followup.destroy', $followup->sync_id) }}" method="post" class="delete-form pull-right">
								@csrf
								@method('DELETE')

								<button type="submit" onclick="return confirm('Are you sure?')" style="background: none;border: none;color: #337ab7;">Delete</button>
							</form>

							<span class="pull-right" style="margin-top: 1px;">
								<a href="{{ route('pregnant-women-followup.edit', $followup->sync_id) }}">Edit</a>
							</span>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>