@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-3">
                <a href="{{ route('community') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">

                                <h2 class="font-bold">Volunteer log</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('community.outreach') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">

                                <h2 class="font-bold">Outreach Supervisor</h2>
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

                                      <th width="100">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($volunteers as $volunteer)
                                  <tr class="volunteer" data-volunteer-id={{ $volunteer->id }}>
                                      <td><a class="client-link">{{ $volunteer->name }}</a></td>
                                      <td><i class="fa fa-flag"></i> {{ $volunteer->block }} - {{ $volunteer->subblock }}</td>
                                      <td><input type="text" name="screened"></td>
                                      <td><input type="text" name="referred"></td>
                                      <td><input type="text" name="progress"></td>


                                      <td>
                                        <button  class="btn btn-default btn-sm btn-block" type="button" ><i class="fa fa-plus"></i> Submit</button>


                                      </td>
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
