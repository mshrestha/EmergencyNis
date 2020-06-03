@extends('monthly_mail.app_opendashboard')
@push('styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12 border-bottom">
            <div class="col-lg-9 ">
                <div class="col-lg-12 center">
                    <h1>Welcome to Emergency Nutrition System </h1>
                </div>
                <div class="col-lg-12">
                    This is a test PDF
                </div>
            </div>

            <div class="col-lg-3 ">
                <div class=" pull-right">
                    {{--<img src="./img/logo-nutrition.png" width="200px"/>--}}
                </div>
            </div>

        </div>
    </div>



@endsection

@push('scripts')
@endpush

