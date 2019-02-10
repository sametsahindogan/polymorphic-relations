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

Route::get('/', function () { return redirect('/posts'); });


Route::group(['prefix'=>'posts'], function () {

    /** Listing posts by all users. */
    Route::get('/', 'PostController@get')->name('getPosts');

    /** Get post by ID. */
    Route::get('/{id}', 'PostController@getById')->name('getPostById');

    /** Create post by all users. */
    Route::post('/create', 'PostController@create')->name('createPost');

    /** Update post by all users. */
    Route::post('/update', 'PostController@update')->name('updatePost');

    /** Delete post by all users. */
    Route::get('/delete/{id}', 'PostController@delete')->name('deletePost');

});
