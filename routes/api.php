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

Route::post('/register', 'Api\\UserController@register');
Route::post('/login', 'Api\\UserController@login');

Route::get('test', 'TestController@test');
Route::prefix('user')->middleware(['auth:api'])->group(function() {
    Route::get('/{id?}', 'Api\\UserController@getUserDetail');
    Route::put('/', 'Api\\UserController@putUserDetail');
});
