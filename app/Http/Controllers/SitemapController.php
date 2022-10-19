<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Question;
use App\Answer;
use App\Comment;
use App\User;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        $sitemap = App::make("sitemap");

        // Topページ
        $sitemap->add(URL::to('/'), now(), '1.0', 'always');

        // DBのデータを元に動的に質問表示画面のurl取得
        $questions = Question::query()->orderBy('updated_at', 'DESC')->get();
        foreach ($questions as $question) {
            $sitemap->add(route('questions.show', compact('question')), $question->updated_at, '1.0', 'always');
        }
        
        // 質問作成画面
        $sitemap->add(URL::to('/questions/create'), now(), '1.0', 'always');
        // 質問編集画面
        foreach ($questions as $question) {
            $sitemap->add(route('questions.edit', compact('question')), $question->updated_at, '0.8', 'always');
        }
        
        // 回答作成画面
        foreach ($questions as $question) {
            $sitemap->add(route('answers.create', compact('question')), $question->updated_at, '0.8', 'always');
        }
        // 回答編集画面
        $answers = Answer::query()->orderBy('updated_at', 'DESC')->get();
                foreach ($answers as $answer) {
                    $sitemap->add(route('answers.edit', compact('answer')), $answer->updated_at, '0.8', 'always');
                }        
                
        // コメント作成画面
        foreach ($answers as $answer) {
                    $sitemap->add(route('comments.create', compact('answer')), $answer->updated_at, '0.8', 'always');
                }        
        // コメント編集画面
        $comments = Comment::query()->orderBy('updated_at', 'DESC')->get();
                foreach ($comments as $comment) {
                    $sitemap->add(route('comments.edit', compact('comment')), $comment->updated_at, '0.8', 'always');
                }       
        
        // ユーザー表示画面
        $users = User::query()->orderBy('updated_at', 'DESC')->get();
                foreach ($users as $user) {
                    $sitemap->add(route('users.show', compact('user')), $user->updated_at, '0.8', 'always');
                }  
        // ユーザー編集画面
        foreach ($users as $user) {
                    $sitemap->add(route('users.edit', compact('user')), $user->updated_at, '0.8', 'always');
                }
        
        // 会員登録画面
        $sitemap->add(URL::to('/register'), now(), '0.7', 'monthly');
        // ログイン画面
        $sitemap->add(URL::to('/login'), now(), '0.7', 'monthly');
        // 本登録完了画面
        $sitemap->add(URL::to('/verified'), now(), '0.7', 'monthly');
        // 本登録未完了画面
        $sitemap->add(URL::to('/verify'), now(), '0.7', 'monthly');
        
        // プライバシーポリシー
        $sitemap->add(URL::to('/privacy'), now(), '0.9', 'always');
        
        // XMLファイルで出力する場合
        $sitemap->store('xml', 'mysitemap');

        // 出力
        return $sitemap->render('xml');
    }
}
