@if(Session::has('notify_message'))
    <div class="alert alert-custom alert-{{ Session::get('notify_type') }}">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ Session::get('notify_message') }}</span>
    </div>
@endif
