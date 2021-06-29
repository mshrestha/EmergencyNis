<style>
    .dark-timeline .colorSam {
        background: rgba(255, 0, 0, .8);
        color: white;
        !important;
    }
    .dark-timeline .colorMam {
        background: rgba(255, 255, 0, .8);
        color: black;
        !important;
    }
    .dark-timeline .colorNormal {
        background: rgba(0, 128, 0, .8);
        color: white;
        !important;
    }
    /*.dark-timeline .vertical-timeline-content {*/
        /*background: rgba(255, 0, 153, .2);*/
        /*!important;*/
    /*}*/
    .modal {
        border: 1px solid black;
        background-color: #ffffff;
        height: 95%;
        width: 95%;
        margin:0 auto;
    }
</style>
<div class="row m-b-lg">
    <div class="col-lg-3 text-center">
        <div>
            <img alt="image" src="{{ $child->child_image() }}"
            style="width: 100%;height: 110px;object-fit:cover;">
        </div>

    </div>
    <div class="col-lg-8">
        <strong>{{ $child->children_name }}</strong>
        <p>
            ID: {{ $child->sync_id}}<br />
            MOHAID: {{ $child->moha_id}}<br />
            Sex: {{ $child->sex}}<br />
            {{--{{ $child->age }} months old<br />--}}
            <?php
            if ($child->date_of_birth == null  ) {
                $created_at=new DateTime($child->created_at);
                $dob = $created_at->modify("-".$child->age.' months');
            } else
                $dob = new DateTime($child->date_of_birth);
            $diff = $dob->diff(new DateTime());
            $age = $diff->format('%m') + 12 * $diff->format('%y');
            echo $age.' month old';
            ?><br/>
            {{ $child->facility->name.' '.$child->facility->facility_id }}<br/>
            Block {{ $child->block.''.$child->sub_block_no }}, Household {{ $child->hh_no }} <br />

        </p>
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('children.edit', $child->sync_id) }}" class="edit-btn">
                    <button class="btn btn-info btn-circle" type="button" title="Edit"><i class="fa fa-pencil"></i></button>
                </a>
                <a href="{{ route('children.show', $child->sync_id) }}" class="edit-btn">
                    <button class="btn btn-success btn-circle" type="button" title="Facility Followup"><i class="fa fa-plus"></i></button>
                </a>
                <form action="{{ route('children.destroy', $child->sync_id) }}" method="post" class="delete-form">
                    @csrf
                    @method('DELETE')

                    <button  class="btn btn-danger btn-circle" type="submit" title="Delete" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button id='zoombtnW' class='btn btn-info '>
            GMP-Weight <i class="fa fa-bar-chart"></i>
        </button>
        <canvas  class="hidden" id="gmpWChart" ></canvas>
        <button id='zoombtnH' class='btn btn-success '>
            GMP-Height <i class="fa fa-bar-chart"></i>
        </button>
        <canvas  class="hidden" id="gmpHChart" ></canvas>
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
                    {{-- <div id="vertical-timeline" class="vertical-container dark-timeline">
                        @foreach($followups as $followup)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon gray-bg">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            @if(array_key_exists('nutritionstatus', $followup))
                            <div class="{{(($followup['nutritionstatus']=='SAM') ? 'vertical-timeline-content colorSam' : (($followup['nutritionstatus']=='MAM') ? 'vertical-timeline-content colorMam' :'vertical-timeline-content colorNormal'))}}" >
                                <span class="vertical-date small text-muted"> {{ $followup['date'] }} </span><br />
                                <p>Visited {{ $followup['facility']['facility_id'] }}</p>

                                @if(isset($followup['muac']))
                                    <strong>MUAC: </strong> {{ $followup['muac'] }} cm <br />
                                @endif
                                @if(isset($followup['weight']))
                                    <strong>Weight: </strong> {{ $followup['weight'] }} kg <br />
                                @endif
                                @if(isset($followup['height']))
                                    <strong>Height: </strong> {{ $followup['height'] }} cm <br />
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
                    </div> --}}
                </div>
                @endif


            </div>


    </div>
</div>
<h4>Related Mother</h4>
@foreach($child->pregnant_womens as $key=>$pw)
    <a href="{{ route('pregnant-women.show', $pw->sync_id) }}">
        {{$pw->pregnant_women_name.' ID:'.$pw->sync_id.' Moha ID:'.$pw->moha_id.' FCN:'.$pw->family_count_no }}
    </a>
@endforeach

<div class=" text-center" onclick="printDiv('qrcode')" id="qrcode">
   {!! QrCode::size(200)->generate(route('facility-followup.show', $child->id)) !!}
</div>

<div id="gmpWModal" class="modal" >
    <div class="modalContent" style="height: 85%; width: 85%; margin:0 auto;">
        <span class="close gmpWclose"> &times; </span>
        <canvas id="gmpWChartModal"></canvas>
    </div>
</div>
<div id="gmpHModal" class="modal" >
    <div class="modalContent" style="height: 85%; width: 85%; margin:0 auto;">
        <span class="close gmpHclose"> &times; </span>
        <canvas id="gmpHChartModal"></canvas>
    </div>
</div>

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
    var ctx = document.getElementById('gmpWChart').getContext('2d');
    var actual_weight = JSON.parse('<?php echo json_encode($gmp_chart['weight']); ?>');
    var actual_height = JSON.parse('<?php echo json_encode($gmp_chart['height']); ?>');
    var radiusW = JSON.parse('<?php echo json_encode($gmp_chart['radiusW']); ?>');
    var radiusH = JSON.parse('<?php echo json_encode($gmp_chart['radiusH']); ?>');
    var child_sex = JSON.parse('<?php echo json_encode($gmp_chart['sex']); ?>');
    var child_info = JSON.parse('<?php echo json_encode($gmp_chart['child_info']); ?>');
//        console.log(actual_height);
//        console.log(radiusH);

//GMP Weight Start
    var ctx_gmpW = document.getElementById('gmpWChartModal').getContext('2d');
    var ctx_gmpH = document.getElementById('gmpHChartModal').getContext('2d');
    if (child_sex =='male') {
        var gmpWModal = new Chart(ctx_gmpW, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60'],
                datasets: [
                    {
                        label: 'Child Weight',
                        data: actual_weight,
                        type: 'line',
                        pointBackgroundColor: 'black',
                        borderColor:'black',
                        pointRadius: radiusW,
//                        pointRadius: 5,
                        fill: false,
                        showLine: false,
                        order: 1
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
                    }],

            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                bezierCurve: false,
                title: {
                    display: true,
                    text: 'Boy\'s GMP Weight: '+child_info
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
                        radius: 0
                    }
                }
            }
        });
        var gmpHModal = new Chart(ctx_gmpH, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60'],
                datasets: [
                    {
                        label: 'Child Height',
                        data: actual_height,
                        type: 'line',
                        pointBackgroundColor: 'black',
                        borderColor:'black',
                        pointRadius: radiusH,
//                        pointRadius: 5,
                        fill: false,
                        showLine: false,
                        order: 1
                    },

                    {
                        label: '-3Z',
                        data: [45,49,52,55,57,60,62,64,65,66,67,68,69,70,71,72,73,74,75,75,76,77,78,78.5,79,79,80,80,80.5,81,
                            81.25,81.5,82,82.5,83,83.5,84,84.5,85,85.5,86,86.5,87,87,88,88.5,89,89,90,91,91,92,92,93,93,94,94,95,95,96,96],
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
                        data: [46,51,54,57,59,62,64,65,66,67,68,70,71,72,73,74,75,76,77,78,78.5,79,80,81,82,83,83.5,84,84.5,85,
                            85.5,86,86.5,87,87.5,88,89,90,90.5,91,92,92.5,93,93.5,94,94.5,95,95.5,96,96.5,97,97.5,97.75,98.25,98.5,99,99.25,99.5,100,100.5,101],
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
                        data: [48.5,53,57,59,62,64,65,67,68.5,70,71,72.5,74,75,76,77,78,79,80,81,82,83,83.5,84,85,85.5,86,87,88,
                            89,89.5,90,90.5,91,91.5,92,93,94,94.5,95,95.5,96,96.5,97,97.5,98,98.5,99,99.5,100,100.5,101,102,102,103,103,104,104.25,104.5,105,105.5],
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
                        data: [50,54,59,61,64,66,67,69,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,91.5,
                            92,93,93.5,94,94.5,95,96,96.5,97,98,99,99.5,100,101,101.5,102,102.5,103,104,104.5,105,105.5,106,106.5,107,107.5,108,108.5,109,109.5,110],
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
                        data: [52,57,60,64,66,68,70,71.5,73,74,75.5,77,78,79,81,82,83,84,85,86,87,88,89,90,91,92,93,93.5,94,95,95.5,
                            96,96.5,97,98,99,99.5,100,100.5,101,102,103,104,104.5,105,105.5,106,106.25,106.5,107,107.5,108,108.5,109,109.5,110,111,111.5,112,113,114],
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
                        data: [54,59,62,66,68,70,72,74,75,77,78,79,80,82,83,84.5,86,87,88,89,90,91,92,93,94,95,96,97,97.5,98,
                            99,100,100.5,101,102,103,104,104.5,105,105.5,106,106.5,107,108,108.5,109,110,110.5,111,112,113,113.5,114,114.5,115,115.5,116,117,118,118.5,119],
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
                        data: [55,60,65,67,70,71,73,75,77,78,80,81,82,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,
                            102,103,103.5,104,105,106,107,108,108.5,109,110,111,111.5,112,113,114,114.5,115,115.5,116,117,118,118.5,119,120,120.5,121,122,123,124],
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
                    text: 'Boy\'s GMP Height: '+child_info
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
                        radius: 0
                    }
                }
            }
        });
    } else {
        var gmpWModal = new Chart(ctx_gmpW, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60'],
                datasets: [
                    {
                        label: 'Child Weight',
                        data: actual_weight,
                        type: 'line',
                        pointBackgroundColor: 'black',
                        pointRadius: radiusW,
                        borderColor:'black',
//                        pointRadius: 5,
                        fill: false,
                        showLine: false,
                        order: 1
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
                    text: 'Girl\'s GMP Weight: '+child_info
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
                        radius: 0
                    }
                },
//                tooltips: {
//                    mode: 'index',
//                    intersect: false
//                },
//                hover: {
//                    mode: 'index',
//                    intersect: false
//                }
            }
        });
        var gmpHModal = new Chart(ctx_gmpH, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60'],
                datasets: [
                    {
                        label: 'Child Height',
                        data: actual_height,
                        type: 'line',
                        pointBackgroundColor: 'black',
                        borderColor:'black',
                        pointRadius: radiusH,
//                        pointRadius: 5,
                        fill: false,
                        showLine: false,
                        order: 1
                    },

                    {
                        label: '-3Z',
                        data: [44,47,51,54,56,57.5,59,60,61.5,62.5,64,65,66,67,68,69,70,71,72,73,74,74.5,75,76,76.5,77,78,79,79.5,80,
                            80.5,81,81.5,82,82.5,83,83.5,84,84.5,85,85.5,86,86.5,87,87.5,88,88.5,89,89.5,90,90.5,91,91.5,92,92.5,93,93.5,94,94.5,95,95.5],
                        backgroundColor: [
                            'rgba(230, 126, 34, .5)',
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 1,
                        tooltip:false
                    },
                    {
                        label: '-2Z',
                        data: [45,49,53,55,57,59,61,62,64,65,66.5,67,68,70,71,72,73,74,75,76,77,78,78.5,79,80,81,82,83,83.5,84,84.5,85,
                            85.5,86,86.5,87,87.5,88,88.5,89,90,90.5,91,92,92.5,93,93.5,94,94.5,95,95.5,96,96.5,97,97.5,97.75,98.25,98.5,99,99.5,100],
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
                        data: [47,51,55,57,59,62,63,65,66,68,69,70,71.5,72.5,74,74.5,75.5,76.5,77.5,78.5,79,80,81,82,83,84,84.5,85,86,86.5,87,88,
                            89,89.5,90,90.5,91.5,92,92.5,93,94,94.5,95,95.5,96,96.5,97,97.5,98,98.5,99,100,100.5,101,101.5,102,102.5,103,103.5,104,104.5],
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
                        data: [49,54,57,59,62,64,66,67,69,70,71,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,91.5,
                            92,92.5,93,93.5,94,95,95.5,96,97,97.5,98,99,99.5,100,101,101.5,102,102.5,103,103.5,104,105,105.5,106,106.5,107,107.5,108,108.5,109],
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
                        data: [51,55,59,62,64,66,68,71,72,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,95.5,
                            96,97,98,99,99.5,100,101,101.5,102,103,104,104.5,105,105.5,106,107,107.5,108,108.5,109,109.5,110,110.5,111,111.5,112,112.5,113,114],
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
                        data: [53,57,61,64,66,68,70,72,74,75,76,77,78,79,80,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,97.5,98,
                            99,100,101,102,103,104,104.5,105,105.5,106,107,108,109,109.5,110,111,111.5,112,113,114,114.5,115,115.5,116,116.5,117,117.5,118],
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
                        data: [55,60,63,66,69,70,72,74,75,77,79,80,81,83,84,85,86,88,89,90,91,93,94,95,96,96.5,97,98,99,100,101,
                            102,103,103.5,104,105,106,107,108,108.5,109,110,111,111.5,112,113,114,114.5,115,115.5,116,117,118,118.5,119,120,120.5,121,122,123,124],
                        backgroundColor: [
                            'rgba(236, 236, 236, .5)'
                        ],
                        borderColor: [
                            'rgba(55, 59, 64, .2)'
                        ],
                        borderWidth: 0
                    }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                bezierCurve: false,
                datasetFill: true,
                title: {
                    display: true,
                    text: 'Girl\'s GMP Height: '+child_info
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
    var modalW = document.getElementById("gmpWModal");
    var btn = document.getElementById("zoombtnW");
    var span = document.getElementsByClassName("gmpWclose")[0];

    btn.onclick = function () {
        modalW.style.display = 'block';
        renderChart();
    }
    span.onclick = function () {
        modalW.style.display = 'none';
    }
    window.onclick = function (event) {
        if (event.target == modalW) {
            modalW.style.display = 'none';
        }
    }
    var modalH = document.getElementById("gmpHModal");
    var btn = document.getElementById("zoombtnH");
    var span = document.getElementsByClassName("gmpHclose")[0];

    btn.onclick = function () {
        modalH.style.display = 'block';
        renderChart();
    }
    span.onclick = function () {
        modalH.style.display = 'none';
    }
    window.onclick = function (event) {
        if (event.target == modalH) {
            modalH.style.display = 'none';
        }
    }

</script>

