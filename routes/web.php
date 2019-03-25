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
Route::get('/', 'StadiumPostsController@index');

Route::get('/stadium/{id}/comment', 'StadiumPostsController@show')->where('id', '[0-9]+');
Route::get('/stadium/{id}/game', 'StadiumPostsController@show')->where('id', '[0-9]+');
Route::get('/stadium/{id}/index', 'StadiumPostsController@show')->where('id', '[0-9]+');
// Route::get('/stadium/{id}', 'StadiumPostsController@show')->where('id', '[0-9]+');

Route::get('/stadium/{id}/edit', 'StadiumPostsController@edit');

Route::patch('/stadium/{id}', 'StadiumPostsController@update');

Route::post('/stadium', 'StadiumPostsController@store');

Route::get('/stadium/create', 'StadiumPostsController@create');

Route::delete('/stadium/{id}', 'StadiumPostsController@destroy');

