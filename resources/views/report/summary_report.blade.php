@extends('layouts.app')
@section('content')
    <h2></h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    {{--<h2>Facility wise Summary Report--}}
                    {{--</h2>--}}
                    <form action="{{ route('summary_report_ym') }}" class="form-horizontal" method="get">
                        <div class="form-group">
                            <h2 class="col-sm-3">Facility wise Summary Report </h2>
                            <h4 class="col-sm-3">( From {{\Carbon\Carbon::parse($reportStart)->format(' d-M-Y').' To ' .\Carbon\Carbon::parse($reportEnd)->format(' d-M-Y')}} )</h4>
                            <label class="col-sm-2 control-label">Select Duration</label>
                            <div class="col-sm-4">
                                <h4 style="display: inline-block">From</h4>
                                <select class="btn btn" name="monthFrom" required>
                                    @foreach($monthList as $month_list)
                                        <li>
                                            <option value="{{$month_list->new_date}}">{{$month_list->new_date}}</option>
                                        </li>
                                    @endforeach
                                </select>
                                <h4 style="display: inline-block">To</h4>
                                <select class="btn btn" name="monthTo" required>
                                    @foreach($monthList as $month_list)
                                        <li>
                                            <option value="{{$month_list->new_date}}">{{$month_list->new_date}}</option>
                                        </li>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-success" style="display: inline-block"><i class="fa fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ibox-content">


                    <div class="full-height-scroll">

                    </div>
                    <div class="table-responsive">
                        <table class="table dataTables table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                {{--<th>id</th>--}}
                                <th>Name</th>
                                <th>Facility ID</th>
                                <th>Camp</th>
                                <th>Implementing<br/> Partner</th>
                                <th>Program<br/> Partner</th>
                                <th>Service<br/> Type</th>
                                <th>Child<br/>Registration</th>
                                <th>Child<br/>Followup</th>
                                <th>Women<br/>Registration</th>
                                <th>Women<br/>Followup</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($facilities as $key=>$facility)
                                <tr class="facility-client" data-facility-id={{ $facility->id }}>
                                    <td>{{ $key+1 }}</td>
{{--                                    <td>{{ $facility->id }}</td>--}}
                                    <td>{{ $facility->name }}</td>
                                    <td>{{ $facility->facility_id }}</td>
                                    <td>{{ $facility->camp->name }}</td>
                                    <td>
                                        {{($facility->ip_id!=null) ? $facility->ip->name :''}}
                                    </td>
                                    <td> {{($facility->pp_id!=null) ? $facility->pp->name :''}} </td>
                                    <td>
                                        @foreach($facility->services as $service)
                                            {{$service->name.', '}}
                                        @endforeach
                                    </td>
                                    <td style="text-align: center">{{summaryReport($reportStart, $reportEnd,$facility->id)['registered_child']}}</td>
                                    <td style="text-align: center">{{summaryReport($reportStart, $reportEnd,$facility->id)['child_followup']}}</td>
                                    <td style="text-align: center">{{summaryReport($reportStart, $reportEnd,$facility->id)['registered_women']}}</td>
                                    <td style="text-align: center">{{summaryReport($reportStart, $reportEnd,$facility->id)['women_followup']}}</td>
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
                {extend: 'excel', title: 'facility'},
                {extend: 'pdf', title: 'facility'},
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