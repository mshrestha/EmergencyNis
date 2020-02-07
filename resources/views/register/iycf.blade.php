@extends('layouts.app')
@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">

            <div class="row">
                <div class="col-sm-8 tab-content">
                    <div class="ibox tab-pane active" id="tab-1">
                        <div class="ibox-title">
                            <h2>
                                Registered Children
                                <a href="{{ route('children.create') }}" class="pull-right">
                                    <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                                class="fa fa-plus"></i>
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
                                                <th>MNR</th>
                                                <th>Child name</th>
                                                <th>Mother</th>
                                                <th>Father</th>
                                                <th>Block HH-no</th>
                                                <th>Facility</th>

                                                <th>Follow up</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($children as $child)
                                                <tr class="children-client" data-child-id="{{ $child->sync_id }}">
                                                    <td>{{ $child->sync_id }}</td>
                                                    <td>{{ $child->mnr_no }}</td>
                                                    <td><a href="#child-{{ $child->sync_id }}"
                                                           class="client-link">{{ $child->children_name }}</a></td>
                                                    <td>{{ $child->mother_caregiver_name }}</td>
                                                    <td>{{ $child->fathers_name }}</td>
                                                    <td>{{ $child->sub_block_no }} {{ $child->hh_no }}</td>
                                                    <td>{{ $child->facility['implementing_partner'] }}  {{ $child->facility['service_type'] }} </td>

                                                    <td>
                                                        <a href="{{ route('iycf-followup.show', $child->sync_id) }}"
                                                           class="edit-btn" title="IYCF Followup">
                                                            <button class="btn btn-default  btn-registered"
                                                                    type="button">
                                                                Add Session
                                                            </button>
                                                        </a>

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
                    <!--This is where Pregnant woman register starts -->

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
            </div>
        </div>
    </div> <!-- row -->
@endsection


@push('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{!! asset('js/plugins/moment.min.js')!!}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<script>
    $('#child-info').html('Loading ...');
    $(document).ready(function () {
        var first_child = {{ isset($children[0]) ? $children[0]->sync_id : '' }}
        load_child(first_child);

        $('.dataTables').DataTable({
            "aaSorting": [],
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

    // $(document).ready(function () {
    //     $(function() {
    //         var hash = window.location.hash;
    //         url = hash; // do some validation on the hash here

    //         switch (hash) {
    //             case 'child':
    //             url = 'tab-1';
    //             break;
    //             case 'pregnant-woman':
    //             url = 'tab-2';
    //             break;
    //             default:
    //             url = 'tab-1';
    //         }

    //         hash && $('ul.nav a[href="' + hash + '"]').tab('show');
    //     });
    // });
</script>
@endpush
