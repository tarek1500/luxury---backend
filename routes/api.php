<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'API', 'as' => 'api.'], function () {
	Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
		Route::post('login', 'AuthController@login')->name('login');
		Route::post('register', 'AuthController@register')->name('register');
		Route::post('logout', 'AuthController@logout')->middleware('auth:sanctum')->name('logout');
	});

	Route::group(['middleware' => 'auth:sanctum'], function () {
		Route::get('user', function (Request $request) {
			return $request->user();
		});

		Route::get('timeline', 'TimelineController@index')->name('timeline.index');
		Route::apiResource('posts', 'PostController');
		Route::apiResource('comments', 'CommentController')->except(['show']);
	});
});