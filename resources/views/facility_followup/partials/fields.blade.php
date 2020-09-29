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
                            <div class="col-md-5">
                                <label for="">Planed Date</label>
                                <input type="hidden" name="facility_id" value="{{ Auth::user()->facility_id }}"/>
                                <input type="hidden" name="children_id" value="{{ $children->sync_id }}"/>
                                <input type="date" name="planed_date" class="form-control"
                                       value="{{ $plan_date }}">
                            </div>
                            {{--</div>--}}
                            {{--<div class="form-group row" >--}}
                            <div class="col-md-5">
                                <label for="">Actual Date</label>
                                <input type="date" name="date" class="form-control"
                                       value="{{ isset($facility_followup) ? $facility_followup->date : date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for="refered_by">Referred From</label>
                                <select name="refered_by" class="form-control">
                                    <option value="">Please Select Referral</option>
                                    <option value="MUAC Assessed at Community"
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'MUAC Assessed at Community') ? ' selected' : '' }}>
                                        MUAC Assessed at Community
                                    </option>
                                    <option value="Other Service centre" {{ (isset($facility_followup) && $facility_followup->refered_by == 'Other Service centre') ? ' selected' : '' }}>
                                        Other Service centre
                                    </option>
                                    <option value="Inpatient (SC)"
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'Inpatient (SC)') ? ' selected' : '' }}>
                                        Inpatient (SC)
                                    </option>
                                    <option value="Self"
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'Self') ? ' selected' : '' }}>
                                        Self
                                    </option>
                                    <option value="OTP"
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'OTP') ? ' selected' : '' }}>
                                        OTP
                                    </option>
                                    <option value="TSFP"
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'TSFP') ? ' selected' : '' }}>
                                        TSFP
                                    </option>
                                    <option value="BSFP"
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'BSFP') ? ' selected' : '' }}>
                                        BSFP
                                    </option>
                                    <option value="Health Facility"
                                            {{ (isset($facility_followup) && $facility_followup->refered_by == 'Health Facility') ? ' selected' : '' }}>
                                        Health Facility
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="">MUAC (cm)</label>
                                <input type="number" name="muac" class="form-control" placeholder="MUAC (cm)"
                                       id="child_muac"
                                       value="{{ isset($facility_followup) ? $facility_followup->muac : '' }}" min="0"
                                       step="0.01">
                            </div>
                            <div class="col-md-3">
                                <label for="">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" placeholder="Weight (kg)"
                                       id="child_weight"
                                       value="{{ isset($facility_followup) ? $facility_followup->weight : '' }}" min="0.1"
                                       step="0.1">
                            </div>
                            <div class="col-md-3">
                                <label for="">Height (cm)</label>
                                <input type="number" name="height" class="form-control" placeholder="Height (cm)"
                                       id="child_height"
                                       value="{{ isset($facility_followup) ? $facility_followup->height : '' }}" min="0"
                                       step="0.1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for="">WFH Z Score (SD)</label>
                                <input type="text" name="wfh_z_score" class="form-control" placeholder="WFH Z Score"
                                       id="zscore"
                                       value="{{ isset($facility_followup) ? $facility_followup->wfh_z_score : '' }}"
                                       readonly>
                            </div>
                            <div class="col-md-5">
                                <label for="">Oedema</label>
                                <select name="oedema" class="form-control" id="oedema">
                                    <option value="0" {{ (isset($facility_followup) && $facility_followup->oedema == '0') ? ' selected' : '' }}>
                                        0
                                    </option>
                                    <option value="+" {{ (isset($facility_followup) && $facility_followup->oedema == '+') ? ' selected' : '' }}>
                                        +
                                    </option>
                                    <option value="++" {{ (isset($facility_followup) && $facility_followup->oedema == '++') ? ' selected' : '' }}>
                                        ++
                                    </option>
                                    <option value="+++" {{ (isset($facility_followup) && $facility_followup->oedema == '+++') ? ' selected' : '' }}>
                                        +++
                                    </option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for="">Nutrition Status</label>
                                <select name="nutritionstatus" class="form-control" id="nutritionstatus">
                                    <option value="">Nutrition Status</option>
                                    <option value="SAM" {{ (isset($facility_followup) && $facility_followup->nutritionstatus == 'SAM') ? 'selected' : '' }}>
                                        SAM
                                    </option>
                                    <option value="MAM" {{ (isset($facility_followup) && $facility_followup->nutritionstatus == 'MAM') ? 'selected' : '' }}>
                                        MAM
                                    </option>
                                    <option value="Normal" {{ (isset($facility_followup) && $facility_followup->nutritionstatus == 'Normal') ? 'selected' : '' }}>
                                        Normal
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="">Identification Outcome</label>

                                <select name="outcome" class="form-control" id="identification-outcome">
                                    <option value="" >
                                        Select Outcome
                                    </option>
                                    <optgroup label="SAM" id="outcome_sam">
                                        <option value="SAM new case" {{ (isset($facility_followup) && $facility_followup->outcome == 'SAM new case') ? 'selected' : '' }}>
                                            SAM new case
                                        </option>
                                        <option value="Followup visit at OTP" {{ (isset($facility_followup) && $facility_followup->outcome == 'Followup visit at OTP') ? 'selected' : '' }}>
                                            Followup visit at OTP
                                        </option>
                                        <option value="Already admitted at TSFP" {{ (isset($facility_followup) && $facility_followup->outcome == 'Already admitted at TSFP') ? 'selected' : '' }}>
                                            Already admitted at TSFP
                                        </option>
                                        <option value="Referred to Other OTP" {{ (isset($facility_followup) && $facility_followup->outcome == 'Referred to Other OTP') ? 'selected' : '' }}>
                                            Referred to Other OTP
                                        </option>
                                    </optgroup>
                                    <optgroup label="MAM" id="outcome_mam">
                                        <option value="MAM new case" {{ (isset($facility_followup) && $facility_followup->outcome == 'MAM new case') ? 'selected' : '' }}>
                                            MAM new case
                                        </option>
                                        <option value="Follow up visit at TSFP" {{ (isset($facility_followup) && $facility_followup->outcome == 'Follow up visit at TSFP') ? 'selected' : '' }}>
                                            Follow up visit at TSFP
                                        </option>
                                        <option value="Already admitted at OTP" {{ (isset($facility_followup) && $facility_followup->outcome == 'Already admitted at OTP') ? 'selected' : '' }}>
                                            Already admitted at OTP
                                        </option>
                                        <option value="Referred to TSFP" {{ (isset($facility_followup) && $facility_followup->outcome == 'Referred to TSFP') ? 'selected' : '' }}>
                                            Referred to TSFP
                                        </option>
                                    </optgroup>
                                    <optgroup label="NORMAL" id="outcome_normal">
                                        <option value="Normal new case" {{ (isset($facility_followup) && $facility_followup->outcome == 'Normal new case') ? 'selected' : '' }}>
                                            Normal new case
                                        </option>
                                        <option value="Already in TSFP Program" {{ (isset($facility_followup) && $facility_followup->outcome == 'Already in TSFP Program') ? 'selected' : '' }}>
                                            Already in TSFP Program
                                        </option>
                                        <option value="Referred to BSFP" {{ (isset($facility_followup) && $facility_followup->outcome == 'Referred to BSFP') ? 'selected' : '' }}>
                                            Referred to BSFP
                                        </option>
                                        <option value="Follow up visit at BSFP" {{ (isset($facility_followup) && $facility_followup->outcome == 'Follow up visit at BSFP') ? 'selected' : '' }}>
                                            Follow up visit at BSFP
                                        </option>
                                    </optgroup>


                                </select>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <h1>Medical and Physical</h1>

        <div class="row step-content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins ">
                        <div class="ibox-title">
                            <h5>General Information</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                <label for="">Continued Breastfeeding</label>
                                <select name="continued_breastfeeding" class="form-control">
                                    <option value="">Select Continued Breastfeeding</option>
                                    <option value="Yes" {{ (isset($facility_followup) && $facility_followup->continued_breastfeeding == 'Yes') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ (isset($facility_followup) && $facility_followup->continued_breastfeeding == 'No') ? ' selected' : '' }}>
                                        No
                                    </option>
                                    <option value="N/A" {{ (isset($facility_followup) && $facility_followup->continued_breastfeeding == 'N/A') ? ' selected' : '' }}>
                                        N/A
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Complementary Feeding</label>
                                <input type="text" name="complementary_feeding_frequency" class="form-control"
                                       placeholder="Frequency (How many times)"
                                       value="{{ isset($facility_followup) ? $facility_followup->complementary_feeding_frequency : '' }}">
                                <br/>
                                <input type="number" name="complementary_feeding_introduction_time" class="form-control"
                                       placeholder="Introduction Time (Age of child in month)"
                                       value="{{ isset($facility_followup) ? $facility_followup->complementary_feeding_introduction_time : '' }}"
                                       min="0">
                                <br/>
                                <input type="text" name="complementary_feeding_foodtype" class="form-control"
                                       placeholder="Type of Food"
                                       value="{{ isset($facility_followup) ? $facility_followup->complementary_feeding_foodtype : '' }}">
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins ">
                        <div class="ibox-title">
                            <h5>Medical History</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="">Diarrhoea (no of days)</label>
                                <input type="number" name="medical_history_diarrhoea" class="form-control"
                                       placeholder="Diarrhoea (no of days)"
                                       value="{{ isset($facility_followup) ? $facility_followup->medical_history_diarrhoea : '' }}"
                                       min="0" step="1">
                            </div>
                            <div class="form-group">
                                <label for="">Vomiting (no of days)</label>
                                <input type="number" name="medical_history_vomiting" class="form-control"
                                       placeholder="Vomiting (no of days)"
                                       value="{{ isset($facility_followup) ? $facility_followup->medical_history_vomiting : '' }}"
                                       min="0" step="1">
                            </div>
                            <div class="form-group">
                                <label for="">Fever (no of days)</label>
                                <input type="number" name="medical_history_fever" class="form-control"
                                       placeholder="Fever (no of days)"
                                       value="{{ isset($facility_followup) ? $facility_followup->medical_history_fever : '' }}"
                                       min="0" step="1">
                            </div>
                            <div class="form-group">
                                <label for="">Cough (no of days)</label>
                                <input type="number" name="medical_history_cough" class="form-control"
                                       placeholder="Cough (no of days)"
                                       value="{{ isset($facility_followup) ? $facility_followup->medical_history_cough : '' }}"
                                       min="0" step="1">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Others (specific)</label>
                                        <input type="text" name="medical_history_others_detail" class="form-control"
                                               placeholder="Others (specific)"
                                               value="{{ isset($facility_followup) ? $facility_followup->medical_history_others_detail : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No of days</label>
                                        <input type="number" name="medical_history_others" class="form-control"
                                               placeholder="Others (specific)(no of days)"
                                               value="{{ isset($facility_followup) ? $facility_followup->medical_history_others : '' }}"
                                               min="0" step="1">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6">
                    <div class="ibox float-e-margins ">
                        <div class="ibox-title">
                            <h5>Physical Examination</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="">Temperature (oF)</label>
                                <input type="number" name="temperature" class="form-control"
                                       placeholder="Temperature (oF)"
                                       value="{{ isset($facility_followup) ? $facility_followup->temperature : '' }}"
                                       min="0" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="">Respiratory rate (breaths/min)</label>
                                <input type="number" name="respiratory_rate" class="form-control"
                                       placeholder="Respiratory rate (breaths/min)"
                                       value="{{ isset($facility_followup) ? $facility_followup->respiratory_rate : '' }}"
                                       min="0" step="1">
                            </div>

                            <div class="form-group">
                                <label for="">Sign of dehydration</label>
                                <select name="sign_of_dehydration" class="form-control">
                                    <option value="">Select sign of dehydration</option>
                                    <option value="Yes" {{ (isset($facility_followup) && $facility_followup->sign_of_dehydration == 'Yes') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ (isset($facility_followup) && $facility_followup->sign_of_dehydration == 'No') ? ' selected' : '' }}>
                                        No
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Pneumonia</label>
                                <select name="pneumonia" class="form-control">
                                    <option value="">Select Pneumonia</option>
                                    <option value="Yes" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'Yes') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'No') ? ' selected' : '' }}>
                                        No
                                    </option>
                                    <option value="Severe" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'Severe') ? ' selected' : '' }}>
                                        Severe
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Signs of anaemia/Palmar</label>
                                <select name="anaemiapalmer" class="form-control">
                                    <option value="">Signs of anaemia/palmer</option>
                                    <option value="Yes" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'Yes') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'No') ? ' selected' : '' }}>
                                        No
                                    </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Skin changes/lesions</label>
                                <select name="skin_changes" class="form-control">
                                    <option value="">Select skin changes/lesions</option>
                                    <option value="Yes" {{ (isset($facility_followup) && $facility_followup->skin_changes == 'Yes') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ (isset($facility_followup) && $facility_followup->skin_changes == 'No') ? ' selected' : '' }}>
                                        No
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Pale conjunctiva</label>
                                <select name="pale_conjunctiva" class="form-control">
                                    <option value="">Select pale conjunctiva</option>
                                    <option value="Yes" {{ (isset($facility_followup) && $facility_followup->pale_conjunctiva == 'Yes') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ (isset($facility_followup) && $facility_followup->pale_conjunctiva == 'No') ? ' selected' : '' }}>
                                        No
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ibox float-e-margins ">
                        <div class="ibox-title">
                            <h5>Appetite test</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="">Presence of appetite</label>
                                <select name="presence_of_appetite" class="form-control">
                                    <option value="">Select presence of appetite</option>
                                    <option value="Yes" {{ (isset($facility_followup) && $facility_followup->presence_of_appetite == 'Yes') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No" {{ (isset($facility_followup) && $facility_followup->presence_of_appetite == 'No') ? ' selected' : '' }}>
                                        No
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ibox float-e-margins ">
                        <div class="ibox-title">
                            <h5>Systemetic treatment</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="">Antibiotic</label>
                                <select name="antibiotic" class="form-control">
                                    <option value="">Select antibiotic</option>
                                    <option value="125mg (6-11m)" {{ (isset($facility_followup) && $facility_followup->antibiotic == '125mg (6-11m)') ? ' selected' : '' }}>
                                        125mg (6-11m)
                                    </option>
                                    <option value="187.5mg (12-23m)" {{ (isset($facility_followup) && $facility_followup->antibiotic == '187.5mg (12-23m)') ? ' selected' : '' }}>
                                        187.5mg (12-23m)
                                    </option>
                                    <option value="250mg (24-59m)" {{ (isset($facility_followup) && $facility_followup->antibiotic == '250mg (24-59m)') ? ' selected' : '' }}>
                                        250mg (24-59m)
                                    </option>
                                    <option value="Not Applicable" {{ (isset($facility_followup) && $facility_followup->antibiotic == 'Not Applicable') ? ' selected' : '' }}>
                                        Not Applicable
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Albendazole</label>
                                <select name="albendazole" class="form-control">
                                    <option value="">Select albendazole</option>
                                    <option value="200mg (12-23m)" {{ (isset($facility_followup) && $facility_followup->albendazole == '200mg (12-23m)') ? ' selected' : '' }}>
                                        200mg (12-23m)
                                    </option>
                                    <option value="400mg (>24m)" {{ (isset($facility_followup) && $facility_followup->albendazole == '400mg (>24m)') ? ' selected' : '' }}>
                                        400mg (>24m)
                                    </option>
                                    <option value="Not applicable" {{ (isset($facility_followup) && $facility_followup->albendazole == 'Not applicable') ? ' selected' : '' }}>
                                        Not Applicable
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">

                                <label for="">Albendazole Received Date</label>
                                <input type="date" name="albendazole_date" class="form-control"
                                       value="{{ isset($facility_followup) ? $facility_followup->albendazole_date : '' }}">

                            </div>

                            <div class="form-group">
                                <label for="">Received all EPI vaccinations as per schedule</label>
                                <select name="received_all_epi_vaccination" class="form-control">
                                    <option value="">Select EPI vaccinations</option>
                                    <option value="1" {{ (isset($facility_followup) && $facility_followup->received_all_epi_vaccination == '1') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="0" {{ (isset($facility_followup) && $facility_followup->received_all_epi_vaccination == '0') ? ' selected' : '' }}>
                                        No
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="measles">Received Measles Vaccination</label>
                                <select name="measles" class="form-control">
                                    <option value="">Select Measles</option>
                                    <option value="Yes" {{ (isset($facility_followup) && $facility_followup->measles == 'Yes') ? ' selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="No"{{ (isset($facility_followup) && $facility_followup->measles == 'No') ? ' selected' : '' }}>
                                        No
                                    </option>
                                    <option value="Not Applicable" {{ (isset($facility_followup) && $facility_followup->measles == 'Not Applicable') ? ' selected' : '' }}>
                                        Not Applicable
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="background-color: red; color: white">
                <div class="form-group" >
                    {{--<label class="col-sm-6 control-label" >Any complicacy found ? </label>--}}
                    {{--<div class="col-sm-6" >--}}
                        {{--<input style="display: inline" type="radio" name="complicacy_found" value="1" {{ (isset($child) && $child->sex == '1') ? ' checked' : '' }}> Yes--}}
                        {{--<input style="display: inline" type="radio" name="complicacy_found" value="0" {{ (isset($child) && $child->sex == '0') ? ' checked' : '' }}> No--}}
                    &nbsp; &nbsp; &nbsp; <input style="display: inline" type="radio" name="medical_complecation" value="0" {{ (isset($facility_followup) && $facility_followup->medical_complecation == '0') ? ' checked' : '' }}/>
                        <label style="display: inline">No medical complecation</label>
                        <input style="display: inline" type="radio" name="medical_complecation" value="1" {{ (isset($facility_followup) && $facility_followup->medical_complecation == '1') ? ' checked' : '' }}/>
                        <label style="display: inline">Medical complecation (Referred to SC)</label>
                        <input style="display: inline" type="radio" name="medical_complecation" value="2" {{ (isset($facility_followup) && $facility_followup->medical_complecation == '2') ? ' checked' : '' }}/>
                        <label style="display: inline">Medical complecation (Keep in OTP)</label>
                    {{--</div>--}}
                </div>
                {{--<div class="form-group" >--}}
                    {{--&nbsp; &nbsp; &nbsp; <input type="radio" name="medical_complecation" value="0" class="form-control"/>--}}
                    {{--<label >No medical complecation</label>--}}
                {{--&nbsp; &nbsp; &nbsp; <input type="radio" name="medical_complecation" value="1" class="form-control"/>--}}
                {{--<label >Medical complecation (Referred to SC)</label>--}}
                {{--&nbsp; &nbsp; &nbsp; <input type="radio" name="medical_complecation" value="2" class="form-control"/>--}}
                {{--<label >Medical complecation (Keep in OTP)</label>--}}
            {{--</div>--}}
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
                            <label for="">New admission</label>
                            <select name="new_admission" class="form-control">
                                <option value="">Select new admission</option>
                                <option value="MUAC" {{ (isset($facility_followup) && $facility_followup->new_admission == 'MUAC') ? ' selected' : '' }}>
                                    MUAC
                                </option>
                                <option value="WFH Zscore" {{ (isset($facility_followup) && $facility_followup->new_admission == 'WFH Zscore') ? ' selected' : '' }}>
                                    WFH Z score
                                </option>
                                <option value="MUAC and WFH Zscore" {{ (isset($facility_followup) && $facility_followup->new_admission == 'MUAC and WFH Zscore') ? ' selected' : '' }}>
                                    MUAC and WFH Zscore
                                </option>
                                <option value="Oedema" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Oedema') ? ' selected' : '' }}>
                                    Oedema
                                </option>
                                <option value="Age 6 to 59m" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Age 6 to 59m') ? ' selected' : '' }}>
                                    Age 6 to 59m
                                </option>
                                <option value="Relapse" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Relapse') ? ' selected' : '' }}>
                                    Relapse
                                </option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="">Readmission</label>
                            <select name="readmission" class="form-control">
                                <option value="">Select readmission</option>
                                <option value="Readmission after default" {{ (isset($facility_followup) && $facility_followup->readmission == 'Readmission after default') ? ' selected' : '' }}>
                                    Readmission after default
                                </option>
                                <option value="Readmission after non recovery" {{ (isset($facility_followup) && $facility_followup->readmission == 'Readmission after non recovery') ? ' selected' : '' }}>
                                    Readmission after non recovery
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Transfer in</label>
                            <select name="transfer_in" class="form-control">
                                <option value="">Select transfer in</option>
                                <option value="Transfer in from TSFP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from TSFP') ? ' selected' : '' }}>
                                    Transfer in from TSFP
                                </option>
                                <option value="Transfer in from SC" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from SC') ? ' selected' : '' }}>
                                    Transfer in from SC
                                </option>
                                <option value="Transfer in from OTP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from OTP') ? ' selected' : '' }}>
                                    Transfer in from OTP
                                </option>
                                <option value="Transfer in from BSFP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from BSFP') ? ' selected' : '' }}>
                                    Transfer in from BSFP
                                </option>
                                <option value="Transfer in from Medical Center" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from Medical Center') ? ' selected' : '' }}>
                                    Transfer in from Medical Center
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Return from</label>
                            <select name="return_from" class="form-control">
                                <option value="">Select return from</option>
                                <option value="SAM Treatment" {{ (isset($facility_followup) && $facility_followup->return_from == 'SAM Treatment') ? ' selected' : '' }}>
                                    SAM Treatment
                                </option>
                                <option value="MAM Treatement" {{ (isset($facility_followup) && $facility_followup->return_from == 'MAM Treatement') ? ' selected' : '' }}>
                                    MAM Treatement
                                </option>
                                <option value="Inpatient Treatement" {{ (isset($facility_followup) && $facility_followup->return_from == 'Inpatient Treatement') ? ' selected' : '' }}>
                                    Inpatient Treatement
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 discharge-criteria-tab discharge-criteria-tabs" id="discharge-criteria-tab">
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
                                <option value="Recovered" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Recovered') ? ' selected' : '' }}>
                                    Recovered
                                </option>
                                <option value="Age > 59m" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Age > 59m') ? ' selected' : '' }}>
                                    Age > 59m
                                </option>
                                <option value="Death" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Death') ? ' selected' : '' }}>
                                    Death
                                </option>
                                <option value="Defaulted" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Defaulted') ? ' selected' : '' }}>
                                    Defaulted
                                </option>
                                <option value="Non responder" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Non responder') ? ' selected' : '' }}>
                                    Non responder
                                </option>
                                {{--                                <option value="Medical Transfer" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Medical Transfer') ? ' selected' : '' }}>Medical Transfer </option>--}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Transfer out</label>
                            <select name="discharge_criteria_transfer_out" class="form-control">
                                <option value="">Select transfer out</option>
                                <option value="Transfer to SAM treatment" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to SAM treatment') ? ' selected' : '' }}>
                                    Transfer to SAM treatment
                                </option>
                                <option value="Transfer to MAM treatment" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to MAM treatment') ? ' selected' : '' }}>
                                    Transfer to MAM treatment
                                </option>
                                <option value="Transfer to SC" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to SC') ? ' selected' : '' }}>
                                    Transfer to SC
                                </option>
                                <option value="Transfer to other OTP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other OTP') ? ' selected' : '' }}>
                                    Transfer to other OTP
                                </option>
                                <option value="Transfer to other TSFP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other TSFP') ? ' selected' : '' }}>
                                    Transfer to other TSFP
                                </option>
                                <option value="Transfer to other BSFP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other BSFP') ? ' selected' : '' }}>
                                    Transfer to other BSFP
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Others</label>
                            <select name="discharge_criteria_others" class="form-control">
                                <option value="">Select others</option>
                                <option value="Medical transfer" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_others == 'Medical transfer') ? ' selected' : '' }}>
                                    Medical transfer
                                </option>
                                <option value="Unkown" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_others == 'Unkown') ? ' selected' : '' }}>
                                    Unkown
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 discharge-criteria-tabs">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>Anthropometric Measurement during discharge</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="">Discharge weight (kg)</label>
                            <input type="number" name="discharge_weight_kg" class="form-control"
                                   placeholder="Discharge weight (kg)"
                                   value="{{ isset($facility_followup) ? $facility_followup->discharge_weight_kg : '' }}"
                                   min="0" step="0.1">
                        </div>
                        <div class="form-group">
                            <label for="">Lowest weight (kg)</label>
                            <input type="number" name="lowest_weight_kg" class="form-control"
                                   placeholder="Lowest weight (kg)"
                                   value="{{ isset($facility_followup) ? $facility_followup->lowest_weight_kg : '' }}"
                                   min="0" step="0.1">
                        </div>
                        <div class="form-group">
                            <label for="">Duration between lowest weight and discharged weight (days)</label>
                            <input type="number" name="duration_between_lowest_weight_and_discharged_weight_days"
                                   class="form-control"
                                   placeholder="Duration between lowest weight and discharged weight (days)"
                                   value="{{ isset($facility_followup) ? $facility_followup->duration_between_lowest_weight_and_discharged_weight_days : '' }}"
                                   min="0">
                        </div>
                        <div class="form-group">
                            <label for="">Gain of weight</label>
                            <input type="number" name="gain_of_weight" class="form-control" placeholder="Gain of weight"
                                   value="{{ isset($facility_followup) ? $facility_followup->gain_of_weight : '' }}"
                                   min="0" step="0.1">
                        </div>
                        <div class="form-group">
                            <label for="">Duration between discharged and admission days (LOS) (days)</label>
                            <input type="number" name="duration_between_discharged_and_admission_days"
                                   class="form-control"
                                   placeholder="Duration between discharged and admission days (LOS) (days)"
                                   value="{{ isset($facility_followup) ? $facility_followup->duration_between_discharged_and_admission_days : '' }}"
                                   min="0">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End of Second Row -->
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
                        <div class="form-group rutf" id="rutf">
                            <label for="">No of RUTF</label>
                            <input type="number" name="no_of_rutf" class="form-control" placeholder="No of RUTF"
                                   value="{{ isset($facility_followup) ? $facility_followup->no_of_rutf : '' }}"
                                   min="0">
                        </div>
                        <div class="form-group rusf" id="rusf">
                            <label for="">No of RUSF</label>
                            <input type="number" name="no_of_rusf" class="form-control" placeholder="No of RUSF"
                                   value="{{ isset($facility_followup) ? $facility_followup->no_of_rusf : '' }}"
                                   min="0">
                        </div>
                        <div class="form-group wsbpp" id="wsbp">
                            <label for="">Super Cerial Plus (WSB++)(kg)</label>
                            <input type="number" name="wsb_plus_plus_kg" class="form-control"
                                   placeholder="Super Cerial Plus (WSB++)(kg)"
                                   value="{{ isset($facility_followup) ? $facility_followup->wsb_plus_plus_kg : '' }}"
                                   min="0.5" step="0.5">
                        </div>
                        {{--<div class="form-group wsbp" id="wsbp">--}}
                        {{--<label for="">WSB+ (kg)</label>--}}
                        {{--<input type="number" name="wsb_plus_kg" class="form-control" placeholder="WSB+ (kg)" value="{{ isset($facility_followup) ? $facility_followup->wsb_plus_kg : '' }}" min="0">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                        {{--<label for="">Oil (kg)</label>--}}
                        {{--<input type="number" name="oil_kg" class="form-control" placeholder="Oil (kg)" value="{{ isset($facility_followup) ? $facility_followup->oil_kg : '' }}" min="0">--}}
                        {{--</div>--}}
                        <div class="form-group others" id="others">
                            <label for="">Others</label>
                            <input type="number" name="others" class="form-control" placeholder="Others"
                                   value="{{ isset($facility_followup) ? $facility_followup->others : '' }}" min="0">
                        </div>
                        <div class="form-group">
                            <label>Next visit date *</label>
                            <input type="date" name="next_visit_date" class="form-control"
                                   value="{{ isset($facility_followup) ? $facility_followup->next_visit_date : '' }}">
                        </div>

                    </div>
                </div>
            </div>


        </div><!-- End of Second Row -->

    </div>


</div>
