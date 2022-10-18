@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>日韓質問|{{ $question->title }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="question-show-inner col-12 col-lg-7 bg-white mx-auto border-bottom  border-secondary rounded">
                    <div class="question row mt-0">
                        <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                            <div class="text-center"><a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a></div>
                        </div>
                        
                        <div class='question-inner card-body col-10 pl-0 pb-2'>
                            <div class="question-card-header">
                                @auth
                                    <div class="dropdown float-right"> 
                                        <button id="btnOpenMenu" class="detail-btn"  
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        
                                        <div class="dropdown-menu pb-0" aria-labelledby="btnOpenMenu">
                                            @if($question->user->id == Auth::user()->id)
                                                <form action="/questions/{{ $question->id }}/edit" method="GET">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">質問を編集する</button>
                                                </form>
                                                <form action="/questions/{{ $question->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item delete-btn" type="submit">質問を削除する</button>
                                                </form>
                                            @else
                                                @if($question->is_reported_by_auth_user())
                                                    <a href="{{ route('questions.unreport', ['question_id' => $question->id]) }}" class="dropdown-item">通報済み</a>
                                                @else
                                                    <a href="{{ route('questions.report', ['question_id' => $question->id]) }}" class="dropdown-item">通報する</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endauth
                                
                                <div class="question-user pt-2 pl-sm-0 pl-3">
                                    <a class="user-name pl-2 pl-sm-0" href="/users/{{ $question->user_id }}">{{ Str::limit( $question->user->name,40) }}</a>
                                </div>
                            </div>
                            
                            <div class="question-header">
                                <h2 class="title card-titile pl-sm-0 pl-3">
                                    <p class="card-titile">{{ Str::limit( $question->title, 40) }}</p>
                                </h2>
                            </div>
                            
                            <div class="question-body">
                                <p class='body card-text mt-3 mb-4'>{{ $question->body }}</p>
                                <div class="images row px-3 pl-sm-3 pl-3 pr-sm-5 pr-3">
                                    @foreach($question->question_images as $question_image)
                                        <a href="{{ $question_image->image }}" data-lightbox="a" data-alt="質問に関する画像" class="col-6 p-0 pr-1">
                                            <img src="{{ $question_image->image }}" alt="question images" class="image img-fuild mb-1 w-100 rounded">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="row mb-1 ml-0 py-2">
                                <div class="question-about col-4 m-0 p-0 text-left text-nowrap">
                                    <p class="mb-0">{{ $question->country->name }}について</p>
                                </div>
                                
                                <div class="created_at col-8 p-0 pr-3 text-right text-nowrap">
                                    <p class="mb-0">({{ $question->created_at->format('Y/m/d-G:m:s') }})</p>
                                </div>
                            </div>
                            
                            <div class="row question-card-footer w-100 pt-0 pl-2 mr-0 pb-2">
                                <div class="col-sm-2 col-5 pl-0 d-flex align-items-center text-nowrap">
                                    @auth
                                        @if(!$question->is_liked_by_auth_user())
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
                                
                                <div class="col-sm-4 col-6 d-flex align-items-center d-flex align-items-center my-sm-0 mt-2">
                                    <button class="btn py-0 pl-3 mb-0 category-link" name ="question_category">{{ $question->category->name }}</a>
                                </div>
                                
                                <div class="to-answer-page col-sm-6 col-12 text-nowrap text-right px-sm-3 px-0 pt-sm-0 pt-2">
                                    <a class="btn btn-success btn-lg rounded-pill text-nowrap py-1" href="/answers/{{ $question->id }}/create">回答する&ensp;<i class="far fa-comment-dots"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="answers">
                        <!--画像表示用-->
                        <?php $j=1; ?>
                        @foreach ($answers as $answer)
                            <div class="answer row mt-0 border-secondary border-bottom">
                                <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                                    <div class="text-center"><a href="/users/{{ $answer->user_id }}"><img src="{{ $answer->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a></div>
                                    @if(isset($answer->comments[0]))
                                        <div class="comment-flow-line h-100">
                                        </div>
                                    @endif
                                </div>
                                
                                <div class='answer-inner card-body col-10 pl-0 pb-2'>
                                    <div class="answer-card-header">
                                        @auth
                                            <div class="dropdown float-right"> 
                                                <button id="btnOpenMenu" class="detail-btn"  
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu pb-0" aria-labelledby="btnOpenMenu">
                                                    @if($answer->user->id == Auth::user()->id)
                                                        <form action="/answers/{{ $answer->id }}/edit" method="GET">
                                                            @csrf
                                                            <button class="dropdown-item" type="submit">回答を編集する</button>
                                                        </form>
                                                        <form action="/answers/{{ $answer->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item delete-btn" type="submit">回答を削除する</button>
                                                        </form>
                                                    @else
                                                        @if($answer->is_reported_by_auth_user())
                                                            <a href="{{ route('answers.unreport', ['answer_id' => $answer->id]) }}" class="dropdown-item">通報済み</a>
                                                        @else
                                                            <a href="{{ route('answers.report', ['answer_id' => $answer->id]) }}" class="dropdown-item">通報する</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endauth
                                        
                                        <div class="answer-user pt-2 pl-sm-0 pl-3">
                                            <a class="user-name pl-2 pl-sm-0" href="/users/{{ $answer->user_id }}">{{ Str::limit( $answer->user->name,40) }}</a>
                                        </div>
                                    </div>
                                    
                                    <div class="answer-body">
                                        <p class='body card-text mt-3 mb-4'>{{ $answer->body }}</p>
                                        <div class="images row px-3 pl-sm-3 pl-3 pr-sm-5 pr-3">
                                            @foreach($answer->answer_images as $answer_image)
                                                <a href="{{ $answer_image->image }}" data-lightbox="{{ $j }}" data-alt="回答に関する画像" class="col-6 p-0 pr-1">
                                                    <img src="{{ $answer_image->image }}" alt="answer images" class="image img-fuild mb-1 w-100 rounded">
                                                </a>
                                            @endforeach
                                        </div>
                                        <?php $j++;  ?>
                                    </div>
                                    
                                    <div class="row mb-1 ml-0">
                                        <div class="col-space col-4 m-0 p-0 text-left text-nowrap">
                                        </div>
                                        <div class="created_at col-8 p-0 pr-3 text-right text-nowrap">
                                            <p class="mb-0">({{ $answer->created_at->format('Y/m/d-G:m:s') }})</p>
                                        </div>
                                    </div>
                                    
                                    <div class="row answer-card-footer w-100 pt-0 px-2 pb-2">
                                        <div class="col-3 pl-0 d-flex align-items-center text-nowrap">
                                            @auth
                                                @if(!$answer->is_liked_by_auth_user())
                                                    <span class="likes">
                                                        <i class="fas fa-arrow-alt-circle-up like-btn answer-like-toggle" data-answer-id="{{ $answer->id }}"></i>
                                                        <span class="like-counter">{{ $answer->likes->count() }}</span>
                                                    </span>
                                                @else
                                                    <span class="likes">
                                                        <i class="fas fa-arrow-alt-circle-up like-btn answer-like-toggle liked" data-answer-id="{{ $answer->id }}"></i>
                                                        <span class="like-counter">{{ $answer->likes->count() }}</span>
                                                    </span>
                                                @endif
                                            @endauth
                                            @guest
                                                <span class="likes">
                                                    <a href="/login"><i class="fas fa-arrow-alt-circle-up like-btn"></i></a>
                                                    <span class="like-counter">{{ $answer->likes->count() }}</span>
                                                </span>
                                            @endguest
                                        </div>
                                        
                                        <div class="col-space col-2 d-flex align-items-center">
                                        </div>
                                        
                                        <div class="to-comment-page col-7 text-nowrap text-center d-flex align-items-center">
                                            <a class="btn btn-success btn-lg rounded-pill text-nowrap m-auto py-1" href="/comments/{{ $answer->id }}/create">コメントする&ensp;<i class="far fa-comments"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--コメントを追加ボタン表示場所決定用-->
                            <?php $i = 1; ?>
                            <!--画像表示用-->
                            <?php $k = 0; ?>
                            <div class="comments">
                                @foreach ($answer->comments as $comment)
                                    <div class="comment row mt-0 border-secondary border-bottom">
                                        <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                                            <div class="text-center bg-white pt-2"><a href="/users/{{ $comment->user_id }}"><img src="{{ $comment->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a></div>
                                            @if($i != $answer->comments->count())
                                                <div class="comment-flow-line h-100">
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class='comment-inner card-body col-10 pl-0 pb-2'>
                                            <div class="comment-card-header">
                                                @auth
                                                    <div class="dropdown float-right"> 
                                                        <button id="btnOpenMenu" class="detail-btn"  
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                        
                                                        <div class="dropdown-menu pb-0" aria-labelledby="btnOpenMenu">
                                                            @if($comment->user->id == Auth::user()->id)
                                                                <form action="/comments/{{ $comment->id }}/edit" method="GET">
                                                                    @csrf
                                                                    <button class="dropdown-item" type="submit">コメントを編集する</button>
                                                                </form>
                                                                
                                                                <form action="/comments/{{ $comment->id }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="dropdown-item delete-btn" type="submit">コメントを削除する</button>
                                                                </form>
                                                            @else
                                                                @if($comment->is_reported_by_auth_user())
                                                                    <a href="{{ route('comments.unreport', ['comment_id' => $comment->id]) }}" class="dropdown-item">通報済み</a>
                                                                @else
                                                                    <a href="{{ route('comments.report', ['comment_id' => $comment->id]) }}" class="dropdown-item">通報する</a>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endauth
                                                <div class="comment-user pt-2 pl-sm-0 pl-3">
                                                    <a class="user-name pl-2 pl-sm-0" href="/users/{{ $comment->user_id }}">{{ Str::limit( $comment->user->name,40) }}</a>
                                                </div>
                                            </div>
                                            
                                            <div class="comment-body">
                                                <p class='body card-text mt-3 mb-4'>{{ $comment->body }}</p>
                                                 <div class="images row px-3 pl-sm-3 pl-3 pr-sm-5 pr-3">
                                                    @foreach($comment->comment_images as $comment_image)
                                                        <a href="{{ $comment_image->image }}" data-lightbox="{{ $k }}" data-alt="コメントに関する画像" class="col-6 p-0 pr-1">
                                                            <img src="{{ $comment_image->image }}" alt="comment images" class="image img-fuild mb-1 w-100 rounded">
                                                        </a>
                                                    @endforeach
                                                </div>
                                                <?php $k--;  ?>
                                            </div>
                                            
                                            <div class="row mb-1 ml-0">
                                                <div class="col-space col-4 m-0 p-0 text-left text-nowrap">
                                                </div>
                                                <div class="created_at col-8 p-0 pr-3 text-right text-nowrap">
                                                    <p class="mb-0">({{ $comment->created_at->format('Y/m/d-G:m:s') }})</p>
                                                </div>
                                            </div>
                                            
                                            @if($i == $answer->comments->count())
                                                <div class="row comment-card-footer w-100 pt-0 px-2 pb-2">
                                                    <div class="col-space col-3 pl-0 d-flex align-items-center">
                                                    </div>
                                                    <div class="col-space col-2 d-flex align-items-center">
                                                    </div>
                                                    <div class="to-comment-page col-7 text-nowrap text-center d-flex align-items-center">
                                                        <a class="btn btn-success btn-lg rounded-pill text-nowrap m-auto py-1" href="/comments/{{ $answer->id }}/create">コメント追加&ensp;<i class="far fa-comments"></i></a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="footer py-3 text-center">
                        <a href="/" class="btn btn-secondary rounded">ホームへ戻る&ensp;<i class="fas fa-home"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection