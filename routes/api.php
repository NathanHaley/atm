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

Route::group(['middleware' => 'auth:api'], function() {

    Route::post('/checking/deposit', 'Api\CheckingController@deposit')->name('checking.deposit');
    Route::post('/checking/withdraw', 'Api\CheckingController@withdraw')->name('checking.withdraw');
    Route::post('/checking/transfer', 'Api\CheckingController@transfer')->name('checking.transfer');

    Route::post('/saving/deposit', 'Api\SavingController@deposit')->name('saving.deposit');
    Route::post('/saving/withdraw', 'Api\SavingController@withdraw')->name('saving.withdraw');
    Route::post('/chesavingcking/transfer', 'Api\SavingController@transfer')->name('saving.transfer');
});


