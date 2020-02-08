<div class="row m-b-lg">
    <div class="col-lg-4 text-center">
        <div>
            <img alt="image" src="{{ $child->child_image() }}"
            style="width: 100%;height: 110px;object-fit:cover;">
        </div>

    </div>
    <div class="col-lg-8">
        <strong>{{ $child->children_name }}</strong>
        <p>
            ID: {{ $child->sync_id}}<br />
            MNR: {{ $child->mnr_no}}<br />
            {{ $child->age }} months old<br />
            {{ $child->facility['implementing_partner'] }}  {{ $child->facility['service_type'] }}<br/>
            Block {{ $child->sub_block_no }}, Household {{ $child->hh_no }} <br />

        </p>
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('children.edit', $child->sync_id) }}" class="edit-btn">
                    <button class="btn btn-info btn-circle" type="button"><i class="fa fa-pencil"></i></button>
                </a>
                <form action="{{ route('children.destroy', $child->sync_id) }}" method="post" class="delete-form">
                    @csrf
                    @method('DELETE')

                    <button  class="btn btn-danger btn-circle" type="submit" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button id='zoombtn' class='btn btn-info pull-right'>
            GMP-Weight <i class="fa fa-bar-chart"></i>
        </button>

        <canvas  class="hidden" id="gmpChart" width="500" height="300"></canvas>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <canvas id="childWeight" width="500" height="300"></canvas>

    </div>
</div>
<div class="client-detail">
    <div class="full-height-scroll">
            <div id="followup-1" class="tab-pane active">
                @if(count($followups))
                <div style="margin-top: 10px;">

                    <strong>Nutrition Report</strong>
                    @if(isset($followups[0]['medical_history_diarrhoea']))
                    <ul class="list-group clear-list">
                        @if(isset($followups[0]['facility_id']))
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_diarrhoea'] }} </span>
                            Dirrhoea (no of days)
                        </li>
                        @endif
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_vomiting'] }} </span>
                            Vomiting (no of days)
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_fever'] }} </span>
                            Fever (no of days)
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['medical_history_cough'] }} </span>
                            Cought (no of days)
                        </li>
                    </ul>
                    @else
                    <ul class="list-group clear-list">
                        @if (isset($followups[0]['exclusive_breastfeeding']))
                        <li class="list-group-item fist-item">
                            <span class="pull-right"> {{ $followups[0]['exclusive_breastfeeding'] ? 'Yes' : 'No' }} </span>
                            Exclusive Breastfeeding
                        </li>
                        @endif
                        @if (isset($followups[0]['received_all_epi_vaccination']))
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['received_all_epi_vaccination'] ? 'Yes' : 'No' }} </span>
                            Received all EPI
                        </li>
                        @endif
                        @if (isset($followups[0]['edema']))
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['edema'] ? 'Yes' : 'No' }} </span>
                            Edema
                        </li>
                        @endif
                        @if(isset($followups[0]['nutritionstatus']))
                        <li class="list-group-item">
                            <span class="pull-right"> {{ $followups[0]['nutritionstatus'] }} </span>
                            Nutritional Status
                        </li>
                        @endif
                    </ul>
                    @endif
                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                        @foreach($followups as $followup)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            @if(array_key_exists('nutritionstatus', $followup))
                            <div class="vertical-timeline-content">
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span><br />
                                <p>Visited {{ $followup['facility']['facility_id'] }}</p>

                                @if(isset($followup['muac']))
                                    <strong>MUAC: </strong> {{ $followup['muac'] }} cm <br />
                                @endif
                                @if(isset($followup['weight']))
                                    <strong>Weight: </strong> {{ $followup['weight'] }} kg <br />
                                @endif

                                @if(isset($followup['wfh_z_score']))
                                    <strong>Z-score: </strong> {{ $followup['wfh_z_score'] }} <br />
                                @endif


                                <span class="pull-right">
                                    <a href="{{ route('facility-followup.edit', $followup['sync_id']) }}">Edit</a>
                                </span>
                                
                                <form action="{{ route('facility-followup.destroy', $followup['sync_id']) }}" method="post" class="delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button  class="btn btn-danger btn-circle" type="submit" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                            @elseif(array_key_exists('deworming', $followup))
                            <div class="vertical-timeline-content">
                                <p>Visited facility for Followup</p>
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span>
                                <span class="pull-right">
                                <a href="{{ route('community-followup.edit', $followup['id']) }}">Edit</a>
                                </span>
                            </div>
                            @elseif(array_key_exists('psycho_social_support', $followup))
                            <div class="vertical-timeline-content">
                                <p>Visited  IYCF Followup</p>
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span>
                                <span class="pull-right">
                                <a href="{{ route('iycf-followup.edit', $followup['sync_id']) }}">Edit</a>
                                </span>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif


            </div>


    </div>
</div>
<div class=" text-center" onclick="printDiv('qrcode')" id="qrcode">
   {!! QrCode::size(200)->generate(route('facility-followup.show', $child->id)) !!}
</div>

<div id="myModal" class="modal" >
    <div class="modalContent" style="height: 85%; width: 85%; margin:0 auto;">
        <span class="close"> &times; </span>
        <canvas id="gmpChartModal"></canvas>
    </div>
</div>

{{--<div id="myModal" class="modal" >--}}
{{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
        {{--<h4 class="modal-title">CanvasJS Chart within Bootstrap Modal</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
        {{--<div id="myModal" style="height: 360px; width: 100%;">--}}
            {{--<canvas id="gmpChartModal"></canvas>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--</div>--}}


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

<script>
    var ctx = document.getElementById('gmpChart').getContext('2d');
    var actual_weight = JSON.parse('<?php echo json_encode($gmp_chart_weight['weight']); ?>');
    var child_sex = JSON.parse('<?php echo json_encode($gmp_chart_weight['sex']); ?>');
    var child_info = JSON.parse('<?php echo json_encode($gmp_chart_weight['child_info']); ?>');
    //    console.log(child_sex);
    if (child_sex =='male') {
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60'],
                datasets: [
                    {
                        label: 'Child Weight',
                        data: actual_weight,
                        backgroundColor: ['rgba(255, 99, 132, 1)'],
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 2,
                        fill: false,
                    },
                    {
                        label: '-3Z',
                        data: [2, 3, 3.9, 4.5, 5, 5.3, 5.6, 6, 6.2, 6.5, 6.6, 6.8, 7, 7.1, 7.25, 7.4, 7.6, 7.75, 7.8, 8, 8.2, 8.25, 8.4, 8.5, 8.6,
                            8.8, 8.9, 9, 9.1, 9.25, 9.4, 9.5, 9.6, 9.75, 9.8, 9.9, 10, 10.1, 10.25, 10.35, 10.4, 10.5, 10.6, 10.75, 10.8, 10.9, 11, 11.15, 11.25, 11.3, 11.4, 11.5, 11.6, 11.75, 11.8, 11.9, 12, 12.1, 12.25, 12.4, 12.5],
                        backgroundColor: [
                            'rgba(230, 126, 34, .5)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, .2)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '-2Z',
                        data: [2.5, 3.5, 4.4, 5, 5.6, 6, 6.4, 6.6, 7, 7.2, 7.4, 7.6, 7.75, 8, 8.1, 8.4, 8.5, 8.6, 8.8, 9, 9.1, 9.25, 9.4, 9.5, 9.75,
                            9.9, 10, 10.1, 10.25, 10.4, 10.5, 10.6, 10.75, 10.9, 11, 11.1, 11.25, 11.4, 11.5, 11.6, 11.75, 11.9, 12, 12.1, 12.25, 12.4, 12.5, 12.6, 12.75, 12.9, 13, 13.1, 13.2, 13.3, 13.4, 13.5, 13.6, 13.7, 13.8, 13.9, 14],
                        backgroundColor: [
                            'rgba(255, 255, 126, 1)',
                        ],
                        borderColor: [
//                        'rgba(255, 206, 86, .2)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '-1Z',
                        data: [3, 4, 5, 5.75, 6.25, 6.75, 7.2, 7.5, 7.75, 8, 8.25, 8.5, 8.75, 8.9, 9, 9.2, 9.4, 9.6, 9.8, 10, 10.1, 10.35, 10.5, 10.7, 10.8,
                            11, 11.2, 11.3, 11.5, 11.7, 11.8, 12, 12.1, 12.3, 12.4, 12.5, 12.75, 12.9, 13, 13.1, 13.25, 13.4, 13.5, 13.6, 13.75, 13.85, 14, 14.1, 14.3, 14.4, 14.5, 14.6, 14.8, 15, 15.1, 15.25, 15.4, 15.6, 15.75, 15.9, 16],
                        backgroundColor: [
                            'rgba(240, 255, 0, 1)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, .2)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Medium',
                        data: [3.5, 4.5, 5.5, 6.5, 7, 7.5, 8, 8.25, 8.6, 9, 9.25, 9.5, 9.75, 10, 10.25, 10.4, 10.6, 10.75, 11, 11.25, 11.4, 11.6, 11.8, 12, 12.25,
                            12.4, 12.5, 12.7, 12.9, 13.1, 13.3, 13.5, 13.7, 13.9, 14, 14.2, 14.4, 14.5, 14.7, 14.9, 15, 15.2, 15.4, 15.5, 15.6, 15.8, 16, 16.25, 16.4, 16.5, 16.6, 16.8, 17, 17.25, 17.4, 17.5, 17.65, 17.8, 18, 18.25, 18.4],
                        backgroundColor: [
                            'rgba(77, 175, 124, .5)',
                        ],
                        borderColor: [
//                        'rgba(153, 102, 255, .2)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+1Z',
                        data: [4, 5.25, 6.4, 7.25, 7.9, 8.4, 8.9, 9.25, 9.6, 10, 10.25, 10.5, 10.8, 11.1, 11.4, 11.5, 11.75, 12, 12.25, 12.5, 12.75, 13, 13.25, 13.5, 13.75,
                            13.9, 14.1, 14.3, 14.5, 14.75, 15, 15.25, 15.4, 15.6, 15.8, 16, 16.2, 16.4, 16.6, 16.75, 17, 17.25, 17.4, 17.6, 17.75, 18, 18.25, 18.4, 18.6, 18.9, 19, 19.25, 19.4, 19.6, 19.9, 20, 20.25, 20.4, 20.6, 20.8, 21],
                        backgroundColor: [
                            'rgba(77, 175, 124, .8)'
                        ],
                        borderColor: [
//                        'rgba(255, 159, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+2Z',
                        data: [4.5, 6, 7, 8, 8.75, 9.25, 9.75, 10.4, 10.75, 11, 11.4, 11.75, 12, 12.3, 12.6, 12.8, 13.1, 13.4, 13.75, 14, 14.25, 14.5, 14.75, 15, 15.25,
                            15.5, 15.75, 16, 16.25, 16.5, 16.8, 17, 17.4, 17.6, 17.8, 18.1, 18.25, 18.5, 18.75, 19, 19.25, 19.5, 19.75, 20, 20.25, 20.5, 20.75, 21, 21.25, 21.4, 21.6, 22, 22.25, 22.4, 22.6, 22.9, 23.1, 23.4, 23.6, 23.9, 24.25],
                        backgroundColor: [
                            'rgba(77, 175, 124, 1)'
                        ],
                        borderColor: [
                            'rgba(155, 159, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+3Z',
                        data: [5, 6.5, 8, 9, 10, 10.5, 11, 11.5, 12, 12.5, 12.75, 13, 13.25, 13.5, 14, 14.25, 14.5, 15, 15.25, 15.5, 15.75, 16.25, 16.5, 16.75, 17,
                            17.5, 17.75, 18, 18.4, 18.7, 19, 19.25, 19.5, 19.75, 20, 20.4, 20.6, 21, 21.25, 21.25, 21.5, 21.75, 22, 22.75, 23, 23.25, 23.5, 23.9, 24.2, 24.5, 24.9, 25.1, 25.4, 25.6, 26, 26.3, 26.5, 27, 27.25, 27.5, 28],
                        backgroundColor: [
                            'rgba(236, 236, 236, .5)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    }]
            },

            options: {
                responsive: true,

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    point: {
                        radius: 1
                    }
                }
            }
        });
    }else {
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '00'],
                datasets: [
                    {
                        label: 'Child Weight',
                        data: actual_weight,
                        backgroundColor: ['rgba(255, 99, 132, 1)'],
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 2,
                        fill: false,
                    },{
                        label: '-3Z',
                        data: [2, 2.6, 3.4, 4, 4.4, 4.8, 5.1, 5.4, 5.6, 5.8, 6, 6.1, 6.25, 6.5, 6.6, 6.8, 6.9, 7, 7.2, 7.4, 7.5, 7.6, 7.8, 8, 8.1,
                            8.2, 8.4, 8.5, 8.6, 8.8, 8.9, 9, 9.2, 9.3, 9.4, 9.5, 9.6, 9.7, 9.9, 10, 10.1, 10.25, 10.4, 10.5, 10.6, 10.7, 10.8, 10.9, 11, 11.1, 11.2, 11.3, 11.4, 11.45, 11.5, 11.6, 11.7, 11.8, 11.9, 12, 12.1],
                        backgroundColor: [
                            'rgba(230, 126, 34, .5)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '-2Z',
                        data: [2.5, 3.2, 3.9, 4.5, 5, 5.4, 5.6, 6, 6.4, 6.5, 6.8, 6.9, 7, 7.2, 7.4, 7.6, 7.8, 8, 8.1, 8.3, 8.5, 8.6, 8.8, 8.9, 9,
                            9.2, 9.4, 9.5, 9.6, 9.9, 10, 10.1, 10.4, 10.5, 10.6, 10.7, 10.8, 11, 11.1, 11.2, 11.4, 11.5, 11.6, 11.8, 11.9, 12, 12.1, 12.2, 12.4, 12.5, 12.6, 12.7, 12.8, 12.9, 13, 13.1, 13.3, 13.4, 13.5, 13.6, 13.7],
                        backgroundColor: [
                            'rgba(255, 255, 126, 1)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '-1Z',
                        data: [2.8, 3.6, 4.5, 5.1, 5.7, 6.1, 6.5, 6.9, 7, 7.2, 7.5, 7.7, 7.8, 8.1, 8.4, 8.5, 8.7, 8.9, 9.1, 9.3, 9.5, 9.6, 9.9, 10, 10.1,
                            10.4, 10.5, 10.6, 10.9, 11, 11.2, 11.4, 11.6, 11.7, 11.9, 12, 12.2, 12.4, 12.5, 12.6, 12.9, 13, 13.1, 13.4, 13.5, 13.6, 13.7, 13.9, 14, 14.2, 14.3, 14.4, 14.6, 14.8, 15, 15.1, 15.2, 15.4, 15.5, 15.6, 15.7],
                        backgroundColor: [
                            'rgba(240, 255, 0, 1)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Medium',
                        data: [3.2, 4.2, 5.1, 5.8, 6.4, 6.9, 7.4, 7.6, 7.9, 8.2, 8.5, 8.7, 8.9, 9.2, 9.4, 9.6, 9.8, 10, 10.2, 10.4, 10.6, 10.9, 11.1, 11.4, 11.5,
                            11.6, 11.9, 12.15, 12.3,
                            12.5, 12.6, 12.9, 13.2, 13.4, 13.5, 13.7, 13.9, 14, 14.15, 14.4, 14.6, 14.9, 15, 15.4, 15.5, 15.6, 15.7, 15.9, 16, 16.2, 16.4, 16.6, 16.8, 17, 17.2, 17.3, 17.4, 17.6, 17.9, 18, 18.1],
                        backgroundColor: [
                            'rgba(77, 175, 124, 1)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+1Z',
                        data: [3.7, 4.8, 5.9, 6.6, 7.3, 7.8, 8.2, 8.6, 9, 9.3, 9.6, 9.9, 10.1, 10.4, 10.6, 10.9, 11.1, 11.4, 11.6, 11.9, 12, 12.4, 12.5, 12.8, 13,
                            13.2, 13.5, 13.6, 14, 14.2, 14.4, 14.6, 14.9, 15.1, 15.4, 15.6, 15.9, 16, 16.2, 16.5, 16.7, 17, 17.2, 17.6, 17.7, 17.9, 18, 18.25, 18.5, 18.8, 19, 19.2, 19.4, 19.6, 19.9, 20.1, 20.4, 20.5, 20.8, 21, 21.1],
                        backgroundColor: [
                            'rgba(77, 175, 124, .8)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+2Z',
                        data: [4.2, 5.5, 6.6, 7.5, 8.1, 8.8, 9.2, 9.9, 10.1, 10.5, 10.9, 11.1, 11.5, 11.9, 12.1, 12.4, 12.6, 12.9, 13.1, 13.5, 13.7, 14, 14.2, 14.5, 14.8,
                            15, 15.4,
                            15.6, 16, 16.2, 16.5, 16.9, 17.1, 17.4, 17.6, 17.9, 18.1, 18.4, 18.7, 19, 19.2, 19.5, 19.9, 20.4, 20.5, 20.6, 20.9, 21.1, 21.5, 21.8, 22, 22.4, 22.6, 22.9, 23.2, 23.5, 23.8, 24, 24.4, 24.6, 24.9],
                        backgroundColor: [
                            'rgba(77, 175, 124, .5)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+3Z',
                        data: [4.8, 6.4, 7.5, 8.5, 9.4, 10, 10.5, 11, 11.5, 12, 12.5, 12.8, 13.1, 13.5, 13.8, 14.1, 14.5, 14.8, 15, 15.5, 15.7, 16, 16.3, 16.7, 17,
                            17.2, 17.6, 18, 18.2, 18.6, 19, 19.25, 19.5, 20, 20.2, 20.5, 21, 21.2, 21.5, 22, 22.25, 22.7, 23, 23.4, 23.6, 24.1, 24.5, 24.7, 25.1, 25.5, 26, 26.3, 26.5, 27, 27.4, 27.7, 28.1, 28.5, 28.8, 29.2, 29.5],
                        backgroundColor: [
                            'rgba(236, 236, 236, .5)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                responsive: true,

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    point: {
                        radius: 1
                    }
                }
            }
        });
    }

    var ctx_modal = document.getElementById('gmpChartModal').getContext('2d');
    if (child_sex =='male') {
        var myChartModal = new Chart(ctx_modal, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60'],
                datasets: [
                    {
                        label: 'Child Weight',
                        data: actual_weight,
                        backgroundColor: ['rgba(255, 99, 132, 1)'],
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 2,
                        fill: false,
                    },
                    {
                        label: '-3Z',
                        data: [2, 3, 3.9, 4.5, 5, 5.3, 5.6, 6, 6.2, 6.5, 6.6, 6.8, 7, 7.1, 7.25, 7.4, 7.6, 7.75, 7.8, 8, 8.2, 8.25, 8.4, 8.5, 8.6,
                            8.8, 8.9, 9, 9.1, 9.25, 9.4, 9.5, 9.6, 9.75, 9.8, 9.9, 10, 10.1, 10.25, 10.35, 10.4, 10.5, 10.6, 10.75, 10.8, 10.9, 11, 11.15, 11.25, 11.3, 11.4, 11.5, 11.6, 11.75, 11.8, 11.9, 12, 12.1, 12.25, 12.4, 12.5],
                        backgroundColor: [
                            'rgba(230, 126, 34, .5)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, .2)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '-2Z',
                        data: [2.5, 3.5, 4.4, 5, 5.6, 6, 6.4, 6.6, 7, 7.2, 7.4, 7.6, 7.75, 8, 8.1, 8.4, 8.5, 8.6, 8.8, 9, 9.1, 9.25, 9.4, 9.5, 9.75,
                            9.9, 10, 10.1, 10.25, 10.4, 10.5, 10.6, 10.75, 10.9, 11, 11.1, 11.25, 11.4, 11.5, 11.6, 11.75, 11.9, 12, 12.1, 12.25, 12.4, 12.5, 12.6, 12.75, 12.9, 13, 13.1, 13.2, 13.3, 13.4, 13.5, 13.6, 13.7, 13.8, 13.9, 14],
                        backgroundColor: [
                            'rgba(255, 255, 126, 1)',
                        ],
                        borderColor: [
//                        'rgba(255, 206, 86, .2)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '-1Z',
                        data: [3, 4, 5, 5.75, 6.25, 6.75, 7.2, 7.5, 7.75, 8, 8.25, 8.5, 8.75, 8.9, 9, 9.2, 9.4, 9.6, 9.8, 10, 10.1, 10.35, 10.5, 10.7, 10.8,
                            11, 11.2, 11.3, 11.5, 11.7, 11.8, 12, 12.1, 12.3, 12.4, 12.5, 12.75, 12.9, 13, 13.1, 13.25, 13.4, 13.5, 13.6, 13.75, 13.85, 14, 14.1, 14.3, 14.4, 14.5, 14.6, 14.8, 15, 15.1, 15.25, 15.4, 15.6, 15.75, 15.9, 16],
                        backgroundColor: [
                            'rgba(240, 255, 0, 1)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, .2)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Medium',
                        data: [3.5, 4.5, 5.5, 6.5, 7, 7.5, 8, 8.25, 8.6, 9, 9.25, 9.5, 9.75, 10, 10.25, 10.4, 10.6, 10.75, 11, 11.25, 11.4, 11.6, 11.8, 12, 12.25,
                            12.4, 12.5, 12.7, 12.9, 13.1, 13.3, 13.5, 13.7, 13.9, 14, 14.2, 14.4, 14.5, 14.7, 14.9, 15, 15.2, 15.4, 15.5, 15.6, 15.8, 16, 16.25, 16.4, 16.5, 16.6, 16.8, 17, 17.25, 17.4, 17.5, 17.65, 17.8, 18, 18.25, 18.4],
                        backgroundColor: [
                            'rgba(77, 175, 124, 1)'
                        ],
                        borderColor: [
//                        'rgba(153, 102, 255, .2)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+1Z',
                        data: [4, 5.25, 6.4, 7.25, 7.9, 8.4, 8.9, 9.25, 9.6, 10, 10.25, 10.5, 10.8, 11.1, 11.4, 11.5, 11.75, 12, 12.25, 12.5, 12.75, 13, 13.25, 13.5, 13.75,
                            13.9, 14.1, 14.3, 14.5, 14.75, 15, 15.25, 15.4, 15.6, 15.8, 16, 16.2, 16.4, 16.6, 16.75, 17, 17.25, 17.4, 17.6, 17.75, 18, 18.25, 18.4, 18.6, 18.9, 19, 19.25, 19.4, 19.6, 19.9, 20, 20.25, 20.4, 20.6, 20.8, 21],
                        backgroundColor: [
                            'rgba(77, 175, 124, .8)'
                        ],
                        borderColor: [
//                        'rgba(255, 159, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+2Z',
                        data: [4.5, 6, 7, 8, 8.75, 9.25, 9.75, 10.4, 10.75, 11, 11.4, 11.75, 12, 12.3, 12.6, 12.8, 13.1, 13.4, 13.75, 14, 14.25, 14.5, 14.75, 15, 15.25,
                            15.5, 15.75, 16, 16.25, 16.5, 16.8, 17, 17.4, 17.6, 17.8, 18.1, 18.25, 18.5, 18.75, 19, 19.25, 19.5, 19.75, 20, 20.25, 20.5, 20.75, 21, 21.25, 21.4, 21.6, 22, 22.25, 22.4, 22.6, 22.9, 23.1, 23.4, 23.6, 23.9, 24.25],
                        backgroundColor: [
                            'rgba(77, 175, 124, .5)'
                        ],
                        borderColor: [
                            'rgba(155, 159, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+3Z',
                        data: [5, 6.5, 8, 9, 10, 10.5, 11, 11.5, 12, 12.5, 12.75, 13, 13.25, 13.5, 14, 14.25, 14.5, 15, 15.25, 15.5, 15.75, 16.25, 16.5, 16.75, 17,
                            17.5, 17.75, 18, 18.4, 18.7, 19, 19.25, 19.5, 19.75, 20, 20.4, 20.6, 21, 21.25, 21.25, 21.5, 21.75, 22, 22.75, 23, 23.25, 23.5, 23.9, 24.2, 24.5, 24.9, 25.1, 25.4, 25.6, 26, 26.3, 26.5, 27, 27.25, 27.5, 28],
                        backgroundColor: [
                            'rgba(236, 236, 236, .5)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                bezierCurve: false,
                title: {
                    display: true,
                    text: child_info
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    point: {
                        radius: 1
                    }
                }
            }
        });
    } else {
        var myChartModal = new Chart(ctx_modal, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '00'],
                datasets: [
                    {
                        label: 'Child Weight',
                        data: actual_weight,
                        backgroundColor: ['rgba(255, 99, 132, 1)'],
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 2,
                        fill: false,
                    },{
                        label: '-3Z',
                        data: [2, 2.6, 3.4, 4, 4.4, 4.8, 5.1, 5.4, 5.6, 5.8, 6, 6.1, 6.25, 6.5, 6.6, 6.8, 6.9, 7, 7.2, 7.4, 7.5, 7.6, 7.8, 8, 8.1,
                            8.2, 8.4, 8.5, 8.6, 8.8, 8.9, 9, 9.2, 9.3, 9.4, 9.5, 9.6, 9.7, 9.9, 10, 10.1, 10.25, 10.4, 10.5, 10.6, 10.7, 10.8, 10.9, 11, 11.1, 11.2, 11.3, 11.4, 11.45, 11.5, 11.6, 11.7, 11.8, 11.9, 12, 12.1],
                        backgroundColor: [
                            'rgba(230, 126, 34, .5)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '-2Z',
                        data: [2.5, 3.2, 3.9, 4.5, 5, 5.4, 5.6, 6, 6.4, 6.5, 6.8, 6.9, 7, 7.2, 7.4, 7.6, 7.8, 8, 8.1, 8.3, 8.5, 8.6, 8.8, 8.9, 9,
                            9.2, 9.4, 9.5, 9.6, 9.9, 10, 10.1, 10.4, 10.5, 10.6, 10.7, 10.8, 11, 11.1, 11.2, 11.4, 11.5, 11.6, 11.8, 11.9, 12, 12.1, 12.2, 12.4, 12.5, 12.6, 12.7, 12.8, 12.9, 13, 13.1, 13.3, 13.4, 13.5, 13.6, 13.7],
                        backgroundColor: [
                            'rgba(255, 255, 126, 1)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '-1Z',
                        data: [2.8, 3.6, 4.5, 5.1, 5.7, 6.1, 6.5, 6.9, 7, 7.2, 7.5, 7.7, 7.8, 8.1, 8.4, 8.5, 8.7, 8.9, 9.1, 9.3, 9.5, 9.6, 9.9, 10, 10.1,
                            10.4, 10.5, 10.6, 10.9, 11, 11.2, 11.4, 11.6, 11.7, 11.9, 12, 12.2, 12.4, 12.5, 12.6, 12.9, 13, 13.1, 13.4, 13.5, 13.6, 13.7, 13.9, 14, 14.2, 14.3, 14.4, 14.6, 14.8, 15, 15.1, 15.2, 15.4, 15.5, 15.6, 15.7],
                        backgroundColor: [
                            'rgba(240, 255, 0, 1)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Medium',
                        data: [3.2, 4.2, 5.1, 5.8, 6.4, 6.9, 7.4, 7.6, 7.9, 8.2, 8.5, 8.7, 8.9, 9.2, 9.4, 9.6, 9.8, 10, 10.2, 10.4, 10.6, 10.9, 11.1, 11.4, 11.5,
                            11.6, 11.9, 12.15, 12.3,
                            12.5, 12.6, 12.9, 13.2, 13.4, 13.5, 13.7, 13.9, 14, 14.15, 14.4, 14.6, 14.9, 15, 15.4, 15.5, 15.6, 15.7, 15.9, 16, 16.2, 16.4, 16.6, 16.8, 17, 17.2, 17.3, 17.4, 17.6, 17.9, 18, 18.1],
                        backgroundColor: [
                            'rgba(77, 175, 124, 1)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+1Z',
                        data: [3.7, 4.8, 5.9, 6.6, 7.3, 7.8, 8.2, 8.6, 9, 9.3, 9.6, 9.9, 10.1, 10.4, 10.6, 10.9, 11.1, 11.4, 11.6, 11.9, 12, 12.4, 12.5, 12.8, 13,
                            13.2, 13.5, 13.6, 14, 14.2, 14.4, 14.6, 14.9, 15.1, 15.4, 15.6, 15.9, 16, 16.2, 16.5, 16.7, 17, 17.2, 17.6, 17.7, 17.9, 18, 18.25, 18.5, 18.8, 19, 19.2, 19.4, 19.6, 19.9, 20.1, 20.4, 20.5, 20.8, 21, 21.1],
                        backgroundColor: [
                            'rgba(77, 175, 124, .8)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+2Z',
                        data: [4.2, 5.5, 6.6, 7.5, 8.1, 8.8, 9.2, 9.9, 10.1, 10.5, 10.9, 11.1, 11.5, 11.9, 12.1, 12.4, 12.6, 12.9, 13.1, 13.5, 13.7, 14, 14.2, 14.5, 14.8,
                            15, 15.4,
                            15.6, 16, 16.2, 16.5, 16.9, 17.1, 17.4, 17.6, 17.9, 18.1, 18.4, 18.7, 19, 19.2, 19.5, 19.9, 20.4, 20.5, 20.6, 20.9, 21.1, 21.5, 21.8, 22, 22.4, 22.6, 22.9, 23.2, 23.5, 23.8, 24, 24.4, 24.6, 24.9],
                        backgroundColor: [
                            'rgba(77, 175, 124, .5)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '+3Z',
                        data: [4.8, 6.4, 7.5, 8.5, 9.4, 10, 10.5, 11, 11.5, 12, 12.5, 12.8, 13.1, 13.5, 13.8, 14.1, 14.5, 14.8, 15, 15.5, 15.7, 16, 16.3, 16.7, 17,
                            17.2, 17.6, 18, 18.2, 18.6, 19, 19.25, 19.5, 20, 20.2, 20.5, 21, 21.2, 21.5, 22, 22.25, 22.7, 23, 23.4, 23.6, 24.1, 24.5, 24.7, 25.1, 25.5, 26, 26.3, 26.5, 27, 27.4, 27.7, 28.1, 28.5, 28.8, 29.2, 29.5],
                        backgroundColor: [
                            'rgba(236, 236, 236, .5)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                bezierCurve: false,
                title: {
                    display: true,
                    text: child_info
                },

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    point: {
                        radius: 1
                    }
                }
            }
        });

    }
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("zoombtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
        modal.style.display = 'block';
        renderChart();
    }

    span.onclick = function () {
        modal.style.display = 'none';
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }



</script>

