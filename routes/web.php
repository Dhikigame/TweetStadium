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
Route::get('/stadium/{id}/info', 'StadiumPostsController@show')->where('id', '[0-9]+');

Route::get('/stadium/{id}/edit', 'StadiumPostsController@edit');

Route::patch('/stadium/{id}', 'StadiumPostsController@update');

Route::post('/stadium', 'StadiumPostsController@store');
Route::post('/stadium/{id}/comment', 'CommentsController@store');

Route::get('/stadium/create', 'StadiumPostsController@create');

Route::delete('/stadium/{id}', 'StadiumPostsController@destroy');

Route::get('ajax/stadium', 'Ajax\StadiumController@index');
Route::get('ajax/comment', 'Ajax\CommentsController@index');
Route::get('ajax/game_news', 'Ajax\GameNewsController@baseball');
// Route::get('ajax/game_news', 'Ajax\GameNewsController@soccer');
// Route::get('ajax/game_news', 'Ajax\GameNewsController@basketball');