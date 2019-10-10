@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-8">
			<form action="{{ route('facility-followup.update', $facility_followup->id) }}" method="post" id="followupform">
				@csrf
				@method('PATCH')

				@include('facility_followup.partials.fields')
				<!-- div class="form-group">
					<button class="btn btn-primary" style="width: 100%;">Save</button>
				</div -->
			</form>
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->

@endsection
@push('scripts')

<script src="{{ asset('js/plugins/steps/jquery.steps.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $("#wizard").steps({
            onFinished: function (event, currentIndex)
            {
                $('#followupform').submit();
            }
        });
        load_child({{$children->id}})
    })
function load_child(child) {
        $.ajax({
            url: '/child-info/'+ child,
            type: 'get',
            success: function(res) {
                $('#child-info').html(res);
            }
        });
    }
    

</script>

@endpush