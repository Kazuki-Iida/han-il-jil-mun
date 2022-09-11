<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        return view('users.edit', ['user' => $user]);
    }
    
    // public function update(User $user)
    // {
    //     return view('users/show')->with(['user' => $user]);  
    // }
    
    public function update(UserRequest $request, $user)
    {

        $user = User::where('id', $user)->first();
        $all_request = $request->all()["user"];

        if (isset($all_request['profile_image'])) {
            $profile_image = $request->file('profile_image');
            // dd($profile_image);
            $upload_info = Storage::disk('s3')->putFile('profile_image', $all_request["profile_image"], 'public');
            $all_request['profile_image'] = Storage::disk('s3')->url($upload_info);
        }

        $user->fill($all_request)->save();
    
        return redirect()->route('users.show', ["user" => $user->id]);
    }
}
