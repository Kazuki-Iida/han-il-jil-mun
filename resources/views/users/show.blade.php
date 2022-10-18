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
        <div class="modal fade" id="likedQuestionShowModal" tabindex="-1" role="dialog" aria-labelledby="followerShowModalLabel">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followerShowModalLabel">Goodした質問&thinsp;<i class="fas fa-thumbs-up like-btn"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class='questions'>
                            @if($liked_questions)
                                <div class="card-wrapper mb-4 mr-2 ml-2 border-top border-success">
                                    <!--画像表示用-->
                                    <?php $k=1; ?>
                                    @foreach ($liked_questions as $question)
                                        <div class="question row mt-0 border-success border-bottom">
                                            <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                                                <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a>
                                            </div>
                                            <div class='question-inner card-body col-10 pl-0'>
                                                <div class="question-card-header">
                                                    <div class="question-user pt-2 pl-sm-0 pl-3">
                                                        <a class="user-name pl-2 pl-sm-0" href="/users/{{ $question->user_id }}">{{ Str::limit( $question->user->name,40) }}</a>
                                                    </div>
                                                </div>
                                                <div class="question-header">
                                                    <h2 class="title card-titile pl-sm-0 pl-3">
                                                        <a class="card-titile" href="/questions/{{ $question->id }}">{{ Str::limit( $question->title, 40) }}</a>
                                                    </h2>
                                                </div>
                                                <div class="question-body">
                                                    <a href="/questions/{{ $question->id }}"><p class='body card-text mt-3 mb-4'>{{ $question->body }}</p></a>
                                                    <div class="images row px-3 pl-sm-3 pl-3 pr-sm-5 pr-3">
                                                        @foreach($question->question_images as $question_image)
                                                            <a href="{{ $question_image->image }}" data-lightbox="{{ $k }}" data-alt="質問に関する画像" class="col-6 p-0 pr-1">
                                                                <img src="{{ $question_image->image }}" alt="question images" class="image img-fuild mb-1 w-100 rounded">
                                                            </a>
                                                        @endforeach
                                                        <?php $k++; ?>
                                                    </div>
                                                </div>
                                                <div class="created_at text-right">
                                                    <p>({{ $question->created_at->format('Y/m/d-G:m:s') }})</p>
                                                </div>
                                                
                                                <div class="row question-card-footer">
                                                    <div class="col-sm-2 col-6 text-nowrap">
                                                        @auth
                                                            @if(!Auth::user()->hasVerifiedEmail())
                                                                <span class="likes">
                                                                    <a href="/verified"><i class="fas fa-thumbs-up like-btn"></i></a>
                                                                    <span class="like-counter">{{ $question->likes->count() }}</span>
                                                                </span>
                                                            @elseif(!$question->is_liked_by_auth_user())
                                                                <span class="likes">
                                                                    <i class="fas fa-thumbs-up like-btn question-like-toggle" data-question-id="{{ $question->id }}"></i>
                                                                    <span class="like-counter">{{ $question->likes->count() }}</span>
                                                                </span>
                                                            @else
                                                                <span class="likes">
                                                                    <i class="fas fa-thumbs-up like-btn question-like-toggle liked" data-question-id="{{ $question->id }}"></i>
                                                                    <span class="like-counter">{{ $question->likes->count() }}</span>
                                                                </span>
                                                            @endif
                                                        @endauth
                                                        @guest
                                                            <span class="likes">
                                                                <a href="/login"><i class="fas fa-thumbs-up like-btn"></i></a>
                                                                <span class="like-counter">{{ $question->likes->count() }}</span>
                                                            </span>
                                                        @endguest
                                                    </div>
                                                    
                                                    <div class="col-sm-4 col-6">
                                                        <form action="/" method="GET">
                                                            @csrf
                                                            <button class="btn py-0 mb-3 category-link" name ="question_category" type="submit" value={{ $question->category->id }}>{{ $question->category->name }}</a>
                                                        </form>
                                                    </div>
                                                    <p class="col-sm-3 col-6">{{ $question->country->name }}について</p>
                                                    <div class="answers-count col-sm-3 col-6"><p>回答数：{{ $question->answers->count() }}</p></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Goodした質問がありません</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="usersQuestionShowModal" tabindex="-1" role="dialog" aria-labelledby="followerShowModalLabel">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followerShowModalLabel">このユーザーの質問</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class='questions'>
                            @if($users_questions)
                                <div class="card-wrapper mb-4 mr-2 ml-2 border-top border-success">
                                    <!--画像表示用-->
                                    <?php $k=1; ?>
                                    @foreach ($users_questions as $question)
                                        <div class="question row mt-0 border-success border-bottom">
                                            <div class="index-user-image col-2 pt-4 pl-3 pr-0">
                                                <a href="/users/{{ $question->user_id }}"><img src="{{ $question->user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width=50 height=50></a>
                                            </div>
                                            <div class='question-inner card-body col-10 pl-0'>
                                                <div class="question-card-header">
                                                    <div class="question-user pt-2 pl-sm-0 pl-3">
                                                        <a class="user-name pl-2 pl-sm-0" href="/users/{{ $question->user_id }}">{{ Str::limit( $question->user->name,40) }}</a>
                                                    </div>
                                                </div>
                                                <div class="question-header">
                                                    <h2 class="title card-titile pl-sm-0 pl-3">
                                                        <a class="card-titile" href="/questions/{{ $question->id }}">{{ Str::limit( $question->title, 40) }}</a>
                                                    </h2>
                                                </div>
                                                <div class="question-body">
                                                    <a href="/questions/{{ $question->id }}"><p class='body card-text mt-3 mb-4'>{{ $question->body }}</p></a>
                                                    <div class="images row px-3 pl-sm-3 pl-3 pr-sm-5 pr-3">
                                                        @foreach($question->question_images as $question_image)
                                                            <a href="{{ $question_image->image }}" data-lightbox="{{ $k }}" data-alt="質問に関する画像" class="col-6 p-0 pr-1">
                                                                <img src="{{ $question_image->image }}" alt="question images" class="image img-fuild mb-1 w-100 rounded">
                                                            </a>
                                                        @endforeach
                                                        <?php $k++; ?>
                                                    </div>
                                                </div>
                                                <div class="created_at text-right">
                                                    <p>({{ $question->created_at->format('Y/m/d-G:m:s') }})</p>
                                                </div>
                                                
                                                <div class="row question-card-footer">
                                                    <div class="col-sm-2 col-6 text-nowrap">
                                                        @auth
                                                            @if(!Auth::user()->hasVerifiedEmail())
                                                                <span class="likes">
                                                                    <a href="/verified"><i class="fas fa-thumbs-up like-btn"></i></a>
                                                                    <span class="like-counter">{{ $question->likes->count() }}</span>
                                                                </span>
                                                            @elseif(!$question->is_liked_by_auth_user())
                                                                <span class="likes">
                                                                    <i class="fas fa-thumbs-up like-btn question-like-toggle" data-question-id="{{ $question->id }}"></i>
                                                                    <span class="like-counter">{{ $question->likes->count() }}</span>
                                                                </span>
                                                            @else
                                                                <span class="likes">
                                                                    <i class="fas fa-thumbs-up like-btn question-like-toggle liked" data-question-id="{{ $question->id }}"></i>
                                                                    <span class="like-counter">{{ $question->likes->count() }}</span>
                                                                </span>
                                                            @endif
                                                        @endauth
                                                        @guest
                                                            <span class="likes">
                                                                <a href="/login"><i class="fas fa-thumbs-up like-btn"></i></a>
                                                                <span class="like-counter">{{ $question->likes->count() }}</span>
                                                            </span>
                                                        @endguest
                                                    </div>
                                                    
                                                    <div class="col-sm-4 col-6">
                                                        <form action="/" method="GET">
                                                            @csrf
                                                            <button class="btn py-0 mb-3 category-link" name ="question_category" type="submit" value={{ $question->category->id }}>{{ $question->category->name }}</a>
                                                        </form>
                                                    </div>
                                                    <p class="col-sm-3 col-6">{{ $question->country->name }}について</p>
                                                    <div class="answers-count col-sm-3 col-6"><p>回答数：{{ $question->answers->count() }}</p></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>まだ質問をしていません</p>
                            @endif
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
                                            <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary pt-2" style="width:160">プロフィールを編集する</a>
                                        @else
                                            @if ($is_following)
                                                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger pt-2" style="width:160">フォロー解除</button>
                                                </form>
                                            @else
                                                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-primary pt-2" style="width:160">フォローする</button>
                                                </form>
                                            @endif
                                            @if ($is_followed)
                                                <span>フォローされています</span>
                                            @endif
                                        @endif
                                    @else
                                        <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary pt-2" style="width:150">フォローする</button>
                                        </form>
                                    @endauth
                                </div>
                                <div class="liked-question-button-wrapper text-center mt-2">
                                    <button class="text-white btn btn-success text-nowrap" data-toggle="modal" data-target="#likedQuestionShowModal" style="width:160">
                                        Goodした質問&thinsp;<i class="fas fa-thumbs-up like-btn text-white" style="font-size:20px"></i>
                                    </button>
                                </div>
                                <div class="users-question-button-wrapper text-center mt-2">
                                    <button class="text-white btn btn-success text-nowrap" data-toggle="modal" data-target="#usersQuestionShowModal" style="width:160">
                                        このユーザーの質問
                                    </button>
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