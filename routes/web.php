<?php

Route::group(['middleware' => ['auth']], function(){
    
    Route::post('/questions/like', 'QuestionController@like')->name('questions.like');
    
    Route::post('/answers/like', 'AnswerController@like')->name('answers.like');
    
    Route::get('/questions/create', 'QuestionController@create')->name('questions.create');
    Route::post('/questions', 'QuestionController@store');
    Route::get('/questions/{question}/edit', 'QuestionController@edit')->name('questions.edit');
    Route::patch('/questions/{question}', 'QuestionController@update');
    Route::delete('/questions/{question}', 'QuestionController@delete');
    
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('/users/{user}', 'UserController@update')->name('users.update');
    Route::post('/users/{user}/follow', 'UserController@follow')->name('follow');
    Route::delete('/users/{user}/unfollow', 'UserController@unfollow')->name('unfollow');
    
    Route::get('/answers/{question}/create', 'AnswerController@create')->name('answers.create');
    Route::post('/answers/{question}', 'AnswerController@store');
    Route::get('/answers/{answer}/edit', 'AnswerController@edit')->name('answers.edit');
    Route::patch('/answers/{answer}', 'AnswerController@update');
    Route::delete('/answers/{answer}', 'AnswerController@delete');
    
    Route::get('/comments/{answer}/create', 'CommentController@create')->name('comments.create');
    Route::post('/comments/{answer}', 'CommentController@store');
    Route::get('/comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
    Route::patch('/comments/{comment}', 'CommentController@update');
    Route::delete('/comments/{comment}', 'CommentController@delete');
    
    Route::get('/questions/report/{question_id}', 'QuestionController@report')->name('questions.report');
    Route::get('/questions/unreport/{question_id}', 'QuestionController@unreport')->name('questions.unreport');
    
    Route::get('/answers/report/{answer_id}', 'AnswerController@report')->name('answers.report');
    Route::get('/answers/unreport/{answer_id}', 'AnswerController@unreport')->name('answers.unreport');
    
    Route::get('/comments/report/{comment_id}', 'CommentController@report')->name('comments.report');
    Route::get('/comments/unreport/{comment_id}', 'CommentController@unreport')->name('comments.unreport');
});

Route::get('/', 'QuestionController@index')->name('home');
Route::get('/questions/{question}', 'QuestionController@show')->name('questions.show');
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::get('/privacy', function () {
                return view('privacy');
            });

Route::get('/verified', function(){
    return view('auth.verified');
})->middleware('verified');

Auth::routes(['verify' => true]);

//googleアカウントでのログイン
Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

// サイトマップ表示用
Route::get('/sitemap', 'SitemapController@index')->name('sitemap');
