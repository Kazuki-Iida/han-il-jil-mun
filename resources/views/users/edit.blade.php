@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜プロフィール編集</title>
    </head>
    <body>
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class='user__name'>
                    <h2>ユーザーネーム</h2>
                    <input type='text' name='user[name]' value="{{ $user->name }}">
                </div>
                <div class='user__profile'>
                    <h2>プロフィール</h2>
                    <textarea name='user[profile]' value="{{ $user->profile }}">{{ $user->profile }}</textarea>
                </div>
                <div class='user__profile_image'>
                    <h2>プロフィール画像</h2>
                    <img src="{{ $user->profile_image }}" id="img" class="img-fuild rounded-circle" width="80" height="80">
                    <input type="file" id="image" name="user[profile_image]" onchange="previewImage(this);">
                </div>
                <div class="category">
                <h2>Interests</h2>
                    @foreach($interests as $interest)
                        @if(in_array($interest->id, $checked))
                            <input type="checkbox" name="interests_array[]" value="{{ $interest->id }}" checked>{{ $interest->name }}</br>
                        @else
                            <input type="checkbox" name="interests_array[]" value="{{ $interest->id }}">{{ $interest->name }}</br>
                        @endif
                    @endforeach
                </div>
                <input type="submit" value="保存">
        </div>
    </body>
</html>
@endsection