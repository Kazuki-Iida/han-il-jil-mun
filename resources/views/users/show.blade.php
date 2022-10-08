@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>日韓質問|{{ $user->name }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="container">
            <div class="user-show">
                <div class="user-profile bg-white">
                    <div class="profile-content row">
                        <div class="profile-left mb-3 col-sm-6 col-11">
                            <div class="profile-image-wrapper pb-sm-2 pb-0">
                                <img src="{{ $user->profile_image }}" alt="Contact Person" class="profile-image img-fuild rounded-circle">
                            </div>
                            <h1 class="user-name text-center">
                                {{ $user->name }}
                            </h1>
                            <div class="follow-count-wrapper">
                                <div class="following-count row justify-content-center">
                                    <div class="follow-count col-sm-3 col-5">
                                        <p class="text-center mb-0"><a>{{ $follow_count }}</a></p>
                                        <p class="text-center">フォロー</p>
                                    </div>
                                    <div class="followed-count col-sm-3 col-5">
                                        <p class="text-center mb-0"><a>{{ $follower_count }}</a></p>
                                        <p class="text-center">フォロワー</p>
                                    </div>
                                </div>
                            </div>
                            
                        <div class="following-wrapper">
                            <div class="profile-button-wrapper text-center">
                                @if ($user->id === Auth::user()->id)
                                    <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                    @if ($is_following)
                                        <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">フォロー解除</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary">フォローする</button>
                                        </form>
                                    @endif
                                    @if ($is_followed)
                                        <span>フォローされています</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        </div>
                        <div class="profile-right col-sm-6 col-11 py-sm-5">  
                            <div class="profile-sentence-wrapper h-50">
                                <h3 class="border-bottom border-success">プロフィール</h3>
                                @if(!isset($user->profile))
                                    <h4 class="pt-2">プロフィールが設定されていません</h4>
                                @else
                                    <p>{{ $user->profile }}</p>  
                                @endif
                            </div>
                            <div class="interest-wrapper pt-5 h-50">
                                <h3 class="border-bottom border-success">興味・趣味</h3>
                                @for($i = 0; $i <= 2; $i++)
                                    @if(!isset($user->interests[0]))
                                        <h4 class="pt-2">興味・趣味が設定されていません</h4>
                                        @break
                                    @endif
                                    @if(isset($user->interests[$i]))
                                        <h4>{{ $user->interests[$i]->name }}</br></h4>
                                    @endif
                                @endfor 
                            </div>
                        </div>
                    </div>
                    <div class="back-btn w-100 text-center">
                        <button class="btn btn-success w-25" type="button" onClick="history.back()">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection