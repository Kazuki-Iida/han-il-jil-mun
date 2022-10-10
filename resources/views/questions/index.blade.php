@extends('layouts.app')　
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="body-inner-of-index container">
            <div class="questions-index row">
                <div class="question-index-inner bg-white col-sm-11 col-md-7 mx-auto rounded">
                    <div class="dropdown"> 
                        <button id="btnOpenMenu" class="btn btn-primary dropdown-toggle"  
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if($order == 'newdesc')
                                新着順
                            @else
                                Goodの多い順
                            @endif
                        </button>
                        <div class="dropdown-menu pb-0" aria-labelledby="btnOpenMenu">
                            <form action="/questions" method="GET">
                                <input type="hidden" name ="about" value="{{ $about }}">
                                <input type="hidden" name="question_category" value="{{ $question_category }}">
                                <button class="dropdown-item" name ="order" type="submit" value="gooddesc">Goodの多い順</a>
                                <button class="dropdown-item" name ="order" type="submit" value="newdesc">新着順</a>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown"> 
                        <button id="btnOpenMenu" class="btn btn-primary dropdown-toggle"  
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if($about == '1')
                                日本について
                            @else
                                韓国について
                            @endif
                        </button>
                        <div class="dropdown-menu pb-0" aria-labelledby="btnOpenMenu">
                            <form action="/questions" method="GET">
                                <input type="hidden" name="order" value="{{ $order }}">
                                <input type="hidden" name="question_category" value="{{ $question_category }}">
                                <button class="dropdown-item" name ="about" type="submit" value=1>日本について質問</a>
                                <button class="dropdown-item" name ="about" type="submit" value=2>韓国について質問</a>
                            </form>
                        </div>
                    </div>
                    [<a href='/questions/create'>create</a>]
                    <div class='questions'>
                        <div class="card-wrapper mb-4 mr-2 ml-2 border-top border-success">
                            @foreach ($questions as $question)
                                <div class="question row mt-0 border-success border-bottom">
                                    <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                                        <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a>
                                    </div>
                                    <div class='question-inner card-body col-10 pl-0'>
                                        <div class="question-card-header row">
                                            <div class="question-user col-6">
                                                <a class="user-name pl-2 pl-sm-0" href="/users/{{ $question->user_id }}">{{ Str::limit( $question->user->name,40) }}</a>
                                            </div>
                                            <div class="created_at col-6 float-right">
                                                <p>{{ $question->created_at->format('Y/m/d-G:m:s') }}</p>
                                            </div>
                                        </div>
                                        <div class="question-header">
                                            <h2 class="title card-titile">
                                                <a class="card-titile" href="/questions/{{ $question->id }}">{{ Str::limit( $question->title, 40) }}</a>
                                            </h2>
                                        </div>
                                        <a href="/questions/{{ $question->id }}"><p class='body card-text mt-3 mb-4'>{{ $question->body }}</p></a>
                                        <div class="row">
                                            <div class="col-3">
                                                @if($question->is_liked_by_auth_user())
                                                    <a href="{{ route('question.unlike', ['question_id' => $question->id]) }}" class="btn btn-success btn-sm">Good<span class="badge">{{ $question->likes->count() }}</span></a>
                                                @else
                                                    <a href="{{ route('question.like', ['question_id' => $question->id]) }}" class="btn btn-secondary btn-sm">Good<span class="badge">{{ $question->likes->count() }}</span></a>
                                                @endif
                                            </div>
                                            <div class="col-3">
                                                <form action="/questions" method="GET">
                                                    <input type="hidden" name="order" value="{{ $order }}">
                                                    <input type="hidden" name="about" value="{{ $about }}">
                                                    <button class="btn py-0 mb-3 category-link" name ="question_category" type="submit" value={{ $question->category->id }}>{{ $question->category->name }}</a>
                                                </form>
                                            </div>
                                            <p class="col-3">{{ $question->country->name }}について</p>
                                            <div class="answers-count col-3"><p>回答数：{{ $question->answers->count() }}</p></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="paginate index-paginate">
                        {{ $questions->appends(request()->input())->links() }}
                    </div>
                </div>
                <div class="side-column bg-white col-sm-11 col-md-4 mt-4 mt-sm-0 mx-auto rounded">
                    <div class="category-index pb-2">
                        <h2 class="category-index-title mt-3 border-bottom border-success">カテゴリー一覧</h2>
                        <ul>
                            <li>
                                <div class="category-index-link border-bottom mr-2">
                                    <form action="/questions" method="GET">
                                        <input type="hidden" name="order" value="{{ $order }}">
                                        <input type="hidden" name="about" value="{{ $about }}">
                                        <button class="category-index-btn btn my-0 py-2 w-100 h-auto text-left" name ="question_category" type="submit" value=0>全てのカテゴリー</a>
                                    </form>
                                </div>
                            </li>
                            @foreach($categories as $category)
                            <li>
                                <div class="category-index-link border-bottom mr-2">
                                    <form action="/questions" method="GET">
                                        <input type="hidden" name="order" value="{{ $order }}">
                                        <input type="hidden" name="about" value="{{ $about }}">
                                        <button class="category-index-btn btn my-0 py-2 w-100 h-auto text-left" name ="question_category" type="submit" value={{ $category->id }}>{{ $category->name }}</a>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="question-ranking">
                        <h2 class="category-index-title mt-3 border-bottom border-success">質問Goodランキング(月間)</h2>
                        <ul>
                            <?php $i = 0; $j = $question_good_ranking_counts[$question_good_ranking_users[1]->id]; ?>
                            @foreach($question_good_ranking_users as $question_good_ranking_user)
                                @if($question_good_ranking_counts[$question_good_ranking_user->id] != $j)
                                    <?php $i++; ?>
                                @endif
                                <li>
                                    <div class="question-good-ranking-link border-bottom mr-2">
                                        <a href="/users/{{ $question_good_ranking_user->id }}" class="good-ranking-btn btn my-0 py-2 w-100 h-auto text-left">
                                            <span>{{ $i }}位 &emsp;</span>
                                            {{ Str::limit($question_good_ranking_user->name, 30) }}
                                            <span class="ranking-count float-right">{{ $question_good_ranking_counts[$question_good_ranking_user->id] }}Good!!</span>
                                        </a>
                                    </div>
                                </li>
                                <?php $j =  $question_good_ranking_counts[$question_good_ranking_user->id] ; ?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="answer-ranking pt-2">
                        <h2 class="category-index-title mt-3 border-bottom border-success">回答Goodランキング(月間)</h2>
                        <ul>
                            <?php $i = 0; $j = $question_good_ranking_counts[$question_good_ranking_users[1]->id]; ?>
                            @foreach($answer_good_ranking_users as $answer_good_ranking_user)
                            @if($answer_good_ranking_counts[$answer_good_ranking_user->id] != $j)
                                <?php $i++; ?>
                            @endif
                            <li>
                                <div class="answer-good-ranking-link border-bottom mr-2">
                                    <a href="/users/{{ $answer_good_ranking_user->id }}" class="good-ranking-btn btn my-0 py-2 w-100 h-auto text-left">
                                        <span>{{ $i }}位 &emsp;</span>
                                        {{ Str::limit($answer_good_ranking_user->name, 30) }}
                                        <span class="ranking-count float-right">{{ $answer_good_ranking_counts[$question_good_ranking_user->id] }}Good!!</span>
                                    </a>
                                </div>
                            </li>
                            <?php $j =  $question_good_ranking_counts[$question_good_ranking_user->id] ; ?>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection