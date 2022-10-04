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
use App\QuestionLike;
use App\QuestionReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $order = $request->input('order');
        $about = $request->input('about');
        // $query = Question::query();
        if(!$about){
            $about = 1;
        }
        $query = Question::query()->where('country_id', $about);
                
        if($search){
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach($wordArraySearched as $value) {
                $query->where('body', 'like', '%'.$value.'%');
            }
            $questions = $query->orderBy('created_at', 'desc')->paginate(10);
        }elseif($order == 'newdesc'){
            $questions = $query->orderBy('created_at', 'desc')->paginate(10);
        }elseif($order == 'gooddesc'){
            $questions = $query->withCount('likes')->orderBy('likes_count', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $questions = $query->orderBy('created_at', 'desc')->paginate(10);
        }
        
        // if ($search){
        //     $spaceConversion = mb_convert_kana($search, 's');
        //     $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
        //     foreach($wordArraySearched as $value) {
        //         $query->where('body', 'like', '%'.$value.'%');
        //     }
        //     $questions = $query->orderBy('created_at', 'desc')->paginate(10);
        // }
        return view('questions/index')
        ->with([
            'questions' => $questions,
            'search' => $search,
            'order' => $order,
            'about' => $about
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
    
    /**
    * 引数のIDに紐づくリプライにLIKEする
    *
    * @param $id リプライID
    * @return \Illuminate\Http\RedirectResponse
    */
    public function like($question_id)
    {
        QuestionLike::create([
            'question_id' => $question_id,
            'user_id' => Auth::id(),
        ]);
        
        session()->flash('success', 'You Liked the Question.');
        
        return redirect()->back();
    }
    
    /**
    * 引数のIDに紐づくリプライにUNLIKEする
    *
    * @param $id リプライID
    * @return \Illuminate\Http\RedirectResponse
    */
    public function unlike($question_id)
    {
        $like = QuestionLike::where('question_id', $question_id)->where('user_id', Auth::id())->first();
        $like->delete();
        
        session()->flash('success', 'You Unliked the Question.');
        
        return redirect()->back();
    }
    
    public function report($question_id)
    {
        QuestionReport::create([
            'question_id' => $question_id,
            'user_id' => Auth::id(),
        ]);
        
        session()->flash('success', 'You reported the Question.');
        
        return redirect()->back();
    }
    
    public function unreport($question_id)
    {
        $report = QuestionReport::where('question_id', $question_id)->where('user_id', Auth::id())->first();
        $report->delete();
        
        session()->flash('success', 'You Unreported the Question.');
        
        return redirect()->back();
    }

}
