@extends('layouts.app')
@push('styles')
<!-- Bootstrap Select Css -->

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

                        <div class="row ">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label col-md-5">Supply Date</label>
                                    <div class="col-md-7">
                                        <div class='input-group date' id='datetimepicker4'>
                                            <input type='text' name="supply_date" class="form-control"
                                                   value="{{\Carbon\Carbon::now()->format('dd-mm-YYYY')}}"/>
                                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-5">Supply Type</label>
                                    <div class="col-md-7">
                                        <select name="supply_type" class="form-control">
                                            <option value="">Select supply Type</option>
                                            <option value="Received">Received</option>
                                            <option value="Distribution">Distribution</option>
                                            <option value="Damage">Damage</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Quantity</label>
                                    <div class="col-md-7">
                                        <input type="number" name="quantity" class="form-control" placeholder="Quantity"
                                               value=""
                                               min="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 control-label">Location (From/To)</label>
                                    <div class="col-md-7">
                                        <input type="text" name="location" class="form-control"
                                               placeholder="Location (From/To)">
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Expire Date</label>
                                    <div class="col-md-7">
                                        <div class='input-group date' id='datetimepicker5'>
                                            <input type='text' name="expire_date" class="form-control"
                                                   value="{{\Carbon\Carbon::now()->format('dd-mm-YYYY')}}"/>
                                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-5">Supply Item</label>
                                    <div class="col-md-7">
                                        <select name="supply_item" class="form-control">
                                            <option value="">Select supply Item</option>
                                            <option value="F75">F75</option>
                                            <option value="F100">F100</option>
                                            <option value="RUTF">RUTF</option>
                                            <option value="RUSF">RUSF</option>
                                            <option value="Albendazol">Albendazol</option>
                                            <option value="Amoxiciline">Amoxiciline</option>
                                            <option value="WSB+">WSB+</option>
                                            <option value="WSB++">WSB++</option>
                                            <option value="Oil">Oil</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Unit</label>
                                    <div class="col-md-7">
                                        <select name="unit" class="form-control">
                                            <option value="">Select supply unit</option>
                                            <option value="Pack">Pack</option>
                                            <option value="Kg">Kg</option>
                                            <option value="Liter">Liter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Remarks</label>
                                    <div class=" col-md-7">
                                <textarea type="text" class="form-control " name="remarks"
                                          placeholder="Remarks"></textarea>

                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-7">
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

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

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
            format: 'DD-MM-YYYY'
//            format: 'LT'
        });
    });
</script>


@endpush