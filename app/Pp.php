<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pp extends Model
{
    protected $fillable = ['name'];

    public function ips()
    {
        return $this->belongsToMany(Ip::class, 'ip_pps');
    }

}
