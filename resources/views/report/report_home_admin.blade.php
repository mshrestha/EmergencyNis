@extends('layouts.app')
@section('content')
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">
            <div class="wrapper wrapper-content animated fadeIn">
              <h1>
                <strong>Report</strong>
              </h1>
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                      @if(Auth::user()->role == 'admin')
                    <div class="col-lg-3">
                        <a href="{{ route('summary_report') }}">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <h2 class="font-bold">Summary Report</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                      @endif
                  </div>
                          <div class="row">
                    <div class="col-lg-3">
                        <a href="{{ route('sc_report') }}">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <h2 class="font-bold">SC Report</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ route('otp_report') }}">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <h2 class="font-bold">OTP Report</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ route('tsfp_report') }}">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <h2 class="font-bold">TSFP Report</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ route('bsfp_report') }}">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <h2 class="font-bold">BSFP Report</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                  </div>
                </div>
              </div>
              <h1>
                <strong>Report (Excel Import)</strong>
              </h1>
              <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="{{ route('importExportSc') }}">
                                <div class="widget style1 red-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-cloud-upload fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">

                                            <h2 class="font-bold">SC <br/> Report Import</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('importExportOtp') }}">
                                <div class="widget style1 red-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-cloud-upload fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">

                                            <h2 class="font-bold">OTP<br/> Report Import</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('importExportTsfp') }}">
                                <div class="widget style1 red-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-cloud-upload fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">

                                            <h2 class="font-bold">TSFP<br/> Report Import</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ route('importExportBsfp') }}">
                                <div class="widget style1 red-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-cloud-upload fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">

                                            <h2 class="font-bold">BSFP<br/> Report Import</h2>
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
@endsection
