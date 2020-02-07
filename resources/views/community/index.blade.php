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
                      <h2>Community Sessions
                      <a href="{{ route('community.create') }}" class="pull-right">
                          <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Volunteer</button>
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
                                      <th>Name</th>
                                      <th>Block - Subblock</th>
                                      <th>Screened</th>
                                      <th>Referred</th>
                                      <th>In Progress</th>
                                      <th width="200">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($volunteers as $volunteer)
                                  <tr class="volunteer" data-volunteer-id={{ $volunteer->id }}>
                                      {{ html()->form('POST', route('community-session.store'))->open() }}
                                      <td>
                                        <a class="client-link">{{ $volunteer->name }}</a>
                                        {{ html()->hidden('volunteer_id', $volunteer->sync_id) }}
                                      </td>
                                      <td><i class="fa fa-flag"></i> {{ $volunteer->block }} - {{ $volunteer->subblock }}</td>
                                      <td>
                                        {{ html()->number('screened', $volunteer->todaysCommunitySession()['screened'])->placeholder('Screened')->required() }}
                                      </td>
                                      <td>
                                        {{ html()->number('referred', $volunteer->todaysCommunitySession()['referred'])->placeholder('Referred')->required() }}
                                      </td>
                                      <td>
                                        {{ html()->number('inprogram', $volunteer->todaysCommunitySession()['inprogram'])->placeholder('In Program')->required() }}
                                      </td>
                                      <td>
                                        <button class="btn btn-default btn-sm" type="submit" ><i class="fa fa-plus"></i> Submit</button>
                                        <a href="{{ route('community.edit', $volunteer->sync_id) }}" class="btn btn-default btn-sm"><i class="fa fa-info"></i> Edit</a>
                                      </td>
                                      {{ html()->form()->close() }}
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