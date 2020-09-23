@extends('layouts.app')
@push('styles')
<link href="{{ asset('custom/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>
@endpush
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
    <form action="{{ route('pregnant-women.update', $pregnant_women->sync_id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        
        @include('pregnant_women.partials.fields')
        <div class="m-b-lg">
            <button class="btn btn-primary" type="submit">Register</button>
        </div>
    </form>
</div> <!-- wrapper -->
@endsection
@push('scripts')


<script src="{{ asset('custom/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endpush