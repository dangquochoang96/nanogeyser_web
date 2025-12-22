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

Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'Api\ProductController@index');
    Route::get('/listCate', 'Api\ProductController@listCate');
    Route::get('/{id}', 'Api\ProductController@show');
    Route::post('/upload-option-image', 'Admin\Product\ProductController@uploadImage');
});
