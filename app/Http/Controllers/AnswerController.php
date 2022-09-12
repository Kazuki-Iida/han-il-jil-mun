<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\AnswerRequest;
use App\Question;

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
    
    public function create(Category $category)
    {
        return view('answers/create')->with(['categories' => $category->get()]);;
    }
    
    public function store(Answer $answer, AnswerRequest $request) 
    {
        $input = $request['answer'];
        $answer->fill($input)->save();
        return redirect('/answers/' . $answer->id);
    }

}
