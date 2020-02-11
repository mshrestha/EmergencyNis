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



<script>
    {{--Autometic Z-Score calculation--}}
    $(document).ready(function() {
        $('#child_weight').keyup(function() {
            recalc();
        });
        $('#child_height').keyup(function() {
            recalc();
        });
        function recalc() {
            var child_weight = $("#child_weight").val();
            var child_height = $("#child_height").val();
            console.log(child_weight)
            var abase_url = '{{url('/')}}';
            var url = abase_url + '/wfh_calculation';
            var sendData = {
                childHeight: child_height,
                childWeight: child_weight,
                childSex: child_sex,
                _token: $("input[name='_token']").val()
            };
            $.get(url, sendData, function (data) {
                $("#zscore").val(data.zscore);
            }, 'json')
        }
    });




</script>


@endpush
