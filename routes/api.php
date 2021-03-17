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
Route::get('/profile/info', function () {
    return ['time' => Carbon\Carbon::now()];
});

Route::get('/profile/aws/info', function () {
    return ['course' => 'AWS'];
});

Route::get('/profile/cicd/info', function () {
    return ['course' => 'CI/CD'];
});

Route::get('/profile/criptografia/info', function () {
    return ['course' => 'Criptografia'];
});

Route::get('/profile/database/info', function () {
    return ['course' => 'Database'];
});

Route::get('/profile/designpattern/info', function () {
    return ['course' => 'Design Pattern'];
});

Route::get('/profile/docker/info', function () {
    return ['course' => 'Docker'];
});

Route::get('/profile/git_basic/info', function () {
    return ['course' => 'Git_Basic'];
});

Route::get('/profile/laravel/info', function () {
    return ['course' => 'Laravel'];
});

Route::get('/profile/php_basic/info', function () {
    return ['course' => 'PHP_Basic'];
});