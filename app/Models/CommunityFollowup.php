<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityFollowup extends Model
{
    protected $fillable = [
			'children_id' ,'date' ,'next_visit_date' ,'age' ,'exclusive_breastfeeding' ,'continued_breastfeeding' ,'introduction_time' ,'frequency' ,'no_of_food_groups' ,'quantity_of_food' ,'received_all_epi_vaccination' ,'muac' ,'edema' ,'nutritional_status' ,'refered_to_facility' ,'facility_id' ,'facility_id' ,'referel_slip_no' ,'distribution_mnp_sachet' ,'vitamin_a' ,'deworming'
    ];
}
