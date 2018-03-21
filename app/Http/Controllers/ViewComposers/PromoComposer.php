<?php

namespace App\Http\ViewComposers;

use App\Models\Accounts\Promo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PromoComposer {

    public function __construct() {
        //
    }

    public function compose(View $view) {
        $view->with('user', Auth::user());
        $view->with('promo', Promo::where('slug', config('app.current_promo_slug'))->first());
        $memberCount = Cache::store('database')->get('stat.member_count');
        $memberCount = $memberCount ? $memberCount + 3400 : 3680;
        $view->with('memberCount', number_format($memberCount, 0, '.', '&nbsp;'));
    }
}
