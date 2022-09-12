<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\AnswerRequest;
use App\Question;
use App\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function index(Answer $answer)
    {
        return view('answers/index')->with(['answers' => $answer->getPaginateByLimit()]);  
    }
    
    public function show(Answer $answer)
    {
        return view('answers/show')->with(['answer' => $answer]);
    }
    
    public function create(Answer $answer)
    {
        $user = Auth::user();
        return view('answers/create', ['user' => $user]);
    }
    
    public function store(Answer $answer,Request $request) 
    {
        $input = $request['answer'];
        $answer->fill($input)->save();
        return redirect('/answers/' . $answer->id);
    }

}
