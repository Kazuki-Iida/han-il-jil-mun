@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜質問を編集する</title>
    </head>
    <body class="create-edit-body">
        <div class="create-edit-page p-md-0 px-2 py-4">
            <div class="form-container">
                <div class="form-head bg-success">
                    <h2>質問を編集&ensp;<i class="fas fa-pencil-alt"></i></h2>
                </div>
                
                <div class="form-body">
                    <form id="edit" action="/questions/{{ $question->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title', $question->title) }}"/>
                        <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
                        
                        <textarea name="question[body]" placeholder="質問内容" style="height:250px">{{ old('question.body', $question->body) }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
                        
                        <div class="category-select-wrapper mt-4">
                            <h2 class="text-left">カテゴリー</h2>
                            <div class="container">
                                <div class="row w-100 mx-auto">
                                    @foreach($categories as $category)
                                        <div class="col-sm-4 col-6 text-nowrap">
                                            <label class="radio-label">
                                                @if($category->id == $category_checked)
                                                    <input class="radio-input" type="radio" name="question[category_id]" value="{{ old('question.category_id', $category->id) }}" checked>
                                                    <span class="radio-fake-span"></span>
                                                    <span class="radio-span">{{ $category->name }}</span>
                                                @else
                                                    <input class="radio-input" type="radio" name="question[category_id]" value="{{ old('question.category_id', $category->id) }}">
                                                    <span class="radio-fake-span"></span>
                                                    <span class="radio-span">{{ $category->name }}</span>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="category_id__error" style="color:red">{{ $errors->first('question.category_id') }}</p>
                            </div>
                        </div>
                        
                        <div class="country-select-wrapper mt-4">
                            <group class="inline-radio">
                                @if($question->country_id == 1)
                                    <div><input type="radio" name="question[country_id]" value="1" checked ><label>日本について</label></div>
                                    <div><input type="radio" name="question[country_id]" value="2"><label>韓国について</label></div>
                                @else
                                    <div><input type="radio" name="question[country_id]" value="1"><label>日本について</label></div>
                                    <div><input type="radio" name="question[country_id]" value="2" checked><label>韓国について</label></div>
                                @endif
                            </group>
                            <p class="country_id__error" style="color:red">{{ $errors->first('question.country_id') }}</p>
                        </div>
                        
                        <div class="images row px-3">
                            @foreach($question->question_images as $question_image)
                                <a href="{{ $question_image->image }}" data-lightbox="a" data-alt="質問に関する画像" class="col-6 p-0 pr-1">
                                    <img src="{{ $question_image->image }}" alt="question images" class="image img-fuild mb-1 w-100 rounded">
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