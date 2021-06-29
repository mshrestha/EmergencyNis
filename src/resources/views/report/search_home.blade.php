@extends('layouts.app')
@push('styles')
<!-- Bootstrap Select Css -->
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
{{--<link href="{{ asset('custom/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">--}}
{{--<link href="{{ asset('custom/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">--}}
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">--}}

@endpush
@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Report Search</h5>
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
                    <form action="{{ route('otp_report_admin') }}" class="form-horizontal" method="get">

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
                            <label class="control-label col-md-3">Select Month</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" name="month">
                                    <option value="01" {{($current_month=='02') ? 'selected' : ''}}>January</option>
                                    <option value="02" {{($current_month=='03') ? 'selected' : ''}}>February</option>
                                    <option value="03" {{($current_month=='04') ? 'selected' : ''}}>March</option>
                                    <option value="04" {{($current_month=='05') ? 'selected' : ''}}>April</option>
                                    <option value="05" {{($current_month=='06') ? 'selected' : ''}}>May</option>
                                    <option value="06" {{($current_month=='07') ? 'selected' : ''}}>June</option>
                                    <option value="07" {{($current_month=='08') ? 'selected' : ''}}>July</option>
                                    <option value="08" {{($current_month=='09') ? 'selected' : ''}}>August</option>
                                    <option value="09" {{($current_month=='10') ? 'selected' : ''}}>September</option>
                                    <option value="10" {{($current_month=='11') ? 'selected' : ''}}>October</option>
                                    <option value="11" {{($current_month=='12') ? 'selected' : ''}}>November</option>
                                    <option value="12" {{($current_month=='01') ? 'selected' : ''}}>December</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Select Year </label>
                            <div class="col-sm-9">
                                <input class="date-oyear form-control" type="text" name="year"
                                       style=" z-index: 9999 !important;"
                                       value="<?php echo date('Y') ?>">
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
{{--<script src="{{ asset('custom/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>--}}
{{--<script src="{{ asset('custom/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>--}}

<script type="text/javascript">
    $('.date-oyear').datepicker({
        minViewMode: 2,
        format: 'yyyy'
    });


</script>


@endpush
