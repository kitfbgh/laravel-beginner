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

Route::get('/git_basic', 'ProfileController@git_basic');

Route::get('/php_basic', 'ProfileController@php_basic');

Route::get('/database', 'ProfileController@database');

Route::get('/cicd', 'ProfileController@cicd');

Route::get('/laravel','ProfileController@laravel');

Route::get('/docker', 'ProfileController@docker');

Route::get('/aws', 'ProfileController@aws');

Route::get('/criptografia', 'ProfileController@criptografia');

Route::get('/designpattern', 'ProfileController@designpattern');