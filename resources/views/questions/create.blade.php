@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜質問を投稿する</title>
    </head>
    <body class="create-edit-body">
        <div class="create-edit-page p-md-0 px-2 py-4">
            <div class="form-container">
                <div class="form-head bg-success">
                    <h2>質問を投稿&ensp;<i class="fas fa-pencil-alt"></i></h2>
                </div>
                <div class="form-body">
                    <form id="create" action="/questions" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title') }}"/>
                        <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
                        
                        <textarea name="question[body]" placeholder="質問内容">{{ old('question.body') }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
                        
                        <div class="image-form-wrapper mt-4 mx-auto text-left">
                            <label class="image-label rounded">
                                <input type="file" id="imageInput" name="images_array[]" multiple="multiple">画像ファイルを選択&ensp;<i class="far fa-images"></i>（4枚まで）
                            </label>
                            <p id="fileSelected">（jpeg,bmp,png,jpgのみ）</p>
                            <p class="images__error" style="color:red">{{ $errors->first('images_array') }}</p>
                        </div>
                        
                        <div class="category-select-wrapper mt-4">
                            <h2 class="text-left">カテゴリー</h2>
                            <div class="container">
                                <div class="row w-100 mx-auto">
                                    @foreach($categories as $category)
                                        <div class="col-sm-4 col-6 text-nowrap">
                                            <label class="radio-label">
                                                <input class="radio-input" type="radio" name="question[category_id]" value="{{ $category->id }}"/>
                                                <span class="radio-fake-span"></span>
                                                <span class="radio-span">{{ $category->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="category_id__error" style="color:red">{{ $errors->first('question.category_id') }}</p>
                            </div>
                        </div>
                        
                        <div class="country-select-wrapper mt-4">
                            <group class="inline-radio">
                                <div><input type="radio" name="question[country_id]" value="1"><label>日本について</label></div>
                                <div><input type="radio" name="question[country_id]" value="2"><label>韓国について</label></div>
                            </group>
                            <p class="country_id__error" style="color:red">{{ $errors->first('question.country_id') }}</p>
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