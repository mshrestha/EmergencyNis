@if(!env('LIVE_SERVER') && env('SERVER_CODE'))
<a class="btn btn-danger" href="{{ route('sync.get-live-data') }}">Get live server data to smserver</a>
<div class="sync-wrapper">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Sync to live server</h5>
            <h5 class="pull-right"> (Code {{ env('SERVER_CODE') }})</h5>
		</div>
		<div class="ibox-content">
			<div class="progress">
				<div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
			</div>
			
			<small class="data-sync-count">
				<p>Children data sync : <span class="children_sync_count">{{ $children_sync_count }}</span></p>
				<p>Facility Followup data sync : <span class="facility_followup_sync_count">{{ $facility_followup_sync_count }}</span></p>
				<p>IYCF Followup data sync : <span class="iycf_followup_sync_count">{{ $iycf_followup_sync_count }}</span></p>
				<p>Pregnant Women data sync : <span class="pregnant_women_sync_count">{{ $pregnant_women_sync_count }}</span></p>
				<p>Pregnant Women Followup data sync : <span class="pregnant_women_followup_sync_count">{{ $pregnant_women_followup_sync_count }}</span></p>
                
                <p>Volunteer data sync : <span class="volunteers_sync_count">{{ $volunteers_sync_count }}</span></p>
                <p>Community sections data sync : <span class="community_sessions_sync_count">{{ $community_sessions_sync_count }}</span></p>
                <p>Community sections womens data sync : <span class="community_sessions_womens_sync_count">{{ $community_sessions_womens_sync_count }}</span></p>
                <p>Outreach supervisor data sync : <span class="outreach_supervisors_sync_count">{{ $outreach_supervisors_sync_count }}</span></p>
                <p>Outreach monthly report data sync : <span class="outreach_monthly_reports_sync_count">{{ $outreach_monthly_reports_sync_count }}</span></p>
			</small>

			<button class="btn btn-primary" id="btn-sync-now">Sync</button>
			<div id="syncing-msg" style="display: none;">Syncing ...</div>
		</div>
        {{--<div class="col-lg-3">--}}
            <a href="{{ url('myprofile') }}">
                <div class="widget style1 blue-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-user-circle fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">

                            <h2 class="font-bold">Profile</h2>
                        </div>
                    </div>
                </div>
            </a>
        {{--</div>--}}

    </div>

</div>
@endif

@push('scripts')
<script>
    $('#btn-sync-now').on('click', function () {
        $(this).hide();
        $('#syncing-msg').html('Syncing ...');
        $('#syncing-msg').show();

        sync_children();
    });

    function sync_children() {
        $.ajax({
            type: 'get',
            url: '/sync/children',
            success: function (res) {
                $('.children_sync_count').html(res.sync_left);
                update_progress_bar();

                if (res.has_more == true) {
                    sync_children();
                } else {
                    sync_facility_followup();
                }
            }, error: function (err) {
                $('.children_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

	function sync_facility_followup() {
        $.ajax({
            type: 'get',
            url: '/sync/facility-followup',
            success: function (res) {
                $('.facility_followup_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_facility_followup();
                } else {
                    sync_iycf_followup();
                }
            }, error: function (err) {
                $('.facility_followup_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_iycf_followup() {
        $.ajax({
            type: 'get',
            url: '/sync/iycf-followup',
            success: function (res) {
                $('.iycf_followup_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_iycf_followup();
                } else {
                    sync_pregnant_women();
                }
            }, error: function (err) {
                $('.iycf_followup_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_pregnant_women() {
        $.ajax({
            type: 'get',
            url: '/sync/pregnant-women',
            success: function (res) {
                $('.pregnant_women_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_pregnant_women();
                } else {
                    sync_pregnant_women_followup();
                }
            }, error: function (err) {
                $('.pregnant_women_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_pregnant_women_followup() {
        $.ajax({
            type: 'get',
            url: '/sync/pregnant-women-followup',
            success: function (res) {
                $('.pregnant_women_followup_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_pregnant_women_followup();
                } else {
                    sync_volunteers();
                }
            }, error: function (err) {
                $('.pregnant_women_followup_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_volunteers() {
        $.ajax({
            type: 'get',
            url: '/sync/volunteers',
            success: function (res) {
                $('.volunteers_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_pregnant_women_followup();
                } else {
                    sync_community_sessions();
                }
            }, error: function (err) {
                $('.volunteers_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_community_sessions() {
        $.ajax({
            type: 'get',
            url: '/sync/community-sessions',
            success: function (res) {
                $('.community_sessions_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_community_sessions();
                } else {
                    sync_community_sessions_womens();
                }
            }, error: function (err) {
                $('.community_sessions_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_community_sessions_womens() {
        $.ajax({
            type: 'get',
            url: '/sync/community-sessions-womens',
            success: function (res) {
                $('.community_sessions_womens_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_community_sessions_womens();
                } else {
                    sync_outreach_supervisors();
                }
            }, error: function (err) {
                $('.community_sessions_womens_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_outreach_supervisors() {
        $.ajax({
            type: 'get',
            url: '/sync/outreach-supervisors',
            success: function (res) {
                $('.outreach_supervisors_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_outreach_supervisors();
                } else {
                    sync_outreach_monthly_reports();
                }
            }, error: function (err) {
                $('.outreach_supervisors_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    function sync_outreach_monthly_reports() {
        $.ajax({
            type: 'get',
            url: '/sync/outreach-monthly-reports',
            success: function (res) {
                $('.outreach_monthly_reports_sync_count').html(res.sync_left);
                update_progress_bar();

                if(res.has_more == true) {
                    sync_outreach_monthly_reports();
                } else {
                    $('#syncing-msg').html('All data synced.');
                    $('#btn-sync-now').show();
                }
            }, error: function (err) {
                $('.outreach_monthly_reports_sync_count').html('Try again.');
                $('#btn-sync-now').show();
            }
        });
    }

    var children_sync_count = $('.children_sync_count').html();
	var facility_followup_sync_count = $('.facility_followup_sync_count').html();
	var iycf_followup_sync_count = $('.iycf_followup_sync_count').html();
	var pregnant_women_sync_count = $('.pregnant_women_sync_count').html();
	var pregnant_women_followup_sync_count = $('.pregnant_women_followup_sync_count').html();
    
    var volunteers_sync_count = $('.volunteers_sync_count').html();
    var community_sessions_sync_count = $('.community_sessions_sync_count').html();
    var community_sessions_womens_sync_count = $('.community_sessions_womens_sync_count').html();
    var outreach_supervisors_sync_count = $('.outreach_supervisors_sync_count').html();
    var outreach_monthly_reports_sync_count = $('.outreach_monthly_reports_sync_count').html();

	var main_total_count = parseInt(children_sync_count) + parseInt(facility_followup_sync_count) + parseInt(iycf_followup_sync_count) + parseInt(pregnant_women_sync_count) + parseInt(pregnant_women_followup_sync_count) + parseInt(volunteers_sync_count) + parseInt(community_sessions_sync_count) + parseInt(community_sessions_womens_sync_count) + parseInt(outreach_supervisors_sync_count) + parseInt(outreach_monthly_reports_sync_count);

	function update_progress_bar() {
		var children_sync_count = $('.children_sync_count').html();
		var facility_followup_sync_count = $('.facility_followup_sync_count').html();
		var iycf_followup_sync_count = $('.iycf_followup_sync_count').html();
		var pregnant_women_sync_count = $('.pregnant_women_sync_count').html();
		var pregnant_women_followup_sync_count = $('.pregnant_women_followup_sync_count').html();
        var volunteers_sync_count = $('.volunteers_sync_count').html();
        var community_sessions_sync_count = $('.community_sessions_sync_count').html();
        var community_sessions_womens_sync_count = $('.community_sessions_womens_sync_count').html();
        var outreach_supervisors_sync_count = $('.outreach_supervisors_sync_count').html();
        var outreach_monthly_reports_sync_count = $('.outreach_monthly_reports_sync_count').html();

		var total_count = parseInt(children_sync_count) + parseInt(facility_followup_sync_count) + parseInt(iycf_followup_sync_count) + parseInt(pregnant_women_sync_count) + parseInt(pregnant_women_followup_sync_count) + parseInt(volunteers_sync_count) + parseInt(community_sessions_sync_count) + parseInt(community_sessions_womens_sync_count) + parseInt(outreach_supervisors_sync_count) + parseInt(outreach_monthly_reports_sync_count);

		var percentage = (total_count/main_total_count) * 100;
		var completed_percentage = 100 - parseInt(percentage);

		if(main_total_count == 0) {
			completed_percentage = 100;
		}
		// console.log(completed_percentage);

		$('.progress-bar').css({'width': completed_percentage + '%'});
		$('.progress-bar').html(completed_percentage + '%');
	}
</script>
@endpush