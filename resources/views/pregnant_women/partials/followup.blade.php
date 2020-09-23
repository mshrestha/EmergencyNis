<div class="row">
    <div class="col-md-12" id="wizard">
        <h1>Anthro Measurement</h1>
        <div class="row step-content">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Anthropometric Measurement</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="">Planed Date</label>
                                <input type="hidden" name="facility_id" value="{{ Auth::user()->facility_id }}"/>
                                <input type="hidden" name="pregnant_women_id" value="{{ $pregnant_women_id }}"/>
                                <input type="date" name="planed_date" class="form-control"
                                       value="{{ isset($pregnant_followup) ? $pregnant_followup->planed_date : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="">Actual Date</label>
                                <input type="date" name="actual_date" class="form-control"
                                       value="{{ isset($pregnant_followup) ? $pregnant_followup->actual_date : date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">MUAC (cm)</label>
                                <input type="number" name="muac" class="form-control" placeholder="MUAC (cm)"
                                       value="{{ isset($pregnant_followup) ? $pregnant_followup->muac : '' }}" min="0"
                                       step="0.01">
                            </div>
                            <div class="col-md-6">
                                <label for="">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" placeholder="Weight (kg)"
                                       value="{{ isset($pregnant_followup) ? $pregnant_followup->weight : '' }}" min="0"
                                       step="0.01">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Nutrition Status</label>
                                <select name="nutritionstatus" class="form-control" id="nutritionstatus">
                                    <option value="">Nutrition Status</option>
                                    <option value="MAM" {{ (isset($pregnant_followup) && $pregnant_followup->nutritionstatus == 'MAM') ? ' selected' : '' }}>
                                        MAM
                                    </option>
                                    <option value="Normal" {{ (isset($pregnant_followup) && $pregnant_followup->nutritionstatus == 'Normal') ? ' selected' : '' }}>
                                        Normal
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Identification Outcome</label>

                                <select name="outcome" class="form-control" id="identification-outcome">
                                    <optgroup label="MAM" id="outcome_mam">
                                        <option value="New case">New Case</option>
                                        <option value="Follow up visit at TSFP">Follow up visit at TSFP</option>
                                        <option value="Already admitted at OTP">Already admitted at OTP</option>
                                        <option value="Referred to TSFP">Referred to TSFP</option>
                                    </optgroup>
                                    <optgroup label="NORMAL" id="outcome_normal">
                                        <option value="New case">New Case</option>
                                        <option value="Already in Program">Already in program</option>
                                        <option value="Referred to BSFP">Referred to BSFP</option>
                                        <option value="Follow up visit at BSFP">Follow up visit at BSFP</option>
                                    </optgroup>


                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <h1><span id="admission-discharge-tab-heading">Admission Criteria</span></h1>

        <div class="row step-content">
            <div class="col-lg-12 admission-criteria-tab" id="admission-criteria-tab">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>Admission criteria</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">New admission</label>
                            <div class="col-sm-9">
                                <select name="new_admission" class="form-control">
                                    <option value="">Select new admission</option>
                                    <option value="MUAC" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'MUAC') ? ' selected' : '' }}>
                                        MUAC
                                    </option>
                                    <option value="WFH Zscore" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'WFH Zscore') ? ' selected' : '' }}>
                                        WFH Z score
                                    </option>
                                    <option value="MUAC and WFH Zscore" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'MUAC and WFH Zscore') ? ' selected' : '' }}>
                                        MUAC and WFH Zscore
                                    </option>
                                    <option value="Oedema" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'Oedema') ? ' selected' : '' }}>
                                        Oedema
                                    </option>
                                    <option value="Age 6 to 59m" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'Age 6 to 59m') ? ' selected' : '' }}>
                                        Age 6 to 59m
                                    </option>
                                    <option value="Relapse" {{ (isset($pregnant_women) && $pregnant_women->new_admission == 'Relapse') ? ' selected' : '' }}>
                                        Relapse
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Readmission</label>
                            <div class="col-sm-9">
                                <select name="readmission" class="form-control">
                                    <option value="">Select readmission</option>
                                    <option value="Readmission after default" {{ (isset($pregnant_women) && $pregnant_women->readmission == 'Readmission after default') ? ' selected' : '' }}>
                                        Readmission after default
                                    </option>
                                    <option value="Readmission after non recovery" {{ (isset($pregnant_women) && $pregnant_women->readmission == 'Readmission after non recovery') ? ' selected' : '' }}>
                                        Readmission after non recovery
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Transfer in</label>
                            <div class="col-sm-9">
                                <select name="transfer_in_from" class="form-control">
                                    <option value="">Select transfer in</option>
                                    <option value="Transfer in from TSFP" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from TSFP') ? ' selected' : '' }}>
                                        Transfer in from TSFP
                                    </option>
                                    <option value="Transfer in from SC" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from SC') ? ' selected' : '' }}>
                                        Transfer in from SC
                                    </option>
                                    <option value="Transfer in from OTP" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from OTP') ? ' selected' : '' }}>
                                        Transfer in from OTP
                                    </option>
                                    <option value="Transfer in from BSFP" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from BSFP') ? ' selected' : '' }}>
                                        Transfer in from BSFP
                                    </option>
                                    <option value="Transfer in from Medical Center" {{ (isset($pregnant_women) && $pregnant_women->transfer_in_from == 'Transfer in from Medical Center') ? ' selected' : '' }}>
                                        Transfer in from Medical Center
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Referred From</label>
                            <div class="col-sm-9">
                                <select name="referred_from" class="form-control">
                                    <option value="">Please Select Referral</option>
                                    <option value="MUAC Assessed at Community" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'MUAC Assessed at Community') ? ' selected' : '' }}>
                                        MUAC Assessed at Community
                                    </option>
                                    <option value="Other Service centre" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'Other Service centre') ? ' selected' : '' }}>
                                        Other Service centre
                                    </option>
                                    <option value="Inpatient (SC)" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'Inpatient (SC)') ? ' selected' : '' }}>
                                        Inpatient (SC)
                                    </option>
                                    <option value="Self" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'Self') ? ' selected' : '' }}>
                                        Self
                                    </option>
                                    <option value="OTP" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'OTP') ? ' selected' : '' }}>
                                        OTP
                                    </option>
                                    <option value="TSFP" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'TSFP') ? ' selected' : '' }}>
                                        TSFP
                                    </option>
                                    <option value="BSFP" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'BSFP') ? ' selected' : '' }}>
                                        BSFP
                                    </option>
                                    <option value="Health Facility" {{ (isset($pregnant_women) && $pregnant_women->referred_from == 'Health Facility') ? ' selected' : '' }}>
                                        Health Facility
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Next visit date</label>
                            <div class="col-sm-9">
                                <input type="date" name="next_visit_date" class="form-control"
                                       value="{{ isset($pregnant_women) ? $pregnant_women->next_visit_date : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 discharge-criteria-tab discharge-criteria-tabs" id="discharge-criteria-tab">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>Discharge Critera</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="">Exit</label>
                            <select name="discharge_criteria_exit" class="form-control">
                                <option value="">Select exit</option>
                                <option value="Cured PLW to BSFP" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_exit == 'Cured PLW to BSFP') ? ' selected' : '' }}>
                                    Cured PLW to BSFP
                                </option>
                                <option value="Cured Other" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_exit == 'Cured Other') ? ' selected' : '' }}>
                                    Cured Other
                                </option>
                                <option value="Child become 6 Month Old" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_exit == 'Child become 6 Month Old') ? ' selected' : '' }}>
                                    Child become 6 Month Old
                                </option>
                                <option value="Death" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_exit == 'Death') ? ' selected' : '' }}>
                                    Death
                                </option>
                                <option value="Defaulted" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_exit == 'Defaulted') ? ' selected' : '' }}>
                                    Defaulted
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Transfer out</label>
                            <select name="discharge_criteria_transfer_out" class="form-control">
                                <option value="">Select transfer out</option>
                                <option value="Transfer to SAM treatment" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_transfer_out == 'Transfer to SAM treatment') ? ' selected' : '' }}>
                                    Transfer to SAM treatment
                                </option>
                                <option value="Transfer to MAM treatment" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_transfer_out == 'Transfer to MAM treatment') ? ' selected' : '' }}>
                                    Transfer to MAM treatment
                                </option>
                                <option value="Transfer to SC" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_transfer_out == 'Transfer to SC') ? ' selected' : '' }}>
                                    Transfer to SC
                                </option>
                                <option value="Transfer to other OTP" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_transfer_out == 'Transfer to other OTP') ? ' selected' : '' }}>
                                    Transfer to other OTP
                                </option>
                                <option value="Transfer to other TSFP" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_transfer_out == 'Transfer to other TSFP') ? ' selected' : '' }}>
                                    Transfer to other TSFP
                                </option>
                                <option value="Transfer to other BSFP" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_transfer_out == 'Transfer to other BSFP') ? ' selected' : '' }}>
                                    Transfer to other BSFP
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Others</label>
                            <select name="discharge_criteria_others" class="form-control">
                                <option value="">Select others</option>
                                <option value="Medical transfer" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_others == 'Medical transfer') ? ' selected' : '' }}>
                                    Medical transfer
                                </option>
                                <option value="Unkown" {{ (isset($pregnant_followup) && $pregnant_followup->discharge_criteria_others == 'Unkown') ? ' selected' : '' }}>
                                    Unkown
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End of Second Row -->

        <h1>Health Education</h1>
        <div class="row step-content">
            <div class="col-lg-12">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>Health Education</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="">Nutrition Education</label>
                            <select name="nutrition_education" class="form-control">
                                <option value="">Select Nutrition Education</option>
                                <option value="1" {{ (isset($pregnant_followup) && $pregnant_followup->nutrition_education == '1') ? ' selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0" {{ (isset($pregnant_followup) && $pregnant_followup->nutrition_education == '0') ? ' selected' : '' }}>
                                    No
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nutrition Counseling </label>
                            <select name="nutrition_counseling" class="form-control">
                                <option value="">Select Nutrition Counseling</option>
                                <option value="1" {{ (isset($pregnant_followup) && $pregnant_followup->nutrition_counseling == '1') ? ' selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0" {{ (isset($pregnant_followup) && $pregnant_followup->nutrition_counseling == '0') ? ' selected' : '' }}>
                                    No
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">If Nutrition Counseling is Yes, please write discussion point </label>
                            <input type="text" name="discussion" class="form-control" placeholder="Discussion point"
                                   value="{{ isset($pregnant_followup) ? $pregnant_followup->discussion_point : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="">Received Iron/Folic Tab.</label>
                            <select name="nutrition_education" class="form-control">
                                <option value="">Received Iron/Folic Tab.</option>
                                <option value="1" {{ (isset($pregnant_followup) && $pregnant_followup->receive_iron_folic == '1') ? ' selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0" {{ (isset($pregnant_followup) && $pregnant_followup->receive_iron_folic == '0') ? ' selected' : '' }}>
                                    No
                                </option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <h1>Distribution</h1>
        <div class="row step-content">
            <div class="col-lg-12">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>Therapeutic food</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="">Super Cereal WSB+ (kg)</label>
                            <input type="number" name="wsb_plus_kg" class="form-control"
                                   placeholder="Super Cereal WSB+ (kg)"
                                   value="{{ isset($pregnant_followup) ? $pregnant_followup->wsb_plus_kg : '' }}"
                                   min="0">
                        </div>
                        <div class="form-group">
                            <label for="">Oil (kg)</label>
                            <input type="number" name="oil_kg" class="form-control" placeholder="Oil (kg)"
                                   value="{{ isset($pregnant_followup) ? $pregnant_followup->oil_kg : '' }}" min="0">
                        </div>
                        <div class="form-group">
                            <label for="">Others</label>
                            <input type="number" name="others" class="form-control" placeholder="Others"
                                   value="{{ isset($pregnant_followup) ? $pregnant_followup->others : '' }}" min="0">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End of Second Row -->
    </div>
</div>
