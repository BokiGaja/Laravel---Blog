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
})->name('home');

// Use all resources from PostController
Route::resource('posts', 'PostsController');

Route::get('/register', 'RegisterController@create')->name('show-register');
Route::post('/register', 'RegisterController@store')->name('register');

Route::post('/posts/{id}/comments', 'PostsController@addComment')->name('posts.comment');
