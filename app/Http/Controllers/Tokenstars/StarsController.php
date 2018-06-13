<?php

namespace App\Http\Controllers\Tokenstars;

use App\Services\MailchimpEmailService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Response;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Cookie;

class StarsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function show(Request $request, $locale = 'en') {

        if ($locale === 'jp') {
            $locale = 'ja';
        }
        app('translator')->setLocale('en');

        $stats_data = '';
        $contribute_url = '';

        $view = view('tokenstars.stars.stars', ['contribute_url' => $contribute_url, 'stats_data' => $stats_data]);
        $response = Response($view);

        $promo_cookie = $request->cookie('popup_promo');


        if (!$promo_cookie) {
            $promo_cookie = new Cookie('popup_promo', 1, 0, null, null, null, null);
            $response->withCookie($promo_cookie);
        }

        return $response;
    }

    public function root()
    {
        return view('tokenstars.root');
    }

}
