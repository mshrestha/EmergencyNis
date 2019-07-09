<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $table = "children";
    protected $fillable = [
        'mnr_no', 'mrc_no','date','sub_block_no','hh_no','gps_coordinates_lat','gps_coordinates_lng','family_count_no','mother_caregiver_name','fathers_name','block_leader_name','children_name','date_of_birth','age','sex','phone','picture','barcode',
    ];

    public function child_image() {
    	return asset('uploads/children/'. $this->picture);
    }

    public function followup() {
    	return $this->hasMany('App\Models\CommunityFollowup', 'children_id');
    }
}
