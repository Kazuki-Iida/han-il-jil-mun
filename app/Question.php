<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Question extends Model
{
    public function index(Question $question)
    {
        return $question->get();
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function answer()
    {
        return $this->belongsTo('App\Answer');
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
