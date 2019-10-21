@extends('layouts.app')

@section('content')

    <h2></h2>

    <div class="row">
        <div class="col-sm-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h2>Registered Children
                        <a href="{{ route('children.create') }}" class="pull-right">
                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>
                                Add Child
                            </button>
                        </a>


                    </h2>
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
                                        <th>Child name</th>

                                        <th>Sex</th>
                                        <th>Facility</th>
                                        <th>Status</th>
                                        <th>Follow up</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($children as $child)
                                        <tr class="children-client" data-child-id="{{ $child->sync_id }}">
                                            <td>{{ $child->mnr_no }}</td>
                                            <td><a href="#child-{{ $child->sync_id }}"
                                                   class="client-link">{{ $child->children_name }}</a></td>


                                            <td>{{ $child->sex }}</td>
                                            <td>{{ $child->facility['implementing_partner'] }}  {{ $child->facility['service_type'] }} </td>
                                            <td>
                                                @if (isset($child->facility_followup[$child->facility_followup->count()-1]['nutritionstatus']))
                                                    <small class="label label-{{(($child->facility_followup[$child->facility_followup->count()-1]['nutritionstatus']=='SAM') ? 'danger' : (($child->facility_followup[$child->facility_followup->count()-1]['nutritionstatus']=='MAM') ? 'warning' :'info')) }}">{{ $child->facility_followup[$child->facility_followup->count()-1]['nutritionstatus'] }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('iycf-followup.show', $child->sync_id) }}" class="edit-btn">
                                                    <button class="btn btn-default btn-circle" type="button">
                                                        IYCF<i class="fa fa-plus"></i>
                                                    </button>
                                                </a>
                                                @if(Auth::user()->category == 'community' || Auth::user()->category == 'both')
                                                    <a href="{{ route('community-followup.show', $child->sync_id) }}">
                                                        <button type="button" class="btn btn-default btn-circle">
                                                            <i class="fa fa-child"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                                @if(Auth::user()->category == 'facility' || Auth::user()->category == 'both')
                                                    <a href="{{ route('facility-followup.show', $child->sync_id) }}"
                                                       class="edit-btn">
                                                        <button class="btn btn-default btn-circle" type="button"><i
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
        <div class="col-sm-4">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div id="child-info">

                            </div>
                        </div> <!-- tab-pane -->
                    </div> <!-- tab-content -->
                </div> <!-- ibox-content -->
            </div> <!-- ibox -->
            <canvas id="myChart" width="400" height="400"></canvas>

        </div> <!-- col -->
    </div> <!-- row -->

@endsection

@push('scripts')


<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.bundle.min.js"></script>--}}
<script src="{!! asset('js/plugins/moment.min.js')!!}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>




<script>

    $(document).ready(function () {
        var first_child = {{ isset($children[0]) ? $children[0]->id : '' }}
            //load_child(first_child);


            $('.dataTables').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
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

    var abase_url = '{{url('/')}}';

    function load_child(child) {
        $.ajax({
            url: abase_url + '/child-info/' + child,
            type: 'get',
            success: function (res) {
                $('#child-info').html(res);
            }
        });
    }

    $('.children-client').on('click', function () {
        var child = $(this).data('child-id');
        $('#child-info').html('Loading ...');
        load_child(child);
    });


</script>

@endpush