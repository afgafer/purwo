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

Route::get('dest/',['uses'=>'DestApiController@index','as'=>'dest.index']);
Route::get('dest/{id}',['uses'=>'DestApiController@show','as'=>'dest.show']);


Route::get('hotel/',['uses'=>'HotelController@indexJ','as'=>'hotel.indexJ']);
Route::get('hotel/{id}',['uses'=>'HotelController@showJ','as'=>'hotel.showJ']);
