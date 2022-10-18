<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Question;
use App\Answer;
use App\CommentImage;
use App\Comment;
use App\CommentReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    
    public function create(Comment $comment, Answer $answer)
    {
        $user = Auth::user();
        return view('comments/create')->with(['answer' => $answer]);
    }
    
    public function store(Comment $comment, Answer $answer, CommentRequest $request) 
    {
        $comment->user_id = Auth::id();
        $comment->answer_id = $answer->id;
        $input = $request['comment'];
        $images = $request->file('images_array');
        $comment->fill($input)->save();
        
        // 画像保存
        if(isset($images)){
            foreach ($images as $image) {
                $upload_info = Storage::disk('s3')->putFile('comment_image', $image, 'public');
                $comment_image = New CommentImage;
                $comment_image->comment_id = $comment->id;
                $comment_image->image = Storage::disk('s3')->url($upload_info);
                $comment_image->save();
            }
        }
        return redirect('/questions/' . $comment->answer->question_id);
    }
    
    public function edit($comment)
    {
        $comment = Comment::where('id', $comment)->first();
        return view('comments.edit')->with(['comment' => $comment]);
    }
    
    public function update($comment, CommentRequest $request) 
    {
        $comment = Comment::where('id', $comment)->first();
        $comment_request = $request['comment'];

        $comment->fill($comment_request)->save();
        
        return redirect(route('questions.show' , ['question' => $comment->answer->question->id]));
    }
    
    public function delete(Comment $comment)
    {
        $question_id = $comment->answer->question_id;
        $comment->delete();
        return redirect('/questions/' . $question_id);    
    }
    
    // 通報機能
    public function report($comment_id)
    {
        CommentReport::create([
            'comment_id' => $comment_id,
            'user_id' => Auth::id(),
        ]);
        
        session()->flash('success', 'You reported the Comment.');
        
        return redirect()->back();
    }
    
    // 通報解除
    public function unreport($comment_id)
    {
        $report = CommentReport::where('comment_id', $comment_id)->where('user_id', Auth::id())->first();
        $report->delete();
        
        session()->flash('success', 'You Unreported the Comment.');
        
        return redirect()->back();
    }
}
