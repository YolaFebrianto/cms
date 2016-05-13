<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::post('/create-post', 'PostController@store');
Route::get('/delete-post/{id}', 'PostController@delete');
Route::get('/editform/{id}', 'PostController@getEditForm');
Route::post('/edit-post/{id}', 'PostController@update');
Route::get('/single/{slug}', 'PostController@single');
Route::post('/comment', 'CommentController@comment');
