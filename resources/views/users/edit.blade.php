@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>@section('title', 'プロフィールを編集する')</title>
    </head>
    <body class="create-edit-body">
        <div class="create-edit-page p-md-0 px-2 py-4">
            <div class="form-container">
                <div class="form-head bg-success">
                    <h2>プロフィールを編集&ensp;<i class="fas fa-user-edit"></i></h2>
                </div>
                
                <div class="form-body">
                    <form id="edit" action="/users/{{ $user->id }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class='user__name'>
                            <h5 class="text-left pl-sm-5 pl-3">ユーザーネーム</h5>
                            <input class="mt-0" type='text' name='user[name]' value="{{ $user->name }}">
                            <p class="user_name__error" style="color:red">{{ $errors->first('user.name') }}</p>
                        </div>
                        
                        <div class='user__profile'>
                            <h5 class="text-left pl-sm-5 pl-3">プロフィール</h5>
                            <textarea name='user[profile]' value="{{ $user->profile }}">{{ $user->profile }}</textarea>
                            <p class="user_profile__error" style="color:red">{{ $errors->first('user.profile') }}</p>
                        </div>
                        
                        <div class='user__profile_image'>
                            <h5 class="text-left pl-sm-5 pl-3">プロフィール画像</h5>
                            <label class="image-label rounded">
                                <input type="file" id="imageInput" name="user[profile_image]" value="{{ $user->profile_image }}" onchange="previewImage(this);">画像ファイルを選択&ensp;<i class="far fa-images"></i>
                            </label>
                            <p id="fileSelected">（jpeg,bmp,png,jpgのみ）</p>
                        </div>
                        
                        <h5 class="text-left pl-sm-5 pl-3">興味・趣味（3つまで表示されます）</h5>
                        
                        <div class="container">
                            <div class="row w-100 mx-auto">
                                @foreach($interests as $interest)
                                    <div class="col-sm-4 col-6 text-nowrap">
                                        <label class="radio-label">
                                            @if(in_array($interest->id, $checked))
                                                <input class="radio-input" type="checkbox" name="interests_array[]" value="{{ $interest->id }}" checked>
                                                <span class="radio-fake-span"></span>
                                                <span class="radio-span">{{ $interest->name }}</span>
                                            @else
                                                <input class="radio-input" type="checkbox" name="interests_array[]" value="{{ $interest->id }}">
                                                <span class="radio-fake-span"></span>
                                                <span class="radio-span">{{ $interest->name }}</span>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <p class="category_id__error" style="color:red">{{ $errors->first('question.category_id') }}</p>
                        </div>
                        
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
