@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Pregnant & Lactating</h5>
                    </div>
                    <div class="ibox-content">
                        {{ html()->form('POST', route('community-session-women.store'))->open() }}
                        <div class="form-group">
                            <label for="">Date</label>
                            {{ html()->date('date', date('Y-m-d'))->class('form-control')->required() }}
                        </div>
                        <div class="form-group">
                            <label for="">Volunteer</label>
                            {{ html()->select('volunteer_id', $volunteers)->class('form-control')->placeholder('Select volunteer')->required() }}
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="">Household no.</label>--}}
                            {{--{{ html()->number('household_no')->class('form-control')->placeholder('Household no.')->required() }}--}}
                        {{--</div>--}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">MAM In Program</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ html()->number('mam_inprogress_preg')->class('form-control')->placeholder('Preg.')->required() }}
                                            <label class="pull-right">Preg</label>
                                        </div>
                                        <div class="col-md-6">
                                            {{ html()->number('mam_inprogress_lac')->class('form-control')->placeholder('Lac.')->required() }}
                                            <label class="pull-right">Lac</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">MAM Referred</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ html()->number('mam_referred_preg')->class('form-control')->placeholder('Preg.')->required() }}
                                            <label class="pull-right">Preg</label>
                                        </div>
                                        <div class="col-md-6">
                                            {{ html()->number('mam_referred_lac')->class('form-control')->placeholder('Lac.')->required() }}
                                            <label class="pull-right">Lac</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <label for="">Normal</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ html()->number('normal_preg')->class('form-control')->placeholder('Preg.')->required() }}
                                    <label class="pull-right">Preg</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ html()->number('normal_lac')->class('form-control')->placeholder('Lac.')->required() }}
                                    <label class="pull-right">Preg</label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save</button>
                        {{ html()->form()->close() }}
                    </div> <!-- ibox-content -->
                </div> <!-- ibox -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- wrapper -->
@endsection

@push('scripts')
@endpush