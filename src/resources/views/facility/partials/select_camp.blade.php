<option>Select Camp</option>

@if(!empty($camps))

    {{--@foreach($ips as $key => $value)--}}
        {{--<option value="{{ $key }}">{{ $value }}</option>--}}
    {{--@endforeach--}}
    @foreach($camps as $camp)
        <option value="{{ $camp->id }}" {{ (isset($facility) && $facility->camp_id == $camp->id) ? ' selected' : '' }}>{{ $camp->name }}</option>
    @endforeach


@endif