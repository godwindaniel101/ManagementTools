<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('user', 'API\UsersController');
Route::resource('product', 'API\ProductController');
Route::resource('sales', 'API\MakeSalesController');
Route::get('todaySales', 'API\MakeSalesController@todaySales');
Route::get('loadSales', 'API\MakeSalesController@loadSales');
Route::get('profile', 'API\UsersController@profile');
Route::put('profile', 'API\UsersController@updateProfile');
Route::post('uploadPhoto','API\UsersController@uploadPhoto');
Route::post('changePassword', 'API\UsersController@changePassword');
Route:: post('passwordCheck', 'API\UsersController@passwordCheck');
Route:: get('getCost/{id}', 'API\ProductController@getCost');


Route::resource('chatcontrol', 'API\ChatsController');
Route::post('getMessage' , 'API\ChatsController@getMessage');
Route::post('getDetail' , 'API\ChatsController@getDetail');