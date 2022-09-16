<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Answer;
use App\Category;
use App\User;
use App\Country;
use App\QuestionImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
        $images = $request->file('images_array');
        
        $question->fill($input)->save();
        
        foreach ( $images as $image) {
            $upload_info = Storage::disk('s3')->putFile('question_image', $image, 'public');
            $question_image = New QuestionImage;
            $question_image->question_id = $question->id;
            $question_image->image = Storage::disk('s3')->url($upload_info);
            $question_image->save();
        }
        return redirect('/questions/' . $question->id);
    }
}
