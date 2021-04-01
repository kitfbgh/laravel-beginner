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
Route::get('/', function () {
    return view(
        'welcome',
    );
});

Route::get('courses', 'ProfileController@index');

Route::get('/cache', 'ProfileController@cache');

Route::get('course/{course_id}', 'ProfileController@course');

Route::get('student/{student_id}', 'ProfileController@student');
