@extends('layouts.app')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('facility-followup.save', $children->id) }}" method="post" id="followupform">
                    @csrf
                    @method('POST')
                    @include('facility_followup.partials.fields')

                </form>
            </div> <!-- col -->
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="tab-content">
                            <div id="contact-1" class="tab-pane active">
                                <div id="child-info">
                                    Loading ...
                                </div>
                            </div> <!-- tab-pane -->
                        </div> <!-- tab-content -->
                    </div> <!-- ibox-content -->
                </div> <!-- ibox -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- wrapper -->
@endsection

@push('scripts')

<script src="{{ asset('js/plugins/steps/jquery.steps.min.js')}}"></script>
<script src="{{ asset('js/plugins/chartJs/Chart.min.js')}}"></script>


<script>
    $(document).ready(function () {
        $("#wizard").steps({
            onFinished: function (event, currentIndex) {
                $('#followupform').submit();
            }
        });
        load_child({{$children->sync_id}})
        $("#discharge-criteria-tab").hide();
        $( "#identification-outcome" ).change(function() {
            if($("#identification-outcome").val() == 'New case'){
              $("#admission-criteria-tab").show();
              $("#discharge-criteria-tab").hide();
            }else{
              $("#admission-criteria-tab").hide();
              $("#discharge-criteria-tab").show();
            }
    });
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



{{--Autometic Z-Score calculation--}}
<script>
    $(document).on('change', '.child_height', function () {
        var child_weight = document.getElementById('child_weight').value;
//        console.log(child_weight);
        var child_sex = JSON.parse('<?php echo json_encode($child_sex); ?>');
//        console.log(child_sex);
        var child_height = $(this).val();
//        console.log(child_height)
        var $this = $(this);
        var abase_url = '{{url('/')}}';
        var url = abase_url + '/wfh_calculation';
        var sendData = {
            childHeight: child_height,
            childWeight: child_weight,
            childSex: child_sex,
        _token: $("input[name='_token']").val()
        };
        $.get(url, sendData, function (data) {
            console.log(data)
            $("#zscore").val(data.zscore);
        }, 'json')
    });

</script>


@endpush
