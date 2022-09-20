@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜質問を投稿する</title>
    </head>
    <body>
        <h1>質問編集</h1>
        <form action="/questions/{{ $question->id }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title', $question->title) }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="question[body]" placeholder="質問内容">{{ old('question.body', $question->body) }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
            </div>
            <div class="category">
                <h2>Category</h2>
                    @foreach($categories as $category)
                        @if($category->id == $category_checked)
                            <input type="checkbox" name="question[category_id]" value="{{ old('question.category_id', $category->id) }}" checked>{{ $category->name }}</br>
                        @else
                            <input type="checkbox" name="question[category_id]" value="{{ old('question.category_id', $category->id) }}">{{ $category->name }}</br>
                        @endif
                    @endforeach
            </div>
            <div class="country">
                <h2>Country</h2>
                    @foreach($countries as $country)
                        @if($country->id == $country_checked)
                            <input type="radio" name="question[country_id]" value="{{ old('question.country_id', $country->id) }}" checked>{{ $country->name }}</br>
                        @else
                            <input type="radio" name="question[country_id]" value="{{ old('question.country_id', $country->id) }}">{{ $country->name }}</br>
                        @endif
                    @endforeach
                    <p class="country_id__error" style="color:red">{{ $errors->first('question.country_id') }}</p>
            </div>
            @if(isset($question->question_images))
                <div class="question-edit-show-image">
                    <h4>Image</h4>
                    @foreach($question->question_images as $question_image)
                        <img src="{{ $question_image->image }}" alt="question images" class="img-fuild" width="150" height="100">
                    @endforeach  
                </div>
                <p>※画像は編集できません</p>
            @endif
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>
@endsection