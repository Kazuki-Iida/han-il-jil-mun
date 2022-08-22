<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Question;

class QuestionController extends Controller
{
    public function index(Question $question)
    {
        return view('questions/index')->with(['questions' => $question->getPaginateByLimit()]);  
    }
    
    public function show(Question $question)
    {
        return view('questions/show')->with(['question' => $question]);
    }
    
    public function create()
    {
        return view('questions/create');
    }
    
    public function store(Question $question, QuestionRequest $request) 
    {
        $input = $request['question'];
        $question->fill($input)->save();
        return redirect('/questions/' . $question->id);
    }
}
