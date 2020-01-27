@extends('layouts.app')
@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12 tab-content">
                    <div class="ibox-title">
                        <h2>
                            IYCF Session
                        </h2>
                        <hr/>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline btn-danger"><i
                                                class="fa fa-arrow-left"
                                                aria-hidden="true"></i>
                                        Back</a>
                                    <a href="{{ route('iycfGroupSession.create') }}" class="btn btn-success" ><i  class="fa fa-group"></i>
                                                 Group Session</a>
                                    <a href="#" class="btn btn-info" ><i  class="fa fa-user"></i>
                                        Individual Session</a>
                                    <a href="#" class="btn btn-warning" ><i  class="fa fa-life-saver"></i>
                                        Facility Session</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection


