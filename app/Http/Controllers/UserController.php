<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Interest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('users/show')->with(['user' => $user]);  
    }

    
    public function edit($user) {
        $user = Auth::user();
        $interests = Interest::with('users')->get();
        return view('users.edit', ['user' => $user])->with(['interests' => $interests]);
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
        // dd($request);
        \Log::debug($request);

        if (isset($user_request['profile_image'])) {
            $profile_image = $request->file('profile_image');
            $upload_info = Storage::disk('s3')->putFile('profile_image', $user_request["profile_image"], 'public');
            $user_request['profile_image'] = Storage::disk('s3')->url($upload_info);
        }

            // dd($interest_request);
        $user->fill($user_request)->save();
        $user->interests()->attach($interest_request); 
    
        return redirect()->route('users.show', ["user" => $user->id]);
    }
}
