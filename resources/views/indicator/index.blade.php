@extends('layouts.app')
@push('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Add Indicator</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('indicator.store') }}" class="form-horizontal" method="POST">
                        @csrf

                        <div class="row ">


                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label col-md-5">Supply Type</label>--}}
                                    {{--<div class="col-md-7">--}}
                                        {{--<select name="supply_type" class="form-control">--}}
                                            {{--<option value="">Select supply Type</option>--}}
                                            {{--<option value="Received">Received</option>--}}
                                            {{--<option value="Distribution">Distribution</option>--}}
                                            {{--<option value="Damage">Damage</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Indicator</label>
                                    <div class="col-md-7">
                                        <input type="text" name="indicator" class="form-control"
                                               placeholder="Indicator">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Indicator Short Title</label>
                                    <div class="col-md-7">
                                        <input type="text" name="indicator_short_title" class="form-control"
                                               placeholder="Indicator Short Title">
                                    </div>
                                </div>

                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label col-md-5">Remarks</label>--}}
                                    {{--<div class=" col-md-7">--}}
                                {{--<textarea type="text" class="form-control " name="remarks"--}}
                                          {{--placeholder="Remarks"></textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-7">
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                                class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                        Submit
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox-content">
                <div class="clients-list">
                    <div class="full-height-scroll">
                        <div class="table-responsive">
                            <table class="table dataTables table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Indicator</th>
                                    <th>short Title</th>
                                    {{--<td>Action</td>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($indicators as $key=>$data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->indicator}}</td>
                                        <td>{{$data->indicator_short_title}}</td>
                                        {{--<td>Action</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>
<script>
    $('.dataTables').DataTable({
        pageLength: 12,
        responsive: true,
        ordering: false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
//            {extend: 'copy'},
//            {extend: 'csv'},
//            {extend: 'excel', title: 'RegisteredChildren'},
//            {extend: 'pdf', title: 'RegisteredChildren'},
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

</script>
@endpush