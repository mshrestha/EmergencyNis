<div class="row m-b-lg">
    <div class="col-lg-4 text-center">
        <div>
            <img alt="image" src="{{ $child->child_image() }}"
            style="width: 100%;height: 110px;object-fit:cover;">
        </div>
    </div>
    <div class="col-lg-8">
        <strong>{{ $child->children_name }}</strong>
        <p>
            {{ $child->age }} months old<br />
            Block {{ $child->sub_block_no }}, Household {{ $child->hh_no }} <br />
            Date of Birth: {{ $child->date_of_birth }}
        </p>
        @if(Auth::user()->category == 'community' || Auth::user()->category == 'both')
        <a href="{{ route('community-followup.show', $child->id) }}">
            <button type="button" class="btn btn-primary btn-sm btn-block">
                <i class="fa fa-plus"></i> Add Community Follow Up
            </button>
        </a>
        @endif
        @if(Auth::user()->category == 'facility' || Auth::user()->category == 'both')
        <a href="{{ route('facility-followup.show', $child->id) }}">
            <button type="button" class="btn btn-primary btn-sm btn-block" style="margin-top: 10px;">
                <i class="fa fa-plus"></i> Add Facility Follow Up
            </button>
        </a>
        @endif
    </div>
</div>

<div class="client-detail">
    <div class="full-height-scroll">
        <ul class="nav nav-tabs" style="font-size: 10px;">
            <li class="active"><a data-toggle="tab" href="#followup-1">Followup</a></li>
        </ul>
        <div class="tab-content">
            <div id="followup-1" class="tab-pane active">
                @if(count($followups))
                <div style="margin-top: 10px;">
                    <strong>Nutrition Report</strong>
                    @if(isset($followups[0]['facility_id']))
                    <ul class="list-group clear-list">
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_diarrhoea'] }} </span>
                            Dirrhoea (no of days)
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_vomiting'] }} </span>
                            Vomiting (no of days)
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_fever'] }} </span>
                            Fever (no of days)
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_cough'] }} </span>
                            Cought (no of days)
                        </li>
                    </ul>
                    @else
                    <ul class="list-group clear-list">
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> {{ $followups[0]['exclusive_breastfeeding'] ? 'Yes' : 'No' }} </span>
                            Exclusive Breastfeeding
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['received_all_epi_vaccination'] ? 'Yes' : 'No' }} </span>
                            Received all EPI
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['edema'] ? 'Yes' : 'No' }} </span>
                            Edema
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['nutritional_status'] }} </span>
                            Nutritional Status
                        </li>
                    </ul>
                    @endif
                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                        @foreach($followups as $followup)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            @if(isset($followup['facility_id']))
                            <div class="vertical-timeline-content">
                                <p>Visited {{ $followup['facility']['facility_id'] }}</p>
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span>
                                <span class="pull-right">
                                <a href="{{ route('facility-followup.edit', $followup['id']) }}">Edit</a>
                                </span>
                            </div>
                            @else
                            <div class="vertical-timeline-content">
                                <p>Visited Community Followup</p>
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span>
                                <span class="pull-right">
                                <a href="{{ route('community-followup.edit', $followup['id']) }}">Edit</a>
                                </span>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            {{-- <div id="followup-2" class="tab-pane">
                @if($facility_followups->count())
                <div style="margin-top: 10px;">
                    <strong>Latest Medical History</strong>
                    <ul class="list-group clear-list">
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> {{ $facility_followups[0]->medical_history_diarrhoea }} </span>
                            Dirrhoea (no of days)
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $facility_followups[0]->medical_history_vomiting }} </span>
                            Vomiting (no of days)
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $facility_followups[0]->medical_history_fever }} </span>
                            Fever (no of days)
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $facility_followups[0]->medical_history_cough }} </span>
                            Cought (no of days)
                        </li>
                    </ul>
                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                        @foreach($facility_followups as $facility_followup)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <p>Visited {{ $facility_followup->facility->facility_id }}</p>
                                <span class="vertical-date small text-muted"> {{ $facility_followup->date }} </span>
                                <span class="pull-right">
                                <a href="{{ route('facility-followup.edit', $facility_followup->id) }}">Edit</a>
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div> --}}
        </div>
        
    </div>
</div>