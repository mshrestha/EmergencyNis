@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-8">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Children page</h5>
					<div class="ibox-tools">
						<a href="{{ route('facility-followup.show', $children->sync_id) }}" class="btn btn-xs btn-primary" style="color: white;font-weight: bold;">Add new followup</a>
					</div>
				</div>
				<div class="ibox-content">
					@if($todays_followup)
                    <form action="{{ route('facility-followup.update', $facility_followup->sync_id) }}" method="post" id="followupform">
                        @csrf
                        @method('PATCH')
                        @include('facility_followup.partials.fields')
                        <button tyle="submit" class="btn btn-primary pull-right" style="margin-right: 5px; margin-bottom: 20px;">Save</button>
                    </form>
                    @else
                        <div class="col-lg-5">
                            <a href="{{ route('facility-followup.show', $children->sync_id) }}">
                                <div class="widget style1 lazur-bg">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <i class="fa fa-plus fa-5x"></i>
                                        </div>
                                        <div class="col-xs-10">
                                            <h2 class="font-bold" style="margin-top: 15px;">Add new followup</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif


					<div class="clearfix"></div>
                    <h3 style="margin-left: 10px;">Old followups</h3>
					<div id="vertical-timeline" class="vertical-container dark-timeline" style="height: auto;overflow-y:auto;">
                        @foreach($followups as $followup)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            @if(array_key_exists('nutritionstatus', $followup))
                            <div class="{{(($followup['nutritionstatus']=='SAM') ? 'vertical-timeline-content colorSam' : (($followup['nutritionstatus']=='MAM') ? 'vertical-timeline-content colorMam' :'vertical-timeline-content colorNormal'))}}" >
                                <span class="vertical-date small "> {{ \Carbon\Carbon::parse($followup['date'])->format(' d-M-Y') }} </span><br />
                                <p>Visited {{ $followup['facility']['facility_id'] }}</p>

                                @if(isset($followup['muac']))
                                    <strong>MUAC: </strong> {{ $followup['muac'] }} cm <br />
                                @endif
                                @if(isset($followup['weight']))
                                    <strong>Weight: </strong> {{ $followup['weight'] }} kg <br />
                                @endif
                                @if(isset($followup['height']))
                                    <strong>Height: </strong> {{ $followup['height'] }} cm <br />
                                @endif

                                @if(isset($followup['wfh_z_score']))
                                    <strong>Z-score: </strong> {{ $followup['wfh_z_score'] }} <br />
                                @endif


                                <span class="pull-right">
	                                <form action="{{ route('facility-followup.destroy', $followup['sync_id']) }}" method="post" class="delete-form">
	                                    @csrf
	                                    @method('DELETE')

	                                    <button type="submit" onclick="return confirm('Are you sure?')" style="background: none;border: none;color: black;outline: none;padding: 0;">Delete</button>
	                                </form>

                                    <a href="{{ route('facility-followup.edit', $followup['sync_id']) }}" style="margin-left: 10px; color: black">Edit</a>
                                </span>
                            </div>
                            @elseif(array_key_exists('deworming', $followup))
                            <div class="vertical-timeline-content">
                                <p>Visited facility for Followup</p>
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span>
                                <span class="pull-right">
                                <a href="{{ route('community-followup.edit', $followup['id']) }}">Edit</a>
                                </span>
                            </div>
                            @elseif(array_key_exists('psycho_social_support', $followup))
                            <div class="vertical-timeline-content">
                                <p>Visited  IYCF Followup</p>
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span>
                                <span class="pull-right">
                                <a href="{{ route('iycf-followup.edit', $followup['sync_id']) }}">Edit</a>
                                </span>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
				</div> <!-- ibox-content -->
			</div> <!-- ibox -->
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
        </div>
	</div> <!-- row -->
</div> <!-- wrapper -->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
{{--<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>--}}
<script src="{{ asset('js/plugins/steps/jquery.steps.min.js')}}"></script>
<script>
	$(document).ready(function () {
        $("#wizard").steps({

        	enableAllSteps: true,
        	enablePagination: false,
            onFinished: function (event, currentIndex) {
                $('#followupform').submit();
            }
        });
        load_child({{$children->sync_id}})
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
    });

	var abase_url = '{{url('/')}}';
    function load_child(child) {
        var url = abase_url + '/child-info/' + child;
        $.ajax({
            url: url,
            type: 'get',
            success: function (res) {
                $('#child-info').html(res);
            }
        });
    }
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
//            console.log(child_muac)
//            console.log(child_zscore)
//            console.log(child_oedema)
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
            var ns = 'Normal';
            var nsColor = '#21b9bb';
            if (child_muac < 13){ns='MAM'; nsColor = 'Orange'; }
            if (child_muac < 12){ns='SAM'; nsColor = 'Red'; }
            //$.get(url, sendData, function (data) {
//                console.log(data)
                //var ns = data.nutritionstatus;
//                console.log(ns)

                    $("#nutritionstatus").val(ns)
                        .css('background-color', nsColor);
                if(ns=='SAM') {                    $("#outcome_mam").hide();
                    $("#outcome_normal").hide();
                    $("#outcome_sam").show();

                    $("#wsbp").hide();
//                    $("#wsbpp").hide();
                    $("#rusf").hide();
                    $("#rutf").show();
                    $("#others").show();

                }
                else if (ns == 'MAM') {
                    $("#outcome_mam").show();
                    $("#outcome_sam").hide();
                    $("#outcome_normal").hide();

                    $("#wsbp").hide();
//                    $("#wsbpp").hide();
                    $("#rutf").hide();
                    $("#rusf").show();
                    $("#others").show();

                } else if (ns == 'Normal') {
                    $("#outcome_normal").show();
                    $("#outcome_sam").hide();
                    $("#outcome_mam").hide();

                    $("#rutf").hide();
                    $("#rusf").hide();
                    $("#wsbp").show();
//                    $("#wsbpp").show();
                    $("#others").show();
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

            //}, 'json')
        }
    });
	load_child({{$children->sync_id}})
</script>
@endpush
