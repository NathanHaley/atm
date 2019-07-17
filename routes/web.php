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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login/pin', 'Auth\LoginController@pin')->name('login.pin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home/{accountType?}', 'HomeController@index')->name('home');
});
