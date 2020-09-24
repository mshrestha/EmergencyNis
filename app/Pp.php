<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pp extends Model
{
    protected $fillable = ['name'];

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'pp_sectors');
    }

    public function ips()
    {
        return $this->belongsToMany(Ip::class, 'ip_pps');
    }

    public function facilities()
    {
        return $this->hasMany('App\Models\Facility');
    }

}
