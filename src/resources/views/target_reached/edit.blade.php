@extends('layouts.app')
@push('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
<link href="{{ asset('custom/jquery-year-picker/css/yearpicker.css') }}" rel="stylesheet"/>

@endpush
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Update Target Reached Information</h5>
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
                    {{--<form action="{{ route('.store') }}" class="form-horizontal" method="POST">--}}
                        <form action="{{ route('targetReached.update', $targetReached->id) }}" method="post" class="form-horizontal">
                            @csrf
                            @method('PATCH')

                        <div class="row ">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Indicator</label>
                                <div class="col-sm-7">
                                    <select name="indicator_id" class="form-control show-tick selectpicker"
                                            data-live-search="true" required>
                                        <option value="">Select Indicator</option>
                                        @foreach($indicators as $indicator)
                                            {{--<option value="{{ $indicator->id }}">{{ $indicator->indicator_short_title.'-'.$indicator->indicator }}</option>--}}
                                            <option value="{{ $indicator->id }}"
                                                     {{ (isset($targetReached) && $targetReached->indicator_id == $indicator->id) ? ' selected' : '' }}  >{{ $indicator->indicator_short_title.'-'.$indicator->indicator }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Year </label>
                                <div class="col-md-6">
                                    <input class="yearpicker form-control" style="width: 240px;" type="text" name="data_year"
                                           value="{{$targetReached->data_year}}">
                                </div>
                            </div>

                            <div class="form-group">
                                    <label class="col-md-3 control-label">Target </label>
                                    <div class="col-md-7">
                                        <input type="text" name="target" class="form-control"
                                               placeholder="Target" value="{{$targetReached->target}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Reached </label>
                                    <div class="col-md-7">
                                        <input type="text" name="reached" class="form-control"
                                               placeholder="Reached" value="{{$targetReached->reached}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Comments</label>
                                    <div class=" col-md-7">
                                <textarea type="text" class="form-control " name="comments"
                                          placeholder="Comments">{{$targetReached->comments}}</textarea>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Use This Reached</label>
                                <div class="col-md-7">
                                    <select name="use_this" class="form-control">
                                        {{--<option value="">Select supply Item</option>--}}
                                        <option value="Use this reached data" {{ (isset($targetReached) && $targetReached->use_this == 'Use this reached data') ? ' selected' : '' }}>Use this reached data</option>
                                        <option value="Use system generated reached data" {{ (isset($targetReached) && $targetReached->use_this == 'Use system generated reached data') ? ' selected' : '' }}>Use system generated reached data</option>

                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-7">
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                                class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                        Update
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

<script src="{{ asset('custom/jquery-year-picker/js/yearpicker.js')}}"></script>

<script>
    $(document).ready(function() {
        $(".yearpicker").yearpicker({
//            year: 2015,
            startYear: 2015,
            endYear: 2100
        });
    });
</script>

@endpush