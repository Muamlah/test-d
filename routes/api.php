<?php

use App\Http\Controllers\Admin\ChatAPIController;
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
Route::post('/login', 'API\Auth\AuthController@login')->name('api.user.login');
Route::post('/new-user', 'API\Auth\AuthController@register')->name('api.user.register');
Route::post('/user/{user}/update', 'API\Auth\AuthController@update')->name('api.user.update');

