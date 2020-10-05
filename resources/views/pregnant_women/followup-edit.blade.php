@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.css') }}" rel="stylesheet"/>

<style>
    .modal {
        border: 1px solid black;
        background-color: rgba(255, 255, 255, 1.0);
        height: 95%;
        width: 95%;
        margin:0 auto;
    }
</style>
@endpush
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('pregnant-women-followup.update', $pregnant_followup->sync_id) }}" method="post" id="followupform" class="form-horizontal">
                    @csrf
                    @method('PATCH')
                    @include('pregnant_women.partials.followup')

                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div> <!-- col -->
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="tab-content">
                            <div id="contact-1" class="tab-pane active">
                                <div id="pregnant-women-info">
                                    Loading ...
                                </div>
                            </div> <!-- tab-pane -->
                        </div> <!-- tab-content -->
                    </div> <!-- ibox-content -->
                </div> <!-- ibox -->
            </div> <!-- col -->
            
        </div> <!-- row -->
    </div> <!-- wrapper -->
@endsection

@push('scripts')


<script src="{{ asset('js/plugins/steps/jquery.steps.min.js')}}"></script>

{{--<script>--}}
    {{--$(document).ready(function () {--}}
        {{--$("#wizard").steps({--}}
            {{--onFinished: function (event, currentIndex) {--}}
                {{--$('#followupform').submit();--}}
            {{--}--}}
        {{--});--}}
    {{--})--}}
{{--</script>--}}

<script>
    $(document).ready(function () {
        $("#wizard").steps({
            onFinished: function (event, currentIndex) {
                $('#followupform').submit();
            }
        });
        load_pregnant_women({{$pregnant_women->sync_id}})
        $(".discharge-criteria-tabs").hide();
        $( "#identification-outcome" ).change(function() {
            if($("#identification-outcome").val() == 'New case'){
                $("#admission-criteria-tab").show();
                $(".discharge-criteria-tabs").hide();
                $("#admission-discharge-tab-heading").text("Admission Criteria")
            }else{
                $("#admission-criteria-tab").hide();
                $(".discharge-criteria-tabs").show();
                $('#admission-discharge-tab-heading').text("Discharge Criteria")
            }
        });
    })

    function load_pregnant_women(pregnant_women) {
        var abase_url = '{{url('/')}}';
        $.ajax({
            url: abase_url+'/pregnant-women/'+pregnant_women+'/info',
            type: 'get',
            success: function (res) {
                $('#pregnant-women-info').html(res);
            }
        });
    }

</script>
<script src="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepickerPlandate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });
    $(function () {
        $('#datetimepickerActualdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });
    $(function () {
        $('#datetimepickerNextvisitdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });
</script>

@endpush