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
@endpush
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('facility-followup.save', $children->id) }}" method="post" id="followupform">
                    @csrf
                    @method('POST')
                    @include('facility_followup.partials.fields')

                    <div class="row">
                        <button tyle="submit" class="btn btn-primary pull-right"
                                style="margin-right: 5px; margin-bottom: 20px; z-index:99999;">Save
                        </button>
                </form>
            </div>
        </div> <!-- col -->
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div id="child-info">
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


<script>
    $(document).ready(function () {
        $("#wizard").steps({
            enableAllSteps: true,
            enablePagination: false,
            onFinished: function (event, currentIndex) {
                $('#followupform').submit();
            }
        });
        {{--        var weight='{{isset($facility_followup) ? $facility_followup->weight : ''}}';--}}
        {{--        var weight='{{isset($startingInfo) ? $startingInfo->weight : ''}}';--}}
load_child({{$children->sync_id}});
        $(".discharge-criteria-tabs").hide();
        $("#identification-outcome").change(function () {
//             io = $("#identification-outcome").val();
//            console.log($("#identification-outcome").val())
            if ($("#identification-outcome").val() == 'SAM new case') {
                $("#admission-criteria-tab").show();
                $(".discharge-criteria-tabs").hide();
                $("#admission-discharge-tab-heading").text("Admission Criteria")
//                $("#rutf").show();
            } else if ($("#identification-outcome").val() == 'MAM new case') {
                $("#admission-criteria-tab").show();
                $(".discharge-criteria-tabs").hide();
                $("#admission-discharge-tab-heading").text("Admission Criteria")
//                $("#rutf").hide();
            } else if ($("#identification-outcome").val() == 'Normal new case') {
                $("#admission-criteria-tab").show();
                $(".discharge-criteria-tabs").hide();
                $("#admission-discharge-tab-heading").text("Admission Criteria")
            } else {
                $("#admission-criteria-tab").hide();
                $(".discharge-criteria-tabs").show();
                $('#admission-discharge-tab-heading').text("Discharge Criteria")
//                $("#lowest_weight_kg").val(weight);
            }

        });
    });

    $(document).ready(function () {

        $("#discharge_criteria_exit").change(function () {
            if ($("#discharge_criteria_exit").val() == '') {
                $("#lowest_weight_kg").val('');
                $("#duration_between_weight").val('');
                $("#gain_of_weight").val('');
                $("#discharge_muac").val('');
                $("#discharge_weight_kg").val('');
                $("#duration_day").val('');
            } else {
                var weight = '{{isset($startingInfo) ? $startingInfo->weight : ''}}';
                var discharge_muac = $("#child_muac").val();
                var discharge_weight_kg = $("#child_weight").val();
                var startingDate = '{{isset($startingInfo) ? \Carbon\Carbon::parse($startingInfo->date)->format('d-m-Y') : ''}}';
                var actual_date = $("#actual_date").val();
                var endDate = moment(actual_date, "DD-MM-YYYY");
                var startDate = moment(startingDate, "DD-MM-YYYY");
                var duration_between_weight_day = endDate.diff(startDate, 'days');
                var weightGain = discharge_weight_kg-weight;
//                console.log(discharge_weight_kg);

                $("#lowest_weight_kg").val(weight);
                $("#duration_between_weight").val(duration_between_weight_day);
                $("#gain_of_weight").val(weightGain);
                $("#discharge_muac").val(discharge_muac);
                $("#discharge_weight_kg").val(discharge_weight_kg);
                $("#duration_day").val(duration_between_weight_day);
            }

        });
    });

    var abase_url = '{{url('/')}}';
    function load_child(child) {
        $.ajax({
            url: abase_url + '/child-info/' + child,
            type: 'get',
            success: function (res) {
                $('#child-info').html(res);
            }
        });
    }

</script>


<script>
    {{--Autometic Z-Score calculation--}}
    $(document).ready(function () {
        $('#child_weight').keyup(function () {
            recalc();
        });
        $('#child_height').keyup(function () {
            recalc();
        });
        function recalc() {
            var child_weight = $("#child_weight").val();
            var child_height = $("#child_height").val();
//            console.log(child_weight)
            var abase_url = '{{url('/')}}';
            var url = abase_url + '/wfh_calculation';
            var sendData = {
                childHeight: child_height,
                childWeight: child_weight,
                childSex: child_sex,
                _token: $("input[name='_token']").val()
            };
            $.get(url, sendData, function (data) {
//                console.log(data)
                $("#zscore").val(data.zscore);
            }, 'json')
        }
    });
    {{--Autometic Nutrition Status calculation--}}
    $(document).ready(function () {
        $('#child_weight').keyup(function () {
            re_calc();
        });
        $('#child_height').keyup(function () {
            re_calc();
        });
        $('#oedema').change(function () {
            re_calc();
        });
        $('#child_muac').keyup(function () {
            re_calc();
        });
        function re_calc() {
            var child_weight = $("#child_weight").val();
            var child_height = $("#child_height").val();
            var child_oedema = $("#oedema").val();
            var child_muac = $("#child_muac").val();
            var actual_date = $("#actual_date").val();
            var actual_date2 = moment(actual_date, "DD-MM-YYYY");
//            console.log(actual_date)
            var abase_url = '{{url('/')}}';
            var url = abase_url + '/nutritionStatusCalculation';
            var sendData = {
                childHeight: child_height,
                childWeight: child_weight,
                childOedema: child_oedema,
                childMuac: child_muac,
                childSex: child_sex,
                _token: $("input[name='_token']").val()
            };
//            $("#identification-outcome").change(function () {
//                var io = $("#identification-outcome").val();
//            });
            $.get(url, sendData, function (data) {
//                console.log(data)
                var ns = data.nutritionstatus;
//                console.log(io)
                $("#nutritionstatus").val(data.nutritionstatus)
                    .css('background-color', data.nutritionstatusColor);
                if (ns == 'SAM') {
                    $("#outcome_mam").hide();
                    $("#outcome_normal").hide();
                    $("#outcome_sam").show();
                    $("#wsbp").hide();
//                    $("#wsbpp").hide();
                    $("#rusf").hide();
                    $("#rutf").show();
                    $("#others").show();
                    $("#next_visit_date").val(moment(actual_date2, 'DD-MM-YYYY').add(7, 'days').format('DD-MM-YYYY'));
                }
                else if (ns == 'MAM') {
                    $("#outcome_mam").show();
                    $("#outcome_sam").hide();
                    $("#outcome_normal").hide();
                    $("#wsbp").hide();
//                    $("#wsbpp").hide();
                    $("#rutf").show();
                    $("#rusf").show();
                    $("#others").show();
                    $("#next_visit_date").val(moment(actual_date2, 'DD-MM-YYYY').add(14, 'days').format('DD-MM-YYYY'));
                }
                else if (ns == 'Normal') {
                    $("#outcome_normal").show();
                    $("#outcome_sam").hide();
                    $("#outcome_mam").hide();
                    $("#rutf").hide();
                    $("#rusf").show();
                    $("#wsbp").show();
//                    $("#wsbpp").show();
                    $("#others").show();
                    $("#next_visit_date").val(moment(actual_date2, 'DD-MM-YYYY').add(28, 'days').format('DD-MM-YYYY'));
                }
                else {
                    $("#outcome_normal").show();
                    $("#outcome_sam").show();
                    $("#outcome_mam").show();
                    $("#rutf").show();
                    $("#rusf").show();
                    $("#wsbp").show();
//                    $("#wsbpp").show();
                    $("#others").show();
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
        $('#datetimepickerAlbendazole').datetimepicker({
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
