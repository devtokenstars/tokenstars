<?php

namespace App\Http\Controllers\Tokenstars;

use App\Http\Controllers\Controller;
use App\Services\MailchimpEmailService;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Response;
use Symfony\Component\HttpFoundation\Cookie;

class StarsWatchController extends Controller
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

        $view = view('tokenstars.stars.watch', ['contribute_url' => $contribute_url, 'stats_data' => $stats_data]);
        $response = Response($view);

        return $response;
    }

    public function root()
    {
        return view('tokenstars.root');
    }

}
