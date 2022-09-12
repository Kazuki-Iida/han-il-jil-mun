<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Question extends Model
{
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getByQuestion(int $limit_count = 10)
    {
        return $this->answers()->with('question')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
    ];
}
