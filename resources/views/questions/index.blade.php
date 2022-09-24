@extends('layouts.app')　
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="body-inner-of-index container">
            <div class="questions-index row">
                <div class="question-index-inner bg-white col-sm-11 col-md-7 mx-auto">
                    <form action="/questions" method="GET">
                        <div class="input-group">
                            <input type="search" placeholder="キーワードを入力" name="search" class="search-form form-control" value="@if (isset($search)) {{ $search }} @endif">
                            <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i>検索</button>
                            <button href="/" class="btn btn-outline-secondary">クリア</button>
                        </div>
                    </form>
                    [<a href='/questions/create'>create</a>]
                    <div class='questions'>
                        @foreach ($questions as $question)
                            <div class="question card">
                                <div class='question-inner card-body'>
                                    <div class="question-header row">
                                        <h2 class="title card-titile col-7">
                                            <a href="/questions/{{ $question->id }}">{{ $question->title }}</a>
                                        </h2>
                                        <div class="question-user col-5">
                                            <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width="40" height="40">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
                                    <p class='body card-text'>{{ $question->body }}</p>
                                    <p>カテゴリー：<a class="card-link" href="/categories/{{ $question->category->id }}">{{ $question->category->name }}</a></p>
                                    <p>about:<a class="card-link" href="/countries/{{ $question->country->id }}">{{ $question->country->name }}</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="paginate index-paginate">
                        {{ $questions->appends(request()->input())->links() }}
                    </div>
                </div>
                <div class="side-column bg-white col-sm-11 col-md-4 mx-auto">
                    <p>あああああああああ</p>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection