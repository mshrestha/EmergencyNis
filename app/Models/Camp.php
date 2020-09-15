<?php

namespace App\Models;

use App\Ip;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    protected $fillable = ['name','block_letter'];

    public function ips()
    {
        return $this->belongsToMany(Ip::class, 'camp_ips');
    }

}
