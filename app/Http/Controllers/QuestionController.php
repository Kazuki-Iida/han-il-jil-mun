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
use App\AnswerLike;
use App\QuestionReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class QuestionController extends Controller
{
    public function index(Request $request)
    {
        // 以下並べ替えに関するコード
        $search = $request->input('search');
        $order = $request->input('order');
        $about = $request->input('about');
        $question_category = $request->input('question_category');
        
        if(!$order){
            $order = 'gooddesc';
        }
        
        if(!$about){
            $about = 1;
        }
        
        if(!$question_category){
            $query = Question::query()->where('country_id', $about);
            $question_category = 0;
        }elseif($question_category == 0){
            $query = Question::query()->where('country_id', $about)->where('category_id', $question_category);
        }else{
            $query = Question::query()->where('country_id', $about)->where('category_id', $question_category);
        }
                
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
        
        $category = Category::query()->withCount('questions')->orderBy('questions_count', 'desc')->orderBy('created_at');
        
        
        // 以下ユーザーのgoodランキングに関するコード
        $dt_from = new \Carbon\Carbon();
		$dt_from->startOfMonth();

		$dt_to = new \Carbon\Carbon();
		$dt_to->endOfMonth();
		
        $question_likes = QuestionLike::whereBetween('created_at', [$dt_from, $dt_to])->get();
        
        foreach($question_likes as $question_like){
            $question_user = $question_like->question->user_id;
            $ranking[] = $question_user;
        }
        $question_good_ranking_counts = array_count_values($ranking);
        $question_good_ranking_users_numbers = array_keys($question_good_ranking_counts);
        
        $i = 1;
        foreach($question_good_ranking_users_numbers as $question_good_ranking_users_number){
            $question_good_ranking_users[] = User::where('id', $question_good_ranking_users_number)->first();
            $i++;
            if($i == 8){
                break;
            }
        }

        
        $answer_likes = AnswerLike::whereBetween('created_at', [$dt_from, $dt_to])->get();
        
        foreach($answer_likes as $answer_like){
            $answer_user = $answer_like->answer->user_id;
            $ranking[] = $answer_user;
        }
        $answer_good_ranking_counts = array_count_values($ranking);
        $answer_good_ranking_users_numbers = array_keys($answer_good_ranking_counts);
        
        $j = 1;
        foreach($answer_good_ranking_users_numbers as $answer_good_ranking_users_number){
            $answer_good_ranking_users[] = User::where('id', $answer_good_ranking_users_number)->first();
            $j++;
            if($j ==  8){
                break;
            }
        }
        
        
        return view('questions/index')
        ->with([
            'questions' => $questions,
            'search' => $search,
            'order' => $order,
            'about' => $about,
            'question_category' => $question_category,
            'categories' => $category->get(),
            'question_good_ranking_users' => $question_good_ranking_users,
            'question_good_ranking_counts' => $question_good_ranking_counts,
            'answer_good_ranking_users' => $answer_good_ranking_users,
            'answer_good_ranking_counts' => $answer_good_ranking_counts
            ]);
    }
        
        
        // return view('questions/index')->with(['questions' => $question->getPaginateByLimit()]);  
    // }
    
    public function show(Question $question)
    {
        $answers = Answer::query()->where('question_id', $question->id)->withCount('likes')->orderBy('likes_count', 'desc')->orderBy('created_at', 'desc')->get();
        return view('questions/show')->with(['question' => $question, 'answers' => $answers]);
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
    
    public function like($question_id)
    {
        QuestionLike::create([
            'question_id' => $question_id,
            'user_id' => Auth::id(),
        ]);
        
        session()->flash('success', 'You Liked the Question.');
        
        return redirect()->back();
    }
    
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
