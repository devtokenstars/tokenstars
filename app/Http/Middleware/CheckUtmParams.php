<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Support\Facades\Auth;

use App\Models\Utm;
use App\Models\User;

class CheckUtmParams extends Middleware
{
    public function handle($request, Closure $next)
    {

        if ($request->utm_source) {

            $utm_params = [
                'utm_source' => $request->utm_source,
                'utm_campaign' => $request->utm_campaign,
                'utm_medium' => $request->utm_medium,
                'utm_content' => $request->utm_content,
                'referrer' => $request->referrer,
            ];

            $request->session()->put($utm_params);
        }

        if (Auth::check() && session()->get('utm_source')) {

            if (!$this->check_utm()) {
                $this->create_utm();
            }
        }

        return $next($request);
    }

    public function create_utm()
    {

        $utm = new Utm;
        $utm->user_id = Auth::id();
        $utm->utm_source = session()->get('utm_source');
        $utm->utm_medium = session()->get('utm_medium');
        $utm->utm_campaign = session()->get('utm_campaign');
        $utm->utm_content = session()->get('utm_content');
        $utm->referrer = session()->get('referrer');
        $utm->save();

        session()->forget('utm_source');
        session()->forget('utm_medium');
        session()->forget('utm_campaign');
        session()->forget('utm_content');
        session()->forget('referrer');

    }

    public function check_utm()
    {
        $current_user = Auth::user();

        if ($current_user->last_utm) {


            if (
                $current_user->last_utm->utm_source == session()->get('utm_source') &&
                $current_user->last_utm->utm_medium == session()->get('utm_medium') &&
                $current_user->last_utm->utm_campaign == session()->get('utm_campaign') &&
                $current_user->last_utm->utm_content == session()->get('utm_content') &&
                $current_user->last_utm->referrer == session()->get('referrer')
            ) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

}