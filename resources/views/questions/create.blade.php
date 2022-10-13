@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日韓質問｜質問を投稿する</title>
    </head>
    <body class="create-edit-body">
        
        
        <style>
           
        </style>
        
        
        
        <div class="create-edit-page p-md-0 px-2 py-4">
            <form id="create" action="/questions" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-container">
                    <div class="form-head bg-success">
                        <h2>質問投稿</h2>
                    </div>
                    <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
                    
                    <textarea name="question[body]" placeholder="質問内容">{{ old('question.body') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
                    
                    <h2>Images(4枚まで可)</h2>
                    <input type="file" id="image" name="images_array[]" multiple="multiple">
                    <p class="images__error" style="color:red">{{ $errors->first('images_array') }}</p>
                    
                    <div class="category">
                        <h2>Category</h2>
                        <div class="container">
                            <div class="row w-100 mx-auto">
                                @foreach($categories as $category)
                                    <div class="col-sm-4 col-6 text-nowrap">
                                        <label class="checkbox-label">
                                            <input class="checkbox-input" type="checkbox" name="question[category_id]" value="{{ $category->id }}"/>
                                            <span class="checkbox-front-span"></span>
                                            <span class="checkbox-span">{{ $category->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <p class="category_id__error" style="color:red">{{ $errors->first('question.category_id') }}</p>
                        </div>
                    </div>
                    
                    <div class="country">
                        <h2>Country</h2>
                        
                            <group class="inline-radio">
                                <div><input type="radio" name="question[country_id]"　value="japan"><label>日本について</label></div>
                                <div><input type="radio" name="question[country_id]" value="corea" checked><label>韓国について</label></div>
                            </group>
                            <p class="country_id__error" style="color:red">{{ $errors->first('question.country_id') }}</p>
                    </div>
                    
                    <button id="submit" type="submit">
                        送信
                    </button>
                </form>
                <div class="back">[<a href="/">back</a>]</div>
            </div>
        </div>
    </body>
</html>
@endsection