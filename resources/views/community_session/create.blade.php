@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-title">
                      <h2>Community Screening Children</h2>
                  </div>
                  <div class="ibox-content">
                    {{ html()->form('POST', route('community-session.store'))->open() }}
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="row">
                            <label class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-9">
                              {{ html()->date('date', date('Y-m-d'))->class('form-control')->required() }}
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <label class="col-sm-3 control-label">Volunteer</label>
                            <div class="col-sm-9">
                              {{ html()->select('volunteer_id', $volunteers)->placeholder('Select volunteer')->class('form-control')->required() }}
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <label class="col-sm-3 control-label">Household Number</label>
                            <div class="col-sm-9">
                              {{ html()->text('household_no')->placeholder('Household Number')->class('form-control') }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                      <hr>

                      <div class="table-responsive">
                          <table class="table dataTables table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th></th>
                                      <th>6 - 23</th>
                                      <th>24 - 59</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Total Screening</td>
                                  <td>
                                    M {{ html()->number('tot_scr_6_23_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('tot_scr_6_23_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                  <td>
                                    M {{ html()->number('tot_scr_24_59_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('tot_scr_24_59_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                </tr>
                                <tr>
                                  <td>SAM in progres</td>
                                  <td>
                                    M {{ html()->number('sam_ip_6_23_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('sam_ip_6_23_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                  <td>
                                    M {{ html()->number('sam_ip_24_59_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('sam_ip_24_59_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                </tr>
                                <tr>
                                  <td>SAM Referred</td>
                                  <td>
                                    M {{ html()->number('sam_ref_6_23_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('sam_ref_6_23_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                  <td>
                                    M {{ html()->number('sam_ref_24_59_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('sam_ref_24_59_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                </tr>
                                <tr>
                                  <td>MAM in progress</td>
                                  <td>
                                    M {{ html()->number('mam_ip_6_23_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('mam_ip_6_23_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                  <td>
                                    M {{ html()->number('mam_ip_24_59_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('mam_ip_24_59_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                </tr>
                                <tr>
                                  <td>MAM Referred</td>
                                  <td>
                                    M {{ html()->number('mam_ref_6_23_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('mam_ref_6_23_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                  <td>
                                    M {{ html()->number('mam_ref_24_59_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('mam_ref_24_59_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                </tr>
                                <tr>
                                  <td>At Risk</td>
                                  <td>
                                    M {{ html()->number('at_risk_6_23_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('at_risk_6_23_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                  <td>
                                    M {{ html()->number('at_risk_24_59_m')->placeholder('0')->style(['width' => '100px']) }}
                                    F {{ html()->number('at_risk_24_59_f')->placeholder('0')->style(['width' => '100px']) }}
                                  </td>
                                </tr>
                              </tbody>
                          </table>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-2 control-label">Referred</label>
                              <div class="col-sm-10">
                                M {{ html()->number('referred_m')->placeholder('0')->style(['width' => '100px']) }}
                                F {{ html()->number('referred_f')->placeholder('0')->style(['width' => '100px']) }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                     
                      <button class="btn btn-success">Save</button>
                      {{ html()->form()->close() }}
                  </div>
              </div>
          </div>


        </div>
    </div>
</div> <!-- row -->
@endsection
