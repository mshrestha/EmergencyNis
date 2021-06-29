<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['name'];

    public function pps()
    {
        return $this->belongsToMany(Pp::class, 'pp_sectors');
    }

}
