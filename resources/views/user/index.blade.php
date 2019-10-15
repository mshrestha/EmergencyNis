@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Users List</h5>
					<div class="ibox-tools">
						<a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create user</a>
					</div>
				</div>
				<div class="ibox-content">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>User</th>
								<th>Email</th>
                                <th>Facility</th>
								<th>Role</th>
								<th>Category</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
                                <td>{{ $user->facility['facility_id'] }}</td>
								<td>{{ $user->role }}</td>
								<td>{{ $user->category }}</td>
								<td>
									<a href="{{ route('user.edit', $user->id) }}" class="edit-btn">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="post" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="delete-btn">Delete</button>
                                    </form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div> <!-- ibox-content -->
			</div> <!-- ibox -->
		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>
<script></script>
@endsection
