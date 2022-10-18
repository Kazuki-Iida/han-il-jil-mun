<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\QuestionLike;
use App\QuestionReport;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getByQuestion(int $limit_count = 10)
    {
        return $this->answers()->with('question')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function question_images()
    {
        return $this->hasMany('App\QuestionImage');
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
    
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    
    public function likes()
    {
        return $this->hasMany('App\QuestionLike');
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
        return $this->hasMany(QuestionReport::class, 'question_id');
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
    
    public function getLikedQuestion(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
    }
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
        'country_id',
        'images_array',
        'ip_address',
    ];
}
