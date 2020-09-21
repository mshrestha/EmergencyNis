<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
    	'facility_id', 'camp_id', 'program_partner', 'implementing_partner', 'status', 'latitude', 'longitude', 'service_type',
        'facility_reg', 'community_reg', 'ssid','pp_id','ip_id','name','sector_id'
    ];

    public function camp() {
    	return $this->belongsTo('App\Models\Camp', 'camp_id');
    }
    public function ip() {
    	return $this->belongsTo('App\Ip', 'ip_id');
    }
    public function pp() {
    	return $this->belongsTo('App\Pp', 'pp_id');
    }
}
