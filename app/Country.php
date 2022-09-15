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
    
    public function getByCountry(int $limit_count = 10)
    {
        return $this->questions()->with('country')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
