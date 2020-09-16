<?php

namespace App;

use App\Models\Camp;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    protected $fillable = ['name'];

    public function pps()
    {
        return $this->belongsToMany(Pp::class, 'ip_pps');
    }
    public function camps()
    {
        return $this->belongsToMany(Camp::class, 'camp_ips');
    }
    public function facilities()
    {
        return $this->hasMany('App\Models\Facility');
    }

}
