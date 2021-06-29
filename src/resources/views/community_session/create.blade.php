@extends('layouts.app')
@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>Community Screening Children</h2>
                        </div>
                        <div class="ibox-content">
                            {{ html()->form('POST', route('community-session.store'))->open() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Date</label>
                                            <div class="col-sm-9">
                                                {{ html()->date('date', date('Y-m-d'))->class('form-control')->required() }}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Volunteer</label>
                                            <div class="col-sm-9">
                                                {{ html()->select('volunteer_id', $volunteers)->placeholder('Select volunteer')->class('form-control')->required() }}
                                            </div>
                                        </div>
                                    </div>

                                    {{--<div class="form-group">--}}
                                        {{--<div class="row">--}}
                                            {{--<label class="col-sm-3 control-label">Household Number</label>--}}
                                            {{--<div class="col-sm-9">--}}
                                                {{--{{ html()->text('household_no')->placeholder('Household Number')->class('form-control') }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>

                            <hr>

                            <div class="table-responsive">
                                <table class="table dataTables table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>6 - 23</th>
                                        <th>24 - 59</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>SAM in Program</td>
                                        <td>
                                            M {{ html()->number('sam_ip_6_23_m')->placeholder('0')->style(['width' => '100px'])->class('input spm1') }}
                                            F {{ html()->number('sam_ip_6_23_f')->placeholder('0')->style(['width' => '100px'])->class('input spf1') }}
                                            T {{ html()->number('sam_ip_6_23_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('spt1') }}
                                        </td>
                                        <td>
                                            M {{ html()->number('sam_ip_24_59_m')->placeholder('0')->style(['width' => '100px'])->class('input spm2') }}
                                            F {{ html()->number('sam_ip_24_59_f')->placeholder('0')->style(['width' => '100px'])->class('input spf2') }}
                                            T {{ html()->number('sam_ip_24_59_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('spt2') }}
                                        </td>
                                        <td>
                                            T {{ html()->number('sam_ip_gt')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('spgt') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SAM Referred</td>
                                        <td>
                                            M {{ html()->number('sam_ref_6_23_m')->placeholder('0')->style(['width' => '100px'])->class('input srm1') }}
                                            F {{ html()->number('sam_ref_6_23_f')->placeholder('0')->style(['width' => '100px'])->class('input srf1') }}
                                            T {{ html()->number('sam_ref_6_23_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('srt1') }}
                                        </td>
                                        <td>
                                            M {{ html()->number('sam_ref_24_59_m')->placeholder('0')->style(['width' => '100px'])->class('input srm2') }}
                                            F {{ html()->number('sam_ref_24_59_f')->placeholder('0')->style(['width' => '100px'])->class('input srf2') }}
                                            T {{ html()->number('sam_ref_24_59_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('srt2') }}
                                        </td>
                                        <td>
                                            T {{ html()->number('sam_ref_gt')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('srgt') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MAM in Program</td>
                                        <td>
                                            M {{ html()->number('mam_ip_6_23_m')->placeholder('0')->style(['width' => '100px'])->class('input mpm1') }}
                                            F {{ html()->number('mam_ip_6_23_f')->placeholder('0')->style(['width' => '100px'])->class('input mpf1') }}
                                            T {{ html()->number('mam_ip_6_23_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('mpt1') }}
                                        </td>
                                        <td>
                                            M {{ html()->number('mam_ip_24_59_m')->placeholder('0')->style(['width' => '100px'])->class('input mpm2') }}
                                            F {{ html()->number('mam_ip_24_59_f')->placeholder('0')->style(['width' => '100px'])->class('input mpf2') }}
                                            T {{ html()->number('mam_ip_24_59_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('mpt2') }}
                                        </td>
                                        <td>
                                            T {{ html()->number('mam_ip_gt')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('mpgt') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MAM Referred</td>
                                        <td>
                                            M {{ html()->number('mam_ref_6_23_m')->placeholder('0')->style(['width' => '100px'])->class('input mrm1') }}
                                            F {{ html()->number('mam_ref_6_23_f')->placeholder('0')->style(['width' => '100px'])->class('input mrf1') }}
                                            T {{ html()->number('mam_ref_6_23_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('mrt1') }}
                                        </td>
                                        <td>
                                            M {{ html()->number('mam_ref_24_59_m')->placeholder('0')->style(['width' => '100px'])->class('input mrm2') }}
                                            F {{ html()->number('mam_ref_24_59_f')->placeholder('0')->style(['width' => '100px'])->class('input mrf2') }}
                                            T {{ html()->number('mam_ref_24_59_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('mrt2') }}
                                        </td>
                                        <td>
                                            T {{ html()->number('mam_ref_gt')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('mrgt') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>At Risk</td>
                                        <td>
                                            M {{ html()->number('at_risk_6_23_m')->placeholder('0')->style(['width' => '100px'])->class('input arm1') }}
                                            F {{ html()->number('at_risk_6_23_f')->placeholder('0')->style(['width' => '100px'])->class('input arf1') }}
                                            T {{ html()->number('at_risk_6_23_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('art1') }}
                                        </td>
                                        <td>
                                            M {{ html()->number('at_risk_24_59_m')->placeholder('0')->style(['width' => '100px'])->class('input arm2') }}
                                            F {{ html()->number('at_risk_24_59_f')->placeholder('0')->style(['width' => '100px'])->class('input arf2') }}
                                            T {{ html()->number('at_risk_24_59_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('art2') }}
                                        </td>
                                        <td>
                                            T {{ html()->number('at_risk_gt')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('argt') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Normal</td>
                                        <td>
                                            M {{ html()->number('normal_6_23_m')->placeholder('0')->style(['width' => '100px'])->class('input nm1') }}
                                            F {{ html()->number('normal_6_23_f')->placeholder('0')->style(['width' => '100px'])->class('input nf1') }}
                                            T {{ html()->number('normal_6_23_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('nt1') }}
                                        </td>
                                        <td>
                                            M {{ html()->number('normal_24_59_m')->placeholder('0')->style(['width' => '100px'])->class('input nm2') }}
                                            F {{ html()->number('normal_24_59_f')->placeholder('0')->style(['width' => '100px'])->class('input nf2') }}
                                            T {{ html()->number('normal_24_59_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('nt2') }}
                                        </td>
                                        <td>
                                            T {{ html()->number('normal_gt')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('ngt') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Screening</td>
                                        <td>
                                            M {{ html()->number('tot_scr_6_23_m')->placeholder('0')->readonly()->style(['width' => '100px','background'=>'yellow'])->id('tsm1') }}
                                            F {{ html()->number('tot_scr_6_23_f')->placeholder('0')->readonly()->style(['width' => '100px','background'=>'yellow'])->id('tsf1') }}
                                            T {{ html()->number('tot_scr_6_23_t')->placeholder('0')->disabled()->readonly()->style(['width' => '100px','background'=>'yellow'])->id('tst1') }}
                                        </td>
                                        <td>
                                            M {{ html()->number('tot_scr_24_59_m')->placeholder('0')->readonly()->style(['width' => '100px','background'=>'yellow'])->id('tsm2') }}
                                            F {{ html()->number('tot_scr_24_59_f')->placeholder('0')->readonly()->style(['width' => '100px','background'=>'yellow'])->id('tsf2') }}
                                            T {{ html()->number('tot_scr_24_59_t')->placeholder('0')->disabled()->readonly()->style(['width' => '100px','background'=>'yellow'])->id('tst2') }}
                                        </td>
                                        <td>
                                            T {{ html()->number('tot_scr_gt')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('tsgt') }}
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 control-label">Referred</label>
                                            <div class="col-sm-10">
                                                M {{ html()->number('referred_m')->placeholder('0')->readonly()->style(['width' => '100px', 'background'=>'yellow'])->id('trm') }}
                                                F {{ html()->number('referred_f')->placeholder('0')->readonly()->style(['width' => '100px','background'=>'yellow'])->id('trf') }}
                                                T {{ html()->number('referred_t')->placeholder('0')->disabled()->style(['width' => '100px','background'=>'yellow'])->id('trt') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-success">Save</button>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div> <!-- row -->
@endsection
@push('scripts')
<script>
    $(document).on('change keyup blur', function () {
//        SAM in Program
        var spm1 = +$(".spm1").val();
        var spf1 = +$(".spf1").val();
        $("#spt1").val(spm1+spf1);
        var spm2 = +$(".spm2").val();
        var spf2 = +$(".spf2").val();
        $("#spt2").val(spm2+spf2);
        $("#spgt").val(spm1+spf1+spm2+spf2);
//        SAM Referred
        var srm1 = +$(".srm1").val();
        var srf1 = +$(".srf1").val();
        $("#srt1").val(srm1+srf1);
        var srm2 = +$(".srm2").val();
        var srf2 = +$(".srf2").val();
        $("#srt2").val(srm2+srf2);
        $("#srgt").val(srm1+srf1+srm2+srf2);
//        MAM in Program
        var mpm1 = +$(".mpm1").val();
        var mpf1 = +$(".mpf1").val();
        $("#mpt1").val(mpm1+mpf1);
        var mpm2 = +$(".mpm2").val();
        var mpf2 = +$(".mpf2").val();
        $("#mpt2").val(mpm2+mpf2);
        $("#mpgt").val(mpm1+mpf1+mpm2+mpf2);
//        MAM Referred
        var mrm1 = +$(".mrm1").val();
        var mrf1 = +$(".mrf1").val();
        $("#mrt1").val(mrm1+mrf1);
        var mrm2 = +$(".mrm2").val();
        var mrf2 = +$(".mrf2").val();
        $("#mrt2").val(mrm2+mrf2);
        $("#mrgt").val(mrm1+mrf1+mrm2+mrf2);
//        At Risk
        var arm1 = +$(".arm1").val();
        var arf1 = +$(".arf1").val();
        $("#art1").val(arm1+arf1);
        var arm2 = +$(".arm2").val();
        var arf2 = +$(".arf2").val();
        $("#art2").val(arm2+arf2);
        $("#argt").val(arm1+arf1+arm2+arf2);
//        Normal
        var nm1 = +$(".nm1").val();
        var nf1 = +$(".nf1").val();
        $("#nt1").val(nm1+nf1);
        var nm2 = +$(".nm2").val();
        var nf2 = +$(".nf2").val();
        $("#nt2").val(nm2+nf2);
        $("#ngt").val(nm1+nf1+nm2+nf2);

        $("#tsm1").val(spm1+srm1+mpm1+mrm1+arm1+nm1);
        $("#tsf1").val(spf1+srf1+mpf1+mrf1+arf1+nf1);
        $("#tst1").val(spm1+srm1+mpm1+mrm1+arm1+nm1+spf1+srf1+mpf1+mrf1+arf1+nf1);
        $("#tsm2").val(spm2+srm2+mpm2+mrm2+arm2+nm2);
        $("#tsf2").val(spf2+srf2+mpf2+mrf2+arf2+nf2);
        $("#tst2").val(spm2+srm2+mpm2+mrm2+arm2+nm2+spf2+srf2+mpf2+mrf2+arf2+nf2);
        $("#tsgt").val(spm1+srm1+mpm1+mrm1+arm1+nm1+spf1+srf1+mpf1+mrf1+arf1+nf1+spm2+srm2+mpm2+mrm2+arm2+nm2+spf2+srf2+mpf2+mrf2+arf2+nf2);

        $("#trm").val(srm1 + srm2 + mrm1 + mrm2);
        $("#trf").val(srf1 + srf2 + mrf1 + mrf2);
        $("#trt").val(srm1 + srm2 + mrm1 + mrm2+srf1 + srf2 + mrf1 + mrf2);


    });

</script>
@endpush
