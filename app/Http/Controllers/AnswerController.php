<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
use App\Question;
use App\Answer;
use App\AnswerImage;
use App\Comment;
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
        
        if(isset($images)){
            foreach ($images as $image) {
                $upload_info = Storage::disk('s3')->putFile('answer_image', $image, 'public');
                $answer_image = New AnswerImage;
                $answer_image->answer_id = $answer->id;
                $answer_image->image = Storage::disk('s3')->url($upload_info);
                $answer_image->save();
            }
        }
        return redirect('/questions/' . $answer->question_id);
    }
    
    public function delete(Answer $answer)
    {
        $question_id = $answer->question_id;
        if(isset($answer->comments)){
            foreach($answer->comments as $comment){
                $comment->delete();
            }
        }
        $answer->delete();
        return redirect('/questions/' . $question_id);    
    }
}
