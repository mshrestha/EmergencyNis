@extends('layouts.app')

@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
  <div class="row">


    <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>

                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                            <h2>General Information</h2>
                        </div>
                        <div class="ibox-content">
                            <form method="get" class="form-horizontal">
                              <div class="form-group" id="data_1"><label class="col-sm-3 control-label">Next visit date</label>

                                  <div class="col-sm-9">
                                    <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014" style="width:200px !important">
                                </div>

                                  </div>
                              </div>
                                <div class="form-group"><label class="col-sm-3 control-label">Exclusive Breastfeeding</label>

                                    <div class="col-sm-9">
                                      <input type="checkbox" class="js-switch" checked="" style="display: none;" data-switchery="true">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-3 control-label">Continued Breastfeeding</label>

                                    <div class="col-sm-9">
                                      <input type="checkbox" class="js-switch_2" checked="" style="display: none;" data-switchery="true">

                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-3 control-label">Received all EPI vaccinations as per schedule</label>

                                    <div class="col-sm-9">
                                      <input type="checkbox" class="js-switch_3" checked="" style="display: none;" data-switchery="true">

                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>

                      <div class="ibox float-e-margins">
                          <div class="ibox-title">

                              <div class="ibox-tools">
                                  <a class="collapse-link">
                                      <i class="fa fa-chevron-up"></i>
                                  </a>

                                  <a class="close-link">
                                      <i class="fa fa-times"></i>
                                  </a>
                              </div>
                              <h2>Complementary Feeding</h2>
                          </div>
                          <div class="ibox-content">
                              <form method="get" class="form-horizontal">
                                <div class="form-group"><label class="col-sm-3 control-label">Introduction time (Age)</label>

                                    <div class="col-sm-9">
                                      <div class="radio radio-success">
                                            <input type="radio" id="inlineRadio1" value="less" name="radioInline">
                                            <label for="inlineRadio1">Less than 6 Months</label><br />
                                            <input type="radio" id="inlineRadio2" value="six" name="radioInline">
                                            <label for="inlineRadio2"> 6 months </label><br />
                                            <input type="radio" id="inlineRadio3" value="more" name="radioInline">
                                            <label for="inlineRadio3"> More than 6 months </label>
                                        </div>
                                        <div class="radio radio-inline">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-3 control-label">Frequency</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="Frequency" >
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Number of food groups</label>
                                  <div class="col-sm-9"><input type="text" name="foodGroups" ></div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Quantity of food given</label>
                                  <div class="col-sm-9"><input type="text" name="foodQuantity" ></div>
                                </div>

                              </form>
                          </div>
                        </div>
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">

                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                                <h2>Anthropometric Information</h2>
                            </div>
                            <div class="ibox-content">
                                <form method="get" class="form-horizontal">
                                  <div class="form-group"><label class="col-sm-3 control-label">MUAC</label>

                                      <div class="col-sm-9">
                                        <div id="ionrange_2"></div>


                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Edema</label>
                                      <div class="col-sm-9">
                                        <input type="checkbox" class="js-switch_4" checked="" style="display: none;" data-switchery="true">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Nutritional Status</label>
                                      <div class="col-sm-9">
                                        <input type="text" name="muac">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Referred type</label>
                                      <div class="col-sm-9">
                                        <input type="text" name="muac">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Facility</label>
                                      <div class="col-sm-9">
                                        <input type="text" name="muac">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Referral ID</label>
                                      <div class="col-sm-9">
                                        <input type="text" name="muac">
                                      </div>
                                  </div>
                                </form>
                            </div>
                          </div>
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">

                                  <div class="ibox-tools">
                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>

                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                                  <h2>Nutritional Supplement</h2>
                              </div>
                              <div class="ibox-content">
                                  <form method="get" class="form-horizontal">
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Distribution of MNP Sachet</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="muac">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Vitamin A</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="muac">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label">Deworming</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="muac">
                                        </div>
                                    </div>

                                  </form>
                              </div>
                            </div>

                                <a href="/home">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </a>

                </div>
                <div class="col-lg-4">
                  <div id="contact-1" class="tab-pane active">
                      <div class="row m-b-lg">
                          <div class="col-lg-4 text-center">
                              <h2>Rafique Ahmed</h2>

                              <div class="m-b-sm">
                                  <img alt="image" class="img-circle" src="img/a2.jpg"
                                       style="width: 62px">
                              </div>
                          </div>
                          <div class="col-lg-8">
                              

                              <p>
                                40 months old<br />
                                Camp 05A Block C <br />
                                Date of Birth: 06/02/2016
                                <br />ID# 05AC1123
                              </p>

                          </div>
                      </div>
                      <div class="client-detail">
                      <div class="full-height-scroll">

                          <strong>Nutrition Report</strong>

                          <ul class="list-group clear-list">
                              <li class="list-group-item fist-item">
                                  <span class="pull-right"> Yes </span>
                                  Exclusive Breastfeeding
                              </li>
                              <li class="list-group-item">
                                  <span class="pull-right"> Yes </span>
                                  Received all EPI
                              </li>
                              <li class="list-group-item">
                                  <span class="pull-right"> 12cm </span>
                                  MUAC
                              </li>
                              <li class="list-group-item">
                                  <span class="pull-right"> No </span>
                                  Edema
                              </li>
                              <li class="list-group-item">
                                  <span class="pull-right"> MAM </span>
                                  Nutritional Status
                              </li>
                          </ul>
                          <strong>Notes</strong>
                          <p>
                              Identified as MAM patient and referred to TSFP
                          </p>
                          <hr/>
                          <strong>Timeline activity</strong>
                          <div id="vertical-timeline" class="vertical-container dark-timeline">
                              <div class="vertical-timeline-block">
                                  <div class="vertical-timeline-icon gray-bg">
                                      <i class="fa fa-coffee"></i>
                                  </div>
                                  <div class="vertical-timeline-content">
                                      <p>TSFP Visited
                                      </p>
                                      <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2018 </span>
                                  </div>
                              </div>
                              <div class="vertical-timeline-block">
                                  <div class="vertical-timeline-icon gray-bg">
                                      <i class="fa fa-briefcase"></i>
                                  </div>
                                  <div class="vertical-timeline-content">
                                      <p>Referred to TSFP
                                      </p>
                                      <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                  </div>
                              </div>
                              <div class="vertical-timeline-block">
                                  <div class="vertical-timeline-icon gray-bg">
                                      <i class="fa fa-bolt"></i>
                                  </div>
                                  <div class="vertical-timeline-content">
                                      <p>Community visit
                                      </p>
                                      <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                  </div>
                              </div>
                              <div class="vertical-timeline-block">
                                  <div class="vertical-timeline-icon navy-bg">
                                      <i class="fa fa-warning"></i>
                                  </div>
                                  <div class="vertical-timeline-content">
                                      <p>Identified as MAM patient
                                      </p>
                                      <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                  </div>
                              </div>
                              <div class="vertical-timeline-block">
                                  <div class="vertical-timeline-icon gray-bg">
                                      <i class="fa fa-coffee"></i>
                                  </div>
                                  <div class="vertical-timeline-content">
                                      <p>Community visit
                                      </p>
                                      <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                  </div>
                              </div>

                          </div>
                      </div>
                      </div>
                  </div>
                </div>
  </div>
</div>
@endsection
@section('scripts')
<!-- Switchery -->
<script src="js/plugins/switchery/switchery.js"></script>

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- IonRangeSlider -->
    <script src="js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

<script>

$('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#0099FF' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#0099FF' });
            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#0099FF' });
            var elem_4 = document.querySelector('.js-switch_4');
            var switchery_4 = new Switchery(elem_4, { color: '#0099FF' });

            $("#ionrange_2").ionRangeSlider({
                        min: 0,
                        max: 20,
                        type: 'single',
                        step: 0.1,
                        postfix: " cms",
                        prettify: false,
                        hasGrid: true
                    });

</script>


@endsection
