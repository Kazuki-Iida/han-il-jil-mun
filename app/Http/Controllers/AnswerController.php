<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
use App\Question;
use App\Answer;
use App\AnswerImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    
    public function create(Answer $answer, Question $question)
    {
        $user = Auth::user();
        return view('answers/create')->with(['question' => $question]);
    }
    
    public function store(Answer $answer, Question $question, AnswerRequest $request) 
    {
        $answer->user_id = Auth::id();
        $answer->question_id = $question->id;
        $input = $request['answer'];
        $images = $request->file('images_array');
        $answer->fill($input)->save();
        
        foreach ( $images as $image) {
            $upload_info = Storage::disk('s3')->putFile('answer_image', $image, 'public');
            $answer_image = New AnswerImage;
            $answer_image->answer_id = $answer->id;
            $answer_image->image = Storage::disk('s3')->url($upload_info);
            $answer_image->save();
        }
        return redirect('/questions/' . $answer->question_id);
    }
    
    public function edit(Answer $answer)
    {
        return view('answers.edit', ['answer' => $answer->id])->with(['answer' => $answer, 'question' => $answer->question]);
    }
    
    public function update($answer, AnswerRequest $request) 
    {
        $answer = Answer::where('id', $answer)->first();
        $answer_request = $request['answer'];

        $answer->fill($answer_request)->save();
        
        return redirect('/answers/' . $answer->id);
    }

}
