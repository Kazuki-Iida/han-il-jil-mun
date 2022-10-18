<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;

class Country extends Model
{
    public function questions()   
    {
        return $this->hasMany('App\Question');  
    }
    
}
