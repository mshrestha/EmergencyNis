@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <ul class="nav nav-tabs ens-register-tabs">
            <li class=""><a href="{{ route('register') }}"> Child Register</a></li>
            <li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="false">Pregnant Woman Register</a></li>
        </ul>
        <div class="row">
            <div class="col-sm-8 tab-content">
                <div class="ibox tab-pane" id="tab-1">
                </div>
                <!--This is where Pregnant woman register starts -->
                <div class="ibox tab-pane active" id="tab-2">
                    <div class="ibox-title">
                        <h2>Pregnant And Lactating Women
                            <a href="{{ route('pregnant-women.create') }}" class="pull-right">
                                <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>
                                    Register
                                </button>
                            </a>
                        </h2>
                        <span class="small">List of Pregnant and Lactating Women</span>
                    </div>
                    <div class="ibox-content">
                        <div class="clients-list">
                            <div class="full-height-scroll">
                                <div class="table-responsive">
                                    <table class="table dataTables table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Woman name</th>
                                                <th>Facility</th>
                                                <th>Follow up</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pregnant_womens as $pregnant_women)
                                            <tr class="pregnant-women-client" data-pregnant-women-id="{{ $pregnant_women->sync_id }}">
                                                <td>{{ $pregnant_women->id }}</td>
                                                <td>{{ $pregnant_women->pregnant_women_name }}</td>
                                                <td>{{ $pregnant_women->facility->facility_id }}</td>
                                                <td>
                                                    <a href="{{ route('pregnant-women-followup.show', $pregnant_women->sync_id) }}"class="edit-btn">
                                                     <button class="btn btn-default btn-circle" type="button"><i
                                                        class="fa fa-plus"></i></button>
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
            </div>
            <div class="col-sm-4">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="tab-content">
                            <div id="contact-1" class="tab-pane active">
                                <div id="pregnant-women-info">

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

    $(document).ready(function () {
        var first_pregnant_women = {{ isset($pregnant_womens[0]) ? $pregnant_womens[0]->sync_id : '' }}
        $('#pregnant-women-info').html('Loading ...');
        load_pregnant_women(first_pregnant_women);
        
        $('.dataTables').DataTable({
            "aaSorting": [],
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgtpi',
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

    function load_pregnant_women(pregnant_women) {
        $.ajax({
            url: '/pregnant-women/'+pregnant_women+'/info',
            type: 'get',
            success: function (res) {
                $('#pregnant-women-info').html(res);
            }
        });
    }

    $('.pregnant-women-client').on('click', function () {
        var pregnant_women = $(this).data('pregnant-women-id');
        $('#pregnant-women-info').html('Loading ...');
        load_pregnant_women(pregnant_women);
    });
</script>

@endpush