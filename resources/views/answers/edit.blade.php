@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜回答を編集する</title>
    </head>
    <body class="create-edit-body">
        <div class="create-edit-page p-md-0 px-2 py-4">
            <div class="form-container">
                <div class="form-head bg-success">
                    <h2>回答を編集&ensp;<i class="far fa-comment-dots"></i></h2>
                </div>
                <div class="form-body">
                    <form id="create" action="/answers/{{ $answer->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="border border-success rounded mx-sm-0 mx-3 mb-3 p-3">
                            <h4 class="">
                                <p class="text-left">{{ $answer->question->title }}</p>
                            </h4>
                            <div class="">
                                <p class='text-left mb-1'>{{ $answer->question->body }}</p>
                                <div class="images row px-3">
                                    @foreach($answer->question->question_images as $question_image)
                                        <a href="{{ $question_image->image }}" data-lightbox="a" data-alt="質問に関する画像" class="col-6 p-0 pr-1">
                                            <img src="{{ $question_image->image }}" alt="question images" class="image img-fuild mb-1 w-100 rounded">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <textarea name="answer[body]" placeholder="回答内容" style="height:250px">{{ old('answer.body', $answer->body) }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('answer.body') }}</p>
                        
                        <div class="images row px-3">
                            @foreach($answer->answer_images as $answer_image)
                                <a href="{{ $answer_image->image }}" data-lightbox="a" data-alt="回答に関する画像" class="col-6 p-0 pr-1">
                                    <img src="{{ $answer_image->image }}" alt="answer images" class="image img-fuild mb-1 w-100 rounded">
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