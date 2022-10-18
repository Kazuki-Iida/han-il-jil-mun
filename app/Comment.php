<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CommentReport;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
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
    
    public function reports()
    {
        return $this->hasMany(CommentReport::class, 'comment_id');
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
        'body',
        'user_id',
    ];
}
