@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User Profile Update</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">User Name: </label>
                            <p class="form-control-static"> {{$user->name}}</p>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Email Address : </label>
                            <p class="form-control-static"> {{$user->email}}</p>
                        </div>
                        @if($user->role=='user')
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">Facility : </label>
                                <p class="form-control-static"> {{$user->facility->facility_id.' ( '.$user->facility->name.' )'}}</p>
                            </div>
                        @endif
                        @if(env('SERVER_CODE')!='LIVE_SERVER')
                            <h2>Password Change only possible from Live Server, please visit <a href="https://emergencynutrition.org" target="_blank">https://emergencynutrition.org</a> for password change.</h2>
                            <h3>After change your password need to update your SMSERVER database</h3>
                        @else
                        <form action="{{ route('user.password_update', $user->id) }}" class="form-horizontal"
                              method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Current Password :
                                    <span class="required"> * </span></label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name="current_password"
                                           placeholder="Current Password" required>
                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">New Password :
                                    <span class="required"> * </span></label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name="new_password"
                                           placeholder="New Password" required>
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <p id="password-strength-text"></p>
                            </div>
                            <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Confirm Password :
                                    <span class="required"> * </span></label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name="confirm_password"
                                           placeholder="Confirm Password" required>
                                    @if ($errors->has('confirm_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="clearfix margin-top-10">
                                <span class="label label-danger">NOTE ! </span>
                                <span class="help-block"><small> The password must be 6 characters long and different from current password.
                                        {{--at least meet 4 of the following 5 rules <br/>--}}
                                        {{--English uppercase characters (A–Z), English lowercase characters (a–z), Base 10 digits (0–9),--}}
                                        {{--Non-alphanumeric ( !,@,#,$,%,^,&,*,or_ ), Unicode characters--}}
                                                    </small></span>
                            </div>
                            <button class="btn btn-primary pull-right">Save</button>
                            <div class="clearfix"></div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection