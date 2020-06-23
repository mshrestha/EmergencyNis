@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Monthly Mail</h5>
					<div class="ibox-tools">
					</div>
				</div>
				<div class="ibox-content">
					<form action="{{ route('monthly_mail') }}" class="form-horizontal" method="get" >
						@csrf
					<table class="table table-striped table-bordered">
						<thead>
						<th><input type="checkbox"
								   id="select_all"/> Select All ( Mail Recipients )
						</th>
						</thead>
						<tbody>
                            <?php
                            $columns = 4;
                            $rows = ceil(count($contacts) / $columns);
                            echo '<table class="table table-striped table-hover" >';
                            for ($row = 0; $row < $rows; $row++) {
                            echo '<tr>';
                            foreach ($contacts as $k => $user) {
                            if ($k % $rows == $row) {
                            ?>
							<td>
								<input type="checkbox" class="checkbox" name="contacts[]" value="{{$user->email}}" >
							</td>
							<td >
								{{ $user->full_name}}<br/>{{$user->email }}
							</td>
                            <?php
                            }
                            }
                            echo '</tr>';
                            }
                            echo '</table>';
                            ?>

						</tbody>
					</table>
						<button class="btn btn-primary pull-right">Send Mail</button>
						<div class="clearfix"></div>
					</form>
				</div> <!-- ibox-content -->
			</div> <!-- ibox -->
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#select_all').on('click', function () {
            if (this.checked) {
                $('.checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function () {
                    this.checked = false;
                });
            }
        });

        $('.checkbox').on('click', function () {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });
    });

</script>
@endpush

