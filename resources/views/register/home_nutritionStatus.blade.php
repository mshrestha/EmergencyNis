@extends('layouts.app')
@push('styles')
<style>
    .modal {
        border: 1px solid black;
        background-color: rgba(255, 255, 255, 1.0);
        height: 95%;
        width: 95%;
        margin: 0 auto;
    }
    .FixedHeightContainer
    {
        float:right;
        height: 250px;
        width:250px;
        overflow: auto;
    }
</style>

<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12 tab-content">
                    <div class="ibox tab-pane active" id="tab-1">
                        <div class="ibox-title">
                            {{--<div class="col-md-12 ">--}}
                                <h2>Registered Children</h2>
                            <div class="pull-right " style="display: inline; top: 0; right: 0; position:absolute; padding-top: 15px; padding-right: 30px">

                                <a href="{{ route('register') }}" >
                                    <button type="button" class="btn btn-primary"><i
                                                class="fa fa-user"></i>
                                        All
                                    </button>
                                </a>
                                <a href="{{ route('sam_child') }}" >
                                    <button type="button" class="btn btn-danger"><i
                                                class="fa fa-user"></i>
                                        SAM
                                    </button>
                                </a>
                                <a href="{{ route('mam_child') }}" >
                                    <button type="button" class="btn btn-warning"><i
                                                class="fa fa-user"></i>
                                        MAM
                                    </button>
                                </a>
                                <a href="{{ route('normal_child') }}" >
                                    <button type="button" class="btn btn-info"><i
                                                class="fa fa-user"></i>
                                        Normal
                                    </button>
                                </a>
                                <div  class="btn-group " >
                                    <button type="button" class="btn btn-success dropdown-toggle"
                                            data-toggle="dropdown">
                                        Select Facility
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu FixedHeightContainer" role="menu">
                                        @foreach($camp_facilities as $cf)
                                            <li>
                                                <a href="{{url('register_selected_facility/'.$cf->id)}}">{{$cf->facility_id}}</a>
                                            </li>
                                        @endforeach
                                        <li class="divider"></li>
                                        <li><a href="{{ url('/register') }}">All</a></li>
                                    </ul>
                                </div>

                                <a href="{{ route('children.create') }}" >
                                    <button type="button" class="btn btn-primary"><i
                                                class="fa fa-plus"></i>
                                        Add Child
                                    </button>
                                </a>

                            </div>
                                <span class="small">All child needs to be registered in order to use this system.</span>
                        </div>
                        <div class="ibox-content">
                            <div class="clients-list">
                                <div class="full-height-scroll">
                                    <div class="table-responsive">
                                        <table class="table dataTables table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>MOHAID</th>
                                                <th>FCN</th>
                                                <th>Child name</th>
                                                <th>Mother</th>
                                                <th>Father</th>
                                                <th>Block HH-no</th>
                                                <th>Facility</th>
                                                <th>Nutrition Status</th>
                                                <th>Date Status</th>
                                                {{--<th>Weight Status</th>--}}
                                                <th>Follow up</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($children as $child)
                                                <tr class="children-client"
                                                    data-child-href="{{ route('children.show', $child->sync_id) }}">
                                                    <td class="children-show">{{ $child->children_id }}</td>
                                                    <td class="children-show">{{ $child->moha_id }}</td>
                                                    <td class="children-show">{{ $child->family_count_no }}</td>
                                                    <td class="children-show">
                                                        <a href="{{ route('children.show', $child->children_id) }}"
                                                           class="client-link">{{ $child->children_name }}</a>
                                                    </td>
                                                    <td class="children-show">{{ $child->mother_caregiver_name }}</td>
                                                    <td class="children-show">{{ $child->fathers_name }}</td>
                                                    <td class="children-show">{{ $child->block.' '.$child->sub_block_no.' '.$child->hh_no }} </td>
                                                    <td class="children-show">{{ isset($child->facility->facility_id) ? $child->facility->facility_id : ''}} </td>
                                                    <td class="children-show">
                                                        @if (isset($child->nutritionstatus))
                                                            <small class="label label-{{(($child->nutritionstatus=='SAM') ? 'danger' : (($child->nutritionstatus=='MAM') ? 'warning' :'info')) }}">
                                                                {{ $child->nutritionstatus }}</small>
                                                        @endif
                                                    </td>
                                                    <td class="children-show">
                                                        @if (isset($child->next_visit_date))
                                                            <small class="label label-{{($child->next_visit_date<date('Y-m-d'))?'danger':'' }}">{{ ($child->next_visit_date<date('Y-m-d'))?'Defaulter':'' }}</small>
                                                        @else
                                                            <small class="label label-warning">Missing Date</small>
                                                        @endif
                                                    </td>
                                                    {{--<td class="children-show">--}}
                                                        {{--@if ($child->facility_followup->count()>=2)--}}
                                                            {{--@if($child->facility_followup[$child->facility_followup->count()-1]['weight']==null)--}}
                                                                {{--<small class="label label-warning">weight Missing</small>--}}
                                                            {{--@else--}}
                                                            {{--<small class="label label-{{($child->facility_followup[$child->facility_followup->count()-2]['weight']>$child->facility_followup[$child->facility_followup->count()-1]['weight'])?'danger':'info' }}">{{ ($child->facility_followup[$child->facility_followup->count()-2]['weight']>$child->facility_followup[$child->facility_followup->count()-1]['weight'])?'Weight Loss':'Weight Gain' }}</small>--}}
                                                                {{--@endif--}}
                                                            {{--@else--}}
                                                            {{--<small class="label label-success">New</small>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    <td class="children-show">
                                                        @if(Auth::user()->category == 'community' || Auth::user()->category == 'both')
                                                            <a href="{{ route('community-followup.show', $child->children_id) }}"
                                                               title="Community followup">
                                                                <button type="button"
                                                                        class="btn btn-default btn-registered">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </a>
                                                        @endif
                                                        @if(Auth::user()->category == 'facility' || Auth::user()->category == 'both')
                                                            {{--<a href="{{ route('facility-followup.show', $child->sync_id) }}"--}}
                                                            <a href="{{ route('children.show', $child->children_id) }}"
                                                               class="edit-btn" title="Facility Followup">
                                                                <button class="btn btn-success btn-circle btn-registered"
                                                                        type="button"><i
                                                                            class="fa fa-plus"></i></button>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection




@push('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.dataTables').DataTable({
            aaSorting: [],
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgtip',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'RegisteredChildren'},
                {extend: 'pdf', title: 'RegisteredChildren'},
                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        });
    });
</script>
@endpush
