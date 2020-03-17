<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetReached extends Model
{
    protected $fillable = [
        'indicator_id','target','reached','data_year','comments','use_this'
    ];

    public function indicator() {
        return $this->belongsTo('App\Indicator');
    }


}
