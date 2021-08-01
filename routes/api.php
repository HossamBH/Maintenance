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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function ($router) {

    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::get('check-token', 'AuthController@checkActivation');
        // Route::post('reset-password', 'AuthController@resetPassword');
        // Route::post('pin-code', 'AuthController@checkPinCode');
        // Route::post('new-password', 'AuthController@newPassword');
        // Route::post('register-token', 'AuthController@RegisterToken');
        // Route::post('remove-token', 'AuthController@RemoveToken');

        Route::group(['middleware' => 'auth:api'], function ($router) {
            Route::get('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::get('me', 'AuthController@me');
        });
    });
    Route::group(['middleware' => 'auth:api'], function ($router) {
        Route::resource('city', 'CityController');
        Route::resource('area', 'AreaController');
        Route::resource('category', 'CategoryController');
        Route::resource('tax', 'TaxController');
        Route::resource('tax-type', 'TaxTypeController');
        Route::resource('item', 'ItemController');
    });
});
