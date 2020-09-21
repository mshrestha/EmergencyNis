@extends('layouts.app')
@section('content')
    <h2></h2>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h2>List of Sector
                        <a href="{{ route('sector.create') }}" class="pull-right">
                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>
                                Add Sector
                            </button>
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
                                <th>Program Partner</th>
                                <th width="100">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sectors as $key=>$sector)
                                <tr>
                                    <td><a class="client-link">{{ $key+1 }}</a></td>
                                    <td>{{ $sector->name }}</td>
                                    <td>
                                        @foreach($sector->pps as $sectorps)

                                        {{ $sectorps->name.', ' }}
                                            @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('implementingPartner.edit', $sector->id) }}" class="edit-btn">

                                            <button class="btn btn-info btn-circle" type="button"><i
                                                        class="fa fa-pencil"></i></button>
                                        </a>

                                        {{--<form--}}
                                                {{--action="{{ route('implementingPartner.destroy', $sector->id) }}"--}}
                                                {{--method="post"--}}
                                                {{--class="delete-form" id="delete-form{{$sector->id}}">--}}
                                            {{--@csrf--}}
                                            {{--@method('DELETE')--}}
                                            {{--<button class="btn btn-danger btn-circle" type="submit"--}}
                                                    {{--onclick="return confirm('Are you sure?')"--}}
                                            {{--><i class="fa fa-trash"></i></button>--}}
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

    $(document).ready(function () {


        $('.dataTables').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ImplementingPartner'},
                {extend: 'pdf', title: 'ImplementingPartner'},
                {
                    extend: 'print',
                    customize: function (win) {
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