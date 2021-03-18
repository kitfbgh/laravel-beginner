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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/profile', function () {
//    return view('profile');
//});
Route::get('/', 'ProfileController@index');

Route::get('/cache', 'ProfileController@cache');

Route::get('/5', 'ProfileController@git_basic');

Route::get('/1', 'ProfileController@php_basic');

Route::get('/12', 'ProfileController@database');

Route::get('/7', 'ProfileController@cicd');

Route::get('/2','ProfileController@laravel');

Route::get('/6', 'ProfileController@docker');

Route::get('{id}', 'ProfileController@course');

Route::get('/15', 'ProfileController@criptografia');

Route::get('/4', 'ProfileController@designpattern');