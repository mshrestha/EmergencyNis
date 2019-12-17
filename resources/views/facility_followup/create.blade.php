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
    var ctx = document.getElementById('childWeight').getContext('2d');
    var jsArrayweight = JSON.parse('<?php echo json_encode($chart_weight); ?>');
    var jsArraydate = JSON.parse('<?php echo json_encode($chart_date); ?>');

    var childWeight = new Chart(ctx, {
        type: 'line',
        data: {
            labels: jsArraydate,
            datasets: [{
                label: 'Child Weight Gain',
                fill: false,
                data: jsArrayweight,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',

            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }],

            }
        }
    });



</script>

@endpush