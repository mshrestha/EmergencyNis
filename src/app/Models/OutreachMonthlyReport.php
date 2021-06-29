<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutreachMonthlyReport extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'sync_id';
    protected $guarded = [];

    public function outreachSupervisor() {
    	return $this->belongsTo('App\Models\OutreachSupervisor', 'supervisor_id');
    }
}
