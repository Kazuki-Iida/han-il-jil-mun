<!DOCTYPE HTML>
@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜質問作成</title>
    </head>
    <body>
        <h1>日韓質問</h1>
        <form action="/questions" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="question[body]" placeholder="今日も1日お疲れさまでした。">{{ old('question.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
            </div>
            <!--<div class="category">-->
            <!--    <h2>Category</h2>-->
            <!--    <select name="post[category_id]">-->
            <!--        @foreach($categories as $category)-->
            <!--            <option value="{{ $category->id }}">{{ $category->name }}</option>-->
            <!--        @endforeach-->
            <!--    </select>-->
            <!--</div>-->
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>　　　　　　　　　　　  　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
@endsection
