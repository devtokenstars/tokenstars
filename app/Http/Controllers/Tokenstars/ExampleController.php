<?php

namespace App\Http\Controllers\Tokenstars;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Response;
use Symfony\Component\HttpFoundation\Cookie;

class ExampleController extends Controller
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
        app('translator')->setLocale($locale);

        $stats_data = $this->getStats();

        if ($request->get('utm_source') || $request->get('utm_medium') || $request->get('utm_campaign') || $request->get('utm_content') || $request->get('ref')) {
            $utm_source_cookie = $request->get('utm_source') ? new Cookie('utm_source', $request->get('utm_source'), time() + (365 * 24 * 60 * 60)) : new Cookie('utm_source', $request->get('utm_source'), 1);
            $utm_medium_cookie = $request->get('utm_medium') ? new Cookie('utm_medium', $request->get('utm_medium'), time() + (365 * 24 * 60 * 60)) : new Cookie('utm_medium', $request->get('utm_medium'), 1);
            $utm_campaign_cookie = $request->get('utm_campaign') ? new Cookie('utm_campaign', $request->get('utm_campaign'), time() + (365 * 24 * 60 * 60)) : new Cookie('utm_campaign', $request->get('utm_campaign'), 1);
            $utm_content_cookie = $request->get('utm_content') ? new Cookie('utm_content', $request->get('utm_content'), time() + (365 * 24 * 60 * 60)) : new Cookie('utm_content', $request->get('utm_content'), 1);
            $ref_cookie = $request->get('ref') ? new Cookie('ref', $request->get('ref'), time() + (365 * 24 * 60 * 60)) : new Cookie('ref', $request->get('ref'), 1);


            $contribute_url = "?";
            $contribute_url .= $request->get('utm_source') ? "utm_source=" . $request->get('utm_source') . "&" : "";
            $contribute_url .= $request->get('utm_medium') ? "utm_medium=" . $request->get('utm_medium') . "&" : "";
            $contribute_url .= $request->get('utm_campaign') ? "utm_campaign=" . $request->get('utm_campaign') . "&" : "";
            $contribute_url .= $request->get('utm_content') ? "utm_content=" . $request->get('utm_content') . "&" : "";
            $contribute_url .= $request->get('ref') ? "ref=" . $request->get('ref') : "";
        } else {
            $contribute_url = "?";
            $contribute_url .= $request->cookie('utm_source') ? "utm_source=" . $request->cookie('utm_source') . "&" : "";
            $contribute_url .= $request->cookie('utm_medium') ? "utm_medium=" . $request->cookie('utm_medium') . "&" : "";
            $contribute_url .= $request->cookie('utm_campaign') ? "utm_campaign=" . $request->cookie('utm_campaign') . "&" : "";
            $contribute_url .= $request->cookie('utm_content') ? "utm_content=" . $request->cookie('utm_content') . "&" : "";
            $contribute_url .= $request->cookie('ref') ? "ref=" . $request->cookie('ref') : "";

            $utm_source_cookie = false;
            $utm_medium_cookie = false;
            $utm_campaign_cookie = false;
            $utm_content_cookie = false;
            $ref_cookie = false;
        }

        $view = view('tokenstars.tech', ['contribute_url' => $contribute_url, 'stats_data' => $stats_data]);
        $response = Response($view);
        if ($utm_source_cookie) $response->withCookie($utm_source_cookie);
        if ($utm_medium_cookie) $response->withCookie($utm_medium_cookie);
        if ($utm_campaign_cookie) $response->withCookie($utm_campaign_cookie);
        if ($utm_content_cookie) $response->withCookie($utm_content_cookie);
        if ($ref_cookie) $response->withCookie($ref_cookie);

        return $response;
    }

    public function root($locale = 'en')
    {
        if ($locale === 'jp') {
            $locale = 'ja';
        }
        app('translator')->setLocale($locale);

        return view('tokenstars.root');
    }

    public function getStats() {
        $arr = json_decode(file_get_contents('https://stats.acetoken.tokenstars.com'), true);

        $btc_total = !empty($arr["btc"])?$arr["btc"]: 377;
        $usd_total = !empty($arr["usd"])?$arr["usd"]: 1508000;

        $data = [
            'btc_total'     => $btc_total,
            'usd_total'     => number_format($usd_total),
            'btc_presale'   => 377,
            'btc_plus'      => $btc_total - 377,
            'presale_width' => (int)(377 * 100 / 1500),
            'total_width'   => (int)($btc_total * 100 / 1500)
        ];

        return $data;

    }
}
