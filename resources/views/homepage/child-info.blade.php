<div class="row m-b-lg">
    <div class="col-lg-4 text-center">
        <div>
            <img alt="image" src="{{ $child->child_image() }}"
            style="width: 100%;height: 110px;">
        </div>
    </div>
    <div class="col-lg-8">
        <strong>{{ $child->children_name }}</strong>
        <p>
            {{ $child->age }} months old<br />
            Block {{ $child->sub_block_no }}, Household {{ $child->hh_no }} <br />
            Date of Birth: {{ $child->date_of_birth }}
        </p>
        <a href="{{ route('community-followup.show', $child->id) }}">
            <button type="button" class="btn btn-primary btn-sm btn-block">
                <i class="fa fa-plus"></i> Add Follow Up
            </button>
        </a>
    </div>
</div>
@if($child_followups->count())
<div class="client-detail">
    <div class="full-height-scroll">
        <strong>Nutrition Report</strong>
        <ul class="list-group clear-list">
            <li class="list-group-item fist-item">
                <span class="pull-right"> {{ $child_followups[0]->exclusive_breastfeeding ? 'Yes' : 'No' }} </span>
                Exclusive Breastfeeding
            </li>
            <li class="list-group-item">
                <span class="pull-right"> {{ $child_followups[0]->received_all_epi_vaccination ? 'Yes' : 'No' }} </span>
                Received all EPI
            </li>
            <li class="list-group-item">
                <span class="pull-right"> {{ $child_followups[0]->edema ? 'Yes' : 'No' }} </span>
                Edema
            </li>
            <li class="list-group-item">
                <span class="pull-right"> {{ $child_followups[0]->nutritional_status }} </span>
                Nutritional Status
            </li>
        </ul>
        <strong>Timeline activity</strong>
        <div id="vertical-timeline" class="vertical-container dark-timeline">
            @foreach($child_followups as $children_followup)
            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon gray-bg">
                    <i class="fa fa-briefcase"></i>
                </div>
                <div class="vertical-timeline-content">
                    <p>Followup Visited</p>
                    <span class="vertical-date small text-muted"> {{ $children_followup->date }} </span>
                    <span class="pull-right">
                    <a href="{{ route('community-followup.edit', $children_followup->id) }}">Edit</a>
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif