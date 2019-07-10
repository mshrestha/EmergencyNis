@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-8">
			<form action="{{ route('facility-followup.save', $facility->id) }}" method="post">
				@csrf
				@include('facility_followup.partials.fields')
				<div class="form-group">
					<button class="btn btn-primary" style="width: 100%;">Save</button>
				</div>
			</form>
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection