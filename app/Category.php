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
    
    public function getByCategory(int $limit_count = 5)
    {
        return $this->questions()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
