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
    return view('welcome');
});


Route::namespace('IPN')->prefix('ipn')->group(function () {
    Route::prefix('coinpayments')->group(function () {
        Route::post('transaction', 'CoinpaymentsIPNController@transaction')->name('coinpayments.transactionIpnUrl');
        Route::post('deposit', 'CoinpaymentsIPNController@deposit')->name('coinpayments.depositIpnUrl');
        Route::post('callbackAddress', 'CoinpaymentsIPNController@callbackAddress')->name('coinpayments.callbackAddressIpnUrl');
    });
});


Route::group(['middleware' => 'check_utm'], function() {

    Route::namespace('Dashboard')->group(function () {
        Route::get('/', 'HomeController@home')->name('home');

        // Route::get('/portfolio', 'HomeController@portfolio')->name('portfolio')->middleware('auth');
        Route::match(['get', 'post'], 'profile', 'HomeController@profile')->name('profile')->middleware('auth');
        Route::post('setwallet', 'HomeController@setUserWallet')->name('setwallet')->middleware('auth');
        Route::get('/rules', 'HomeController@rules')->name('rules');
        Route::get('/{slug_name}', 'HomeController@read')->name('read');//->where('id', '\d+');
    });
});