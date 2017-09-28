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
});


Route::group(['prefix' => 'posts'], function () {

    Route::get('/', ['as' => 'app.posts.index', 'uses' => 'TPostsControllers@index']);
    Route::get('/create', ['as' => 'app.posts.create', 'uses' => 'TPostsControllers@create']);
    Route::post('/create', ['uses' => 'TPostsControllers@store']);

    Route::group(['prefix' => '{id}'], function () {

        Route::get('/', ['as' => 'app.posts.show', 'uses' => 'TPostsControllers@show']);
        Route::get('/edit', ['as' => 'app.posts.edit', 'uses' => 'TPostsControllers@edit']);
        Route::post('/edit', ['uses' => 'TPostsControllers@update']);
        Route::delete('/delete', ['as' => 'app.posts.destroy', 'uses' => 'TPostsControllers@destroy']);
    });

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
