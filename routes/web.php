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


Route::post('/telegram/', [
    'uses' => 'TelegramController@webhook'
]);

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

    Route::namespace('Tokenstars')->group(function () {
        Route::get('/', 'FreshController@show', function () {
            app('translator')->setLocale('en');
        });


        Route::get('/hazard', function () {
            return view('tokenstars.pages.hazard');
        });
        Route::get('/luiz', function () {
            return view('tokenstars.pages.luiz');
        });
        Route::get('/fabregas', function () {
            return view('tokenstars.pages.fabregas');
        });
        Route::get('/ovechkin', function () {
            return view('tokenstars.pages.ovechkin');
        });
        Route::get('/rodriguez', function () {
            return view('tokenstars.pages.rodriguez');
        });
        Route::get('/akon', function () {
            return view('tokenstars.pages.akon');
        });
        Route::get('/butler', function () {
            return view('tokenstars.pages.butler');
        });
        Route::get('/murray', function () {
            return view('tokenstars.pages.murray');
        });


        Route::get('/starsipo', function () {
            $filename = 'starsipo-1.pdf';

            return response()->make(file_get_contents(base_path() . '/public/pdfs/' . $filename), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        });

        Route::get('/starsIPO', function () {
            $filename = 'starsipo-1.pdf';

            return response()->make(file_get_contents(base_path() . '/public/pdfs/' . $filename), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        });

        Route::get('/StarIPO', function () {
            $filename = 'starsipo-2.pdf';

            return response()->make(file_get_contents(base_path() . '/public/pdfs/' . $filename), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        });

        Route::get('/ace/', [
            'as' => 'ace',
            'middleware' => 'localize',
            'uses' => 'ExampleController@show'
        ]);

        Route::get('/ace/tech', function () {
            return redirect('/ace');
        });

        Route::get('/team/', [
            'as' => 'earn',
            'middleware' => 'localize',
            'uses' => 'TeamController@show'
        ]);
        Route::get('/fresh/', [
            'as' => 'fresh',
            'middleware' => 'localize',
            'uses' => 'FreshController@show'
        ]);
        Route::get('/predictions/', [
            'as' => 'team',
            'middleware' => 'localize',
            'uses' => 'PredictionsController@show'
        ]);
        Route::get('/earn/', [
            'as' => 'team',
            'middleware' => 'localize',
            'uses' => 'StarsController@show'
        ]);
        Route::get('/watch/', [
            'as' => 'watch',
            'middleware' => 'localize',
            'uses' => 'StarsWatchController@show'
        ]);

        Route::group(['prefix' => '{locale}', 'middleware' => 'localize'], function () {
            Route::get('earn', [
                'uses' => 'StarsController@show'
            ]);
            Route::get('watch', [
                'uses' => 'StarsWatchController@show'
            ]);
            Route::get('fresh', [
                'uses' => 'FreshController@show'
            ]);
            Route::get('predictions', [
                'uses' => 'PredictionsController@show'
            ]);
            Route::get('', [
                'uses' => 'ExampleController@root'
            ]);
            Route::get('ace', [
                'uses' => 'ExampleController@show'
            ]);
            Route::get('team', [
                'uses' => 'TeamController@show'
            ]);
            Route::get('ace/tech', function () {
                return redirect()->route('ace');
            });
        });

    });

});
