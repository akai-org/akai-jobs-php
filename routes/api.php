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

// Route added for standarization - gives possibility to log in through /api/ URI
Route::post('oauth/token', 'Auth\NewAccessTokenController@issueToken');

// TODO przenieść dodawanie ofert pod middleware
Route::post('jobOffers/{jobOffer}', 'Api\JobOfferController@update');
Route::resource('jobOffers', 'Api\JobOfferController', ['except' => 'update']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});