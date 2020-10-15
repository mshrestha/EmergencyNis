@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
<link href="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Children registration</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ route('children.store') }}" class="form-horizontal" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @include('children.partials.fields')
                            <div class="row">
                              <button class="btn btn-primary ">Register</button>
                            </div>
                        </form>
                    </div> <!-- ibox-content -->
                </div> <!-- ibox -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- wrapper -->
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/switchery/switchery.js')}}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>
<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script>
    $(document).ready(function () {
        navigator.geolocation.getCurrentPosition(success, error, options);
    });

    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };

    function success(pos) {
        var crd = pos.coords;


        $('#currentLongitude').val(crd.longitude);
        $('#currentLatitude').val(crd.latitude);

    }

    function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
    }


</script>
<script src="{{ asset('custom/bootstrap_datetime_picker/datetimepicker4.17.47.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepickerRegistration').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });
    $(function () {
        $('#datetimepickerDob').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });
</script>
@endpush
