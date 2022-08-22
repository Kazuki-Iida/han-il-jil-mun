@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜質問を投稿する</title>
    </head>
    <body>
        <h1>質問投稿</h1>
        <form action="/questions" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="question[body]" placeholder="質問内容" value="{{ old('question.body') }}"></textarea>
                <p class="title__error" style="color:red">{{ $errors->first('question.body') }}</p>
            </div>
            <div class="user_id">
                <h2>User_id</h2>
                <input type="number" name="question[user_id]" />
            </div>
            <div class="category_id">
                <h2>category_id</h2>
                <input type="number" name="question[category_id]" />
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>
@endsection