@extends('layouts.app')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        {{--<div class="row">--}}
            {{--<div class="col-lg-12">--}}
                <form action="{{ route('pregnant-women-followup.store') }}" method="post" id="followupform" class="form-horizontal">
                    @csrf
                    @method('POST')
                    @include('pregnant_women.partials.followup')
                        <button class="btn btn-primary" type="submit">Add</button>
                </form>
            {{--</div> <!-- col -->--}}
            {{----}}
        {{--</div> <!-- row -->--}}
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
        load_child()
    })

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


</script>

@endpush