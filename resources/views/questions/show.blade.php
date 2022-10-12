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
        <script type="text/javascript"> 
            function check(){
            	if(window.confirm('削除してよろしいですか？')){
            		return true;
            	}
                else{ 
            		window.alert('キャンセルされました');
            		return false;
            	}
            }
        </script>
<!--        <ul class="list">-->
<!--    <li class="list-item">item1</li>-->
<!--    <li class="list-item">item2</li>-->
<!--    <li class="list-item">item3</li>-->
<!--    <li class="list-item">item4</li>-->
<!--    <li class="list-item">item5</li>-->
<!--    <li class="list-item">item6</li>-->
<!--    <li class="list-item">item7</li>-->
<!--    <li class="list-item">item8</li>-->
<!--    <li class="list-item">item9</li>-->
<!--    <li class="list-item">item10</li>-->
<!--    <li class="list-item">item11</li>-->
<!--    <li class="list-item">item12</li>-->
<!--    <li class="list-item">item13</li>-->
<!--    <li class="list-item">item14</li>-->
<!--    <li class="list-item">item15</li>-->
<!--    <li class="list-item">item16</li>-->
<!--    <li class="list-item">item17</li>-->
<!--    <li class="list-item">item18</li>-->
<!--    <li class="list-item">item19</li>-->
<!--    <li class="list-item">item20</li>-->
<!--</ul>-->
<!--<div class="list-btn">-->
<!--    <button>もっと見る</button>-->
<!--</div>-->
        <div class="container">
            <div class="row">
                <div class="question-show-inner col-12 col-lg-7 bg-white mx-auto rounded">
                    <div class="question row mt-0 border-success border-bottom">
                        <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                            <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a>
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
                                                    <button class="dropdown-item" type="submit">質問を削除する</button>
                                                </form>
                                            @else
                                                @if($question->is_reported_by_auth_user())
                                                    <a href="{{ route('question.unreport', ['question_id' => $question->id]) }}" class="dropdown-item">通報済み</a>
                                                @else
                                                    <a href="{{ route('question.report', ['question_id' => $question->id]) }}" class="dropdown-item">通報する</a>
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
                                    <a class="card-titile" href="/questions/{{ $question->id }}">{{ Str::limit( $question->title, 40) }}</a>
                                </h2>
                            </div>
                            <div class="question-body">
                                <a href="/questions/{{ $question->id }}"><p class='body card-text mt-3 mb-4'>{{ $question->body }}</p></a>
                                <div class="images row px-3 pl-sm-3 pl-3 pr-sm-5 pr-3">
                                    @foreach($question->question_images as $question_image)
                                        <a href="{{ $question_image->image }}" data-lightbox="a" data-alt="質問に関する画像" class="col-6 p-0">
                                            <img src="{{ $question_image->image }}" alt="question images" class="image img-fuild pr-1 mb-1 w-100">
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
                            <div class="row question-card-footer w-100 pt-0 px-2 pb-2">
                                <div class="col-2 pl-0 d-flex align-items-center">
                                    @if($question->is_liked_by_auth_user())
                                        <a href="{{ route('question.unlike', ['question_id' => $question->id]) }}" class="good-btn btn btn-success btn-sm text-nowrap"><i class="far fa-thumbs-up"></i><span class="badge">{{ $question->likes->count() }}</span></a>
                                    @else
                                        <a href="{{ route('question.like', ['question_id' => $question->id]) }}" class="good-btn btn btn-secondary btn-sm text-nowrap"><i class="far fa-thumbs-up"></i><span class="badge">{{ $question->likes->count() }}</span></a>
                                    @endif
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <button class="btn py-0 mb-0 category-link" name ="question_category">{{ $question->category->name }}</a>
                                </div>
                                <div class="to-answer-page col-6 text-nowrap text-center d-flex align-items-center">
                                    <a class="btn btn-success btn-lg rounded-pill text-nowrap m-auto py-1" href="/answers/{{ $question->id }}/create">回答する&ensp;<i class="far fa-comment-dots"></i></a>
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
                                    <a href="/users/{{ $answer->user_id }}"><img src="{{ $answer->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a>
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
                                                            <button class="dropdown-item" type="submit">回答を削除する</button>
                                                        </form>
                                                    @else
                                                        @if($answer->is_reported_by_auth_user())
                                                            <a href="{{ route('answer.unreport', ['answer_id' => $answer->id]) }}" class="dropdown-item">通報済み</a>
                                                        @else
                                                            <a href="{{ route('answer.report', ['answer_id' => $answer->id]) }}" class="dropdown-item">通報する</a>
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
                                                <a href="{{ $answer_image->image }}" data-lightbox="{{ $j }}" data-alt="回答に関する画像" class="col-6 p-0">
                                                    <img src="{{ $answer_image->image }}" alt="answer images" class="image img-fuild pr-1 mb-1 w-100">
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
                                        <div class="col-3 pl-0 d-flex align-items-center">
                                            @if($answer->is_liked_by_auth_user())
                                                <a href="{{ route('answer.unlike', ['answer_id' => $answer->id]) }}" class="good-btn btn btn-success btn-sm text-nowrap"><i class="far fa-thumbs-up"></i><span class="badge">{{ $answer->likes->count() }}</span></a>
                                            @else
                                                <a href="{{ route('answer.like', ['answer_id' => $answer->id]) }}" class="good-btn btn btn-secondary btn-sm text-nowrap"><i class="far fa-thumbs-up"></i><span class="badge">{{ $answer->likes->count() }}</span></a>
                                            @endif
                                        </div>
                                        <div class="col-space col-3 d-flex align-items-center">
                                        </div>
                                        <div class="to-comment-page col-6 text-nowrap text-center d-flex align-items-center">
                                            <a class="btn btn-success btn-lg rounded-pill text-nowrap m-auto py-1" href="/comments/{{ $answer->id }}/create">コメントする&ensp;<i class="far fa-comments"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--コメントを追加ボタン表示場所決定用-->
                            <?php $i = 1; ?>
                            <!--画像表示用-->
                            <?php $k = 0; ?>
                            @foreach ($answer->comments as $comment)
                                <div class="comment row mt-0 border-secondary border-bottom">
                                    <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                                        <a href="/users/{{ $comment->user_id }}"><img src="{{ $comment->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a>
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
                                                                <button class="dropdown-item" type="submit">コメントを削除する</button>
                                                            </form>
                                                        @else
                                                            @if($comment->is_reported_by_auth_user())
                                                                <a href="{{ route('comment.unreport', ['comment_id' => $comment->id]) }}" class="dropdown-item">通報済み</a>
                                                            @else
                                                                <a href="{{ route('comment.report', ['comment_id' => $comment->id]) }}" class="dropdown-item">通報する</a>
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
                                                    <a href="{{ $comment_image->image }}" data-lightbox="{{ $k }}" data-alt="コメントに関する画像" class="col-6 p-0">
                                                        <img src="{{ $comment_image->image }}" alt="comment images" class="image img-fuild pr-1 mb-1 w-100">
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
                                                <div class="col-space col-3 d-flex align-items-center">
                                                </div>
                                                <div class="to-comment-page col-6 text-nowrap text-center d-flex align-items-center">
                                                    <a class="btn btn-success btn-lg rounded-pill text-nowrap m-auto py-1" href="/comments/{{ $answer->id }}/create">コメント追加&ensp;<i class="far fa-comments"></i></a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach
                        @endforeach
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    <div class="answers">
                        @foreach ($answers as $answer)
                            <div class='answer'>
                                <h2 class='answerer'>
                                    {{ $answer->user->name }}
                                </h2>
                                <p class='body'>{{ $answer->body }}</p>
                                @foreach($answer->answer_images as $answer_image)
                                    <img src="{{ $answer_image->image }}" alt="answer images" class="img-fuild" width="150" height="100">
                                @endforeach
                                <div class="answer-good">
                                    @if($answer->is_liked_by_auth_user())
                                        <a href="{{ route('answer.unlike', ['answer_id' => $answer->id]) }}" class="btn btn-success btn-sm">Good<span class="badge">{{ $answer->likes->count() }}</span></a>
                                    @else
                                        <a href="{{ route('answer.like', ['answer_id' => $answer->id]) }}" class="btn btn-secondary btn-sm">Good<span class="badge">{{ $answer->likes->count() }}</span></a>
                                    @endif
                                </div>
                                <div class="report">
                                    @if($answer->is_reported_by_auth_user())
                                        <a href="{{ route('answer.unreport', ['answer_id' => $answer->id]) }}" class="btn btn-dark btn-sm">通報</a>
                                    @else
                                        <a href="{{ route('answer.report', ['answer_id' => $answer->id]) }}" class="btn btn-secondary btn-sm">通報</a>
                                    @endif
                                </div>
                            </div>
                            @auth
                                @if($answer->user->id == Auth::id())
                                    <div class="to-answer-edit-page">
                                        <a href="/answers/{{ $answer->id }}/edit">編集する</a>
                                    </div>
                                    <form action="/answers/{{ $answer->id }}" id="form_{{ $answer->id }}" method="post" onSubmit="return check()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除する</button> 
                                    </form>
                                @endif
                            @endauth
                            <div class="to-comment-page">
                                <a href="/comments/{{ $answer->id }}/create">コメントする</a>
                            </div>
                            @foreach ($answer->comments as $comment)
                                <div class='comment'>
                                    <h2 class='commenter'>
                                        {{ $comment->user->name }}
                                    </h2>
                                    <p class='body'>{{ $comment->body }}</p>
                                    @foreach($comment->comment_images as $comment_image)
                                        <img src="{{ $comment_image->image }}" alt="comment images" class="img-fuild" width="150" height="100">
                                    @endforeach
                                    <div class="report">
                                        @if($comment->is_reported_by_auth_user())
                                            <a href="{{ route('comment.unreport', ['comment_id' => $comment->id]) }}" class="btn btn-dark btn-sm">通報</a>
                                        @else
                                            <a href="{{ route('comment.report', ['comment_id' => $comment->id]) }}" class="btn btn-secondary btn-sm">通報</a>
                                        @endif
                                    </div>
                                </div>
                                @auth
                                    @if($comment->user->id == Auth::id())
                                        <div class="to-comment-edit-page">
                                            <a href="/comments/{{ $comment->id }}/edit">編集する</a>
                                        </div>
                                        <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post" onSubmit="return check()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">削除する</button> 
                                        </form>
                                    @endif
                                @endauth
                            @endforeach
                        @endforeach
                    </div>
                    <div class="footer">
                        <a href="/">戻る</a>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        <h1 class="title">
            {{ $question->title }}
        </h1>
        <div class="user">
            <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width="60" height="60">{{ $question->user->name }}</a>
        </div>
        <div class="content">
            <div class="content__question">
                <h3>本文</h3>
                <p>{{ $question->body }}</p>
                @foreach($question->question_images as $question_image)
                    <img src="{{ $question_image->image }}" alt="question images" class="img-fuild" width="150" height="100">
                @endforeach  
            </div>
            <div class="category-show">
                <a href="/categories/{{ $question->category->id }}">{{ $question->category->name }}</a>
            </div>
            <div class="coutry-show">
                <a href="/countries/{{ $question->country->id }}">{{ $question->country->name }}</a>
            </div>
            <div class="report">
                @if($question->is_reported_by_auth_user())
                    <a href="{{ route('question.unreport', ['question_id' => $question->id]) }}" class="btn btn-dark btn-sm">通報</a>
                @else
                    <a href="{{ route('question.report', ['question_id' => $question->id]) }}" class="btn btn-secondary btn-sm">通報</a>
                @endif
            </div>
        </div>
        
        
        
        <div class="to-answer-page">
            <a href="/answers/{{ $question->id }}/create">回答する</a>
        </div>
        @auth
            @if($question->user->id == Auth::id())
                <div class="to-question-edit-page">
                    <a href="/questions/{{ $question->id }}/edit">編集する</a>
                </div>
                <form action="/questions/{{ $question->id }}" id="form_{{ $question->id }}" method="post" onSubmit="return check()">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除する</button> 
                </form>
            @endif
        @endauth
        <div class="answers">
            @foreach ($answers as $answer)
                <div class='answer'>
                    <h2 class='answerer'>
                        {{ $answer->user->name }}
                    </h2>
                    <p class='body'>{{ $answer->body }}</p>
                    @foreach($answer->answer_images as $answer_image)
                        <img src="{{ $answer_image->image }}" alt="answer images" class="img-fuild" width="150" height="100">
                    @endforeach
                    <div class="answer-good">
                        @if($answer->is_liked_by_auth_user())
                            <a href="{{ route('answer.unlike', ['answer_id' => $answer->id]) }}" class="btn btn-success btn-sm">Good<span class="badge">{{ $answer->likes->count() }}</span></a>
                        @else
                            <a href="{{ route('answer.like', ['answer_id' => $answer->id]) }}" class="btn btn-secondary btn-sm">Good<span class="badge">{{ $answer->likes->count() }}</span></a>
                        @endif
                    </div>
                    <div class="report">
                        @if($answer->is_reported_by_auth_user())
                            <a href="{{ route('answer.unreport', ['answer_id' => $answer->id]) }}" class="btn btn-dark btn-sm">通報</a>
                        @else
                            <a href="{{ route('answer.report', ['answer_id' => $answer->id]) }}" class="btn btn-secondary btn-sm">通報</a>
                        @endif
                    </div>
                </div>
                @auth
                    @if($answer->user->id == Auth::id())
                        <div class="to-answer-edit-page">
                            <a href="/answers/{{ $answer->id }}/edit">編集する</a>
                        </div>
                        <form action="/answers/{{ $answer->id }}" id="form_{{ $answer->id }}" method="post" onSubmit="return check()">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除する</button> 
                        </form>
                    @endif
                @endauth
                <div class="to-comment-page">
                    <a href="/comments/{{ $answer->id }}/create">コメントする</a>
                </div>
                @foreach ($answer->comments as $comment)
                    <div class='comment'>
                        <h2 class='commenter'>
                            {{ $comment->user->name }}
                        </h2>
                        <p class='body'>{{ $comment->body }}</p>
                        @foreach($comment->comment_images as $comment_image)
                            <img src="{{ $comment_image->image }}" alt="comment images" class="img-fuild" width="150" height="100">
                        @endforeach
                        <div class="report">
                            @if($comment->is_reported_by_auth_user())
                                <a href="{{ route('comment.unreport', ['comment_id' => $comment->id]) }}" class="btn btn-dark btn-sm">通報</a>
                            @else
                                <a href="{{ route('comment.report', ['comment_id' => $comment->id]) }}" class="btn btn-secondary btn-sm">通報</a>
                            @endif
                        </div>
                    </div>
                    @auth
                        @if($comment->user->id == Auth::id())
                            <div class="to-comment-edit-page">
                                <a href="/comments/{{ $comment->id }}/edit">編集する</a>
                            </div>
                            <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post" onSubmit="return check()">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除する</button> 
                            </form>
                        @endif
                    @endauth
                @endforeach
            @endforeach
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
@endsection