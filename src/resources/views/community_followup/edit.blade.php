@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-8">
			<form action="{{ route('community-followup.update', $community_followup->id) }}" class="form-horizontal" method="post">
				@csrf
				@method('PATCH')
				@include('community_followup.partials.fields')
			</form>
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection