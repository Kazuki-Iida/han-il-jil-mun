<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth']], function(){
    Route::post('/questions', 'QuestionController@store');
    Route::get('/questions/create', 'QuestionController@create');
    Route::post('/questions/{question}', 'QuestionController@update');
    Route::delete('/questions/{question}', 'QuestionController@delete');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('users/{user}/update', 'UserController@update')->name('users.update');
    Route::get('answers/{question}/create', 'AnswerController@create');
    Route::post('/answers/{question}', 'AnswerController@store');
    Route::post('users/{user}/follow', 'UserController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UserController@unfollow')->name('unfollow');
});

Route::get('/questions', 'QuestionController@index');
Route::get('/', 'QuestionController@index');
Route::get('/questions/{question}', 'QuestionController@show');
Route::get('/categories/{category}', 'CategoryController@index');
Route::get('/users/{user}', 'UserController@show');
Route::get('users/{user}', 'UserController@show')->name('users.show');
Route::resource('user', 'UserController');
//Route::get('/questions/{question}/edit', 'QuestionController@edit');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
