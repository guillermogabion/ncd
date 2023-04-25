<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //

    protected $fillable = [
       'first_name', 
       'last_name', 
       'birthdate', 
       'gender', 
       'address', 
       'disease', 
       'medicine', 
       'quanity' 
    ];
}
