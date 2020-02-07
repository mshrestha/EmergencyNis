@extends('layouts.app')
@section('content')
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">
            <div class="wrapper wrapper-content animated fadeIn">
              <h1>
                <strong>IYCF Session</strong>
              </h1>
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-3">
                        <a href="{{ route('iycfGroupSession.create') }}">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">

                                        <h2 class="font-bold">Group Session</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ route('register-iycf') }}">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">

                                        <h2 class="font-bold">Individual Session</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                  </div>
                </div>

              </div>
            </div>
        </div>
    </div> <!-- row -->
    <div class="row"  style="margin-top: 20px;">
      <div class="col-md-12">
          <div class="row">
              <div class="col-sm-12 tab-content">
                      <div class="ibox-title">
                          <h2>
                              Group Sessions
                          </h2>
                          <div class="ibox-content">
                              <div class="clients-list">
                                  <div class="full-height-scroll">
                                      <div class="table-responsive">
                                          <table class="table dataTables table-striped table-bordered table-hover">
                                              <thead>
                                              <tr>
                                                  <th>Topic</th>
                                                  <th>Type</th>
                                                  <th>Date</th>
                                                  <th>Time</th>



                                              </tr>
                                              </thead>
                                              <tbody>
                                              @foreach($iycfGroupSessions as $key=>$data)
                                                  <tr>
                                                      <td>{{ $data->session_topic}}</td>
                                                      <td>{{ $data->session_type}}</td>
                                                      <td>{{Carbon\Carbon::parse($data->session_date)->format('d-M-Y')}}</td>
                                                      <td>{{Carbon\Carbon::parse($data->start_time)->format('h:ia')}} to {{Carbon\Carbon::parse($data->end_time)->format('h:ia')}}</td>



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
    </div>
@endsection
