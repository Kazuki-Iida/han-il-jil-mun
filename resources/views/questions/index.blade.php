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
        <h1>日韓質問</h1>
        <form action="/questions" method="GET">
            <input type="search" placeholder="キーワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
            <div>
                <button type="submit">検索</button>
                <button>
                    <a href="/question" class="text-white">
                        クリア
                    </a>
                </button>
            </div>
        </form>
        
        [<a href='/questions/create'>create</a>]
        <div class='questions'>
            @foreach ($questions as $question)
                <div class='question'>
                    <h2 class='title'>
                        <a href="/questions/{{ $question->id }}">{{ $question->title }}</a>
                    </h2>
                    <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width="60" height="60">{{ $question->user->name }}</a>
                    <p class='body'>{{ $question->body }}</p>
                </div>
                <a href="/categories/{{ $question->category->id }}">{{ $question->category->name }}</a>
                <a href="/countries/{{ $question->country->id }}">{{ $question->country->name }}</a>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $questions->appends(request()->input())->links() }}
        </div>
    </body>
</html>
@endsection