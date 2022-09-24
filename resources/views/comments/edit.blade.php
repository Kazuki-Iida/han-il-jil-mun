@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜コメントを編集する</title>
    </head>
    <body>
        <h1>コメント編集</h1>
        <form action="/comments/{{ $comment->id }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="body">
                <h2>Body</h2>
                <textarea name="comment[body]" placeholder="コメント">{{ old('comment.body', $comment->body) }}</textarea>
                <p class="title__error" style="color:red">{{ $errors->first('comment.body') }}</p>
            </div>
             @if(isset($comment->comment_images))
                <div class="comment-edit-show-image">
                    <h4>Image</h4>
                    @foreach($comment->comment_images as $comment_image)
                        <img src="{{ $comment_image->image }}" alt="comment images" class="img-fuild" width="150" height="100">
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