<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    protected $fillable = [
        'full_name', 'email'
    ];

}
