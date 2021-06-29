@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-12 tab-content">
                    <div class="ibox-title">
                        <h2>
                            Group Education Session
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
                                                <th>Session Type</th>
                                                <th>Session Topic</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($iycfGroupSessions as $key=>$data)
                                                <tr>
                                                    <td>{{Carbon\Carbon::parse($data->session_date)->format('d-M-Y')}}</td>
                                                    <td>{{Carbon\Carbon::parse($data->start_time)->format('h:ia')}}</td>
                                                    <td>{{Carbon\Carbon::parse($data->end_time)->format('h:ia')}}</td>
                                                    <td>{{ ($data->session_type=='option2'?'MIYCN':'General')}}</td>
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
@push('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>

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


