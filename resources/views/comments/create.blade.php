@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜コメントする</title>
    </head>
    <body class="create-edit-body">
        <div class="create-edit-page p-md-0 px-2 py-4">
            <div class="form-container">
                <div class="form-head bg-success">
                    <h2>コメントする&ensp;<i class="far fa-comments"></i></h2>
                </div>
                
                <div class="form-body">
                    <form id="create" action="/comments/{{ $answer->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <textarea name="comment[body]" placeholder="コメント内容">{{ old('comment.body') }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('comment.body') }}</p>
                        
                        <div class="image-form-wrapper mt-4 mx-auto text-center">
                            <label class="image-label rounded">
                                <input type="file" id="imageInput" name="images_array[]" multiple="multiple">画像ファイルを選択&ensp;<i class="far fa-images"></i>（4枚まで）
                            </label>
                            <p id="fileSelected">（jpeg,bmp,png,jpgのみ）</p>
                            <p class="images__error" style="color:red">{{ $errors->first('images_array') }}</p>
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