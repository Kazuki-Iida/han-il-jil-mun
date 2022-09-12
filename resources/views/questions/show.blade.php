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
        <h1 class="title">
            {{ $question->title }}
        </h1>
        <div class="user">
            {{ $question->user->name }}
        </div>
        <div class="content">
            <div class="content__question">
                <h3>本文</h3>
                <p>{{ $question->body }}</p>    
            </div>
            <a href="/categories/{{ $question->category->id }}">{{ $question->category->name }}</a>
        </div>
        <div class="to-answer">
            <a href="/answers/{{ $question->id }}/create">回答する</a>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
@endsection