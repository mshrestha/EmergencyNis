@extends('layouts.app')
@section('content')
<h2></h2>
<div class="row">
    <div class="col-lg-8">
        <div class="ibox">
            <div class="ibox-title">
                <h2>List of Program Partner
                <a href="{{ route('programPartner.create') }}" class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Program Partner</button>
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
                                <th>Implementing Partner</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pps as $key=>$pp)
                            <tr >
                                <td><a class="client-link">{{ $key+1 }}</a></td>
                                <td>{{ $pp->name }}</td>
                                <td>
                                    @foreach($pp->ips as $ppip)
                                    {{ $ppip->name.', ' }}
                                        @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('programPartner.edit', $pp->id) }}" class="edit-btn">

                                    <button class="btn btn-info btn-circle" type="button"><i class="fa fa-pencil"></i></button>
                                    </a>

                                    {{--<form action="{{ route('programPartner.destroy', $pp->id) }}" method="post" class="delete-form">--}}
                                        {{--@csrf--}}
                                        {{--@method('DELETE')--}}
                                        {{--<button  class="btn btn-danger btn-circle" type="submit"--}}
                                                 {{--onclick="return confirm('Are you sure?')" >--}}
                                            {{--<i class="fa fa-trash"></i></button>--}}
                                    {{--</form>--}}
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
                    {extend: 'excel', title: 'ProgramPartner'},
                    {extend: 'pdf', title: 'ProgramPartner'},
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