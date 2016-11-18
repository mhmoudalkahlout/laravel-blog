<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');

//comments
Route::post('comments/{post_id}', ['uses'=>'CommentsController@store', 'as'=>'comments.store']);
Route::get('comments/{id}/edit', ['uses'=>'CommentsController@edit', 'as'=>'comments.edit']);
Route::put('comments/{id}', ['uses'=>'CommentsController@update', 'as'=>'comments.update']);
Route::delete('comments/{id}', ['uses'=>'CommentsController@destroy', 'as'=>'comments.destroy']);

Route::get('about', 'PagesController@getAbout');
Route::get('/', 'PagesController@getIndex');
Route::get('/home', 'PagesController@getIndex');
Route::resource('posts', 'PostController');
Route::resource('categories', 'CategoryController', ['only' => ['index', 'store', 'destroy']]);
Route::resource('tags', 'TagController', ['except' => ['create']]);
Auth::routes();


