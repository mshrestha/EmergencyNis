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

                                <h2 class="font-bold">Children</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('community-session-women.index') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <h2 class="font-bold">Pregnant & Lactating</h2>
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
                                <h2 class="font-bold">IYCF</h2>
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
                      <h2>Community Screening Pregnant & Lactating
                        <a href="{{ route('community.create') }}" class="pull-right">
                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Volunteer</button>
                        </a>

                        <a href="{{ route('community-session-women.create') }}" class="pull-right" style="margin-right: 10px;">
                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Pregnant & Lactating</button>
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
                          <table class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>Date</th>
                                      <th>Volunteer Name</th>
                                      <th>Household no</th>
                                      <th colspan="2">MAM in progress</th>
                                      <th colspan="2">MAM referred</th>
                                      <th colspan="2">Normal</th>
                                  </tr>
                                  <tr>
                                    <th colspan="3"></th>
                                    <th>Preg</th>
                                    <th>Lac</th>
                                    <th>Preg</th>
                                    <th>Lac</th>
                                    <th>Preg</th>
                                    <th>Lac</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($community_session_womens as $community_session_women)
                                <tr>
                                  <td>{{ $community_session_women->date }}</td>
                                  <td>{{ $community_session_women->volunteer->name }}</td>
                                  <td>{{ $community_session_women->household_no }}</td>
                                  <td>{{ $community_session_women->mam_inprogress_preg }}</td>
                                  <td>{{ $community_session_women->mam_inprogress_lac }}</td>
                                  <td>{{ $community_session_women->mam_referred_preg }}</td>
                                  <td>{{ $community_session_women->mam_referred_lac }}</td>
                                  <td>{{ $community_session_women->normal_preg }}</td>
                                  <td>{{ $community_session_women->normal_lac }}</td>
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
