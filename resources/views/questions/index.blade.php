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
                                    <button onclick="nice({{$question->id}})">いいね</button>
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
                </div>
            </div>
        </div>
        <script type="application/javascript"> 
            function nice(questionId) {
                  $.ajax({
                    headers: {
                      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    url: `/nice/${questionId}`,
                    type: "POST",
                  })
                    .done(function (data, status, xhr) {
                      console.log(data);
                    })
                    .fail(function (xhr, status, error) {
                      console.log();
                    });
                }
        </script>
    </body>
</html>
@endsection