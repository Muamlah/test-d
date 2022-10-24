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

Route::group(['prefix' => 'payment', 'as' => 'rajhiBank.'], function () {
                Route::any('/response/{id}/{type}', 'Website\ARBController@response')->name('response');
                Route::any('error/response/{id}/{type}', 'Website\ARBController@error_response')->name('error_response');

});
Route::group(['prefix' => 'admin/payout', 'as' => 'admin.rajhiBank.'], function () {
                Route::any('success/{id}/{type}', 'Website\ARBController@payout_response')->name('success_payout_response');
                Route::any('error/{id}/{type}', 'Website\ARBController@error_payout_response')->name('error_payout_response');
});
//Route::post('test')->routes(function ($api) {
//    $api->resource('posts');
//    $api->resource('comments');
//});
