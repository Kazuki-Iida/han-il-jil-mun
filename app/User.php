<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    public function interests()
    {
        return $this->belongsToMany('App\Interest');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password', 
        'profile', 
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
    
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }
    
    // フォローする
    public function follow(Int $user_id) 
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id) 
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id) 
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
    
    //多対多のリレーションを書く
    public function question_nices()
    {
        return $this->belongsToMany('App\QuestionNice','nices','user_id','question_id')->withTimestamps();
    }

    //この投稿に対して既にniceしたかどうかを判別する
    public function isNice($questiontId)
    {
      return $this->nices()->where('question_id',$questiontId)->exists();
    }

    //isNiceを使って、既にniceしたか確認したあと、いいねする（重複させない）
    public function nice($questionId)
    {
      if($this->isNice($questionId)){
        //もし既に「いいね」していたら何もしない
      } else {
        $this->nices()->attach($questionId);
      }
    }

    //isLikeを使って、既にniceしたか確認して、もししていたら解除する
    public function unnice($questionId)
    {
      if($this->isLike($questionId)){
        //もし既に「いいね」していたら消す
        $this->nices()->detach($questionId);
      } else {
      }
    }
}
