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
    return redirect('vehicle');
});
Route::get('/home', function () {
    return redirect('vehicle');
})->name('home');

Auth::routes();


Route::get('/vehicle', 'AdminController@vehicle');
Route::get('/store', 'AdminController@store');
Route::get('/data_master', 'AdminController@data_master');

Route::group(['prefix' => 'data'], function(){
	Route::resource('vehicle','VehicleController');
	Route::resource('maker','MakerController');
	Route::resource('product','ProductController');
	Route::resource('store','StoreController');
});