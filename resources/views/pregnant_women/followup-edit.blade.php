@extends('layouts.app')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('pregnant-women-followup.update', $pregnant_followup->sync_id) }}" method="post" id="followupform">
                    @csrf
                    @method('PATCH')
                    @include('pregnant_women.partials.followup')

                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div> <!-- col -->
            
        </div> <!-- row -->
    </div> <!-- wrapper -->
@endsection

@push('scripts')

<script src="{{ asset('js/plugins/steps/jquery.steps.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $("#wizard").steps({
            onFinished: function (event, currentIndex) {
                $('#followupform').submit();
            }
        });
    })
</script>
@endpush