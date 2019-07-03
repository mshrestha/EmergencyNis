@extends('layouts.app')

@section('content')
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-8">
            <div class="ibox">
                <div class="ibox-content">
                    <span class="text-muted small pull-right">Last modification: <i class="fa fa-clock-o"></i> 2:10 pm - 12.06.2014</span>
                    <h2>Child</h2>
                    <p>
                        All child needs to be registered in order to use this system.
                    </p>
                    <div class="input-group">
                        <input type="text" placeholder="Search child " class="input form-control">
                        <span class="input-group-btn">
                                <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>
                    <br/>
                    <a href="{{ route('children.create') }}">
                      <button type="button" class="btn btn-primary btn-sm pull-right">
                        <i class="fa fa-plus"></i> Register
                      </button>
                    </a>
                    <div class="clients-list">
                    <ul class="nav nav-tabs">

                        <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Children</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i> Facilities</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="full-height-scroll">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td class="client-avatar"><img alt="image" src="img/a2.jpg"> </td>
                                            <td><a data-toggle="tab" href="#contact-1" class="client-link">Rafique Ahmed</a></td>
                                            <td> Camp 05A Block C</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +880 1234 4456</td>
                                            <td class="client-status"><span class="label label-primary">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><img alt="image" src="img/a3.jpg"> </td>
                                            <td><a data-toggle="tab" href="#contact-2" class="client-link">Farah Akhter</a></td>
                                            <td>Camp 04E Block E</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +880 1221 2235</td>
                                            <td class="client-status"><span class="label label-primary">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><img alt="image" src="img/a4.jpg"> </td>
                                            <td><a data-toggle="tab" href="#contact-3" class="client-link">Saiful Rahman</a></td>
                                            <td>Camp 02E Block A </td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +432 955 908</td>
                                            <td class="client-status"></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a5.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-4" class="client-link">Zakir Hussein</a></td>
                                            <td>Camp 03F Block D</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +422 600 213</td>
                                            <td class="client-status"><span class="label label-warning">Waiting</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a6.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-2" class="client-link">Sadi Hossein</a></td>
                                            <td>Camp 04E Block B</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +400 468 921</td>
                                            <td class="client-status"></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a7.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-3" class="client-link">Mohammed Siddique</a></td>
                                            <td>Camp 02E Block A</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +880 1122 4492</td>
                                            <td class="client-status"><span class="label label-info">Phoned</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a1.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-1" class="client-link">Sonia Choudhury</a></td>
                                            <td>Camp 05A Block C</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +880 4425 2235</td>
                                            <td class="client-status"><span class="label label-primary">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a3.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-2" class="client-link">Farah Akhter</a></td>
                                            <td>Camp 04E Block E</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +880 1234 4456</td>
                                            <td class="client-status"><span class="label label-warning">Waiting</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a4.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-3" class="client-link">Saiful Rahman</a></td>
                                            <td>Camp 02E Block A </td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +432 955 908</td>
                                            <td class="client-status"></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a5.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-4" class="client-link">Sania Mirza</a></td>
                                            <td>Camp 03F Block D</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +422 600 213</td>
                                            <td class="client-status"></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a2.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-1" class="client-link">Rafique Ahmed</a></td>
                                            <td> Camp 05A Block C</td>
                                            <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                            <td> +880 1234 4456</td>
                                            <td class="client-status"><span class="label label-danger">Deleted</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a7.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-2" class="client-link">Soniya Sholif</a></td>
                                            <td>Camp 02E Block A</td>
                                            <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                            <td> pacheco@manga.com</td>
                                            <td class="client-status"><span class="label label-primary">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a5.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-3"class="client-link">Asif Rahman</a></td>
                                            <td>Camp 03F Block D</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +422 600 213</td>
                                            <td class="client-status"><span class="label label-info">Phoned</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a6.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-4" class="client-link">Zakir Ahmed</a></td>
                                            <td>Camp 04E Block B</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +400 468 921</td>
                                            <td class="client-status"><span class="label label-primary">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a7.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-2" class="client-link">Mohommed Siddique</a></td>
                                            <td>Camp 02E Block A</td>
                                            <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                            <td> pacheco@manga.com</td>
                                            <td class="client-status"><span class="label label-primary">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a1.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-1" class="client-link">Mustafizur Akhter</a></td>
                                            <td>Camp 05A Block C</td>
                                            <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                            <td> Simon@erta.com</td>
                                            <td class="client-status"></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a3.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-3" class="client-link">Farah Akhter</a></td>
                                            <td>Camp 04E Block E</td>
                                            <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                            <td> rooney@proin.com</td>
                                            <td class="client-status"></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a4.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-4" class="client-link">Saiful Rahman</a></td>
                                            <td>Camp 02E Block A </td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +432 955 908</td>
                                            <td class="client-status"><span class="label label-primary">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a5.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-1" class="client-link">Amir Saraf</a></td>
                                            <td>Camp 03F Block D</td>
                                            <td class="contact-type"><i class="fa fa-phone"> </i></td>
                                            <td> +422 600 213</td>
                                            <td class="client-status"><span class="label label-info">Phoned</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a2.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-2" class="client-link">Rafique Ahmed</a></td>
                                            <td> Camp 05A Block C</td>
                                            <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                            <td> +880 1234 4456</td>
                                            <td class="client-status"><span class="label label-warning">Waiting</span></td>
                                        </tr>
                                        <tr>
                                            <td class="client-avatar"><a href=""><img alt="image" src="img/a7.jpg"></a> </td>
                                            <td><a data-toggle="tab" href="#contact-4" class="client-link">Javed Jahangir</a></td>
                                            <td>Camp 02E Block A</td>
                                            <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                            <td> pacheco@manga.com</td>
                                            <td class="client-status"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="full-height-scroll">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td><a data-toggle="tab" href="#company-1" class="client-link">NS-C1E-UNHCR/TDH-OTP02</a></td>
                                            <td>Camp 1E</td>
                                            <td><i class="fa fa-flag"></i>UNHCR - TDH</td>
                                            <td class="client-status"><span class="label label-warning">OTP</span></td>
                                        </tr>
                                        <tr>
                                            <td><a data-toggle="tab" href="#company-2" class="client-link">NS-C1E-WFP/ACF-SFP03</a></td>
                                            <td>Camp 1E</td>
                                            <td><i class="fa fa-flag"></i> WFP - ACF</td>
                                            <td class="client-status"><span class="label label-primary">TSFP/BSFP</span></td>
                                        </tr>
                                        <tr>
                                            <td><a data-toggle="tab" href="#company-3" class="client-link">NS-C1W-UNHCR/TDH-OTP04</a></td>
                                            <td>Camp 1W</td>
                                            <td><i class="fa fa-flag"></i> UNHCR - TDH</td>
                                            <td class="client-status"><span class="label label-warning">OTP</span></td>
                                        </tr>
                                        <tr>
                                            <td><a data-toggle="tab" href="#company-1" class="client-link">NS-C1W-UNHCR/ACF-OTP03</a></td>
                                            <td>Camp 1W</td>
                                            <td><i class="fa fa-flag"></i> UNICEF and Multid - ACF</td>
                                            <td class="client-status"><span class="label label-warning">OTP</span></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox ">

                <div class="ibox-content">
                    <div class="tab-content">
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
                                    <strong>
                                        About me
                                    </strong>

                                    <p>
                                      40 months old<br />
                                      Camp 05A Block C <br />
                                      Date of Birth: 06/02/2016
                                    </p>

                                      <a href="/followup">
                                        <button type="button" class="btn btn-primary btn-sm btn-block">
                                          <i class="fa fa-envelope"></i> Add Follow Up
                                        </button>
                                      </a>

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
                        <div id="contact-2" class="tab-pane">
                            <div class="row m-b-lg">
                                <div class="col-lg-4 text-center">
                                    <h2>Farah Akhter</h2>

                                    <div class="m-b-sm">
                                        <img alt="image" class="img-circle" src="img/a3.jpg"
                                             style="width: 62px">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <strong>
                                        About me
                                    </strong>

                                    <p>
                                      28 months old<br />
                                      Camp 04E Block B <br />
                                      Date of Birth: 12/04/2017
                                    </p>
                                    <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                            class="fa fa-envelope"></i> Add Follow Up
                                    </button>
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
                                            <span class="pull-right"> 10.3cm </span>
                                            MUAC
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> No </span>
                                            Edema
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> SAM </span>
                                            Nutritional Status
                                        </li>
                                    </ul>
                                    <strong>Notes</strong>
                                    <p>
                                        Identified as SAM patient on community visit, and referred to TSFP for further treatment
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
                        <div id="contact-3" class="tab-pane">
                            <div class="row m-b-lg">
                                <div class="col-lg-4 text-center">
                                    <h2>Saiful Rahman</h2>

                                    <div class="m-b-sm">
                                        <img alt="image" class="img-circle" src="img/a4.jpg"
                                             style="width: 62px">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <strong>
                                        About me
                                    </strong>

                                    <p>
                                        38 months old<br />
                                        Camp 02E Block A <br />
                                        Date of Birth: 12/04/2016
                                    </p>
                                    <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                            class="fa fa-envelope"></i> Add Follow Up
                                    </button>
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
                                            <span class="pull-right"> No </span>
                                            Received all EPI
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> 10cm </span>
                                            MUAC
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> No </span>
                                            Edema
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> SAM </span>
                                            Nutritional Status
                                        </li>
                                    </ul>
                                    <strong>Notes</strong>
                                    <p>
                                        Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.
                                    </p>
                                    <hr/>
                                    <strong>Timeline activity</strong>
                                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-coffee"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Community Visit conducted
                                                </p>
                                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2018 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Facility Visited
                                                </p>
                                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2018 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Identified as SAM, Referred to facility
                                                </p>
                                                <span class="vertical-date small text-muted"> 06:10 pm - 09.05.2018 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon navy-bg">
                                                <i class="fa fa-warning"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Community visit
                                                </p>
                                                <span class="vertical-date small text-muted"> 02:50 pm - 09.05.2018 </span>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="contact-4" class="tab-pane">
                            <div class="row m-b-lg">
                                <div class="col-lg-4 text-center">
                                    <h2>Zakir Hussein</h2>

                                    <div class="m-b-sm">
                                        <img alt="image" class="img-circle" src="img/a5.jpg"
                                             style="width: 62px">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <strong>
                                        About me
                                    </strong>

                                    <p>
                                      28 months old<br />
                                      Camp 03F Block D <br />
                                      Date of Birth: 10/02/2017
                                    </p>
                                    <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                            class="fa fa-envelope"></i> Add Follow Up
                                    </button>
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
                                            <span class="pull-right"> No </span>
                                            Received all EPI
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> 10cm </span>
                                            MUAC
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> No </span>
                                            Edema
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> SAM </span>
                                            Nutritional Status
                                        </li>
                                    </ul>
                                    <strong>Notes</strong>
                                    <p>
                                        Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                    </p>
                                    <hr/>
                                    <strong>Timeline activity</strong>
                                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-coffee"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Community Visit conducted
                                                </p>
                                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2018 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Facility Visited
                                                </p>
                                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2018 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Identified as SAM, Referred to facility
                                                </p>
                                                <span class="vertical-date small text-muted"> 06:10 pm - 09.05.2018 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon navy-bg">
                                                <i class="fa fa-warning"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Community visit
                                                </p>
                                                <span class="vertical-date small text-muted"> 02:50 pm - 09.05.2018 </span>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="company-1" class="tab-pane">
                            <div class="m-b-lg">
                                    <h2>Camp 05A Block C</h2>

                                    <p>
                                        Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero,written in 45 BC. This book is a treatise on.
                                    </p>
                                    <div>
                                        <small>Active project completion with: 48%</small>
                                        <div class="progress progress-mini">
                                            <div style="width: 48%;" class="progress-bar"></div>
                                        </div>
                                    </div>
                            </div>
                            <div class="client-detail">
                                <div class="full-height-scroll">

                                    <strong>Nutrition Report</strong>

                                    <ul class="list-group clear-list">
                                        <li class="list-group-item fist-item">
                                            <span class="pull-right"> <span class="label label-primary">NEW</span> </span>
                                            The point of using
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> <span class="label label-warning">WAITING</span></span>
                                            Lorem Ipsum is that it has
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> <span class="label label-danger">BLOCKED</span> </span>
                                            If you are going
                                        </li>
                                    </ul>
                                    <strong>Notes</strong>
                                    <p>
                                        Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                    </p>
                                    <hr/>
                                    <strong>Timeline activity</strong>
                                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-coffee"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Conference on the sales results for the previous year.
                                                </p>
                                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Many desktop publishing packages and web page editors now use Lorem.
                                                </p>
                                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>There are many variations of passages of Lorem Ipsum available.
                                                </p>
                                                <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon navy-bg">
                                                <i class="fa fa-warning"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>The generated Lorem Ipsum is therefore.
                                                </p>
                                                <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-coffee"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Conference on the sales results for the previous year.
                                                </p>
                                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Many desktop publishing packages and web page editors now use Lorem.
                                                </p>
                                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="company-2" class="tab-pane">
                            <div class="m-b-lg">
                                <h2>Penatibus Consulting</h2>

                                <p>
                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some.
                                </p>
                                <div>
                                    <small>Active project completion with: 22%</small>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="client-detail">
                                <div class="full-height-scroll">

                                    <strong>Nutrition Report</strong>

                                    <ul class="list-group clear-list">
                                        <li class="list-group-item fist-item">
                                            <span class="pull-right"> <span class="label label-warning">WAITING</span> </span>
                                            Aldus PageMaker
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"><span class="label label-primary">NEW</span> </span>
                                            Lorem Ipsum, you need to be sure
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"> <span class="label label-danger">BLOCKED</span> </span>
                                            The generated Lorem Ipsum
                                        </li>
                                    </ul>
                                    <strong>Notes</strong>
                                    <p>
                                        Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                    </p>
                                    <hr/>
                                    <strong>Timeline activity</strong>
                                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-coffee"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Conference on the sales results for the previous year.
                                                </p>
                                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Many desktop publishing packages and web page editors now use Lorem.
                                                </p>
                                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>There are many variations of passages of Lorem Ipsum available.
                                                </p>
                                                <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon navy-bg">
                                                <i class="fa fa-warning"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>The generated Lorem Ipsum is therefore.
                                                </p>
                                                <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-coffee"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Conference on the sales results for the previous year.
                                                </p>
                                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Many desktop publishing packages and web page editors now use Lorem.
                                                </p>
                                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="company-3" class="tab-pane">
                            <div class="m-b-lg">
                                <h2>Ultrices Incorporated</h2>

                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.
                                </p>
                                <div>
                                    <small>Active project completion with: 72%</small>
                                    <div class="progress progress-mini">
                                        <div style="width: 72%;" class="progress-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="client-detail">
                                <div class="full-height-scroll">

                                    <strong>Nutrition Report</strong>

                                    <ul class="list-group clear-list">
                                        <li class="list-group-item fist-item">
                                            <span class="pull-right"> <span class="label label-danger">BLOCKED</span> </span>
                                            Hidden in the middle of text
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"><span class="label label-primary">NEW</span> </span>
                                            Non-characteristic words etc.
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right">  <span class="label label-warning">WAITING</span> </span>
                                            Bonorum et Malorum
                                        </li>
                                    </ul>
                                    <strong>Notes</strong>
                                    <p>
                                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.
                                    </p>
                                    <hr/>
                                    <strong>Timeline activity</strong>
                                    <div id="vertical-timeline" class="vertical-container dark-timeline">
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Many desktop publishing packages and web page editors now use Lorem.
                                                </p>
                                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>There are many variations of passages of Lorem Ipsum available.
                                                </p>
                                                <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon navy-bg">
                                                <i class="fa fa-warning"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>The generated Lorem Ipsum is therefore.
                                                </p>
                                                <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-coffee"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Conference on the sales results for the previous year.
                                                </p>
                                                <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                            </div>
                                        </div>
                                        <div class="vertical-timeline-block">
                                            <div class="vertical-timeline-icon gray-bg">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="vertical-timeline-content">
                                                <p>Many desktop publishing packages and web page editors now use Lorem.
                                                </p>
                                                <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                            </div>
                                        </div>
                                    </div>
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
