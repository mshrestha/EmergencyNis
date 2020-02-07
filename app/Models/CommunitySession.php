<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunitySession extends Model
{
	public $incrementing = false;
	protected $primaryKey = 'sync_id';
	protected $guarded = [];

	public function volunteer() {
		return $this->belongsTo('App\Models\Volunteer', 'volunteer_id');
	}
}
