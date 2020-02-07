@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-3">
                <a href="{{ route('community.index') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">

                                <h2 class="font-bold">Volunteer <br>Log</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('outreach-supervisor.index') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">

                                <h2 class="font-bold">Outreach <br>Supervisor</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

          </div>
        </div>

      </div>
        <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-title">
                      <h2>Outreach Monthly Report
                        <a href="{{ route('outreach-supervisor.create') }}" class="pull-right">
                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Supervisor</button>
                        </a>
                      </h2>
                  </div>
                  <div class="ibox-content">

                      <div class="full-height-scroll">
                        <div class="table-responsive">
                            <table class="table dataTables table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Pregnant women</th>
                                        <th>0 to 6 months</th>
                                        <th>6 to 24 months</th>
                                        <th>Grandmothers</th>
                                        <th>Adolescent</th>
                                        <th>Referral</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($outreach_monthly_reports as $outreach_monthly_report)
                                        <tr class="montly-reach">
                                            <td><a class="client-link">
                                                {{ $outreach_monthly_report->outreachSupervisor->name}}
                                            </a></td>
                                            <td>
                                                @php
                                                    $month = $outreach_monthly_report->date_year.'-'.$outreach_monthly_report->date_month.'-01';
                                                    $month = date('F Y', strtotime($month));
                                                @endphp
                                                
                                                {{ $month }}
                                            </td>
                                            <td>{{ $outreach_monthly_report->pregnant_women }}</td>
                                            <td>{{ $outreach_monthly_report->zero_to_six_months }}</td>
                                            <td>{{ $outreach_monthly_report->six_to_twentyfour_months }}</td>
                                            <td>{{ $outreach_monthly_report->grandmothers }}</td>
                                            <td>{{ $outreach_monthly_report->adolescent }}</td>
                                            <td>{{ $outreach_monthly_report->referral }}</td>
                                            <td>
                                                <a href="{{ route('outreach-monthly-report.edit', $outreach_monthly_report->sync_id) }}" class="btn btn-xs btn-info pull-left" style="margin-right: 10px;">
                                                    <i class="fa fa-info"></i> Edit
                                                </a>

                                                {{ html()->form('DELETE', route('outreach-monthly-report.destroy', $outreach_monthly_report->sync_id))->class('pull-left')->open() }}
                                                    <button class="btn btn-xs btn-info" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                                {{ html()->form()->close() }}

                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr class="montly-reach">
                                        {{ html()->form('POST', route('outreach-monthly-report.store'))->open() }}
                                        <td>
                                            {{ html()->select('supervisor_id', $outreach_supervisors)->class('form-control')->placeholder('Select supervisor')->style(['width' => '100%'])->required() }}
                                        <td>
                                          <select name="date_month" required>
                                            <option value=''>Select Month</option>
                                            <option value='1'>Janaury</option>
                                            <option value='2'>February</option>
                                            <option value='3'>March</option>
                                            <option value='4'>April</option>
                                            <option value='5'>May</option>
                                            <option value='6'>June</option>
                                            <option value='7'>July</option>
                                            <option value='8'>August</option>
                                            <option value='9'>September</option>
                                            <option value='10'>October</option>
                                            <option value='11'>November</option>
                                            <option value='12'>December</option>
                                          </select>
                                          <select name="date_year" required>
                                              @for ($i=2020; $i <= date('Y'); $i++)
                                                <option value="{{$i}}">{{$i}}</option> 
                                              @endfor
                                          </select>
                                        </td>
                                        <td>
                                            {{ html()->text('pregnant_women')->style(['width' => '50px'])->required() }}
                                        </td>
                                        <td>
                                            {{ html()->text('zero_to_six_months')->style(['width' => '50px'])->required() }}
                                        </td>
                                        <td>
                                            {{ html()->text('six_to_twentyfour_months')->style(['width' => '50px'])->required() }}
                                        </td>
                                        <td>
                                            {{ html()->text('grandmothers')->style(['width' => '50px'])->required() }}
                                        </td>
                                        <td>
                                            {{ html()->text('adolescent')->style(['width' => '50px'])->required() }}
                                        </td>
                                        <td>
                                            {{ html()->text('referral')->style(['width' => '50px'])->required() }}
                                        </td>
                                        <td>
                                            <button class="btn btn-default btn-sm" type="submit">
                                                Submit
                                            </button>
                                        </td>
                                        {{ html()->form()->close() }}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
</div> <!-- row -->
@endsection

@push('styles')
    <style>
        td {
            vertical-align: middle !important;
        }
    </style>
@endpush

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