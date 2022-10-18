<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionLike extends Model
{
    protected $fillable = ['question_id','user_id'];
    
    public function question()
    {
      return $this->belongsTo(Question::class);
    }
    
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    
    public function getLikedQuestionLikesId(Int $user_id)
    {
      return $this->where('users', $user_id)->orderBy('created_at', 'DESC')->get(['id']);
    }
}
