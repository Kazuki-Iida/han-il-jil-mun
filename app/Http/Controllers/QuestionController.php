<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Category;

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
    
    public function create(Category $category)
    {
        return view('questions/create')->with(['categories' => $category->get()]);;
    }
    
    public function store(Question $question, QuestionRequest $request) 
    {
        $input = $request['question'];
        $question->fill($input)->save();
        return redirect('/questions/' . $question->id);
    }
}
