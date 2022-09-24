@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜コメントする</title>
    </head>
    <body>
        <h1>コメント</h1>
        <form action="/comments/{{ $answer->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="body">
                <h2>Body</h2>
                <textarea name="comment[body]" placeholder="コメント">{{ old('comment.body') }}</textarea>
                <p class="title__error" style="color:red">{{ $errors->first('comment.body') }}</p>
            </div>
            <div class="images">
                <h2>Images(4枚まで可)</h2>
                <input type="file" id="image" name="images_array[]" multiple="multiple">
                <p class="images__error" style="color:red">{{ $errors->first('images_array') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<button type="button" onClick="history.back()">戻る</button>]</div>
    </body>
</html>
@endsection