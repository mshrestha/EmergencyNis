@extends('layouts.app')
@section('content')
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">
            <div class="wrapper wrapper-content animated fadeIn">
              <h1>
                <strong>Excel Report Import</strong>
              </h1>
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-3">
                        <a href="{{ route('importExportOtp') }}">
                            <div class="widget style1 lazur-bg">
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
                        <a href="{{ route('importExportBsfp') }}">
                            <div class="widget style1 lazur-bg">
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
                    <div class="col-lg-3">
                        <a href="{{ route('importExportTsfp') }}">
                            <div class="widget style1 lazur-bg">
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
                        <a href="{{ route('importExportSc') }}">
                            <div class="widget style1 lazur-bg">
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

                  </div>
                </div>

              </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
