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
                        <div class="card-wrapper mb-4 mr-2 ml-2">
                            @foreach ($questions as $question)
                                <div class="question card mt-3 border-success" id="{{ $i }}">
                                    <div class='question-inner card-body'>
                                        <div class="question-header row">
                                            <h2 class="title card-titile col-7">
                                                <a href="/questions/{{ $question->id }}">{{ Str::limit( $question->title, 40) }}</a>
                                            </h2>
                                            <div class="question-user col-5">
                                                <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width="40" height="40">{{ Str::limit( $question->user->name,40) }}</a>
                                            </div>
                                        </div>
                                        <a href="/questions/{{ $question->id }}"><p class='body card-text mt-3 mb-4'>{{ $question->body }}</p></a>
                                        <div>
                                            @if($question->is_liked_by_auth_user())
                                                <a href="{{ route('question.unlike', ['question_id' => $question->id, 'id' => $i]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $question->likes->count() }}</span></a>
                                            @else
                                                <a href="{{ route('question.like', ['question_id' => $question->id, 'id' => $i]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $question->likes->count() }}</span></a>
                                            @endif
                                            {{ $question->likes->count() }}
                                        </div>
                                        <p>カテゴリー：<a class="card-link" href="/categories/{{ $question->category->id }}">{{ $question->category->name }}</a></p>
                                        <p>about:<a class="card-link" href="/countries/{{ $question->country->id }}">{{ $question->country->name }}</a></p>
                                    </div>
                                </div>
                                <p style="display:none">{{ $i++ }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="paginate index-paginate">
                        {{ $questions->appends(request()->input())->links() }}
                    </div>
                </div>
                <div class="side-column bg-white col-sm-11 col-md-4 mx-auto">
                </div>
            </div>
        </div>
    </body>
</html>
@endsection