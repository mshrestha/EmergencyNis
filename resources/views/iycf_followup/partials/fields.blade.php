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
                                <input type="date" name="date" class="form-control" value="{{ isset($facility_followup) ? $facility_followup->date : date('Y-m-d') }}"> 
                            </div>
						</div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                    <label for="refered_by">Underwent full IYCF assessment</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input class="inline" type="radio" name="iycf-assessment" value="yes">Yes
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="inline" type="radio" name="iycf-assessment" value="no">No
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group row">
                            
                            <div class="col-md-5">
                                <label for="">Type of feeding</label>
                                <select name="oedema" class="form-control">
                                    <option>Breastmilk Only</option>
                                    <option>Infant formula Only</option>
                                    <option>Complementaryt foods</option>
                                    <option>Breastmilk + Complimentary foods</option>
                                    <option>Infant formula + Complimentary foods</option>
                                    <option>Breastmilk + Infant formula + Complimentary foods</option>
							     </select>
                                </div>
						</div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Counselling Session Topics</label>
                            </div>
                            <div class="col-md-3"><input type="checkbox" name="session-topics">Breastfeeding support</div>
                            <div class="col-md-3"><input type="checkbox" name="session-topics">Relactation support</div>
                            <div class="col-md-3"><input type="checkbox" name="session-topics">Wet nursing support</div>
                            <div class="col-md-3"><input type="checkbox" name="session-topics">Complementary feeding advice</div>
                            <div class="col-md-3"><input type="checkbox" name="session-topics">Psycho social support</div>
                            <div class="col-md-3"><input type="checkbox" name="session-topics">Other</div>
                        </div>
                            
                        

                        
					</div>
				</div>
			</div>
		</div>
        
            <!-- End of Second Row -->
	</div>

	
</div>
