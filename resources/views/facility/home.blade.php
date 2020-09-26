@extends('layouts.app')
@section('content')
<h2></h2>
<div class="row">
    <div class="col-lg-8">
        <div class="ibox">
            <div class="ibox-title">
                <h2>List of Facilities    
                <a href="{{ route('facility.create') }}" class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Facility</button>
                </a> 
                </h2>
            </div>
            <div class="ibox-content">
                
                <div class="full-height-scroll">
                    
                </div>
                <div class="table-responsive">
                    <table class="table dataTables table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Facility ID</th>
                                <th>Camp</th>
                                <th>Implementing<br/> Partner</th>
                                <th>Program<br/> Partner</th>
                                <th>Service<br/> Type</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($facilities as $key=>$facility)
                            <tr class="facility-client" data-facility-id={{ $facility->id }}>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $facility->name }}</td>
                                <td>{{ $facility->facility_id }}</td>
                                <td>{{ $facility->camp->name }}</td>
                                <td>
                                    {{($facility->ip_id!=null) ? $facility->ip->name :''}}
                                </td>
                                <td> {{($facility->pp_id!=null) ? $facility->pp->name :''}} </td>
                                <td >
                                    @foreach($facility->services as $service)
                                        {{$service->name.', '}}
                                     @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('facility.edit', $facility->id) }}" class="edit-btn">

                                    <button class="btn btn-info btn-circle" type="button"><i class="fa fa-pencil"></i></button>
                                    </a>
                                    <form action="{{ route('facility.destroy', $facility->id) }}" method="post" class="delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button  class="btn btn-danger btn-circle" type="button" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
         
</div>
@endsection

@push('scripts')

    
    <script src="js/plugins/dataTables/datatables.min.js"></script>

  
<script>
    
    $(document).ready(function() {

    
           
 $('.dataTables').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'facility'},
                    {extend: 'pdf', title: 'facility'},
                    {extend: 'print',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');
                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                        }
                    }
                ]
            });
            
    });

    
</script>
@endpush