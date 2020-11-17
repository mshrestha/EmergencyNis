<div class="ibox-title">
    <h2>Registered Children</h2>
    <div class="pull-right "
         style="display: inline; top: 0; right: 0; position:absolute; padding-top: 15px; padding-right: 30px">

        <a href="{{ route('register') }}">
            <button type="button" class="btn btn-outline-info"><i
                        class="fa fa-user"></i>
                All
            </button>
        </a>
        <a href="{{ route('defaulter_child') }}">
            <button type="button" class="btn btn-primary"><i
                        class="fa fa-user"></i>
                Scheduled Absent
            </button>
        </a>
        <a href="{{ route('sam_child') }}">
            <button type="button" class="btn btn-danger"><i
                        class="fa fa-user"></i>
                OTP
            </button>
        </a>
        <a href="{{ route('mam_child') }}">
            <button type="button" class="btn btn-warning"><i
                        class="fa fa-user"></i>
                TSFP
            </button>
        </a>
        <a href="{{ route('normal_child') }}">
            <button type="button" class="btn btn-info"><i
                        class="fa fa-user"></i>
                BSFP
            </button>
        </a>
        <div class="btn-group ">
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

        <a href="{{ route('children.create') }}">
            <button type="button" class="btn btn-primary"><i
                        class="fa fa-plus"></i>
                Add Child
            </button>
        </a>
    </div>
    <span class="small">All child needs to be registered in order to use this system.</span>
</div>
