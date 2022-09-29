<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class QuestionLike extends Model
{
    // 配列内の要素を書き込み可能にする
    protected $fillable = ['question_id','user_id'];
    
    public function question()
    {
      return $this->belongsTo(Question::class);
    }
    
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    
}
