<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'ASC')->paginate($limit_count);
    }
    
    public function comment_images()
    {
        return $this->hasMany('App\CommentImage');
    }
    
    public function answer()   
    {
        return $this->belongsTo('App\Answer');  
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
