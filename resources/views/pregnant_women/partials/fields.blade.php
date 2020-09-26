<div class="row">
	<div class="col-lg-6">
		<div class="ibox ">
			<div class="ibox-title">
				<h5>Woman registration</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				{{--<div class="form-group"><label class="col-sm-3 control-label">Registration ID</label>--}}
					{{--<div class="col-sm-9">--}}
						{{--<input type="text" name="registration_id" class="form-control" placeholder="Registration ID"--}}
							   {{--value="{{ isset($pregnant_women) ? $pregnant_women->registration_id : '' }}">--}}
					{{--</div>--}}
				{{--</div>--}}
				<div class="form-group"><label class="col-sm-3 control-label">Registration Date</label>
					<div class="col-sm-9"><input type="date" name="registration_date" class="form-control" value="{{ isset($pregnant_women) ? $pregnant_women->registration_date : date('Y-m-d') }}">
					</div>
				</div>


				<div class="form-group"><label class="col-sm-3 control-label">MOHA ID</label>
					<div class="col-sm-9"><input type="text" name="moha_id" class="form-control" placeholder="Moha ID"
												 value="{{ isset($pregnant_women) ? $pregnant_women->moha_id : '' }}">
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Progress ID</label>
					<div class="col-sm-9"><input type="text" name="progress_id" class="form-control" placeholder="Progress ID"
												 value="{{ isset($pregnant_women) ? $pregnant_women->progress_id : '' }}">
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Family Count Number (FCN)</label>
					<div class="col-sm-9"><input type="text" name="family_count_no" class="form-control" placeholder="Family Count Number"
												 value="{{ isset($pregnant_women) ? $pregnant_women->family_count_no : '' }}" >
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">SCOPE ID</label>
					<div class="col-sm-9"><input type="text" name="scope_no" class="form-control" placeholder="SCOPE ID"
												 value="{{ isset($pregnant_women) ? $pregnant_women->scope_no : '' }}" >
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Camp</label>
					<div class="col-sm-9">
						<select name="camp_id" class="form-control" required>
							<option value="">Select Camp</option>
							@foreach($camps as $camp)

								<option value="{{ $camp->id }}"
										@if ( $camp->id === $facility->camp->id )
										selected
										@endif {{ (isset($pregnant_women) && $pregnant_women->camp_id == $camp->id) ? ' selected' : '' }}  >{{ $camp->name }} </option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="hr-line-dashed"></div>

				<div class="form-group"><label class="col-sm-3 control-label">Household Number</label>
					<div class="col-sm-9"><input type="text" name="household_no" class="form-control" placeholder="Household Number"
												 value="{{ isset($pregnant_women) ? $pregnant_women->household_no : '' }}" >
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Block</label>
					<div class="col-sm-9"><input type="text" name="block_no" class="form-control" placeholder="Block"
												 value="{{ isset($pregnant_women) ? $pregnant_women->block_no : '' }}" >
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Sub Block</label>
					<div class="col-sm-9"><input type="text" name="sub_block_no" class="form-control" placeholder="Sub Block"
												 value="{{ isset($pregnant_women) ? $pregnant_women->sub_block_no : '' }}" >
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Lat/Lng</label>
					<div class="col-sm-3"><input id="currentLatitude" type="text" name="gps_coordinates_lat" class="form-control" placeholder="Lat"
												 value="@if(isset($pregnant_women)){{ isset($pregnant_women) ? $pregnant_women->gps_coordinates_lat : '' }} @else {{$facility->latitude}} @endif" >
					</div><div class="col-sm-3"><input id="currentLongitude" type="text" name="gps_coordinates_lng" class="form-control" placeholder="Lng"
													   value="@if(isset($pregnant_women)){{ isset($pregnant_women) ? $pregnant_women->gps_coordinates_lng : '' }} @else {{$facility->longitude}} @endif" >
					</div>
				</div>
				<div class="hr-line-dashed"></div>

				<div class="form-group" >
					<label class="col-sm-3 control-label">Children's FCN Number</label>
					<div class="col-sm-9">
						<select name="children_moha_id[]" class="form-control show-tick selectpicker"
								data-live-search="true" multiple>
							<option value="">Select Children</option>
							@foreach($children as $child)
								<option value="{{ $child->sync_id }}" {{ (in_array($child->sync_id, $selected_children)) ? ' selected' : '' }}>{{ $child->family_count_no.' '.$child->children_name  }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group"><label class="col-sm-3 control-label">Name of PLW</label>
					<div class="col-sm-9"><input type="text" class="form-control" name="pregnant_women_name" placeholder="Name of PLW"
												 value="{{ isset($pregnant_women) ? $pregnant_women->pregnant_women_name : '' }}" required>
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Husband's Name</label>
					<div class="col-sm-9"><input type="text" class="form-control" name="husbands_name" placeholder="Husband's Name"
												 value="{{ isset($pregnant_women) ? $pregnant_women->husbands_name : '' }}" required>
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Father's Name</label>
					<div class="col-sm-9"><input type="text" class="form-control" name="fathers_name" placeholder="Father's Name"
												 value="{{ isset($pregnant_women) ? $pregnant_women->fathers_name : '' }}" >
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Age</label>
					<div class="col-sm-9"><input type="number" class="form-control" style="width:100px" name="age" placeholder="Age"
												 value="{{ isset($pregnant_women) ? $pregnant_women->age : '' }}" ><span class="small">(Years)</span>
					</div>
				</div>

				<div class="form-group"><label class="col-sm-3 control-label">Type</label>
					<div class="col-sm-9">
						<input type="radio" name="type" value="pregnant" {{ (isset($pregnant_women) && $pregnant_women->type == 'pregnant') ? ' checked' : '' }}> Pregnant
						<input type="radio" name="type" value="lactating" {{ (isset($pregnant_women) && $pregnant_women->type == 'lactating') ? ' checked' : '' }}> Lactating
					</div>
				</div>

				<div class="hr-line-dashed"></div>

				<div class="form-group"><label class="col-sm-3 control-label">ANC/PNC Card No</label>
					<div class="col-sm-9"><input type="text" class="form-control" name="anc_pnc_card_no" placeholder="ANC/PNC card no"
												 value="{{ isset($pregnant_women) ? $pregnant_women->anc_pnc_card_no : '' }}" required>
					</div>
				</div>

				<div class="form-group"><label class="col-sm-3 control-label">Month of Pregnancy or Lactation</label>
					<div class="col-sm-9"><input type="number" class="form-control" name="pregnancy_month" placeholder="Pregnancy or Lactation Month" 
						value="{{ isset($pregnant_women) ? $pregnant_women->pregnancy_month : '' }}" >(month)
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Expected Delivery Date</label>
					<div class="col-sm-9"><input type="date" name="expected_delivery_date" class="form-control" value="{{ isset($pregnant_women) ? $pregnant_women->expected_delivery_date : '' }}">
					</div>
				</div>
				<div class="form-group"><label class="col-sm-3 control-label">Actual date of delivery</label>
					<div class="col-sm-9"><input type="date" name="actual_date_of_delivery" class="form-control" value="{{ isset($pregnant_women) ? $pregnant_women->actual_date_of_delivery : '' }}">
					</div>
				</div>
				<div class="hr-line-dashed"></div>
			</div> <!-- ibox-content -->
		</div> <!-- ibox -->
	</div> <!-- col -->

</div> <!-- row -->