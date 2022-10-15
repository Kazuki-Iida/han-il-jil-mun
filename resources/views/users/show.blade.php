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
    <body class="user-show-body">
        <!--モーダル-->
        <div class="modal fade" id="followingShowModal" tabindex="-1" role="dialog" aria-labelledby="followingsShowModalLabel">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followingShowModalLabel">フォローしているユーザー一覧</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="following-list">
                            <ul>
                                @if(isset($user->follows[0]))
                                    @foreach($user->follows as $follow)
                                        <div class="">
                                            <a href="/users/{{ $follow->id }}" class="modal-user-btn btn my-0 py-2 w-100 h-auto text-left">
                                                {{ Str::limit($follow->name, 40) }}
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <p>フォローしているユーザーがいません</p>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="followerShowModal" tabindex="-1" role="dialog" aria-labelledby="followerShowModalLabel">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followerShowModalLabel">フォロワー一覧</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="follower-list">
                            <ul>
                                @if(isset($user->followers[0]))
                                    @foreach($user->followers as $follower)
                                        <div class="">
                                            <a href="/users/{{ $follower->id }}" class="modal-user-btn btn my-0 py-2 w-100 h-auto text-left">
                                                {{ Str::limit($follower->name, 40) }}
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <p>フォロワーがいません</p>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <!--ここまでモーダル-->
          
        <div class="container">
            <div class="user-show">
                <div class="user-profile bg-white m-sm-0 m-3">
                    <div class="profile-content row">
                        <div class="profile-left mb-3 col-sm-6 col-11　col-offset-1">
                            <div class="profile-image-wrapper pb-sm-2 pb-0">
                                <img src="{{ $user->profile_image }}" alt="Contact Person" class="profile-image img-fuild rounded-circle">
                            </div>
                            <h1 class="user-name text-center">
                                {{ $user->name }}
                            </h1>
                            <div class="follow-count-wrapper">
                                <div class="following-count row justify-content-center">
                                    <div class="follow-count col-sm-3 col-5 text-center">
                                        <button class="modal-open-btn" data-toggle="modal" data-target="#followingShowModal">
                                            <p class="text-center mb-0">{{ $follow_count }}</p>
                                            <p class="text-center text-nowrap">フォロー</p>
                                        </button>
                                    </div>
                                    <div class="followed-count col-sm-3 col-5 text-center">
                                        <button class="modal-open-btn" data-toggle="modal" data-target="#followerShowModal">
                                            <p class="text-center mb-0">{{ $follower_count }}</p>
                                            <p class="text-center text-nowrap">フォロワー</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="following-wrapper">
                                <div class="profile-button-wrapper text-center">
                                    @auth
                                        @if ($user->id === Auth::user()->id)
                                            <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary pt-2">プロフィールを編集する</a>
                                        @else
                                            @if ($is_following)
                                                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger pt-2">フォロー解除</button>
                                                </form>
                                            @else
                                                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-primary pt-2">フォローする</button>
                                                </form>
                                            @endif
                                            @if ($is_followed)
                                                <span>フォローされています</span>
                                            @endif
                                        @endif
                                    @else
                                        <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary pt-2">フォローする</button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <div class="profile-right col-sm-6 col-11 py-sm-5 col-offset-1">  
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
                    <div class="back-btn w-100 text-center mt-sm-0 mt-5">
                        <button class="btn btn-success w-25" type="button" onClick="history.back()">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection