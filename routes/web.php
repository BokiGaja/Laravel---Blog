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

// Use all resources from PostController, there we also added middleware
Route::resource('posts', 'PostsController');
// Set middleware guest on group of routes, it will allow only to guest to visit those routes
Route::group(['middleware' => ['guest']], function ()
{
    Route::get('/register', 'RegisterController@create')->name('show-register');
    Route::post('/register', 'RegisterController@store')->name('register');
    Route::get('/login', 'LoginController@create')->name('show-login');
    Route::post('/login', 'LoginController@store')->name('login');
});

Route::get('/logout', 'LoginController@logout')->name('logout');
Route::post('/posts/{id}/comments', 'PostsController@addComment')->name('posts.comment');

Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/my-posts', 'UserPostsController@index')->name('my-posts');
});
