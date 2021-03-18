<?php

use App\Exceptions\APIException;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/profile/info', "APIController@profile");

Route::get('/aws/info', "APIController@aws");

Route::get('/cicd/info', "APIController@cicd");

Route::get('/criptografia/info', "APIController@criptografia");

Route::get('/database/info', "APIController@database");

Route::get('/designpattern/info', "APIController@designpattern");

Route::get('/docker/info', "APIController@docker");

Route::get('/git_basic/info', "APIController@git_basic");

Route::get('/laravel/info', "APIController@laravel");

Route::get('/php_basic/info', "APIController@php_basic");