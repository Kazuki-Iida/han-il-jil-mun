<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Interest;
use App\Follower;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(User $user, Follower $follower)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
         return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    
    public function edit() {
        $user = Auth::user();
        $interests = Interest::with('users')->get();
        foreach($user->interests as $interest){
            $checked[] = $interest->id;
        }
        
        return view('users.edit', ['user' => $user])->with(['interests' => $interests, 'checked' => $checked]);
    }
    
    // public function update(User $user)
    // {
    //     return view('users/show')->with(['user' => $user]);  
    // }
    
    public function update(UserRequest $request, $user)
    {

        $user = User::where('id', $user)->first();
        $user_request = $request["user"];
        $interest_request = $request->interests_array;

        if (isset($user_request['profile_image'])) {
            $profile_image = $request->file('profile_image');
            $upload_info = Storage::disk('s3')->putFile('profile_image', $user_request["profile_image"], 'public');
            $user_request['profile_image'] = Storage::disk('s3')->url($upload_info);
        }
        

        $user->fill($user_request)->save();
        $user = User::find(1);
        $user->interests()->sync($interest_request);
    
        return redirect()->route('users.show', ["user" => $user->id]);
    }
    
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
