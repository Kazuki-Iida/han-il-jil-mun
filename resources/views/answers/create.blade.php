@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜回答を投稿する</title>
    </head>
    <body>
        <h1>回答投稿</h1>
        <form action="/answers/{{ $question->id }}" method="POST">
            @csrf
            <div class="body">
                <h2>Body</h2>
                <textarea name="answer[body]" placeholder="回答内容" value="{{ old('answer.body') }}"></textarea>
                <p class="title__error" style="color:red">{{ $errors->first('answer.body') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<button type="button" onClick="history.back()">戻る</button>]</div>
    </body>
</html>
@endsection