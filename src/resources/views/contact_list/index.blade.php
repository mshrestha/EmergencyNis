@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Contact List</h5>
					<div class="ibox-tools">
						<a href="{{ route('contact_list.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create Contact</a>
					</div>
				</div>
				<div class="ibox-content">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Full name</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $user)
							<tr>
								<td>{{ $user->full_name }}</td>
								<td>{{ $user->email }}</td>
								<td>
									<a href="{{ route('contact_list.edit', $user->id) }}" class="edit-btn">Edit</a>
                                    <form action="{{ route('contact_list.destroy', $user->id) }}" method="post" class="delete-form">
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

