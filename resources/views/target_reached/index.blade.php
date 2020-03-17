@extends('layouts.app')
@push('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
<link href="{{ asset('custom/jquery-year-picker/css/yearpicker.css') }}" rel="stylesheet"/>

@endpush
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Add Target Reached Information</h5>
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
                    <form action="{{ route('targetReached.store') }}" class="form-horizontal" method="POST">
                        @csrf

                        <div class="row ">


                            <div class="form-group">
                                <label class="col-sm-3 control-label">Indicator</label>
                                <div class="col-sm-7">
                                    <select name="indicator_id" class="form-control show-tick selectpicker"
                                            data-live-search="true" required>
                                        <option value="">Select Indicator</option>
                                        @foreach($indicators as $indicator)
                                            <option value="{{ $indicator->id }}">{{ $indicator->indicator_short_title.'-'.$indicator->indicator }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Year </label>
                                <div class="col-md-3">
                                    <input class="yearpicker form-control" style="width: 240px;" type="text" name="data_year"
                                           value="<?php echo date('Y') ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                    <label class="col-md-3 control-label">Target </label>
                                    <div class="col-md-7">
                                        <input type="text" name="target" class="form-control"
                                               placeholder="Target">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Reached </label>
                                    <div class="col-md-7">
                                        <input type="text" name="reached" class="form-control"
                                               placeholder="Reached">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Comments</label>
                                    <div class=" col-md-7">
                                <textarea type="text" class="form-control " name="comments"
                                          placeholder="Comments"></textarea>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Use This Reached</label>
                                <div class="col-md-7">
                                    <select name="use_this" class="form-control">
                                        {{--<option value="">Select supply Item</option>--}}
                                        <option value="Use this reached data">Use this reached data</option>
                                        <option value="Use system generated reached data">Use system generated reached data</option>

                                    </select>
                                </div>
                            </div>
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
                                    <th>Year</th>
                                    <th>Target</th>
                                    <th>Reached</th>
                                    <th>Use This</th>
                                    {{--<td>Action</td>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($targetReached as $key=>$data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->indicator->indicator}}</td>
                                        <td>{{$data->data_year}}</td>
                                        <td>{{$data->target}}</td>
                                        <td>{{$data->reached}}</td>
                                        <td>{{$data->use_this}}</td>
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
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>

<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('custom/jquery-year-picker/js/yearpicker.js')}}"></script>
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

<script>
    $(document).ready(function() {
        $(".yearpicker").yearpicker({
//            year: 2015,
            startYear: 2015,
            endYear: 2100
        });
    });
</script>

@endpush