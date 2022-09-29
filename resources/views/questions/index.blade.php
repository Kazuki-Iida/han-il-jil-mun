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
                        <div class="card-wrapper mb-4 mr-2 ml-2 border-top border-success">
                            @foreach ($questions as $question)
                                <div class="question row mt-0 border-success border-bottom" id="{{ $i }}">
                                    <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                                        <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width="50" height="50"></a>
                                    </div>
                                    <div class='question-inner card-body col-10 pl-0'>
                                        <div class="question-user">
                                            <a class="user-name" href="/users/{{ $question->user_id }}">{{ Str::limit( $question->user->name,40) }}</a>
                                        </div>
                                        <div class="question-header">
                                            <h2 class="title card-titile">
                                                <a class="card-titile" href="/questions/{{ $question->id }}">{{ Str::limit( $question->title, 40) }}</a>
                                            </h2>
                                        </div>
                                        <a href="/questions/{{ $question->id }}"><p class='body card-text mt-3 mb-4'>{{ $question->body }}</p></a>
                                        <div class="row">
                                            <div class="col-3">
                                                @if($question->is_liked_by_auth_user())
                                                    <a href="{{ route('question.unlike', ['question_id' => $question->id, 'id' => $i]) }}" class="btn btn-success btn-sm">Good<span class="badge">{{ $question->likes->count() }}</span></a>
                                                @else
                                                    <a href="{{ route('question.like', ['question_id' => $question->id, 'id' => $i]) }}" class="btn btn-secondary btn-sm">Good<span class="badge">{{ $question->likes->count() }}</span></a>
                                                @endif
                                            </div>
                                            <p class="col-3"><a class="card-link" href="/categories/{{ $question->category->id }}">{{ $question->category->name }}</a></p>
                                            <p class="col-3"><a class="card-link" href="/countries/{{ $question->country->id }}">{{ $question->country->name }}</a></p>
                                            <div class="answers-count col-3"><p>回答数：{{ $question->answers->count() }}</p></div>
                                        </div>
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