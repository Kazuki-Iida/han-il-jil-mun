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
    
    // Goodされているか
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
    
    // 通報されているか
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
        'title',
        'body',
        'user_id',
        'category_id',
        'country_id',
        'images_array',
        'ip_address',
    ];
}
