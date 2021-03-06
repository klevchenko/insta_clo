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

Auth::routes();

Route::get('/p/create', 'PostsController@create');
Route::get('/p/{post}', 'PostsController@show');
Route::post('/p', 'PostsController@store');
// delete post
Route::delete('/p/{post}', 'PostsController@destroy')->name('destroyPost');

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::post('/follow/{user}', 'FollowsController@store');

Route::get('/users', 'ProfilesController@showall')->name('allUsers');

// get all post comments
Route::get('/comments/{post}', 'CommentsController@index')->name('getComments');
Route::get('/comments/', 'CommentsController@all');

// post one comment
Route::post('/comment', 'CommentsController@store')->name('addComment');

// delete comment
Route::delete('/comment/{comment}', 'CommentsController@destroy')->name('destroyComment');

// Likes
Route::post('/like/{post}', 'LikesController@store');
Route::get('/liked', 'LikesController@liked')->name('likedPosts');


// Home page
Route::get('/', 'PostsController@index');
