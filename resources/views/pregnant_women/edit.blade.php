@extends('layouts.app')
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