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
            <div id="page_top">
                <a href="#"></a>
            </div>
            
            <div class="questions-index row">
                <div class="question-index-inner bg-white col-11 col-lg-7 mx-auto rounded">
                    <div class="serch-wrapper pt-3 pr-3 pl-3">
                        <form action="/" method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="search" placeholder="質問を検索" name="search" class="search-form form-control" value="@if (isset($search)) {{ $search }} @endif">
                                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i>検索</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="index-btn-wrapper row py-4 px-2">
                        <div class="dropdown-wrapper col-6 text-center">
                            <div class="dropdown"> 
                                <button id="btnOpenMenu" class="btn btn-primary dropdown-toggle w-100 w-sm-75 mt-1"  
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if($about == '1')
                                        日本について
                                    @else
                                        韓国について
                                    @endif
                                </button>
                                
                                <div class="dropdown-menu pb-0" aria-labelledby="btnOpenMenu">
                                    <form action="/" method="GET">
                                        @csrf
                                        <input type="hidden" name="order" value="{{ $order }}">
                                        <input type="hidden" name="question_category" value="{{ $question_category }}">
                                        <button class="dropdown-item" name ="about" type="submit" value=1>日本について質問</a>
                                        <button class="dropdown-item" name ="about" type="submit" value=2>韓国について質問</a>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="dropdown"> 
                                <button id="btnOpenMenu" class="btn btn-primary dropdown-toggle w-100 w-sm-75 mt-1"  
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if($order == 'newdesc')
                                        新着順
                                    @else
                                        Goodの多い順
                                    @endif
                                </button>
                                
                                <div class="dropdown-menu pb-0" aria-labelledby="btnOpenMenu">
                                    <form action="/" method="GET">
                                        @csrf
                                        <input type="hidden" name ="about" value="{{ $about }}">
                                        <input type="hidden" name="question_category" value="{{ $question_category }}">
                                        <button class="dropdown-item" name ="order" type="submit" value="gooddesc">Goodの多い順</a>
                                        <button class="dropdown-item" name ="order" type="submit" value="newdesc">新着順</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="create-btn col-6 text-center d-flex align-items-center text-nowrap">
                            <a class="btn btn-success btn-lg rounded-pill text-nowrap m-auto" href='/questions/create'>質問を投稿&ensp;<i class="fas fa-pencil-alt"></i></a>
                        </div>
                    </div>
                    
                    <div class='questions'>
                        <div class="card-wrapper mb-4 mr-2 ml-2 border-top border-success">
                            <!--画像表示用-->
                            <?php $k=1; ?>
                            @foreach ($questions as $question)
                                <div class="question row mt-0 border-success border-bottom">
                                    <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                                        <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a>
                                    </div>
                                    
                                    <div class='question-inner card-body col-10 pl-0'>
                                        <div class="question-card-header">
                                            <div class="question-user pt-2 pl-sm-0 pl-3">
                                                <a class="user-name pl-2 pl-sm-0" href="/users/{{ $question->user_id }}">{{ Str::limit( $question->user->name,40) }}</a>
                                            </div>
                                        </div>
                                        
                                        <div class="question-header">
                                            <h2 class="title card-titile pl-sm-0 pl-3">
                                                <a class="card-titile" href="/questions/{{ $question->id }}">{{ Str::limit( $question->title, 40) }}</a>
                                            </h2>
                                        </div>
                                        
                                        <div class="question-body">
                                            <a href="/questions/{{ $question->id }}"><p class='body card-text mt-3 mb-4'>{{ $question->body }}</p></a>
                                            <div class="images row px-3 pl-sm-3 pl-3 pr-sm-5 pr-3">
                                                @foreach($question->question_images as $question_image)
                                                    <a href="{{ $question_image->image }}" data-lightbox="{{ $k }}" data-alt="質問に関する画像" class="col-6 p-0 pr-1">
                                                        <img src="{{ $question_image->image }}" alt="question images" class="image img-fuild mb-1 w-100 rounded">
                                                    </a>
                                                @endforeach
                                                <?php $k++; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="created_at text-right">
                                            <p>({{ $question->created_at->format('Y/m/d-G:m:s') }})</p>
                                        </div>
                                        
                                        <div class="row question-card-footer">
                                            <div class="col-sm-2 col-6 text-nowrap">
                                                @auth
                                                    @if(!Auth::user()->hasVerifiedEmail())
                                                        <span class="likes">
                                                            <a href="/verified"><i class="fas fa-thumbs-up like-btn"></i></a>
                                                            <span class="like-counter">{{ $question->likes->count() }}</span>
                                                        </span>
                                                    @elseif(!$question->is_liked_by_auth_user())
                                                        <span class="likes">
                                                            <i class="fas fa-thumbs-up like-btn question-like-toggle" data-question-id="{{ $question->id }}"></i>
                                                            <span class="like-counter">{{ $question->likes->count() }}</span>
                                                        </span>
                                                    @else
                                                        <span class="likes">
                                                            <i class="fas fa-thumbs-up like-btn question-like-toggle liked" data-question-id="{{ $question->id }}"></i>
                                                            <span class="like-counter">{{ $question->likes->count() }}</span>
                                                        </span>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <span class="likes">
                                                        <a href="/login"><i class="fas fa-thumbs-up like-btn"></i></a>
                                                        <span class="like-counter">{{ $question->likes->count() }}</span>
                                                    </span>
                                                @endguest
                                            </div>
                                            
                                            <div class="col-sm-4 col-6">
                                                <form action="/" method="GET">
                                                    @csrf
                                                    <input type="hidden" name="order" value="{{ $order }}">
                                                    <input type="hidden" name="about" value="{{ $about }}">
                                                    <button class="btn py-0 mb-3 category-link" name ="question_category" type="submit" value={{ $question->category->id }}>{{ $question->category->name }}</a>
                                                </form>
                                            </div>
                                            <p class="col-sm-3 col-6">{{ $question->country->name }}について</p>
                                            
                                            <div class="answers-count col-sm-3 col-6">
                                                <p>回答数：{{ $question->answers->count() }}</p>
                                            </div>
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
                
                <div class="side-column bg-white col-11 col-lg-4 mt-4 mt-lg-0 mx-auto px-3 rounded">
                    <div class="category-index pb-2">
                        <h2 class="category-index-title mt-3 border-bottom border-success">カテゴリー一覧</h2>
                        <ul>
                            <li>
                                <div class="category-index-link border-bottom mr-2">
                                    <form action="/" method="GET">
                                        @csrf
                                        <input type="hidden" name="order" value="{{ $order }}">
                                        <input type="hidden" name="about" value="{{ $about }}">
                                        <button class="category-index-btn btn my-0 py-2 w-100 h-auto text-left" name ="question_category" type="submit" value=0>全てのカテゴリー</a>
                                    </form>
                                </div>
                            </li>
                            
                            @foreach($categories as $category)
                            <li>
                                <div class="category-index-link border-bottom mr-2">
                                    <form action="/" method="GET">
                                        @csrf
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
                        <h2 class="category-index-title mt-3 border-bottom border-success">質問&thinsp;<i class="fas fa-thumbs-up"></i>&thinsp;ランキング(月間)</h2>
                        <ul>
                            <?php $i = 0; $j = null; ?>
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
                                <?php $j = $question_good_ranking_counts[$question_good_ranking_user->id] ; ?>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="answer-ranking pt-2">
                        <h2 class="category-index-title mt-3 border-bottom border-success">回答&thinsp;<i class="fas fa-arrow-alt-circle-up"></i>&thinsp;ランキング(月間)</h2>
                        
                        <ul>
                            <?php $i = 0; $j = null; ?>
                            @foreach($answer_good_ranking_users as $answer_good_ranking_user)
                                @if($answer_good_ranking_counts[$answer_good_ranking_user->id] != $j)
                                    <?php $i++; ?>
                                @endif
                                <li>
                                    <div class="answer-good-ranking-link border-bottom mr-2">
                                        <a href="/users/{{ $answer_good_ranking_user->id }}" class="good-ranking-btn btn my-0 py-2 w-100 h-auto text-left">
                                            <span>{{ $i }}位 &emsp;</span>
                                            {{ Str::limit($answer_good_ranking_user->name, 30) }}
                                            <span class="ranking-count float-right">{{ $answer_good_ranking_counts[$answer_good_ranking_user->id] }}Good!!</span>
                                        </a>
                                    </div>
                                </li>
                                <?php $j = $answer_good_ranking_counts[$answer_good_ranking_user->id] ; ?>
                            @endforeach
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection