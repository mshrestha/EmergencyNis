<option>Select Program Partner</option>

@if(!empty($pps))

    {{--@foreach($ips as $key => $value)--}}
        {{--<option value="{{ $key }}">{{ $value }}</option>--}}
    {{--@endforeach--}}
    @foreach($pps as $pp)
        <option value="{{ $pp->id }}" {{ (isset($facility) && $facility->pp_id == $pp->id) ? ' selected' : '' }}>{{ $pp->name }}</option>
    @endforeach


@endif