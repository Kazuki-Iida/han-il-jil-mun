<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\QuestionLike;
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
        return $this->hasMany(QuestionLike::class, 'question_id');
    }
    
    /**
    * リプライにLIKEを付いているかの判定
    *
    * @return bool true:Likeがついてる false:Likeがついてない
    */
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
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
        'country_id',
        'images_array',
    ];
}
