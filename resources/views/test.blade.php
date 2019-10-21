@extends('layouts.app')
@section('content')

    <select name="cases" id="cases">
        <option value="general">General Inquiry</option>
        <option value="credit">Credit Inquiry</option>
        <option value="payment">Payment Issue</option>
    </select><br>
    <label for="email">Email Address <span>*</span></label>
    <input type="text">
    <label for="full name">Full Name <span>*</span></label>
    <input type="text">


    <div class="general" id="general">
        <label for="documents">Wish to submit any requested documents?</label>
        <input type="radio" name="radio">Yes
        <input type="radio" name="radio">No <br><br>
        <label for="select">How did you find out about us?<span>*</span></label><br>
        <select name="case" id="case-type">
            <option value="value1">Value 1</option>
            <option value="value2">Value 2</option>
            <option value="value3">Value 3</option>
        </select><br>
    </div>

    <div class="credit" id="credit">
        <label for="Date of Inquiry">Date of Inquiry<span>*</span></label>
        <input type="date">
        <label for="Agency">Agency 3 <span>*</span></label>
        <input type="text">
    </div>

    <div class="payment" id="payment">
        <label for="Service Phone Number">Service Phone Number<span>*</span></label>
        <input type="text">
        <label for="select">Topic<span>*</span></label><br>
        <select name="case" id="case-type">
            <option value="topic1">Topic 1</option>
            <option value="topic2">Topic 2</option>
            <option value="topic3">Topic 3</option>
        </select><br><br>
    </div>
    <br><br>
    <button>Submit</button>
@endsection

@section('scripts')
    {{--<script>src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"</script>--}}
    <script>
        $('div').hide()

        $('#role').change(function () {
            var value = this.value;
            $('div').hide()
            $('#' + this.value).show();
        });

    </script>
@endsection
