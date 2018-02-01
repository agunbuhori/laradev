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

Route::get('/beacon/{uuid}', 'ApiController@promotions');
Route::get('/mall/{id?}', 'ApiController@mall');
Route::get('/event/{id?}', 'ApiController@event');
Route::get('/haversine', 'ApiController@haversine');

Route::get('/parking/{mall_id}', 'ApiController@parking');

Route::get('/mall/{id}/event', 'ApiController@mall_event');
Route::get('/mall/{id}/parking', 'ApiController@mall_parking');

Route::post('/booking_parking', 'ApiPostController@booking_parking');
Route::post('/checkin_parking', 'ApiPostController@checkin_parking');
Route::post('/checkout_parking', 'ApiPostController@checkout_parking');
Route::post('/vehicle', 'ApiPostController@vehicle');
Route::post('/add_user', 'ApiPostController@add_user');
Route::post('/edit_user', 'ApiPostController@edit_user');
Route::post('/edit_password', 'ApiPostController@edit_password');
Route::post('/member_login', 'ApiPostController@member_login');