@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-12 tab-content">
                    <div class="ibox-title">
                        <h2>
                            Supply
                            {{--<a href="{{ route('children.create') }}" class="pull-right">--}}
                                {{--<button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>--}}
                                    {{--Add Supply Report--}}
                                {{--</button>--}}
                            {{--</a>--}}
                        </h2>
                        <hr/>
                        <div class="row">
                            <a href="{{ route('supply.create') }}" class="pull-right">
                                <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                            class="fa fa-plus"></i>
                                    Add Supply
                                </button>
                            </a>

                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="clients-list">
                            <div class="full-height-scroll">
                                <div class="table-responsive">
                                    <table class="table dataTables table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Supply<br/>Type </th>
                                                <th>Supply<br/>Item </th>
                                                <th>Location</th>
                                                <th>Qty</th>
                                                {{--<th>Action</th>--}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($supplies as $key=>$data)
                                            <tr>
                                                <td>{{Carbon\Carbon::parse($data->supply_date)->format('d-M-Y')}}</td>
                                                <td>{{ $data->supply_type }}</td>
                                                <td>{{ $data->supply_item }}</td>
                                                <td>{{ $data->location}}</td>
                                                <td>{{ $data->quantity.' '.$data->unit }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-sm-4">
            </div> <!-- col -->
        </div>
    </div>
</div> <!-- row -->
@endsection


@push('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{!! asset('js/plugins/moment.min.js')!!}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<script>
    $(document).ready(function () {

        $('.dataTables').DataTable({
            "aaSorting": [],
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgtip',
            buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'RegisteredChildren'},
            {extend: 'pdf', title: 'RegisteredChildren'},
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