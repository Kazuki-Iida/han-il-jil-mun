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
        <form action="/questions" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="question[body]" placeholder="質問内容" value="{{ old('question.body') }}"></textarea>
                <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
            </div>
            <div class="images">
                <h2>Images(4枚まで可)</h2>
                <input type="file" id="image" name="images_array[]" multiple="multiple">
            </div>
            <div class="category">
                <h2>Category</h2>
                    @foreach($categories as $category)
                        <input type="checkbox" name=“question[category_id]” value="{{ $category->id }}">{{ $category->name }}</br>
                    @endforeach
            </div>
            <div class="country">
                <h2>Country</h2>
                    @foreach($countries as $country)
                        <input type="radio" name="question[country_id]" value="{{ $country->id }}">{{ $country->name }}</br>
                    @endforeach
                    <p class="country_id__error" style="color:red">{{ $errors->first('question.country_id') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>
@endsection