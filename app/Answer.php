<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getByQuestion(int $limit_count = 10)
    {
        return $this->answers()->with('question')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function question()   
    {
        return $this->belongsTo('App\Question');  
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    protected $fillable = [
        'body',
        'user_id',
    ];
}
