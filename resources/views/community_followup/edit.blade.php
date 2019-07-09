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
@push('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>

<script>
	$('#data_1 .input-group.date').datepicker({
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true
	});

	var elem = document.querySelector('.js-switch');
	var switchery = new Switchery(elem, { color: '#0099FF' });

	var elem_2 = document.querySelector('.js-switch_2');
	var switchery_2 = new Switchery(elem_2, { color: '#0099FF' });
	var elem_3 = document.querySelector('.js-switch_3');
	var switchery_3 = new Switchery(elem_3, { color: '#0099FF' });
	var elem_4 = document.querySelector('.js-switch_4');
	var switchery_4 = new Switchery(elem_4, { color: '#0099FF' });

	$("#ionrange_2").ionRangeSlider({
		min: 0,
		max: 20,
		type: 'single',
		step: 0.1,
		postfix: " cms",
		prettify: false,
		hasGrid: true
	});

</script>
@endpush
