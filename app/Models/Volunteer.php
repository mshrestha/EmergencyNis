<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    //

    protected $fillable = [
    	'name', 'block','subblock', 'camp_id'
    ];

    public function camp() {
    	return $this->belongsTo('App\Models\Camp', 'camp_id');
    }
}
