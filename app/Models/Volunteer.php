<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'sync_id';
    protected $guarded = [];

    public function camp() {
    	return $this->belongsTo('App\Models\Camp', 'camp_id');
    }

    public function communitySessions() {
    	return $this->hasMany('App\Models\CommunitySession', 'volunteer_id');
    }

    public function todaysCommunitySession() {
    	return $this->communitySessions()->where('date', date('Y-m-d'))->first() ?: [
    		'screened'=>null, 
    		'referred'=>null, 
    		'inprogram'=>null, 
    	];
    }
}
