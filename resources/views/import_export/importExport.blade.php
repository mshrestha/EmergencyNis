@extends('layouts.app')
@push('styles')
<style>
    .table-condensed {
        font-size: 10px;
    }
</style>
@endpush
@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>File Import</h5>
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
                    <form style="margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}"
                          class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input class="col-md-5" type="file" name="import_file"
                               style="border: 1px solid #a1a1a1; padding: 10px"/>
                        <button style="margin-left: 10px; padding: 10px; display: inline" class="btn blue start">
                            <i class="fa fa-upload"></i>
                            <span> Import File </span>
                        </button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="table-responsive">
                <table class="table dataTables table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Status</th>
                        {{--<td>Action</td>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($generated_data as $data)
                        <tr>
                            <td>{{$data->year}}</td>
                            <td>{{ date('F', mktime(0, 0, 0, $data->month, 10))}}</td>
                            <td>Imported</td>
                            {{--<td>Action</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection