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
        @if( Auth::check() )
            {{Auth::user()->name}}
        @endif
        <h1>日韓質問</h1>
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
            @endforeach
        </div>
        [<a href='/questions/create'>create</a>]
    </body>
</html>
@endsection