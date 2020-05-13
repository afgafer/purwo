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

Route::get('/','FrontController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','type']], function () {
    
    Route::resource('dest','DestController');
    Route::resource('hotel','HotelController');
    Route::resource('room','RoomController');
    Route::resource('article','ArticleController');

    Route::put('confirm/{id}/image','ImageController@pConfirm')->name('image.pConfirm');

    Route::resource('event','EventController');
    Route::resource('admin','AdminController');

    Route::get('order/search',['uses'=>'OrderController@search','as'=>'order.search']);//
    Route::get('order/filter','OrderController@filter')->name('order.filter');
    Route::get('order/transaction','OrderController@transaction')->name('order.transaction');
    Route::get('order/payment','OrderController@payment')->name('order.payment');
    Route::get('order/export','OrderController@ordersEx')->name('order.export');
    Route::resource('order','OrderController')->except('store');
    Route::put('order/{id}/confirm','OrderController@confirm')->name('order.confirm');
});
//Route::resource('user','UserController');
Route::group(['prefix' => 'member', 'middleware' => ['auth']], function () {
    Route::get('form','OrderController@form')->name('order.form');
    Route::get('select','OrderController@select')->name('order.select');
    Route::get('choice/{id}','OrderController@choice')->name('order.choice');
    Route::get('choice/room/{id}','OrderController@room')->name('order.room');
    Route::get('cAgain','OrderController@cAgain')->name('order.cAgain');//hapus
    Route::post('order/store',['uses'=>'OrderController@store','as'=>'order.store']);
    Route::get('order','OrderController@indexA')->name('order.indexA');
    Route::get('order/{id}','OrderController@showA')->name('order.showA');
    Route::put('order/{id}/upload','OrderController@upload')->name('order.upload');
    Route::put('cancel/{id}/','OrderController@cancel')->name('order.cancel');

    Route::get('cart/',['uses'=>'CartController@index','as'=>'cart.index']);
    Route::post('cart/{id}/take',['uses'=>'CartController@take','as'=>'cart.take']);
    Route::post('cart/create',['uses'=>'CartController@create','as'=>'cart.create']);
    Route::post('cart/search',['uses'=>'CartController@search','as'=>'cart.search']);//
    //Route::post('cart/{id}',['uses'=>'CartController@show','as'=>'cart.show']);
    Route::post('cart/{id}/remove',['uses'=>'CartController@remove','as'=>'cart.remove']);
    Route::post('cart/{id}/destroy',['uses'=>'CartController@destroy','as'=>'cart.destroy']);
    Route::post('cart/drop',['uses'=>'CartController@drop','as'=>'cart.drop']);
});
Route::get('user/{id}','UserController@show')->name('user.show');

Route::get('dest/map','DestController@map')->name('dest.map');
Route::get('dest','DestController@indexA')->name('dest.indexA');
Route::get('dest/{id}','DestController@show')->name('dest.showA');

Route::get('hotel/map','HotelController@map')->name('hotel.map');
Route::get('hotel','HotelController@indexA')->name('hotel.indexA');
Route::get('hotel/{id}','HotelController@show')->name('hotel.showA');
Route::get('room/search','RoomController@search')->name('room.search');
Route::get('room/check','RoomController@check')->name('room.check');
Route::get('room','RoomController@indexA')->name('room.indexA');
Route::get('room/{id}','RoomController@show')->name('room.showA');
Route::get('article','ArticleController@indexA')->name('article.indexA');
Route::get('article/{id}','ArticleController@show')->name('article.showA');
Route::get('event','EventController@indexA')->name('event.indexA');
Route::get('event/{id}','EventController@show')->name('event.showA');

Route::get('images','ImageController@indexA')->name('image.indexA');
Route::get('image/create',['uses'=>'ImageController@createA','as'=>'image.create']);
Route::resource('image','ImageController')->except('create');