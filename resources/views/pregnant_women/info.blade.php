<div class="row m-b-lg m-l-md">
	<div class="col-lg-12">
		<strong>{{ $pregnant_women->pregnant_women_name }}</strong>
		<p>
			{{ 'Husband : '.$pregnant_women->husbands_name }}<br />
			{{ 'Father : '.$pregnant_women->fathers_name }}<br /><br />
			{{ 'Reg. ID : '.$pregnant_women->registration_id}}<br />
			{{ 'Reg. Date : '.$pregnant_women->registration_date}}<br />
			{{ 'Moha ID : '.$pregnant_women->moha_id}}<br />
			{{ 'Progress ID : '.$pregnant_women->progress_id}}<br />
			{{ 'FCN : '.$pregnant_women->family_count_no}}<br />
			{{ 'ANC/PNC : '.$pregnant_women->anc_pnc_card_no}}<br />
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

