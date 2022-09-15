<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Answer;
use App\Category;
use App\User;
use App\Country;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(Question $question)
    {
        return view('questions/index')->with(['questions' => $question->getPaginateByLimit()]);  
    }
    
    public function show(Question $question, Answer $answer)
    {
        return view('questions/show')->with(['question' => $question, 'answers' => $question->getByQuestion()]);
    }
    
    public function create(Category $category, Country $country)
    {
        return view('questions/create')->with(['categories' => $category->get(), 'countries' => $country->get()]);;
    }
    
    public function store(Question $question, QuestionRequest $request) 
    {
        $question->user_id = Auth::id();
        $input = $request['question'];
        $question->fill($input)->save();
        return redirect('/questions/' . $question->id);
    }
}
