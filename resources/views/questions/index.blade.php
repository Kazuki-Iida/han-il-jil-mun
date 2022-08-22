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
        {{Auth::user()->name}}
        <h1>日韓質問</h1>
        <div class='questions'>
            @foreach ($questions as $question)
                <div class='question'>
                    <h2 class='title'>
                        <a href="/questions/{{ $question->id }}">{{ $question->title }}</a>
                    </h2>
                    <p class='body'>{{ $question->body }}</p>
                </div>
            @endforeach
        </div>
        [<a href='/questions/create'>create</a>]
    </body>
</html>
@endsection