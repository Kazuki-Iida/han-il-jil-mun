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
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
    ];
}
