@extends('layouts.app')
@push('styles')
<!-- Bootstrap Select Css -->
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>

@endpush
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Add Supply information</h5>
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
                    <form action="{{ route('supply.store') }}" class="form-horizontal" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="control-label col-md-2"> Month :</label>
                            <div class="col-sm-4">
                                <select class="bs-select form-control" name="month" readonly>
                                    <option value="01" {{($request->month=='01') ? 'selected' : ''}}>January</option>
                                    <option value="02" {{($request->month=='02') ? 'selected' : ''}}>February</option>
                                    <option value="03" {{($request->month=='03') ? 'selected' : ''}}>March</option>
                                    <option value="04" {{($request->month=='04') ? 'selected' : ''}}>April</option>
                                    <option value="05" {{($request->month=='05') ? 'selected' : ''}}>May</option>
                                    <option value="06" {{($request->month=='06') ? 'selected' : ''}}>June</option>
                                    <option value="07" {{($request->month=='07') ? 'selected' : ''}}>July</option>
                                    <option value="08" {{($request->month=='08') ? 'selected' : ''}}>August</option>
                                    <option value="09" {{($request->month=='09') ? 'selected' : ''}}>September</option>
                                    <option value="10" {{($request->month=='10') ? 'selected' : ''}}>October</option>
                                    <option value="11" {{($request->month=='11') ? 'selected' : ''}}>November</option>
                                    <option value="12" {{($request->month=='12') ? 'selected' : ''}}>December</option>
                                </select>
                            </div>
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                            <label class="control-label col-sm-2">Year :</label>
                            <div class="col-sm-4">
                                <input class="date-oyear form-control" type="text" name="year"
                                       style=" z-index: 9999 !important;"
                                       value="<?php echo $request->year ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="container content col-md-12">
                                <table id="supplyTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="col-md-2">Select Supply</th>
                                        <th>Remaining From Last Month</th>
                                        <th>Received</th>
                                        <th>Consumed</th>
                                        <th>Damaged</th>
                                        <th>Balance</th>
                                        <th>Add / Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{--<div class="form-group">--}}
                                                <select name="supply[]" class="form-control">
                                                    {{--<option value="">Supply</option>--}}
                                                    <option value="F75">F75</option>
                                                    <option value="F100">F100</option>
                                                    <option value="RUTF">RUTF</option>
                                                    <option value="Albendazol">Albendazol</option>
                                                    <option value="Amoxiciline">Amoxiciline</option>
                                                </select>
                                            {{--</div>--}}
                                        </td>
                                        <td>
                                            {{--<input type="number" name="respiratory_rate" class="form-control" placeholder="Respiratory rate (breaths/min)" value="{{ isset($facility_followup) ? $facility_followup->respiratory_rate : '' }}" min="0">--}}
                                            <input type="number" name="remainingFromLastMonth[]" class="form-control"
                                                   value="0" min="0" required>
                                        </td>
                                        <td>
                                            <input type="number" name="received[]" class="form-control" value="0" min="0" required>
                                        </td>
                                        <td>
                                            <input type="number" name="consumed[]" class="form-control" value="0" min="0" required>
                                        </td>
                                        <td>
                                            <input type="number" name="damaged[]" class="form-control" value="0" min="0" required>
                                        </td>
                                        <td>
                                            <input type="number" name="balance[]" class="form-control" value="0" min="0" required>
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
                    <hr/>

                    <div class="table-responsive">
                        <h3>Supply Information of {{$month_year}}</h3>
                        @if(count($previousMonthSupplies)>0)
                        <table class="table dataTables table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Supply</th>
                                <th>Remaining from Last Month</th>
                                <th>Received</th>
                                <th>Consumed</th>
                                <th>Damaged</th>
                                <th>Balance</th>
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($previousMonthSupplies as $key=>$data)
                                <tr>
                                    <td>{{ $data->supply }}</td>
                                    <td>{{ $data->remainingFromLastMonth }}</td>
                                    <td>{{ $data->received }}</td>
                                    <td>{{ $data->consumed }}</td>
                                    <td>{{ $data->damaged }}</td>
                                    <td>{{ $data->balance }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                            @else
                        <h4>No Record Found</h4>
                            @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>


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


@endpush