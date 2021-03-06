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
@include('register.partials.menu_tab')
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
                                                <th>Plan Date </th>
                                                <th>Date Status</th>
                                                <th>Weight Status</th>
                                                <th>Follow up</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($children as $child)
                                                <tr class="children-client"
                                                    data-child-href="{{ route('children.show', $child->sync_id) }}">
                                                    <td class="children-show">{{ $child->sync_id }}</td>
                                                    <td class="children-show">{{ $child->moha_id }}</td>
                                                    <td class="children-show">{{ $child->family_count_no }}</td>
                                                    <td class="children-show">
                                                        <a href="{{ route('children.show', $child->sync_id) }}"
                                                           class="client-link">{{ $child->children_name }}</a>
                                                    </td>
                                                    <td class="children-show">{{ $child->mother_caregiver_name }}</td>
                                                    <td class="children-show">{{ $child->fathers_name }}</td>
                                                    <td class="children-show">{{ $child->block.' '.$child->sub_block_no.' '.$child->hh_no }} </td>
                                                    <td class="children-show">{{ isset($child->facility->facility_id) ? $child->facility->facility_id : ''}} </td>
                                                    <td class="children-show">
                                                        @if (isset($child->facility_followup[$child->facility_followup->count()-1]['nutritionstatus']))
                                                            <small class="label label-{{(($child->facility_followup[$child->facility_followup->count()-1]['nutritionstatus']=='SAM') ? 'danger' : (($child->facility_followup[$child->facility_followup->count()-1]['nutritionstatus']=='MAM') ? 'warning' :'info')) }}">{{ $child->facility_followup[$child->facility_followup->count()-1]['nutritionstatus'] }}</small>
                                                        @endif
                                                    </td>
                                                    <td class="children-show">
                                                        @if (isset($child->facility_followup[$child->facility_followup->count()-1]['planed_date']))
                                                            {{\Carbon\Carbon::parse($child->facility_followup[$child->facility_followup->count()-1]['planed_date'])->format(' d-M-Y') }}
                                                        @endif
                                                    </td>
                                                    <td class="children-show">
                                                        @if (isset($child->facility_followup[$child->facility_followup->count()-1]['next_visit_date']))
                                                            <small class="label label-{{($child->facility_followup[$child->facility_followup->count()-1]['next_visit_date']<date('Y-m-d'))?'danger':'' }}">{{ ($child->facility_followup[$child->facility_followup->count()-1]['next_visit_date']<date('Y-m-d'))?'Defaulter':'' }}</small>
                                                        @else
                                                            <small class="label label-warning">Missing Date</small>
                                                        @endif
                                                    </td>
                                                    <td class="children-show">
                                                        @if ($child->facility_followup->count()>=2)
                                                            @if($child->facility_followup[$child->facility_followup->count()-1]['weight']==null)
                                                                <small class="label label-warning">weight Missing</small>
                                                            @else
                                                            <small class="label label-{{($child->facility_followup[$child->facility_followup->count()-2]['weight']>$child->facility_followup[$child->facility_followup->count()-1]['weight'])?'danger':'info' }}">
                                                                {{($child->facility_followup[$child->facility_followup->count()-2]['weight']>$child->facility_followup[$child->facility_followup->count()-1]['weight'])?'Weight Loss':'Weight Gain'}}</small>
                                                                @endif
                                                            @else
                                                            <small class="label label-success">New</small>
                                                        @endif
                                                    </td>
                                                    <td class="children-show">
                                                        @if(Auth::user()->category == 'community' || Auth::user()->category == 'both')
                                                            <a href="{{ route('community-followup.show', $child->sync_id) }}"
                                                               title="Community followup">
                                                                <button type="button"
                                                                        class="btn btn-default btn-registered">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </a>
                                                        @endif
                                                        @if(Auth::user()->category == 'facility' || Auth::user()->category == 'both')
                                                            {{--<a href="{{ route('facility-followup.show', $child->sync_id) }}"--}}
                                                            <a href="{{ route('children.show', $child->sync_id) }}"
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
