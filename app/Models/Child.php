<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'sync_id';
    protected $table = "children";
    protected $fillable = [
        'sync_id', 'sync_status', 'mnr_no', 'mrc_no','date','sub_block_no','hh_no','gps_coordinates_lat','gps_coordinates_lng',
        'family_count_no','mother_caregiver_name','fathers_name','block_leader_name','children_name','date_of_birth','age','sex',
        'phone','picture','barcode','camp_id', 'facility_id','moha_id','progress_id','block','age_group'
    ];

    public function child_image() {
        if(is_file('uploads/children/'. $this->picture)) {
    	   return asset('uploads/children/'. $this->picture);
        } else {
            return asset('img/default.jpeg');
        }
    }

    public function followup() {
    	return $this->hasMany('App\Models\CommunityFollowup', 'children_id');
    }
    
    public function facility() {
    	return $this->belongsTo('App\Models\Facility', 'facility_id');
    }

    public function facility_followup() {
        return $this->hasMany('App\Models\FacilityFollowup', 'children_id');
    }

}
