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
                <div class='answer' id="{{ $i }}">
                    <h2 class='answerer'>
                        {{ $answer->user->name }}
                    </h2>
                    <p class='body'>{{ $answer->body }}</p>
                    @foreach($answer->answer_images as $answer_image)
                        <img src="{{ $answer_image->image }}" alt="answer images" class="img-fuild" width="150" height="100">
                    @endforeach
                    <div class="answer-good">
                        @if($answer->is_liked_by_auth_user())
                            <a href="{{ route('answer.unlike', ['answer_id' => $answer->id, 'id' => $i]) }}" class="btn btn-success btn-sm">Good<span class="badge">{{ $answer->likes->count() }}</span></a>
                        @else
                            <a href="{{ route('answer.like', ['answer_id' => $answer->id, 'id' => $i]) }}" class="btn btn-secondary btn-sm">Good<span class="badge">{{ $answer->likes->count() }}</span></a>
                        @endif
                    </div>
                    <p style="display:none">{{ $i++ }}</p>
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