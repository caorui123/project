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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'UserController@login');
Route::any('register', 'UserController@register');
Route::any('login', 'UserController@login');
Route::get('logout', 'UserController@logout');
//Route::get('jump', 'UserController@jump');/
Route::get('article', 'ArticleController@show');
Route::any('article/add', 'ArticleController@add');
Route::get('article/del', 'ArticleController@del');
Route::any('article/update', 'ArticleController@update');

