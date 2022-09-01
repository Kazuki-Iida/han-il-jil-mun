<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('users/show')->with(['user' => $user]);  
    }

    
    // public function edit(User $user)
    // {
    //     return view('user/edit')->with(['questions' => $question->getPaginateByLimit()]);  
    // }
    
    // public function update(User $user)
    // {
    //     return view('users/show')->with(['user' => $user]);  
    // }
    
}
