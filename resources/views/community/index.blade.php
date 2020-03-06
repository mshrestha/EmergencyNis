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
                      <h2>Community Screening Children
                        <a href="{{ route('community.create') }}" class="pull-right">
                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Volunteer</button>
                        </a>
                        <a href="{{ route('community-session.create') }}" class="pull-right" style="margin-right: 10px;">
                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Community Screening Children</button>
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
                                      <th rowspan="3">Date</th>
                                      <th rowspan="3">Volunteer</th>
                                      <th colspan="4">Screening</th>
                                      <th colspan="4">SAM in prog</th>
                                      <th colspan="4">SAM Referred</th>
                                      <th colspan="4">MAM Identified</th>
                                      <th colspan="4">MAM Referred</th>
                                      <th colspan="4">At Risk</th>
                                      <th colspan="4" rowspan="2">No Referred</th>
                                  </tr>
                                  <tr>
                                    <th colspan="2">6 - 23</th>
                                    <th colspan="2">24 - 59</th>
                                    <th colspan="2">6 - 23</th>
                                    <th colspan="2">24 - 59</th>
                                    <th colspan="2">6 - 23</th>
                                    <th colspan="2">24 - 59</th>
                                    <th colspan="2">6 - 23</th>
                                    <th colspan="2">24 - 59</th>
                                    <th colspan="2">6 - 23</th>
                                    <th colspan="2">24 - 59</th>
                                    <th colspan="2">6 - 23</th>
                                    <th colspan="2">24 - 59</th>
                                  </tr>
                                  <tr>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                    <th>M</th>
                                    <th>F</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($community_sessions as $community_session)
                                  <tr>
                                    <td>{{ $community_session->date }}</td>
                                    <td>{{ $community_session->volunteer->name }}</td>
                                    <td>{{ $community_session->tot_scr_6_23_m }}</td>
                                    <td>{{ $community_session->tot_scr_6_23_f }}</td>
                                    <td>{{ $community_session->tot_scr_24_59_m }}</td>
                                    <td>{{ $community_session->tot_scr_24_59_f }}</td>
                                    <td>{{ $community_session->sam_ip_6_23_m }}</td>
                                    <td>{{ $community_session->sam_ip_6_23_f }}</td>
                                    <td>{{ $community_session->sam_ip_24_59_m }}</td>
                                    <td>{{ $community_session->sam_ip_24_59_f }}</td>
                                    <td>{{ $community_session->sam_ref_6_23_m }}</td>
                                    <td>{{ $community_session->sam_ref_6_23_f }}</td>
                                    <td>{{ $community_session->sam_ref_24_59_m }}</td>
                                    <td>{{ $community_session->sam_ref_24_59_f }}</td>
                                    <td>{{ $community_session->mam_ip_6_23_m }}</td>
                                    <td>{{ $community_session->mam_ip_6_23_f }}</td>
                                    <td>{{ $community_session->mam_ip_24_59_m }}</td>
                                    <td>{{ $community_session->mam_ip_24_59_f }}</td>
                                    <td>{{ $community_session->mam_ref_6_23_m }}</td>
                                    <td>{{ $community_session->mam_ref_6_23_f }}</td>
                                    <td>{{ $community_session->mam_ref_24_59_m }}</td>
                                    <td>{{ $community_session->mam_ref_24_59_f }}</td>
                                    <td>{{ $community_session->at_risk_6_23_m }}</td>
                                    <td>{{ $community_session->at_risk_6_23_f }}</td>
                                    <td>{{ $community_session->at_risk_24_59_m }}</td>
                                    <td>{{ $community_session->at_risk_24_59_f }}</td>
                                    <td>{{ $community_session->referred_m }}</td>
                                    <td>{{ $community_session->referred_f }}</td>
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
