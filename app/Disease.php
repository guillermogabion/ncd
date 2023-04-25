<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    //
    protected $efillable = [
        'name',
        'description',
        'symptoms'
    ];
}
