<!DOCTYPE HTML>
@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $question->title }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class = "body-inner">
            <h1 class="title">
                {{ $question->title }}
            </h1>
            <div class="content">
                <div class="content__question">
                    <h3>本文</h3>
                    <p>{{ $question->body }}</p>    
                </div>
            </div>
            <!--<a href="/categories/{{ $question->category->id }}">{{ $question->category->name }}</a>-->
            <p class="edit">[<a href="/questions/{{ $question->id }}/edit">edit</a>]</p>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
            </div>
    </body>
</html>　　　　　　　　　　　　  　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
@endsection
