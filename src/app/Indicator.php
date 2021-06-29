<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $fillable = [
        'indicator','indicator_short_title'
    ];

    public function target_reached() {
        return $this->hasMany('App\TargetReached');
    }

}
