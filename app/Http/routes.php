<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Http\Middleware\CheckRole;

Route::get('/', 'BlogsController@index');

Route::auth();

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['Role:admin|editor']], function () {
        Route::resource('admin/blogs', 'AdminBlogsController');
        Route::resource('admin/users', 'AdminUsersController');
    });

    Route::post('blogs/like', ['as' => 'blogs.like', 'uses' => 'BlogsController@like']);
});

Route::resource('blogs', 'BlogsController');

Route::post('blogs/loadmore', ['as' => 'blogs.loadmore', 'uses' => 'BlogsController@loadmore']);