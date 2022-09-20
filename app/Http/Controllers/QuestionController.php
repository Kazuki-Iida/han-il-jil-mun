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
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::paginate(10);
        $search = $request->input('search');
        $query = Question::query();
        if ($search){
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach($wordArraySearched as $value) {
                $query->where('body', 'like', '%'.$value.'%');
            }
            $questions = $query->paginate(10);
        }
        return view('questions/index')
        ->with([
            'questions' => $questions,
            'search' => $search,
            ]);
    }
        
        
        // return view('questions/index')->with(['questions' => $question->getPaginateByLimit()]);  
    // }
    
    public function show(Question $question, Answer $answer, Comment $comment)
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
        if(isset($images)){
            foreach ( $images as $image) {
                $upload_info = Storage::disk('s3')->putFile('question_image', $image, 'public');
                $question_image = New QuestionImage;
                $question_image->question_id = $question->id;
                $question_image->image = Storage::disk('s3')->url($upload_info);
                $question_image->save();
            }
        }
        return redirect('/questions/' . $question->id);
    }
    
    public function edit($question, Category $category, Country $country)
    {
        $question = Question::where('id', $question)->first();
        $category_checked = $question->category_id;
        $country_checked = $question->country_id;
        return view('questions.edit', ['question' => $question->id])->with(['question' => $question, 'categories' => $category->get(), 'countries' => $country->get(), 'category_checked' => $category_checked, 'country_checked' => $country_checked]);;
    }
    
    public function update($question, QuestionRequest $request) 
    {
        $question = Question::where('id', $question)->first();
        $question_request = $request['question'];

        $question->fill($question_request)->save();
        
        return redirect('/questions/' . $question->id);
    }
    
    public function delete(Question $question)
    {
        if(isset($question->answers)){
            foreach($question->answers as $answer){
                if(isset($answer->comments)){
                    foreach($answer->comments as $comment){
                        $comment->delete();
                    }
                }
                $answer->delete();
            }
        }
        $question->delete();
        return redirect('/');
    }
}
