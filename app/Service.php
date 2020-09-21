<?php

namespace App;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];

//    public function facilities()
//    {
//        return $this->belongsToMany(Facility::class, 'facility_services');
//    }

}
