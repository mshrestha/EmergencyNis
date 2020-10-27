@extends('layouts.app')
@push('styles')
<!-- Bootstrap Select Css -->
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>
@endpush
@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>SC Report Search</h5>
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
                    <form action="{{ route('sc_report_admin') }}" class="form-horizontal" method="get">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Facility</label>
                            <div class="col-sm-9">
                                <select name="facility_id" class="form-control show-tick selectpicker"
                                        data-live-search="true" required>
                                    <option value="">Select Facility</option>
                                    @foreach($facilities as $facility)
                                        <option value="{{ $facility->id }}" {{ (isset($user) && $user->facility_id == $facility->id) ? ' selected' : '' }}>{{ $facility->facility_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Select Duration</label>
                            <div class="col-sm-9">
                                <h4 style="display: inline-block">From</h4>
                                <select class="btn btn" name="monthFrom" required>
                                    @foreach($monthList as $month_list)
                                        <li>
                                            <option value="{{$month_list->new_date}}">{{$month_list->new_date}}</option>
                                        </li>
                                    @endforeach

                                </select>
                                <h4 style="display: inline-block">To</h4>
                                <select class="btn btn" name="monthTo" required>
                                    @foreach($monthList as $month_list)
                                        <li>
                                            <option value="{{$month_list->new_date}}">{{$month_list->new_date}}</option>
                                        </li>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                                class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>
                                        Search
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>

<script type="text/javascript">
//    $('.date-oyear').datepicker({
//        minViewMode: 2,
//        format: 'yyyy'
//    });

//    $("#date-oyear").datepicker({
//        format: " yyyy",
//        viewMode: "years",
//        minViewMode: "years"
//    });


</script>


@endpush