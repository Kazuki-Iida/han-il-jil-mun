<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
use App\Question;
use App\Answer;
use App\AnswerImage;
use App\Comment;
use App\AnswerLike;
use App\AnswerReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnswerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('verified');
    // }

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
    
    public function edit($answer)
    {
        $answer = Answer::where('id', $answer)->first();
        return view('answers.edit')->with(['answer' => $answer]);
    }
    
    public function update($answer, AnswerRequest $request) 
    {
        $answer = Answer::where('id', $answer)->first();
        $answer_request = $request['answer'];

        $answer->fill($answer_request)->save();
        
        return redirect(route('questions.show' , ['question' => $answer->question->id]));
    }
    
    public function delete(Answer $answer)
    {
        if(isset($answer->likes)){
            AnswerLike::where('answer_id', $answer->id)->delete();
        }
        
        $question_id = $answer->question_id;
        if(isset($answer->comments)){
            foreach($answer->comments as $comment){
                $comment->delete();
            }
        }
        $answer->delete();
        return redirect('/questions/' . $question_id);    
    }
    
    public function like(Request $request)
    {
        $user_id = Auth::user()->id;
        $answer_id = $request->answer_id;
        $already_liked = AnswerLike::where('user_id', $user_id)->where('answer_id', $answer_id)->first();
    
        if (!$already_liked) {
            $like = new AnswerLike;
            $like->answer_id = $answer_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            AnswerLike::where('answer_id', $answer_id)->where('user_id', $user_id)->delete();
        }
        
        $answer = Answer::where('id', $answer_id)->first();
        $answer_likes_count = $answer->likes->count();
        $param = [
            'answer_likes_count' => $answer_likes_count,
        ];
        return response()->json($param);
    }
    
    
    public function report($answer_id)
    {
        AnswerReport::create([
            'answer_id' => $answer_id,
            'user_id' => Auth::id(),
        ]);
        
        session()->flash('success', 'You reported the Answer.');
        
        return redirect()->back();
    }
    
    public function unreport($answer_id)
    {
        $report = AnswerReport::where('answer_id', $answer_id)->where('user_id', Auth::id())->first();
        $report->delete();
        
        session()->flash('success', 'You Unreported the Answer.');
        
        return redirect()->back();
    }
}
