@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-12 tab-content">
                    <div class="ibox-title">
                        <h2>
                            IYCF Group Session
                        </h2>
                        <div class="ibox-content">
                            <div class="clients-list">
                                <div class="full-height-scroll">
                                    <div class="table-responsive">
                                        <table class="table dataTables table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Session Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>session Type</th>
                                                <th>session Topic</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($iycfGroupSessions as $key=>$data)
                                                <tr>
                                                    <td>{{Carbon\Carbon::parse($data->session_date)->format('d-M-Y')}}</td>
                                                    <td>{{Carbon\Carbon::parse($data->start_time)->format('h:ia')}}</td>
                                                    <td>{{Carbon\Carbon::parse($data->end_time)->format('h:ia')}}</td>
                                                    <td>{{ $data->session_type}}</td>
                                                    <td>{{ $data->session_topic}}</td>
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
        </div>
    </div>
</div> <!-- row -->
@endsection


