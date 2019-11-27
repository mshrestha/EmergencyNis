<div class="row">
	<div class="col-md-12" id="wizard">
        <h1>IYCF Module</h1>
		<div class="row step-content">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>IYCF Registry</h5>
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
                                <input type="hidden" name="children_id" value="{{ $children->sync_id }}" />
                                <input type="date" name="date" class="form-control" value="{{ isset($iycf_followup) ? $iycf_followup->date : date('Y-m-d') }}"> 
                            </div>
						</div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                    <label>Underwent full IYCF assessment</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input class="inline" type="radio" name="underwent_full_iycf_assesment" value="1" {{ (isset($iycf_followup) && $iycf_followup->underwent_full_iycf_assesment == 1) ? ' checked' : '' }}>Yes
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="inline" type="radio" name="underwent_full_iycf_assesment" value="0" {{ (isset($iycf_followup) && $iycf_followup->underwent_full_iycf_assesment == 0) ? ' checked' : '' }}>No
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group row">
                            
                            <div class="col-md-5">
                                <label for="">Type of feeding</label>
                                <select name="type_of_feeding" class="form-control">
                                    <option value="Breastmilk Only" {{ (isset($iycf_followup) && $iycf_followup->type_of_feeding == 'Breastmilk Only') ? ' selected' : '' }}>Breastmilk Only</option>
                                    <option value="Infant formula Only" {{ (isset($iycf_followup) && $iycf_followup->type_of_feeding == 'Infant formula Only') ? ' selected' : '' }}>Infant formula Only</option>
                                    <option value="Complementaryt foods" {{ (isset($iycf_followup) && $iycf_followup->type_of_feeding == 'Complementaryt foods') ? ' selected' : '' }}>Complementaryt foods</option>
                                    <option value="Breastmilk + Complimentary foods" {{ (isset($iycf_followup) && $iycf_followup->type_of_feeding == 'Breastmilk + Complimentary foods') ? ' selected' : '' }}>Breastmilk + Complimentary foods</option>
                                    <option value="Infant formula + Complimentary foods" {{ (isset($iycf_followup) && $iycf_followup->type_of_feeding == 'Infant formula + Complimentary foods') ? ' selected' : '' }}>Infant formula + Complimentary foods</option>
                                    <option value="Breastmilk + Infant formula + Complimentary foods" {{ (isset($iycf_followup) && $iycf_followup->type_of_feeding == 'Breastmilk + Infant formula + Complimentary foods') ? ' selected' : '' }}>Breastmilk + Infant formula + Complimentary foods</option>
							     </select>
                                </div>
						</div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Counselling Session Topics</label>
                            </div>
                            <div class="col-md-3"><input type="checkbox" value="1" name="breastfeeding_support" {{ (isset($iycf_followup) && $iycf_followup->breastfeeding_support == 1) ? ' checked' : '' }}>Breastfeeding support</div>
                            <div class="col-md-3"><input type="checkbox" value="1" name="relactation_support" {{ (isset($iycf_followup) && $iycf_followup->relactation_support == 1) ? ' checked' : '' }}>Relactation support</div>
                            <div class="col-md-3"><input type="checkbox" value="1" name="wet_nursing_support" {{ (isset($iycf_followup) && $iycf_followup->wet_nursing_support == 1) ? ' checked' : '' }}>Wet nursing support</div>
                            <div class="col-md-3"><input type="checkbox" value="1" name="complementary_feeding_advice" {{ (isset($iycf_followup) && $iycf_followup->complementary_feeding_advice == 1) ? ' checked' : '' }}>Complementary feeding advice</div>
                            <div class="col-md-3"><input type="checkbox" value="1" name="psycho_social_support" {{ (isset($iycf_followup) && $iycf_followup->psycho_social_support == 1) ? ' checked' : '' }}>Psycho social support</div>
                            <div class="col-md-3"><input type="checkbox" value="1" name="other" {{ (isset($iycf_followup) && $iycf_followup->other == 1) ? ' checked' : '' }}>Other</div>
                        </div>
					</div>
				</div>
			</div>
		</div>
        <!-- End of Second Row -->
	</div>
</div>