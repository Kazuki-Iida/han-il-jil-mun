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
        <h1 class="title">
            {{ $user->name }}
        </h1>
        <div class="content">
            <div class="content__user">
                <h3>名前</h3>
                <p>{{ $user->name }}</p>    
                <h3>プロフィール</h3>
                <p>{{ $user->profile }}</p>    
                <h3>興味・趣味</h3>
                @foreach($user->interests as $interest)
                    <p>{{ $interest->name }}</br></p>
                @endforeach  
                <h3>プロフィール画像</h3>
                <img src="{{ $user->profile_image }}" alt="Contact Person" class="img-fuild rounded-circle" width="60" height="60">
            </div>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
@endsection