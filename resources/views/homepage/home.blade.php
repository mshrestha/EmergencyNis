@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Monthly</span>
                                <h5>Admissions</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">376</h1>
                                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                <small>children</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Normal</span>
                                <h5>Cure Rate</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">96%</h1>
                                <div class="stat-percent font-bold text-info">2% <i class="fa fa-level-up"></i></div>
                                <small>August</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Low</span>
                                <h5>Death Rate</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">1%</h1>
                                <div class="stat-percent font-bold text-danger">0.5% <i class="fa fa-level-down"></i></div>
                                <small>August</small>
                            </div>
                        </div>
                    </div>
            
        
        <!--Second Line -->
        
        <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">High</span>
                                <h5>Default Rate</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">2%</h1>
                                <div class="stat-percent font-bold text-success">0.5% <i class="fa fa-bolt"></i></div>
                                <small>August</small>
                            </div>
                        </div>
                    </div>
        <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">High</span>
                                <h5>Non Respondent Rate</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">1%</h1>
                                <div class="stat-percent font-bold text-success">0.5% <i class="fa fa-bolt"></i></div>
                                <small>August</small>
                            </div>
                        </div>
                    </div>
        <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Low</span>
                                <h5>Average Weight at dismissal</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">6.2</h1>
                                <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                                <small>Kgs</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">August</span>
                                <h5>Average Length of Stay</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">7.38</h1>
                                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                                <small>weeks</small>
                            </div>
                        </div>
                    </div>
                    
                    
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Average Weight Gain (Kgs)</h5>
                        <div class="ibox-tools">
                            
                        </div>
                    </div>
                    <div class="ibox-content no-padding">
                        <div class="flot-chart m-t-lg" style="height: 55px;">
                            <div class="flot-chart-content" id="flot-chart1" style="padding: 0px; position: relative;"><canvas class="flot-base" width="713" height="110" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 356.656px; height: 55px;"></canvas><canvas class="flot-overlay" width="713" height="110" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 356.656px; height: 55px;"></canvas></div>
                        </div>
                    </div>

                </div>
            </div>
        
        <!-- End of Consoles -->
        </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="ibox">
                <div class="ibox-content">                    
                    <div class="clients-list">
                        <ul class="nav nav-tabs">
                            <li class="{{ request()->get('tab') !== 'facility' ? ' active' : '' }}"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Children</a></li>
                            <li class="{{ request()->get('tab') == 'facility' ? ' active' : '' }}"><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i> Facilities</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane {{ request()->get('tab') !== 'facility' ? ' active' : '' }}">
                                <div class="full-height-scroll">
                                    <div class="row" style="margin-top: 15px;">
                                        
                                        <div class="col-md-3 pull-right">
                                            <div class="form-group">
                                                <a href="{{ route('children.create') }}">
                                                    <button type="button" class="btn btn-primary btn-sm btn-block pull-right">
                                                        <i class="fa fa-plus"></i> Register New Child
                                                    </button>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                    <h2>Child</h2>
                                    <p>
                                        All child needs to be registered in order to use this system.
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table dataTables table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Child name</th>
                                                    <th>Date of birth</th>
                                                    <th>MNR no</th>
                                                    <th>Sex</th>
                                                    <th width="100">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($children as $child)
                                                <tr class="children-client" data-child-id="{{ $child->id }}">
                                                    <td class="client-avatar"><img alt="image" src="{{ $child->child_image() }}"></td>
                                                    <td><a href="#child-{{ $child->id }}" class="client-link">{{ $child->children_name }}</a></td>
                                                    <td>{{ $child->date_of_birth }}</td>
                                                    <td>{{ $child->mnr_no }}</td>
                                                    <td>{{ $child->sex }}</td>
                                                    <td>
                                                        <a href="{{ route('children.edit', $child->id) }}" class="edit-btn">
                                                            <button class="btn btn-info btn-circle" type="button"><i class="fa fa-pencil"></i></button>
                                                        </a> 
                                                        
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane {{ request()->get('tab') == 'facility' ? ' active' : '' }}">
                                <div class="full-height-scroll">
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <form action="{{ route('facility-search') }}">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" placeholder="Search facility (Facility ID)" name="q" class="input form-control" value="{{ request()->get('tab') == 'facility' ? request()->get('q') : '' }}">
                                                    <input type="hidden" name="tab" value="facility">
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-3" style="padding-left: 0;">
                                            <div class="form-group">
                                                <a href="{{ route('facility.create') }}">
                                                    <button type="button" class="form-control btn btn-danger">
                                                        <i class="fa fa-plus"></i> Register Facility
                                                    </button>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Facility ID</th>
                                                    <th>Camp</th>
                                                    <th>Implementing Partner</th>
                                                    <th>Program Partner</th>
                                                    <th>Service Type</th>
                                                    <th width="100">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($facilities as $facility)
                                                <tr class="facility-client" data-facility-id={{ $facility->id }}>
                                                    <td><a class="client-link">{{ $facility->facility_id }}</a></td>
                                                    <td>{{ $facility->camp->name }}</td>
                                                    <td><i class="fa fa-flag"></i> {{ $facility->implementing_partner }}</td>
                                                    <td><i class="fa fa-flag"></i> {{ $facility->program_partner }}</td>
                                                    <td class="client-status"><span class="label label-warning">{{ $facility->service_type }}</span></td>
                                                    <td>
                                                        <a href="{{ route('facility.edit', $facility->id) }}" class="edit-btn">
                                                        
                                                        <button class="btn btn-info btn-circle" type="button"><i class="fa fa-pencil"></i></button>
                                                        </a>
                                                        <form action="{{ route('facility.destroy', $facility->id) }}" method="post" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            
                                                            <button  class="btn btn-danger btn-circle" type="button" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></button>
                                                        </form>
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
        <div class="col-sm-4">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div id="child-info">
                                Loading ...
                            </div>
                        </div> <!-- tab-pane -->
                    </div> <!-- tab-content -->
                </div> <!-- ibox-content -->
            </div> <!-- ibox -->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- wrapper -->
@endsection

@push('scripts')
 <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="js/plugins/flot/curvedLines.js"></script>
    
    <script src="js/plugins/dataTables/datatables.min.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>
<script>
    
    $(document).ready(function() {
        var first_child = {{ isset($children[0]) ? $children[0]->id : '' }}
        load_child(first_child);
    var d1 = [[1262304000000, 30000], [1264982400000, 30057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 29302], [1280620800000, 34237], [1283299200000, 41004], [1285891200000, 51044], [1288569600000, 55577], [1291161600000, 59295]];
           
            var data1 = [
                { label: "Avg. Weight Gain", data: d1, color: '#17a084'},
              
            ];
            $.plot($("#flot-chart1"), data1, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        },
                    },
                    points: {
                        width: 0.1,
                        show: false
                    },
                },
                grid: {
                    show: false,
                    borderWidth: 1
                },
                legend: {
                    show: false,
                }
            });

           

 $('.dataTables').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'RegisteredChildren'},
                    {extend: 'pdf', title: 'RegisteredChildren'},

                    {extend: 'print',
                     customize: function (win){
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

    function load_child(child) {
        $.ajax({
            url: '/child-info/'+ child,
            type: 'get',
            success: function(res) {
                $('#child-info').html(res);
            }
        });
    }

    $('.children-client').on('click', function() {
        var child = $(this).data('child-id');
        $('#child-info').html('Loading ...');

        load_child(child);
    });

    function load_facility(facility) {
        $.ajax({
            url: '/facility-info/'+ facility,
            type: 'get',
            success: function(res) {
                $('#child-info').html(res);
            }
        })
    }

    $('.facility-client').on('click', function() {
        var facility = $(this).data('facility-id');

        $('#child-info').html('Loading ...');
        load_facility(facility);
    });
</script>
@endpush