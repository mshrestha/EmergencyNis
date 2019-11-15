<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PregnantWomenFollowup extends Model
{
	public $incrementing = false;
    protected $primaryKey = 'sync_id';
	protected $guarded = [];

	public function pregnantWomen() {
		return $this->belongsTo('App\Models\PregnantWomen', 'pregnant_women_id');
	}

	public function facility() {
		return $this->belongsTo('App\Models\Facility', 'facility_id');
	}
}
