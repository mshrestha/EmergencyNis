@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.css') }}" rel="stylesheet"/>
<style>
    .dark-timeline .colorSam {
        background: rgba(255, 0, 0, .8);
        color: white;
    !important;
    }
    .dark-timeline .colorMam {
        background: rgba(255, 255, 0, .8);
        color: black;
    !important;
    }
    .dark-timeline .colorNormal {
        background: rgba(0, 128, 0, .8);
        color: white;
    !important;
    }
</style>
@endpush
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
	<div class="row">
		<div class="col-lg-8">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Pregnant Women page</h5>
					<div class="ibox-tools">
						<a href="{{ route('pregnant-women-followup.show', $pregnant_women->sync_id) }}" class="btn btn-xs btn-primary" style="color: white;font-weight: bold;">Add new followup</a>
					</div>
				</div>
				<div class="ibox-content">
					@if($todays_followup)
                    <form action="{{ route('pregnant-women-followup.update', $facility_followup->sync_id) }}" method="post" id="followupform">
                        @csrf
                        @method('PATCH')
                        @include('pregnant_women.partials.followup')
                        <button tyle="submit" class="btn btn-primary pull-right" style="margin-right: 5px; margin-bottom: 20px;">Save</button>
                    </form>
                    @else
                        <div class="col-lg-5">
                            <a href="{{ route('pregnant-women-followup.show', $pregnant_women->sync_id) }}">
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
                        @foreach($women_followups as $followup)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="{{(($followup['nutritionstatus']=='SAM') ? 'vertical-timeline-content colorSam' : (($followup['nutritionstatus']=='MAM') ? 'vertical-timeline-content colorMam' :'vertical-timeline-content colorNormal'))}}" >
                                <span class="vertical-date small "> {{ \Carbon\Carbon::parse($followup['actual_date'])->format(' d-M-Y') }} </span><br />
                                <p>Visited {{ $followup['facility_id'] }}</p>

                                @if(isset($followup['muac']))
                                    <strong>MUAC: </strong> {{ $followup['muac'] }} cm <br />
                                @endif
                                @if(isset($followup['weight']))
                                    <strong>Weight: </strong> {{ $followup['weight'] }} kg <br />
                                @endif

                                <span class="pull-right">
	                                <form action="{{ route('pregnant-women-followup.destroy', $followup['sync_id']) }}" method="post" class="delete-form">
	                                    @csrf
	                                    @method('DELETE')

	                                    <button type="submit" onclick="return confirm('Are you sure?')" style="background: none;border: none;color: black;outline: none;padding: 0;">Delete</button>
	                                </form>

                                    <a href="{{ route('pregnant-women-followup.edit', $followup['sync_id']) }}" style="margin-left: 10px; color: black">Edit</a>
                                </span>
                            </div>
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
                            <div id="pregnant-women-info">
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


<script src="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.js') }}"></script>

<script>
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

    load_pregnant_women({{$pregnant_women->sync_id}})
</script>

@endpush
