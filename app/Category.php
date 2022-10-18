<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Category extends Model
{
    public function questions()   
    {
        return $this->hasMany('App\Question');  
    }
    
}
