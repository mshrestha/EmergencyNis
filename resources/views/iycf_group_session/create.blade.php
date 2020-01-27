@extends('layouts.app')
@push('styles')
<style>
    /*.datetimepicker {*/
    /*z-index: 999 !important;*/
    /*}*/
</style>
{{--<link href="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.css') }}" rel="stylesheet"/>--}}

@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Add IYCF Group Session</h5>
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
                    <form action="{{ route('iycfGroupSession.store') }}" class="form-horizontal" method="POST">
                        @csrf


                        <div class="row  col-md-12">

                            <div class="form-group">
                                <label class="control-label col-md-2">Session Date</label>
                                <div class="col-md-6">
                                    <div class='input-group date' id='datetimepicker4'>
                                        <input type='text' name="session_date" class="form-control" value="{{\Carbon\Carbon::now()->format('dd-mm-YYYY')}}"/>
                                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row   col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Start Time</label>
                                    <div class="col-md-2">
                                        <div class='input-group date' id='datetimepicker5'>
                                            <input type='text' name="start_time" class="form-control"/>
                                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                                        </div>
                                    </div>
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                    <label class="control-label col-md-2">End Time</label>
                                    <div class="col-md-2">
                                        <div class='input-group date' id='datetimepicker6'>
                                            <input type='text' name="end_time" class="form-control"/>
                                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Session Type</label>
                                <div class="col-md-6">
                                    <select name="session_type" class="form-control">
                                        <option value="">Select Session Type</option>
                                        <option value="option1">Type1</option>
                                        <option value="option2">Type2</option>
                                        <option value="option3">Type3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Session Topic</label>
                                <div class="col-sm-6">
                                    <input type="text" name="session_topic" class="form-control"
                                           placeholder="Session Topic">
                                </div>
                            </div>


                        </div>

                        <div class="row ">
                            <div class="container content col-md-12">
                                <h4>Add Beneficiary</h4>
                                <table id="supplyTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="col-md-2">Select Type</th>
                                        <th class="col-md-2">Select Sex</th>
                                        <th class="col-md-2">Select Type</th>
                                        <th>Add / Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="name[]" class="form-control" required>
                                        </td>
                                        <td>
                                            <select name="type[]" class="form-control">
                                                {{--<option value="">Type</option>--}}
                                                <option value="6-23Months Children">6-23Months Children</option>
                                                <option value="24-59Months Children">24-59Months Children</option>
                                                <option value="Pregnant Women">Pregnant Women</option>
                                                <option value="Lactating Women">Lactating Women</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="sex[]" class="form-control">
                                                {{--<option value="">Sex</option>--}}
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="beneficiary_type[]" class="form-control">
                                                {{--<option value="">Beneficiary Type</option>--}}
                                                <option value="Beneficiary">Beneficiary</option>
                                                <option value="Guardian">Guardian</option>
                                                <option value="Guardian & Beneficiary">Guardian & Beneficiary</option>
                                            </select>
                                        </td>
                                        <td><a id="addnew" href=""><i class="fa fa-plus-circle"></i> Add More</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                {{--</div>--}}

                            </div>
                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                                class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                        Submit
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
{{--<script src="{{ asset('custom/bootstrap_datetime_picker/moment.min.js') }}"></script>--}}
{{--<script src="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.js') }}"></script>--}}
<script>
    var newRowNum = 0;
    $('#addnew').click(function () {
        newRowNum = $(supplyTable).children('tbody').children('tr').length + 1;
        var addRow = $(this).parent().parent();
        var newRow = addRow.clone();
        $('input', addRow).val('');
        $('td:last-child', newRow).html('<a href="" class="remove"><i class="fa fa-minus-circle"><\/i> Remove<\/a>');
        addRow.before(newRow);
        $('a.remove', newRow).click(function () {
            $(this).closest('tr').remove();
            return false;
        });
        return false;
    });
    $('.removeDefault').click(function () {
        $(this).closest('tr').remove();
        return false;
    });


</script>
<script type="text/javascript">
    //date only
    $(function () {
        $('#datetimepicker4').datetimepicker({
            format: 'DD-MM-YYYY'
//            format: 'LT'
        });
    });
    $(function () {
        $('#datetimepicker5').datetimepicker({
            format: 'LT'
        });
    });
    $(function () {
        $('#datetimepicker6').datetimepicker({
            format: 'LT'
        });
    });
</script>


@endpush