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

Route::group(['prefix'=>'tags'], function () {

    /** Listing tags by all users. */
    Route::get('/', 'TagController@index')->name('getTags');

    /** Listing tagged posts by all users. */
    Route::get('/{id}', 'TagController@getById')->name('getTaggedPosts');

    /** Create tag by all users. */
    Route::post('/create', 'TagController@create')->name('createTag');

});