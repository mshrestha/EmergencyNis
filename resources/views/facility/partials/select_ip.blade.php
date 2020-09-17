<option>Select Implementing Partner</option>

@if(!empty($ips))

    {{--@foreach($ips as $key => $value)--}}
        {{--<option value="{{ $key }}">{{ $value }}</option>--}}
    {{--@endforeach--}}
    @foreach($ips as $ip)
        <option value="{{ $ip->id }}" {{ (isset($facility) && $facility->ip_id == $ip->id) ? ' selected' : '' }}>{{ $ip->name }}</option>
    @endforeach


@endif