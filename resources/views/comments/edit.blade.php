@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜コメントを編集する</title>
    </head>
    <body class="create-edit-body">
        <div class="create-edit-page p-md-0 px-2 py-4">
            <div class="form-container">
                <div class="form-head bg-success">
                    <h2>コメントを編集&ensp;<i class="far fa-comments"></i></h2>
                </div>
                <div class="form-body">
                    <form id="edit" action="/comments/{{ $comment->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <textarea name="comment[body]" placeholder="コメント内容" style="height:250px">{{ old('comment.body', $comment->body) }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('comment.body') }}</p>
                        
                        <div class="images row px-3">
                            @foreach($comment->comment_images as $comment_image)
                                <a href="{{ $comment_image->image }}" data-lightbox="a" data-alt="コメントに関する画像" class="col-6 p-0 pr-1">
                                    <img src="{{ $comment_image->image }}" alt="comment images" class="image img-fuild mb-1 w-100 rounded">
                                </a>
                            @endforeach
                        </div>
                        <p class="text-left">※画像は変更できません</p>
                        
                        <button class="btn btn-success w-50 my-3" type="submit">
                            送信&ensp;<i class="far fa-paper-plane"></i>
                        </button>
                        <a href="/" class="btn btn-secondary w-50 mb-4 rounded">
                            ホームへ戻る&ensp;<i class="fas fa-home"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection