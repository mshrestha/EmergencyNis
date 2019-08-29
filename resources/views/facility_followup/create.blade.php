@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<form action="{{ route('facility-followup.save', $children->id) }}" method="post">
				@csrf
				@include('facility_followup.partials.fields')
				<div class="form-group row">
                    <div class="col-md-3">
                        <button class="btn btn-primary" style="width: 100%;">Save</button>
                    </div>
					
				</div>
			</form>
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
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