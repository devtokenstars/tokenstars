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


Route::group(['middleware' => 'check_utm'], function() {

Route::namespace('Auth')->group(function () {
    Route::get('logout', 'LoginController@logout')->name('auth.logout');
    Route::get('signin', 'LoginController@loginView')->name('login');
    Route::post('signin', 'LoginController@loginCheck')->name('auth.loginCheck');
    Route::match(['get', 'post'], 'requestcode', 'LoginController@requestCode')->name('auth.requestCode');
    Route::get('confirm', 'LoginController@confirm')->name('auth.confirm');
    Route::match(['get', 'post'], 'signup', 'RegisterController@register')->name('register');
    Route::match(['get', 'post'], 'check2fa', 'LoginController@checkGoogle2FA')->name('auth.check2fa');
    // Password Reset Routes...
    Route::prefix('password')->group(function () {
        $this->get('reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $this->post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $this->get('reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        $this->post('reset', 'ResetPasswordController@reset');
    });
});

});


Route::prefix('tokens')->group(function () {
    Route::post('wallet', 'TokensController@wallet')->name('tokens.wallet');
    Route::post('buy', 'TokensController@buy')->name('tokens.buy');
    Route::post('wallet_user', 'TokensController@wallet_user')->name('tokens.wallet_user');
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