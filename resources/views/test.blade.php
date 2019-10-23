@extends('layouts.app')
@section('content')


    <select id='purpose'>
        <option value="0">Personal use</option>
        <option value="1">Business use</option>
        <option value="2">Passing on to a client</option>
    </select>
    <div style='display:none;' id='business'>Business Name<br/>&nbsp;
        <br/>&nbsp;
        <input type='text' class='text' name='business' value size='20' />
        <br/>
    </div>
@endsection

@push('scripts')
    {{--<script>src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"</script>--}}
    <script>
        $(document).ready(function(){
            $('#purpose').on('change', function() {
                if ( this.value == '1')
                {
                    $("#business").show();
                }
                else
                {
                    $("#business").hide();
                }
            });
        });
    </script>
@endpush
