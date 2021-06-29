<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PregnantWomen extends Model
{
	public $incrementing = false;
	protected $primaryKey = 'sync_id';
    protected $guarded = [];

    public function facility() {
    	return $this->belongsTo('App\Models\Facility', 'facility_id');
    }

    public function followups() {
    	return $this->hasMany('App\Models\PregnantWomenFollowup', 'pregnant_women_id');
    }

    public function childrens()
    {
        return $this->belongsToMany('App\Models\Child', 'children_pregnant_womens');
    }

}
