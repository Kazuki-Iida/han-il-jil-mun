<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AnswerLike;
use App\AnswerReport;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    
    public function answer_images()
    {
        return $this->hasMany('App\AnswerImage');
    }
    
    public function question()   
    {
        return $this->belongsTo('App\Question');  
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function likes()
    {
        return $this->hasMany('App\AnswerLike');
    }
    
    public function is_liked_by_auth_user()
    {
        $id = \Auth::id();
        
        $likers = array();
        foreach($this->likes as $like) {
            array_push($likers, $like->user_id);
        }
        
        if (in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function reports()
    {
        return $this->hasMany(AnswerReport::class, 'answer_id');
    }
    
    public function is_reported_by_auth_user()
    {
        $id = \Auth::id();
        
        $reporters = array();
        foreach($this->reports as $report) {
            array_push($reporters, $report->user_id);
        }
        
        if (in_array($id, $reporters)) {
            return true;
        } else {
            return false;
        }
    }
    
    protected $fillable = [
        'body',
        'user_id',
    ];
}
