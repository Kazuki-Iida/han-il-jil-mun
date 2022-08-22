<!DOCTYPE html>
<!--@extends('layouts.app')　　　　　　　　　　　　　　　　　　-->

<!--@section('content')-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>韓国質問</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>韓国質問</h1>
        <div class='questions'>
            @foreach ($questions as $question)
                <div class='question'>
                    <h2 class='title'>
                        <a href="/questions/{{ $question->id }}">{{ $question->title }}</a>
                    </h2>
                    <p class='body'>{{ $question->body }}</p>
                    <a href="/categories/{{ $question->category->id }}">{{ $question->category->name }}</a>
                </div>
                <form action="/questions/{{ $question->id }}" id="form_{{ $question->id }}" method="question" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('削除してもよろしいですか?')">delete</button> 
                </form>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $questions->links() }}
        </div>
        <div class='link-to-create'>
            [<a href='/questions/create'>create</a>]
        </div>
    </body>
</html>　　　　　　　　　　　　  　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
<!--@endsection-->
