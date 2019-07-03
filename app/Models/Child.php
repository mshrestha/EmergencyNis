<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $table = "children";
    protected $fillable = [
        'mrc_no','date','sub_block_no','hh_no','gps_coordinates','family_count_no','mother_caregiver_name','fathers_name','block_leader_name','children_name','date_of_birth','age','sex','picture','barcode',
    ];
}
