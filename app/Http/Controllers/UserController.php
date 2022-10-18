<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Interest;
use App\Follower;
use App\Question;
use App\QuestionLike;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('destroy');
        $this->middleware('verified')->except(['show', 'destroy']);
    }

    
    public function show(User $user, Follower $follower)
    {
        $login_user = auth()->user();
        if (Auth::check()){
            $is_following = $login_user->isFollowing($user->id);
            $is_followed = $login_user->isFollowed($user->id);
        }else{
            $is_following = false;
            $is_followed = false;
        }
        
        // 表示するユーザーがGoodした質問取得
        $questionLikes = QuestionLike::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        
        if(isset($questionLikes[0])){
            foreach($questionLikes as $questionLike){
                $liked_questions[] = Question::where('id', $questionLike->question_id)->first();
            }
        }else{
            $liked_questions = [];
        }
        
        
        // 表示するユーザーの質問
        $users_questions = Question::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        if(!isset($users_questions[0])){
            $users_questions = [];
        }
        
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        
         return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'liked_questions' => $liked_questions,
            'users_questions' => $users_questions,
        ]);
    }

    
    public function edit() {
        $user = Auth::user();
        $interests = Interest::with('users')->get();
        $checked = [];
        foreach($user->interests as $interest){
            $checked[] = $interest->id;
        }
        
        return view('users.edit', ['user' => $user])->with(['interests' => $interests, 'checked' => $checked]);
    }
    
    public function update(UserRequest $request, $user)
    {

        $user = User::where('id', $user)->first();
        $user_request = $request["user"];
        if(!is_null($request->interests_array)){
            $interest_request = $request->interests_array;
            $user->interests()->sync($interest_request);
        }
        
        // プロフィール画像保存準備
        if (isset($user_request['profile_image'])) {
            $profile_image = $request->file('profile_image');
            $upload_info = Storage::disk('s3')->putFile('profile_image', $user_request["profile_image"], 'public');
            $user_request['profile_image'] = Storage::disk('s3')->url($upload_info);
        }
        
        // 保存
        $user->fill($user_request)->save();
        $user = User::find(1);
        
    
        return redirect()->route('users.show', ["user" => $user->id]);
    }
    
    // フォロー機能
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除機能
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }

}
