@extends('layouts.app')

@section('content')
<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-8">
            <div class="ibox">
                <div class="ibox-content">                    
                    <div class="clients-list">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Children</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i> Facilities</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="full-height-scroll">
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search child " class="input form-control">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-left: 0;">
                                            <div class="form-group">
                                                <a href="{{ route('children.create') }}">
                                                    <button type="button" class="form-control btn btn-danger">
                                                        <i class="fa fa-plus"></i> Register Children
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
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Child name</th>
                                                    <th>Date of birth</th>
                                                    <th>MNR no</th>
                                                    <th>Sex</th>
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
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="full-height-scroll">
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search facility " class="input form-control">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                                                </span>
                                            </div>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($facilities as $facility)
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-1" class="client-link">{{ $facility->facility_id }}</a></td>
                                                    <td>{{ $facility->camp->name }}</td>
                                                    <td><i class="fa fa-flag"></i> {{ $facility->implementing_partner }}</td>
                                                    <td><i class="fa fa-flag"></i> {{ $facility->program_partner }}</td>
                                                    <td class="client-status"><span class="label label-warning">{{ $facility->service_type }}</span></td>
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
    <script>
        var first_child = {{ isset($children[0]) ? $children[0]->id : '' }}
        load_child(first_child);

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
    </script>
@endpush