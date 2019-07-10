<div>
    <div class="m-b-md">
        <h2>{{ $facility->facility_id }} </h2>
        <div>
            <a href="{{ route('facility-followup.show', $facility->id) }}" class="btn btn-primary btn-sm" style="width: 100%"><i class="fa fa-plus"></i> Add Facility Followup</a>
        </div>
    </div>
    <div class="facility-client-detail">
        <div class="full-height-scroll">
            <strong>Facility Details</strong> <label class="label label-success pull-right">{{ $facility->status }}</label>
            <hr>
            <ul class="list-group clear-list">
                <li class="list-group-item fist-item">
                    <span class="pull-right"> <span class="label label-primary">{{ $facility->program_partner }}</span> </span>
                    Program Partner
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <span class="label label-warning">{{ $facility->implementing_partner }}</span></span>
                    Implementing Partner
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <span class="label label-danger">{{ $facility->latitude }} , {{ $facility->longitude }}</span> </span>
                    Latitude, Longitude
                </li>
                <li class="list-group-item">
                    <span class="pull-right"> <span class="label label-info">{{ $facility->camp->name }}</span> </span>
                    Camp
                </li> 
            </ul>
            <hr/>
            <strong>Facility Followups</strong>
            <div id="vertical-timeline" class="vertical-container dark-timeline">
                @foreach($facility_followups as $facility_followup)
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon gray-bg">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="vertical-timeline-content">
                        <p style="margin-top: 0;">Facility Followup</p>
                        <span class="vertical-date small text-muted">{{ $facility_followup->date }}</span>
                        <span class="pull-right">
                            <a href="{{ route('facility-followup.edit', $facility_followup->id) }}">Edit</a>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>