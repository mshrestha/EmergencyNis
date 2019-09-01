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
            {{ $child->mnr_no}}<br />
            {{ $child->age }} months old<br />
            Block {{ $child->sub_block_no }}, Household {{ $child->hh_no }} <br />
            Date of Birth: {{ $child->date_of_birth }}
            
        </p>
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('children.edit', $child->id) }}" class="edit-btn">
                    <button class="btn btn-info btn-circle" type="button"><i class="fa fa-pencil"></i></button>
                </a>
                <form action="{{ route('children.destroy', $child->id) }}" method="post" class="delete-form">
                    @csrf
                    @method('DELETE')

                    <button  class="btn btn-danger btn-circle" type="submit" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></button>
                </form>      
            </div>
            
        </div>
    </div>
</div>

<div class="client-detail">
    <div class="full-height-scroll">
            <div id="followup-1" class="tab-pane active">
                @if(count($followups))
                <div style="margin-top: 10px;">
                    <strong>Nutrition Report</strong>
                    @if(isset($followups[0]['medical_history_diarrhoea']))
                    <ul class="list-group clear-list">
                        @if(isset($followups[0]['facility_id']))
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_diarrhoea'] }} </span>
                            Dirrhoea (no of days)
                        </li>
                        @endif
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
                        @if (isset($followups[0]['exclusive_breastfeeding']))
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> {{ $followups[0]['exclusive_breastfeeding'] ? 'Yes' : 'No' }} </span>
                            Exclusive Breastfeeding
                        </li>
                        @endif
                        @if (isset($followups[0]['received_all_epi_vaccination']))
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['received_all_epi_vaccination'] ? 'Yes' : 'No' }} </span>
                            Received all EPI
                        </li>
                        @endif
                        @if (isset($followups[0]['edema']))
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['edema'] ? 'Yes' : 'No' }} </span>
                            Edema
                        </li>
                        @endif
                        @if(isset($followups[0]['nutritional_status']))
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['nutritional_status'] }} </span>
                            Nutritional Status
                        </li>
                        @endif
                    </ul>
                    @endif
                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                        @foreach($followups as $followup)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            @if(isset($followup['facility']['facility_id']))
                            <div class="vertical-timeline-content">
                                <p>Visited {{ $followup['facility']['facility_id'] }}</p>
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span>
                                <span class="pull-right">
                                <a href="{{ route('facility-followup.edit', $followup['id']) }}">Edit</a>
                                </span>
                            </div>
                            @else
                            <div class="vertical-timeline-content">
                                <p>Visited facility for Followup</p>
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
        
        
    </div>
</div>
<div class=" text-center" onclick="printDiv('qrcode')" id="qrcode">
   {!! QrCode::size(200)->generate(route('facility-followup.show', $child->id)); !!}
</div>

