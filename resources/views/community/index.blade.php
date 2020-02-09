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
                      {{ html()->form('get')->open() }}
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            {{ html()->date('date', $selected_date)->class('form-control')->required() }}
                          </div>
                        </div>
                        <div class="col-md-1">
                          <button class="btn btn-info" tyle="submit">Filter</button>
                        </div>
                      </div>
                      {{ html()->form()->close() }}
                      <hr>

                      <div class="table-responsive">
                          <table class="table dataTables table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>Name</th>
                                      <th>Block - Subblock</th>
                                      <th>Date</th>
                                      <th>Screened</th>
                                      <th>Referred</th>
                                      <th>In Progress</th>
                                      <th>SAM</th>
                                      <th>MAM</th>
                                      <th>At Risk</th>
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
                                        {{ $selected_date }}
                                        {{ html()->hidden('date', $selected_date) }}
                                      </td>
                                      <td>
                                        {{ html()
                                          ->number('screened', 
                                            $volunteer->todaysCommunitySession($selected_date)['screened']
                                          )
                                          ->style(['width' => '100px'])
                                          ->placeholder('Screened')
                                          ->required() }}
                                      </td>
                                      <td>
                                        {{ html()->number('referred', $volunteer->todaysCommunitySession($selected_date)['referred'])->style(['width' => '100px'])->placeholder('Referred')->required() }}
                                      </td>
                                      <td>
                                        {{ html()->number('inprogram', $volunteer->todaysCommunitySession($selected_date)['inprogram'])->style(['width' => '100px'])->placeholder('In Program')->required() }}
                                      </td>
                                      <td>
                                        {{ html()->number('sam', $volunteer->todaysCommunitySession($selected_date)['sam'])->style(['width' => '100px'])->placeholder('SAM')->required() }}
                                      </td>
                                      <td>
                                        {{ html()->number('mam', $volunteer->todaysCommunitySession($selected_date)['mam'])->style(['width' => '100px'])->placeholder('MAM')->required() }}
                                      </td>
                                      <td>
                                        {{ html()->number('atrisk', $volunteer->todaysCommunitySession($selected_date)['atrisk'])->style(['width' => '100px'])->placeholder('At Risk')->required() }}
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