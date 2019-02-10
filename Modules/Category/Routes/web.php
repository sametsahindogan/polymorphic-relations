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

Route::prefix('categories')->group(function() {

    /** Listing category by all users. */
    Route::get('/', 'CategoryController@index')->name('getCategories');

    /** Listing categorized posts by all users. */
    Route::get('/{id}', 'CategoryController@getById')->name('getCategorizedPosts');

    /** Create category by all users. */
    Route::post('/create', 'CategoryController@create')->name('createCategory');
});
