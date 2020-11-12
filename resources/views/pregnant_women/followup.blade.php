@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.css') }}" rel="stylesheet"/>

<style>
    .modal {
        border: 1px solid black;
        background-color: rgba(255, 255, 255, 1.0);
        height: 95%;
        width: 95%;
        margin: 0 auto;
    }
</style>

<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('pregnant-women-followup.store') }}" method="post" id="followupform"
                      class="form-horizontal">
                    @csrf
                    @method('POST')
                    @include('pregnant_women.partials.followup')
                    <button class="btn btn-primary" type="submit">Add</button>
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
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>

<script>
    $(document).ready(function () {
        $("#wizard").steps({
            enableAllSteps: true,
            enablePagination: false,
            onFinished: function (event, currentIndex) {
                $('#followupform').submit();
            }
        });
        load_pregnant_women({{$pregnant_women->sync_id}})
        $(".discharge-criteria-tabs").hide();
        $("#identification-outcome").change(function () {
            if ($("#identification-outcome").val() == 'MAM new case') {
                $("#admission-criteria-tab").show();
                $(".discharge-criteria-tabs").hide();
                $("#admission-discharge-tab-heading").text("Admission Criteria")
            }
            else if ($("#identification-outcome").val() == 'Normal new case') {
                $("#admission-criteria-tab").show();
                $(".discharge-criteria-tabs").hide();
                $("#admission-discharge-tab-heading").text("Admission Criteria")
            } else {
                $("#admission-criteria-tab").hide();
                $(".discharge-criteria-tabs").show();
                $('#admission-discharge-tab-heading').text("Discharge Criteria")
            }
        });
    })

    function load_pregnant_women(pregnant_women) {
        var abase_url = '{{url('/')}}';
        $.ajax({
            url: abase_url + '/pregnant-women/' + pregnant_women + '/info',
            type: 'get',
            success: function (res) {
                $('#pregnant-women-info').html(res);
            }
        });
    }
</script>

<script>
    {{--Autometic Nutrition Status calculation--}}
$(document).ready(function () {
        $('#women_muac').keyup(function () {
            re_calc();
        });
        function re_calc() {
            var women_muac = $("#women_muac").val();
//            console.log(women_muac)
            var abase_url = '{{url('/')}}';
            var url = abase_url + '/nutritionStatusWomen';
            var sendData = {
                womenMuac: women_muac,
                _token: $("input[name='_token']").val()
            };
            $.get(url, sendData, function (data) {
                var ns = data.nutritionstatus;
                $("#nutritionstatus").val(data.nutritionstatus)
                    .css('background-color', data.nutritionstatusColor);
                 if (ns == 'MAM') {
                    $("#outcome_mam").show();
                    $("#outcome_normal").hide();
//                    $("#wsbp").hide();
//                    $("#wsbpp").hide();
//                    $("#rutf").show();
//                    $("#rusf").show();
//                    $("#others").show();
                }
                else if (ns == 'Normal') {
                    $("#outcome_normal").show();
                    $("#outcome_mam").hide();
//                    $("#rutf").hide();
//                    $("#rusf").show();
//                    $("#wsbp").show();
//                    $("#wsbpp").show();
//                    $("#others").show();
                }
                else {
                    $("#outcome_normal").show();
                    $("#outcome_mam").show();
//                    $("#rutf").show();
//                    $("#rusf").show();
//                    $("#wsbp").show();
//                    $("#wsbpp").show();
//                    $("#others").show();
                }
            }, 'json')
        }
    });

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
