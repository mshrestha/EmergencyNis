<div class="form-group">
	<label>Supervisor name</label>
	{{ html()->text('name', $outreach_monthly_report->outreachSupervisor->name)->class('form-control')->disabled()->required() }}
</div>

<div class="form-group">
	<label>Month</label>
	@php
	    $month = $outreach_monthly_report->date_year.'-'.$outreach_monthly_report->date_month.'-01';
	    $month = date('F Y', strtotime($month));
	@endphp
	
	{{ html()->text('name', $month)->class('form-control')->disabled()->required() }}
</div>

<div class="form-group">
	<label>Pregnant women</label>
	{{ html()->number('pregnant_women')->class('form-control')->required() }}
</div>
<div class="form-group">
	<label>0 to 6 months</label>
	{{ html()->number('zero_to_six_months')->class('form-control')->required() }}
</div>
<div class="form-group">
	<label>6 to 24 months</label>
	{{ html()->number('six_to_twentyfour_months')->class('form-control')->required() }}
</div>
<div class="form-group">
	<label>grandmothers</label>
	{{ html()->number('grandmothers')->class('form-control')->required() }}
</div>
<div class="form-group">
	<label>adolescent</label>
	{{ html()->number('adolescent')->class('form-control')->required() }}
</div>
<div class="form-group">
	<label>referral</label>
	{{ html()->number('referral')->class('form-control')->required() }}
</div>