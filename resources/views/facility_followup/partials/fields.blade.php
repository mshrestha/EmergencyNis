<div class="row">
	<div class="col-md-12">
		<div class="row">
			

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
						<div class="form-group row" >
                            <div class="col-md-5">
                                <label for="">Date</label>
                                <input type="hidden" name="facility_id" value="{{ Auth::user()->facility_id }}" />
                                <input type="hidden" name="children_id" value="{{ $children->id }}" />
                                <input type="date" name="date" class="form-control" value="{{ isset($facility_followup) ? $facility_followup->date : date('Y-m-d') }}"> 
                            </div>
						</div>
                        <div class="form-group row">
                        <div class="col-md-5">
                                <label for="">Referred From</label>
                                <select name="oedema" class="form-control">
                                    <option value="" >Please Select Referral</option>
                                    <option value="" >MUAC Assessed at Community</option>
                                    <option value="" >Other Service centre</option>
                                    <option value="" >Inpatient (SC)</option>
                                    <option value="" >Self</option>
                                    <option value="" >OTP</option>
                                    <option value="" >TSFP</option>
                                    <option value="" >BSFP</option>
                                    <option value="" >Health Facility</option>

                                
							     </select>
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-md-3">
                                <label for="">MUAC (cm)</label>
                                <input type="number" name="muac" class="form-control" placeholder="MUAC (cm)" value="{{ isset($facility_followup) ? $facility_followup->muac : '' }}" min="0" step="0.01">
                            </div>
                            <div class="col-md-3">
                                <label for="">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" placeholder="Weight (kg)" value="{{ isset($facility_followup) ? $facility_followup->weight : '' }}" min="0" step="0.01">
						    </div>
                            <div class="col-md-3">
                                <label for="">Height (cm)</label>
                                <input type="number" name="height" class="form-control" placeholder="Height (cm)" value="{{ isset($facility_followup) ? $facility_followup->height : '' }}" min="0" step="0.01">
                            </div>
						</div>
						<div class="form-group row">
                            <div class="col-md-5">
                                <label for="">WFH Z Score (SD)</label>
                                <input type="text" name="wfh_z_score" class="form-control" placeholder="WFH Z Score" value="{{ isset($facility_followup) ? $facility_followup->wfh_z_score : '' }}" min="0">
                            </div>
                            <div class="col-md-5">
                                <label for="">Oedema</label>
                                <select name="oedema" class="form-control">
                                    <option value="0" {{ (isset($facility_followup) && $facility_followup->oedema == '0') ? ' selected' : '' }}>0</option>
                                    <option value="+" {{ (isset($facility_followup) && $facility_followup->oedema == '+') ? ' selected' : '' }}>+</option>
                                    <option value="++" {{ (isset($facility_followup) && $facility_followup->oedema == '++') ? ' selected' : '' }}>++</option>
                                    <option value="+++" {{ (isset($facility_followup) && $facility_followup->oedema == '+++') ? ' selected' : '' }}>+++</option>
                                
							     </select>
                                </div>
						</div>
                        <div class="form-group row">
                        <div class="col-md-5">
                                <label for="">Nutrition Status</label>
                                <select name="nutritionstatus" class="form-control">
                                    <option value="" >Nutrition Status</option>
                                    <option value="" >SAM</option>
                                    <option value="" >MAM</option>
                                    <option value="" >Normal</option>
                                    
                                
							     </select>
                            </div>
                            <div class="col-md-5">
                                <label for="">Identification Outcome</label>
                                <select name="outcome" class="form-control">
                                    <optgroup label="SAM">
                                        <option value="New case" >New case</option>
                                        <option value="Followup visit at OTP" >Followup visit at OTP</option>
                                        <option value="Already admitted at TSFP" >Already admitted at TSFP</option>
                                        <option value="Referred to OTP" >Referred to OTP</option>
                                        
                                    </optgroup>
                                    <optgroup label="MAM">
                                        <option value="OTP follow up visit" >OTP follow up visit</option>
                                        <option value="Already admitted at TSFP" >Already admitted at TSFP</option>
                                        <option value="Referred to TSFP" >Referred to TSFP</option>
                                        
                                        <option value="New Case" >New Case</option>
                                        <option value="Follow up visit at TSFP" >Follow up visit at TSFP</option>
                                        <option value="Already admitted at TSFP" >Already admitted at TSFP</option>
                                        <option value="Referred to TSFP" >Referred to TSFP</option>
                                    </optgroup>
                                    <optgroup label="normal">
                                        <option value="Already in Program" >Already in program</option>
                                        <option value="" >Referred to BSFP</option>
                                        <option value="" >Follow up visit</option>
                                    </optgroup>
                                        
                                
							     </select>
                            </div>
                        </div>

                        
					</div>
				</div>
			</div>
		</div>
		<div class="form-group row">
            <div class="col-md-3">
                <button type="submit" class="btn btn-success form-control" style="background: #ec2999; color: #fff;">Save</button>
            </div>
		</div>
		<div class="row">
            <div class="col-lg-6">
				<div class="ibox float-e-margins collapsed">
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
							<input type="number" name="medical_history_diarrhoea" class="form-control" placeholder="Diarrhoea (no of days)" value="{{ isset($facility_followup) ? $facility_followup->medical_history_diarrhoea : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Vomiting (no of days)</label>
							<input type="number" name="medical_history_vomiting" class="form-control" placeholder="Vomiting (no of days)" value="{{ isset($facility_followup) ? $facility_followup->medical_history_vomiting : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Fever (no of days)</label>
							<input type="number" name="medical_history_fever" class="form-control" placeholder="Fever (no of days)" value="{{ isset($facility_followup) ? $facility_followup->medical_history_fever : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Cough (no of days)</label>
							<input type="number" name="medical_history_cough" class="form-control" placeholder="Cough (no of days)" value="{{ isset($facility_followup) ? $facility_followup->medical_history_cough : '' }}" min="0">
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Others (specific)</label>
									<input type="text" name="medical_history_others_detail" class="form-control" placeholder="Others (specific)" value="{{ isset($facility_followup) ? $facility_followup->medical_history_others_detail : '' }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">No of days</label>
									<input type="number" name="medical_history_others" class="form-control" placeholder="Others (specific)(no of days)" value="{{ isset($facility_followup) ? $facility_followup->medical_history_others : '' }}" min="0">
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
            <div class="col-lg-6">
				<div class="ibox float-e-margins collapsed">
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
							<label for="">Temperature (oC)</label>
							<input type="number" name="temperature" class="form-control" placeholder="Temperature (oC)" value="{{ isset($facility_followup) ? $facility_followup->temperature : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Respiratory rate (breaths/min)</label>
							<input type="number" name="respiratory_rate" class="form-control" placeholder="Respiratory rate (breaths/min)" value="{{ isset($facility_followup) ? $facility_followup->respiratory_rate : '' }}" min="0">
						</div>

						<div class="form-group">
							<label for="">Sign of dehydration</label>
							<select name="sign_of_dehydration" class="form-control">
								<option value="">Select sign of dehydration</option>
								<option value="Yes" {{ (isset($facility_followup) && $facility_followup->sign_of_dehydration == 'Yes') ? ' selected' : '' }}>Yes</option>
								<option value="No" {{ (isset($facility_followup) && $facility_followup->sign_of_dehydration == 'No') ? ' selected' : '' }}>No</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Pneumonia</label>
							<select name="pneumonia" class="form-control">
								<option value="">Select Pneumonia</option>
								<option value="Yes" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'Yes') ? ' selected' : '' }}>Yes</option>
								<option value="No" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'No') ? ' selected' : '' }}>No</option>
								<option value="Severe" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'Severe') ? ' selected' : '' }}>Severe</option>
							</select>
						</div>
                        <div class="form-group">
							<label for="">Signs of anaemia/Palmar</label>
							<select name="anaemiapalmer" class="form-control">
								<option value="">Signs of anaemia/palmer</option>
								<option value="Yes" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'Yes') ? ' selected' : '' }}>Yes</option>
								<option value="No" {{ (isset($facility_followup) && $facility_followup->pneumonia == 'No') ? ' selected' : '' }}>No</option>
								
							</select>
						</div>
						<div class="form-group">
							<label for="">Skin changes/lesions</label>
							<select name="skin_changes" class="form-control">
								<option value="">Select skin changes/lesions</option>
								<option value="Yes" {{ (isset($facility_followup) && $facility_followup->skin_changes == 'Yes') ? ' selected' : '' }}>Yes</option>
								<option value="No" {{ (isset($facility_followup) && $facility_followup->skin_changes == 'No') ? ' selected' : '' }}>No</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Pale conjunctiva</label>
							<select name="pale_conjunctiva" class="form-control">
								<option value="">Select pale conjunctiva</option>
								<option value="Yes" {{ (isset($facility_followup) && $facility_followup->pale_conjunctiva == 'Yes') ? ' selected' : '' }}>Yes</option>
								<option value="No" {{ (isset($facility_followup) && $facility_followup->pale_conjunctiva == 'No') ? ' selected' : '' }}>No</option>
							</select>
						</div>
					</div>
				</div>
			</div>
            <div class="col-lg-6">
				<div class="ibox float-e-margins collapsed">
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
								<option value="Yes" {{ (isset($facility_followup) && $facility_followup->presence_of_appetite == 'Yes') ? ' selected' : '' }}>Yes</option>
								<option value="No" {{ (isset($facility_followup) && $facility_followup->presence_of_appetite == 'No') ? ' selected' : '' }}>No</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			

			<div class="col-lg-6">
				<div class="ibox float-e-margins collapsed">
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
								<option value="125mg (6-11m)" {{ (isset($facility_followup) && $facility_followup->antibiotic == '125mg (6-11m)') ? ' selected' : '' }}>125mg (6-11m)</option>
								<option value="187.5mg (12-23m)" {{ (isset($facility_followup) && $facility_followup->antibiotic == '187.5mg (12-23m)') ? ' selected' : '' }}>187.5mg (12-23m)</option>
								<option value="250mg (24-59m)" {{ (isset($facility_followup) && $facility_followup->antibiotic == '250mg (24-59m)') ? ' selected' : '' }}>250mg (24-59m)</option>
                                <option value="Not Applicable" {{ (isset($facility_followup) && $facility_followup->antibiotic == 'Not Applicable') ? ' selected' : '' }}>Not Applicable</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Albendazole</label>
							<select name="albendazole" class="form-control">
								<option value="">Select albendazole</option>
								<option value="200mg (12-23m)" {{ (isset($facility_followup) && $facility_followup->albendazole == '200mg (12-23m)') ? ' selected' : '' }}>200mg (12-23m)</option>
								<option value="400mg (>24m)" {{ (isset($facility_followup) && $facility_followup->albendazole == '400mg (>24m)') ? ' selected' : '' }}>400mg (>24m)</option>
                                <option value="Not applicable" {{ (isset($facility_followup) && $facility_followup->albendazole == 'Not applicable') ? ' selected' : '' }}>Not Applicable</option>
							</select>
						</div>
                        <div class="form-group">
							<label for="">Received Measles Vaccination</label>
							<select name="albendazole" class="form-control">
								<option value="">Select Measles</option>
								<option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Not Applicable">Not Applicable</option>
								
							</select>
						</div>
					</div>
				</div>
			</div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success form-control" style="background: #ec2999; color: #fff;">Save</button>
                    </div>
                </div>
            </div>
            <div class="row"><br />
            <div class="col-lg-6">
				<div class="ibox float-e-margins collapsed">
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
								<option value="MUAC" {{ (isset($facility_followup) && $facility_followup->new_admission == 'MUAC') ? ' selected' : '' }}>MUAC</option>
								<option value="WFH Zscore" {{ (isset($facility_followup) && $facility_followup->new_admission == 'WFH Zscore') ? ' selected' : '' }}>WFH Z score</option>
                                <option value="MUAC and WFH Zscore" {{ (isset($facility_followup) && $facility_followup->new_admission == 'MUAC and WFH Zscore') ? ' selected' : '' }}>MUAC and WFH Zscore</option>
								<option value="Oedema" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Oedema') ? ' selected' : '' }}>Oedema</option>
								<option value="Age 6 to 59m" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Age 6 to 59m') ? ' selected' : '' }}>Age 6 to 59m</option>
                                <option value="Relapse" {{ (isset($facility_followup) && $facility_followup->new_admission == 'Relapse') ? ' selected' : '' }}>Relapse</option>
							</select>
                            
						</div>
                        
						<div class="form-group">
							<label for="">Readmission</label>
							<select name="readmission" class="form-control">
								<option value="">Select readmission</option>
								<option value="Readmission after default" {{ (isset($facility_followup) && $facility_followup->readmission == 'Readmission after default') ? ' selected' : '' }}>Readmission after default</option>
								<option value="Readmission after non recovery" {{ (isset($facility_followup) && $facility_followup->readmission == 'Readmission after non recovery') ? ' selected' : '' }}>Readmission after non recovery</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Transfer in</label>
							<select name="transfer_in" class="form-control">
								<option value="">Select transfer in</option>
								<option value="Transfer in from TSFP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from TSFP') ? ' selected' : '' }}>Transfer in from TSFP</option>
								<option value="Transfer in from SC" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from SC') ? ' selected' : '' }}>Transfer in from SC</option>
								<option value="Transfer in from OTP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from OTP') ? ' selected' : '' }}>Transfer in from OTP</option>
								<option value="Transfer in from BSFP" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from BSFP') ? ' selected' : '' }}>Transfer in from BSFP</option>
                                <option value="Transfer in from Medical Center" {{ (isset($facility_followup) && $facility_followup->transfer_in == 'Transfer in from Medical Center') ? ' selected' : '' }}>Transfer in from Medical Center</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Return from</label>
							<select name="return_from" class="form-control">
								<option value="">Select return from</option>
								<option value="SAM Treatment" {{ (isset($facility_followup) && $facility_followup->return_from == 'SAM Treatment') ? ' selected' : '' }}>SAM Treatment</option>
								<option value="MAM Treatement" {{ (isset($facility_followup) && $facility_followup->return_from == 'MAM Treatement') ? ' selected' : '' }}>MAM Treatement</option>
                                <option value="Inpatient Treatement" {{ (isset($facility_followup) && $facility_followup->return_from == 'Inpatient Treatement') ? ' selected' : '' }}>Inpatient Treatement</option>
							</select>
						</div>
                        <div class="form-group">
                                <label>Next visit date</label>
                                <input type="date" name="next_visit_date" class="form-control" value="{{ isset($facility_followup) ? $facility_followup->next_visit_date : '' }}">    
						</div>
					</div>
				</div>
			</div>
            <div class="col-lg-6">
				<div class="ibox float-e-margins collapsed">
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
							<label for="">No of RUTF</label>
							<input type="number" name="no_of_rutf" class="form-control" placeholder="No of RUTF" value="{{ isset($facility_followup) ? $facility_followup->no_of_rutf : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">No of RUSF</label>
							<input type="number" name="no_of_rusf" class="form-control" placeholder="No of RUSF" value="{{ isset($facility_followup) ? $facility_followup->no_of_rusf : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">WSB++ (kg)</label>
							<input type="number" name="wsb_plus_plus_kg" class="form-control" placeholder="WSB++ (kg)" value="{{ isset($facility_followup) ? $facility_followup->wsb_plus_plus_kg : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">WSB+ (kg)</label>
							<input type="number" name="wsb_plus_kg" class="form-control" placeholder="WSB+ (kg)" value="{{ isset($facility_followup) ? $facility_followup->wsb_plus_kg : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Oil (kg)</label>
							<input type="number" name="oil_kg" class="form-control" placeholder="Oil (kg)" value="{{ isset($facility_followup) ? $facility_followup->oil_kg : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Others</label>
							<input type="number" name="others" class="form-control" placeholder="Others" value="{{ isset($facility_followup) ? $facility_followup->others : '' }}" min="0">
						</div>
					</div>
				</div>
			</div>
            
                <div class="col-lg-6">
				<div class="ibox float-e-margins collapsed">
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
								<option value="Recovered" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Recovered') ? ' selected' : '' }}>Recovered</option>
                                <option value="Age > 59m" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Age > 59m') ? ' selected' : '' }}>Age > 59m</option>
								<option value="Death" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Death') ? ' selected' : '' }}>Death</option>
								<option value="Defaulted" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Defaulted') ? ' selected' : '' }}>Defaulted</option>
								<option value="Non responder" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Non responder') ? ' selected' : '' }}>Non responder </option>
                                <option value="Medical Transfer" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_exit == 'Medical Transfer') ? ' selected' : '' }}>Medical Transfer </option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Transfer out</label>
							<select name="discharge_criteria_transfer_out" class="form-control">
								<option value="">Select transfer out</option>
								<option value="Transfer to SAM treatment" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to SAM treatment') ? ' selected' : '' }}>Transfer to SAM treatment</option>
								<option value="Transfer to MAM treatment" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to MAM treatment') ? ' selected' : '' }}>Transfer to MAM treatment</option>
								<option value="Transfer to SC" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to SC') ? ' selected' : '' }}>Transfer to SC</option>
								<option value="Transfer to other OTP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other OTP') ? ' selected' : '' }}>Transfer to other OTP</option>
								<option value="Transfer to other TSFP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other TSFP') ? ' selected' : '' }}>Transfer to other TSFP</option>
								<option value="Transfer to other BSFP" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_transfer_out == 'Transfer to other BSFP') ? ' selected' : '' }}>Transfer to other BSFP</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Others</label>
							<select name="discharge_criteria_others" class="form-control">
								<option value="">Select others</option>
								<option value="Medical transfer" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_others == 'Medical transfer') ? ' selected' : '' }}>Medical transfer</option>
								<option value="Unkown" {{ (isset($facility_followup) && $facility_followup->discharge_criteria_others == 'Unkown') ? ' selected' : '' }}>Unkown</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			

			<div class="col-lg-6">
				<div class="ibox float-e-margins collapsed">
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
							<input type="number" name="discharge_weight_kg" class="form-control" placeholder="Discharge weight (kg)" value="{{ isset($facility_followup) ? $facility_followup->discharge_weight_kg : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Lowest weight (kg)</label>
							<input type="number" name="lowest_weight_kg" class="form-control" placeholder="Lowest weight (kg)" value="{{ isset($facility_followup) ? $facility_followup->lowest_weight_kg : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Duration between lowest weight and discharged weight (days)</label>
							<input type="number" name="duration_between_lowest_weight_and_discharged_weight_days" class="form-control" placeholder="Duration between lowest weight and discharged weight (days)" value="{{ isset($facility_followup) ? $facility_followup->duration_between_lowest_weight_and_discharged_weight_days : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Gain of weight</label>
							<input type="number" name="gain_of_weight" class="form-control" placeholder="Gain of weight" value="{{ isset($facility_followup) ? $facility_followup->gain_of_weight : '' }}" min="0">
						</div>
						<div class="form-group">
							<label for="">Duration between discharged and admission days (LOS) (days)</label>
							<input type="number" name="duration_between_discharged_and_admission_days" class="form-control" placeholder="Duration between discharged and admission days (LOS) (days)" value="{{ isset($facility_followup) ? $facility_followup->duration_between_discharged_and_admission_days : '' }}" min="0">
						</div>
					</div>
				</div>
			</div>
		</div><!-- End of Second Row -->
	</div>

	
</div>
