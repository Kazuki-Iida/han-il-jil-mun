@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜回答を編集する</title>
    </head>
    <body>
        <h1>回答編集</h1>
        <form action="/answers/{{ $answer->id }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="body">
                <h2>Body</h2>
                <textarea name="answer[body]" placeholder="回答内容">{{ old('answer.body', $answer->body) }}</textarea>
                <p class="title__error" style="color:red">{{ $errors->first('answer.body') }}</p>
            </div>
             @if(isset($answer->answer_images))
                <div class="answer-edit-show-image">
                    <h4>Image</h4>
                    @foreach($answer->answer_images as $answer_image)
                        <img src="{{ $answer_image->image }}" alt="answer images" class="img-fuild" width="150" height="100">
                    @endforeach  
                </div>
                <p>※画像は編集できません</p>
            @endif
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<button type="button" onClick="history.back()">戻る</button>]</div>
    </body>
</html>
@endsection