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
    return view('layouts.admin');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'setup'], function() {
	Route::get('/module', 'SetupController@module');
	Route::get('/role', 'SetupController@role');
	Route::get('/authorization', 'SetupController@authorization');
	Route::get('/page', 'SetupController@page');
});

Route::get('/dashboard', 'DashboardController@index');

Route::group(['namespace' => 'Data', 'prefix' => 'data'], function() {
	Route::resource('module', 'ModuleController');
	Route::resource('mall', 'MallController');
	Route::resource('merchant', 'MerchantController');
	Route::resource('beacon', 'BeaconController');
	Route::post('/beacon/disable/{id}', 'BeaconController@disable');
	Route::resource('promotion', 'PromotionController');
	Route::post('/promotion/delete', 'PromotionController@delete');
	Route::post('/promotion/unpublish', 'PromotionController@unpublish');
	Route::resource('parking_lot', 'ParkingLotController');
	Route::resource('event', 'EventController');
	Route::post('/beacon/switch/{id}', 'BeaconController@switch');
	Route::resource('parking_transaction', 'ParkingTransactionController');
});

Route::group(['prefix' => 'authorization'], function() {
	Route::get('/mall', 'AdminController@mall');
	Route::get('/mall_profile/{code}', 'AdminController@mall_profile');
	Route::get('/merchant', 'AdminController@merchant');
	Route::get('/beacon', 'AdminController@beacon');
	Route::get('/promotion', 'AdminController@promotion');
	Route::get('/event', 'AdminController@event');
	Route::get('/our_profile', 'AdminController@profile');
	Route::get('/beacon_manager', 'AdminController@beacon_manager');
	Route::get('/parking_lot/{mall?}', 'AdminController@parking_lot');
	Route::get('/parking_history', 'AdminController@parking_history');
});

Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/reset', 'Auth\PasswordController@reset');