<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //

    protected $fillable = [
        'name',
        'description',
        'dosage'
    ];
}
