<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
    	'facility_id', 'camp_id', 'program_partner', 'implementing_partner', 'status', 'latitude', 'longitude', 'service_type', 'facility_reg', 'community_reg'
    ];

    public function camp() {
    	return $this->belongsTo('App\Models\Camp', 'camp_id');
    }
}
