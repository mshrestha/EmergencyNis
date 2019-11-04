<div class="row">

	
        
		
			
            
			<div class="col-lg-4">
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
                            <div class="col-md-8">
                                <label for="">Date</label>
                                <input type="hidden" name="facility_id" value="{{ Auth::user()->facility_id }}" />
                                <input type="hidden" name="children_id" value="" />
                                <input type="date" name="date" class="form-control" value="{{ isset($facility_followup) ? $facility_followup->date : date('Y-m-d') }}"> 
                            </div>
						</div>
                        
						<div class="form-group row">
                            <div class="col-md-6">
                                <label for="">MUAC (cm)</label>
                                <input type="number" name="muac" class="form-control" placeholder="MUAC (cm)" value="{{ isset($facility_followup) ? $facility_followup->muac : '' }}" min="0" step="0.01">
                            </div>
                            <div class="col-md-6">
                                <label for="">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" placeholder="Weight (kg)" value="{{ isset($facility_followup) ? $facility_followup->weight : '' }}" min="0" step="0.01">
						    </div>
                           
						</div>
						
                        

                        
					</div>
				</div>
                <a href="/register/#tab-2"><span class="btn btn-primary ">Add</span></a>
			</div>

</div>