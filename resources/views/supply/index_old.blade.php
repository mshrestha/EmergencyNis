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
                            <form action="{{ route('supply.create') }}" class="form-horizontal" method="GET">
                                {{--@csrf--}}

                                <div class="form-group">
                                    <label class="control-label col-md-2">Select Month</label>
                                    <div class="col-sm-3">
                                        <select class="bs-select form-control" name="month">
                                            <option value="01" {{($current_month=='02') ? 'selected' : ''}}>January</option>
                                            <option value="02" {{($current_month=='03') ? 'selected' : ''}}>February</option>
                                            <option value="03" {{($current_month=='04') ? 'selected' : ''}}>March</option>
                                            <option value="04" {{($current_month=='05') ? 'selected' : ''}}>April</option>
                                            <option value="05" {{($current_month=='06') ? 'selected' : ''}}>May</option>
                                            <option value="06" {{($current_month=='07') ? 'selected' : ''}}>June</option>
                                            <option value="07" {{($current_month=='08') ? 'selected' : ''}}>July</option>
                                            <option value="08" {{($current_month=='09') ? 'selected' : ''}}>August</option>
                                            <option value="09" {{($current_month=='10') ? 'selected' : ''}}>September</option>
                                            <option value="10" {{($current_month=='11') ? 'selected' : ''}}>October</option>
                                            <option value="11" {{($current_month=='12') ? 'selected' : ''}}>November</option>
                                            <option value="12" {{($current_month=='01') ? 'selected' : ''}}>December</option>
                                        </select>
                                    </div>
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                    <label class="control-label col-sm-2">Select Year </label>
                                    <div class="col-sm-3">
                                        <input class="date-oyear form-control" type="text" name="year"
                                               style=" z-index: 9999 !important;"
                                               value="<?php echo date('Y') ?>">
                                    </div>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                        Add Supply
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="clients-list">
                            <div class="full-height-scroll">
                                <div class="table-responsive">
                                    <table class="table dataTables table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Period</th>
                                                <th>Supply</th>
                                                <th>Remaining from Last Month</th>
                                                <th>Received</th>
                                                <th>Consumed</th>
                                                <th>Damaged</th>
                                                <th>Balance</th>
                                                {{--<th>Action</th>--}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($supplies as $key=>$data)
                                            <tr>
                                                <td>{{ $data->period }}</td>
                                                <td>{{ $data->supply }}</td>
                                                <td>{{ $data->remainingFromLastMonth }}</td>
                                                <td>{{ $data->received }}</td>
                                                <td>{{ $data->consumed }}</td>
                                                <td>{{ $data->damaged }}</td>
                                                <td>{{ $data->balance }}</td>
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