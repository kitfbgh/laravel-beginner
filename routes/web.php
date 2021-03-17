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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/profile', function () {
//    return view('profile');
//});
Route::get('/profile', 'ProfileController@index');

Route::get('/profile/cache', 'ProfileController@cache');

Route::get('/profile/git_basic', 'ProfileController@git_basic');

Route::get('/profile/php_basic', 'ProfileController@php_basic');

Route::get('/profile/database', 'ProfileController@database');

Route::get('/profile/cicd', 'ProfileController@cicd');

Route::get('/profile/laravel','ProfileController@laravel');

Route::get('/profile/docker', 'ProfileController@docker');

Route::get('/profile/aws', 'ProfileController@aws');

Route::get('/profile/criptografia', 'ProfileController@criptografia');

Route::get('/profile/designpattern', 'ProfileController@designpattern');