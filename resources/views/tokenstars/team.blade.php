@extends('tokenstars.layouts.layout-team')

@php
    $lang = app('translator')->getLocale()
@endphp

@section('content')
        <div class="popup-container j-popup j-subscribe-popup">
            <div class="popup-holder popup-holder--default j-popup-holder">
                <div class="popup-hide-btn j-hide-popup">
                    <img src="/images/ace/tech-version/close-icon-red.png">
                </div>
                <form class="bold-font j-top-form" target="_blank" onsubmit="ga('send', 'event', 'email-add', 'notify-ok', 'menu');">
                    <input type="email" name="EMAIL" id="mce-EMAIL" class="text-input main-form__input medium-font" placeholder="E-mail">
                    <input type="hidden" name="LANGUAGE" value="{{ $lang }}">
                    <input type="hidden" name="SOURCE" value="">
                    <div class="big-margin-before j-top-response"></div>
                    <input type="submit" id="mc-embedded-subscribe" class="btn btn-blue btn-big big-margin-before" value="@lang('tokenstars-team.main_form.subscribe')">
                </form>
            </div>
        </div>

        <div class="popup-container j-popup j-bonus-popup">
            <div class="popup-holder popup-holder--default j-popup-holder">
                <div class="popup-hide-btn j-hide-popup">
                    <img src="/images/ace/tech-version/close-icon-red.png">
                </div>
                <div class="j-bonus-form">
                <h3 class="bonus-popup-title bold-font">@lang('tokenstars-team.crowdsale.title')</h3>
                <p class="big-font-size big-margin-before">@lang('tokenstars-team.crowdsale.subtitle')</p>

                <form class="bold-font big-margin-before j-bonus-form" target="_blank">
                    <input type="hidden" name="LANGUAGE" value="{{ $lang }}">
                    <input type="hidden" name="SOURCE" value="">

                    <div class="row">
                        <div class="col-lg-12 big-margin-before">
                            <p class="big-font-size sub-font-color medium-font">E-mail</p>
                            <input type="email" name="EMAIL" id="mce-EMAIL" class="text-input main-form__input small-margin-before medium-font" placeholder="">
                        </div>
                    </div>

                    <div class="row">
                        <!-- <div class="col-lg-6 big-margin-before">
                            <p class="big-font-size sub-font-color medium-font medium-margin-before">I will pay in</p>
                            <input type="radio" class="radio-input" name="coin" id="bonus-btc" checked value="BTC">
                            <label for="bonus-btc" class="big-margin-before">BTC</label>
                            <input type="radio" class="radio-input" name="coin" id="bonus-eth" value="ETH">
                            <label for="bonus-eth" class="big-margin-before">ETH</label>
                        </div> -->
                        <div class="col-lg-12 big-margin-before">
                            <p class="big-font-size sub-font-color medium-font medium-margin-before">@lang('tokenstars-team.crowdsale.range')</p>
                            <select class="select-input small-margin-before" name="range">
                                <option value="1">0.01BTC - 0.1BTC</option>
                                <option value="2">0.1BTC - 0.5BTC</option>
                                <option value="3">0.5BTC - 1 BTC </option>
                                <option value="4">1 BTC - 3 BTC (amount bonus 5%)</option>
                                <option value="5">3 BTC - 5 BTC (amount bonus 10%)</option>
                                <option value="6">5 BTC+  (amount bonus 20%)</option>
                            </select>
                        </div>
                    </div>
                    <div class="big-margin-before j-top-response"></div>
                    <div class="row huge-margin-before">
                        <div class="col-lg-6 offset-lg-3 big-margin-before">
                            <input type="submit" id="mc-embedded-subscribe" class="btn btn-blue btn-big btn-long" value="@lang('tokenstars-team.crowdsale.btn')">
                        </div>
                    </div>
                </form>
                </div>
                <div class="align-center hide j-bonus-response">
                    <p class="title-size bold-font">@lang('tokenstars-team.crowdsale.response_title')</p>
                    <p class="big-font-size huge-margin-before">@lang('tokenstars-team.crowdsale.response_text')</p>
                </div>
            </div>
        </div>

        <div class="popup-container j-popup j-stay-popup">
            <div class="popup-holder popup-holder--default j-popup-holder">
                <div class="popup-hide-btn j-hide-popup">
                    <img src="/images/ace/tech-version/close-icon-red.png">
                </div>
                <h3 class="bonus-popup-title bold-font">@lang('tokenstars-team.stay_popup.title')</h3>
                <p class="big-font-size big-margin-before">@lang('tokenstars-team.stay_popup.subtitle')</p>

                <form class="bold-font huge-margin-before j-top-form" target="_blank" onsubmit="">
                    <input type="hidden" name="LANGUAGE" value="{{ $lang }}">
                    <input type="hidden" name="SOURCE" value="">

                    <p class="big-font-size sub-font-color medium-font">E-mail</p>
                    <input type="email" name="EMAIL" id="mce-EMAIL" class="text-input main-form__input small-margin-before medium-font" placeholder="">

                    <div class="big-margin-before j-top-response"></div>
                        <div class="row huge-margin-before">
                            <div class="col-lg-6 big-margin-before">
                                <input type="submit" id="mc-embedded-subscribe" class="btn btn-blue btn-big btn-long" value="@lang('tokenstars-team.main_form.subscribe')">
                            </div>
                        </div>
                </form>
            </div>
        </div>

        <div class="popup-container j-popup j-why-team">
            <div class="popup-holder popup-holder--default j-popup-holder">
                <div class="popup-hide-btn j-hide-popup">
                    <img src="/images/ace/tech-version/close-icon-red.png">
                </div>
                <div class="title-size uppercase bold-font">@lang('tokenstars-team.main.reason_title')</div>
                <ol>
                    <li class="big-margin-before">@lang('tokenstars-team.main.reason_1')</li>
                    <li class="big-margin-before">@lang('tokenstars-team.main.reason_2')</li>
                    <li class="big-margin-before">@lang('tokenstars-team.main.reason_3')</li>
                    <li class="big-margin-before">@lang('tokenstars-team.main.reason_4')</li>
                    <li class="big-margin-before">@lang('tokenstars-team.main.reason_5')</li>
            </div>
        </div>

        <div class="chat-float-holder">
            <div class="bold-font">@lang('tokenstars-messages.float_chat.chat_float_name')</div>
            <div class="sub-font-color">@lang('tokenstars-messages.float_chat.chat_float_title')</div>
            <div class="small-margin-before">
                <div class="chat-float-photo" style="background-image: url('/upload/images/stukolov.jpg')"></div>
                <a href="https://t.me/TokenStars_en" target="_blank" class="btn btn-regular btn-blue" onclick="ga('send', 'event', 'click', 'telegram', 'float');"><img src="/images/ace/tech-version/telegram-white.png" alt="" class="chat-float-icon"> @lang('tokenstars-messages.float_chat.chat_float_button')</a>
            </div>
        </div>

        <section class="section-holder main main--team">
            <div class="wrap">
                <div class="row row-eq-height">
                    <div class="col-lg-6 col-md-12">
                        <div class="bold-font">
                            <!-- <div class="main-left-side"></div> -->
                            <h1 class="main-title main-title--team">@lang('tokenstars-team.main.title')</h1>
                            <h2 class="big-font-size medium-font huge-margin-before">@lang('tokenstars-team.main.subtitle1')</h2>
                            <a href="@lang('tokenstars-team.other.whitepaper')" target="_blank" class="btn btn-highlight btn-big huge-margin-before" onclick="ga('send', 'event', 'click', 'downloadwp', 'top_team');">@lang('tokenstars-team.main.whitepaper')</a>
                            <br />
                            <a href="/upload/files/@lang('tokenstars-team.main.onepager_file').pdf" target="_blank" class="btn btn-white-border btn-regular big-margin-before" onclick="ga('send', 'event', '1pager', '1pager', '');">@lang('tokenstars-team.main.onepager')</a>
                            &nbsp;&nbsp;
                            <span class="j-popup-trigger btn btn-white-border btn-regular big-margin-before" data-target-popup=".j-why-team" onclick="ga('send', 'event', '5reasons', '5reasons', '');">@lang('tokenstars-team.main.reasons')</span>
                        </div>

                        <div class="main-review-holder huge-margin-before">
                            <a target="_blank" onclick="ga('send', 'event', 'listing', 'icorating', 'top');" href="https://icorating.com/ico/tokenstars-team/"><img src="/images/team/reviews/icorating.png" alt="TokenStars TEAM Rating Review" class="main-review-badge"></a>
                            <a target="_blank" onclick="ga('send', 'event', 'listing', 'top_ico_gold', 'top');" href="https://topicolist.com/ico/tokenstars-team "><img src="/images/team/reviews/topicolist.png" alt="TokenStars Gold Level TOP ICO LIST" class="main-review-badge"></a>
                            <a target="_blank" onclick="ga('send', 'event', 'listing', 'ico_bazaar', 'top');" href="https://icobazaar.com/v2/tokenstars_team"><img src="/images/team/reviews/icobazar.png" alt="TokenStars AA ICO Bazaar" class="main-review-badge"></a>
                            <a target="_blank" onclick="ga('send', 'event', 'listing', 'ico_bench', 'top');" href="https://icobench.com/ico/tokenstars-team"><img src="/images/team/reviews/icobench.png" alt="TokenStars ICObench" class="main-review-badge"></a>
                            <a target="_blank" onclick="ga('send', 'event', 'listing', 'track_ico', 'top');" href="https://www.trackico.io/ico/tokenstars-team/#rating"><img src="/images/team/reviews/trackico.png" alt="TokenStars TrackICO" class="main-review-badge"></a>
                            <a target="_blank" onclick="ga('send', 'event', 'listing', 'ico_ranker', 'top');" href="https://www.icoranker.com/ico/tokenstars-team/"><img src="/images/team/reviews/icoranker.png" alt="TokenStars ICORanker" class="main-review-badge"></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="main-form bold-font">
                            <h3 class="main-form__title">@lang('tokenstars-team.main_form.over')</h3>
                            @if(false)
                            <p class="sub-font-color medium-margin-before">@lang('tokenstars-team.main_form.bonus_date')</p>
                            <div class="big-margin-before main-line--black"></div>
                            <p class="big-margin-before big-font-size medium-font">@lang('tokenstars-messages.main_form.bonus2', ['btc' => '1', 'percent' => '5'])</p>
                            <div class="main-counter">
                                <div class="main-counter__item">
                                    <p class="huge-title-size j-counter-days"></p>
                                    <p class="medium-margin-before small-font-size">@lang('tokenstars-messages.main_form.counter.days')</p>
                                </div>
                                <div class="main-counter__item">
                                    <p class="huge-title-size j-counter-hours"></p>
                                    <p class="medium-margin-before small-font-size">@lang('tokenstars-messages.main_form.counter.hours')</p>
                                </div>
                                <div class="main-counter__item">
                                    <p class="huge-title-size j-counter-minutes"></p>
                                    <p class="medium-margin-before small-font-size">@lang('tokenstars-messages.main_form.counter.minutes')</p>
                                </div>
                                <div class="main-counter__item">
                                    <p class="huge-title-size j-counter-seconds"></p>
                                    <p class="medium-margin-before small-font-size">@lang('tokenstars-messages.main_form.counter.seconds')</p>
                                </div>
                            </div>

                            <script>
                                //Render counter:
                                function counterHeader(date) {
                                    var block = {
                                        days: document.getElementsByClassName('j-counter-days')[0],
                                        hours: document.getElementsByClassName('j-counter-hours')[0],
                                        minutes: document.getElementsByClassName('j-counter-minutes')[0],
                                        seconds: document.getElementsByClassName('j-counter-seconds')[0]
                                    };

                                    ts = new Date(date).getTime();
                                    var render = function() {
                                        var now = new Date().getTime();
                                        var distance = ts - now;
                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        block.days.innerHTML = days;
                                        block.hours.innerHTML = hours;
                                        block.minutes.innerHTML = minutes;
                                        block.seconds.innerHTML = seconds;
                                    };

                                    render();
                                    return setInterval(render, 1000);
                                }
                                // counterHeader('Mar 28, 2018 23:00:00 UTC+3')
                            </script>
                            @endif

                            <div class="main-progress-bar">
                                <span class="main-progress-bar__sale" style="width: {{$stats_data['team_distributed']}}%">10&nbsp;037&nbsp;039 @lang('tokenstars-messages.main.progress.distributed')</span>
                            </div>

                            <div class="big-margin-before main-line--black"></div>
                            <a href="https://teamtoken.tokenstars.com/users/sign_in{{$contribute_url}}" class="btn btn-blue btn-big big-margin-before">@lang('tokenstars-team.main_form.kyc')</a>

                            <br />
                            <a href="https://tokenstars.com/upload/files/how_to_add_TEAM_tokens.pdf" target="_blank" class="btn btn-blue-border btn-small big-margin-before">@lang('tokenstars-team.main_form.how_to')</a>


                        </div>
                        <div class="huge-margin-before align-center">
                            <a href="https://t.me/TokenStars{{ $lang == 'ru' ? '_ru' : ($lang == 'jp'? 'Japan' : '_en') }}" target="_blank" class="main-social-item" onclick="ga('send', 'event', 'click', 'telegram', 'top');"><img title="Telegram" alt="Telegram" src="/images/ace/tech-version/telegram-white.png" /> Telegram</a>
                            <a href="{{ $lang == 'ru' ? 'https://bitcointalk.org/index.php?topic=2045165.0' : 'https://bitcointalk.org/index.php?topic=2043613.0' }}" target="_blank" class="main-social-item"><img title="BitCoinTalk" alt="BitCoinTalk" src="/images/ace/tech-version/bitcointalk-white.png" /> BitCoinTalk</a>
                        </div>
                        <!-- <div class="main-form bold-font">
                            <h3 class="main-form__title">@lang('tokenstars-team.main_form.title')</h3>
                            <p class="sub-title-size medium-font huge-margin-before">@lang('tokenstars-team.main_form.subtitle1')</p>
                            <p class="sub-title-size sub-font-color medium-font big-margin-before">@lang('tokenstars-team.main_form.details_soon')</p>

                            @if(false)
                            <p class="sub-font-color big-font-size small-margin-before">@lang('tokenstars-team.main_form.date')</p>
                            <div class="main-counter big-margin-before">
                                <div class="main-counter__item">
                                    <p class="huge-title-size j-counter-days"></p>
                                    <p class="medium-margin-before small-font-size">@lang('tokenstars-messages.main_form.counter.days')</p>
                                </div>
                                <div class="main-counter__item">
                                    <p class="huge-title-size j-counter-hours"></p>
                                    <p class="medium-margin-before small-font-size">@lang('tokenstars-messages.main_form.counter.hours')</p>
                                </div>
                                <div class="main-counter__item">
                                    <p class="huge-title-size j-counter-minutes"></p>
                                    <p class="medium-margin-before small-font-size">@lang('tokenstars-messages.main_form.counter.minutes')</p>
                                </div>
                                <div class="main-counter__item">
                                    <p class="huge-title-size j-counter-seconds"></p>
                                    <p class="medium-margin-before small-font-size">@lang('tokenstars-messages.main_form.counter.seconds')</p>
                                </div>
                            </div>
                            <script>
                                //Render counter:
                                function counterHeader(date) {
                                    var block = {
                                        days: document.getElementsByClassName('j-counter-days')[0],
                                        hours: document.getElementsByClassName('j-counter-hours')[0],
                                        minutes: document.getElementsByClassName('j-counter-minutes')[0],
                                        seconds: document.getElementsByClassName('j-counter-seconds')[0]
                                    };

                                    ts = new Date(date).getTime();
                                    var render = function() {
                                        var now = new Date().getTime();
                                        var distance = ts - now;
                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        block.days.innerHTML = days;
                                        block.hours.innerHTML = hours;
                                        block.minutes.innerHTML = minutes;
                                        block.seconds.innerHTML = seconds;
                                    };

                                    render();
                                    return setInterval(render, 1000);
                                }
                                counterHeader('Nov 7, 2017 22:00:00 UTC+3')
                            </script>
                            <h4 class="big-title-size highlight-color big-margin-before">@lang('tokenstars-team.main_form.bonus1', [ 'bonus' => '+50%'])</h4>
                            <p class="sub-font-color">@lang('tokenstars-team.main_form.bonus1_text')</p>

                            @endif

                            <a href="#" class="btn btn-blue btn-big big-margin-before j-popup-trigger" data-target-popup=".j-stay-popup" onclick="ga('send', 'event', 'click', 'popup_Join', 'top');">@lang('tokenstars-team.main_form.subscribe')</a>
                            @if(false)
                            <div class="main-line--black big-margin-before "></div>
                            <a class="btn btn-highlight btn-big big-margin-before j-popup-trigger" data-target-popup=".j-bonus-popup" >@lang('tokenstars-team.main_form.crowdsale')</a>
                            @endif
                        </div> -->
                    </div>
                </div>
            </div>
        </section>

        <a href="https://tokenstars.com/charity" target="_blank" class="section-holder christmas-banner j-christmas-banner">
            <div class="wrap">
                <div class="christmas-close phone-only j-christmas-close">
                    <img src="/images/ace/tech-version/close-icon-red.png">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="christmas-banner-text">
                            <p class="big-font-size">@lang('tokenstars-messages.christmas.subtitle')</p>
                            <h3 class="big-title-size bold-font">@lang('tokenstars-messages.christmas.title')</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 huge-margin-before">
                        <div class="christmas-banner-images">
                            <img class="" src="/images/christmas/hingis.png"><img class="" src="/images/christmas/matthaus.png"><img class="" src="/images/christmas/redfoo.png"><img class="" src="/images/christmas/datsyuk.png"><img class="" src="/images/christmas/haas.png">
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <section class="section-holder">
            <div class="wrap">
                <div class="row">
                    <div class="col-lg-2 offset-lg-1 col-md-4 huge-margin-before">
                        <div class="main-feature">
                            <img class="main-feature__image" src="/images/team/main-features/1.png">
                            <p>@lang('tokenstars-team.features.feature1')</p>
                        </div>

                    </div>
                    <div class="col-lg-2 col-md-4 huge-margin-before">
                        <div class="main-feature">
                            <img class="main-feature__image" src="/images/team/main-features/2.png">
                            <p>@lang('tokenstars-team.features.feature2')</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 huge-margin-before">
                        <div class="main-feature">
                            <img class="main-feature__image" src="/images/team/main-features/3.png">
                            <p>@lang('tokenstars-team.features.feature3')</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 huge-margin-before">
                        <div class="main-feature">
                            <img class="main-feature__image" src="/images/team/main-features/4.png">
                            <p>@lang('tokenstars-team.features.feature4')</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 huge-margin-before">
                        <div class="main-feature">
                            <img class="main-feature__image" src="/images/team/main-features/5.png">
                            <p>@lang('tokenstars-team.features.feature5')</p>
                            <a href="https://medium.com/@TokenStars/https-medium-com-tokenstars-join-the-team-10-news-from-tokenstars-98464eb711ed" target="_blank" class="btn btn-small btn-blue-border medium-margin-before">@lang('tokenstars-team.features.btn')</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="banner-bg desktop-only">
            <div class="wrap">
                <div class="row roadmap-features-holder bold-font">
                    <div class="col-md-3 roadmap-feature">@lang('tokenstars-messages.roadmap.banner.item1')</div>
                    <div class="col-md-3 roadmap-feature">@lang('tokenstars-messages.roadmap.banner.item5')</div>
                    <div class="col-md-3 roadmap-feature">@lang('tokenstars-messages.roadmap.banner.item3')</div>
                    <div class="col-md-3 roadmap-feature">@lang('tokenstars-messages.roadmap.banner.item6')</div>
                </div>
            </div>
        </section>

        <section class="section-holder relative" id="ambassadors">
            <div class="ambassador-popup-holder hide">
                <div class="ambassador-popup">
                    <img src="/images/team/close-popup.png" alt="" class="popup-close j-close-amb-popup">

                    @php
                        $i = 0;
                        $stars = ['mattheus', 'haas', 'kucherov', 'zambrotta', 'myskina', 'karpin', 'torres', 'kurilova',
                        'pioline', 'soderling', 'anter', 'lingham', 'ver', 'fedorov', 'redfoo', 'datsyuk', 'hingis', 'boe'];
                    @endphp
                    @foreach($stars as $key => $star)
                        @php
                            $i += 1
                        @endphp
                        <div class="ambassador-card-popup hide" id="amb-{{$i}}">
                            <div class="ambassador-card__image medium-margin-before" style="background-image: url('/upload/images/amb-{{$star}}.jpg')"></div>
                            <div class="ambassador-card-popup-text">
                                <div class="small-font-size medium-margin-before medium-font">@lang('tokenstars-team.ambassadors.' . $star . '.title')</div>
                                <div class="big-font-size bold-font">@lang('tokenstars-team.ambassadors.' . $star . '.name')</div>
                                <div class="super-small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.' . $star . '.info')</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="wrap">
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="section-title section-title--labeled bold-font">@lang('tokenstars-team.ambassadors.title')</h2>
                        <p class="section-title-label section-title-label--small">@lang('tokenstars-team.ambassadors.title_label')</p>
                    </div>
                    <div class="col-md-5 align-right">
                        <div class="sub-font-color ambassador-learn-more">
                            <img src="/images/team/ambassador-info.png" alt="">@lang('tokenstars-team.ambassadors.details')</div>
                    </div>
                </div>

                <div class="align-center">

                    <div class="row row-eq-height">

                        @php
                        $i = 0;
                        $stars = ['mattheus', 'haas', 'kucherov', 'zambrotta', 'myskina', 'karpin', 'torres', 'kurilova',
                        'pioline', 'soderling', 'anter', 'lingham', 'ver', 'fedorov', 'redfoo', 'datsyuk', 'hingis', 'boe'];
                        @endphp
                        @foreach($stars as $key => $star)
                            @php
                                $i += 1
                            @endphp
                            <div class="col-md-3 col-xs-12">
                                <div class="ambassador-card" rel="amb-{{$i}}">
                                    <div class="ambassador-card__image medium-margin-before ambassador-hover" style="background-image: url('/upload/images/amb-{{$star}}.jpg')"></div>
                                    <div class="small-font-size small-margin-before medium-font">@lang('tokenstars-team.ambassadors.' . $star . '.title')</div>
                                    <div class="big-font-size bold-font">@lang('tokenstars-team.ambassadors.' . $star . '.name')</div>
                                    <div class="ambassador-phone-text super-small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.' . $star . '.info')</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder alt-bg-color" id="rico">
            <div class="wrap">
                <h2 class="section-title section-title--labeled bold-font">@lang('tokenstars-team.rico.title')</h2>
                <div class="sub-section-title bold-font medium-margin-before">@lang('tokenstars-team.rico.subtitle')</div>
                <ul class="lightSlider">
                    <li>
                        <img src="/images/team/rico/west.jpg" alt="Kaney West by Rico Torres" class="rico-images huge-margin-before">
                    </li>
                    <li>
                        <img src="/images/team/rico/usher.jpg" alt="Usher by Rico Torres" class="rico-images huge-margin-before">
                    </li>
                    <li>
                        <img src="/images/team/rico/sincity.jpg" alt="Sin City by Rico Torres" class="rico-images huge-margin-before">
                    </li>
                    <li>
                        <img src="/images/team/rico/brody.jpg" alt="Adrien Brody by Rico Torres" class="rico-images huge-margin-before">
                    </li>
                    <li>
                        <img src="/images/team/rico/gaga.jpg" alt="Lady Gaga by Rico Torres" class="rico-images huge-margin-before">
                    </li>
                    <li>
                        <img src="/images/team/rico/bryant.jpg" alt="Kobe Bryant by Rico Torres" class="rico-images huge-margin-before">
                    </li>
                    <li>
                        <img src="/images/team/rico/alba.jpg" alt="Lady Gaga by Jessica Alba Torres" class="rico-images huge-margin-before">
                    </li>
                    <li>
                        <img src="/images/team/rico/jagger.jpg" alt="Mick Jagger by Rico Torres" class="rico-images huge-margin-before">
                    </li>
                    <li>
                        <img src="/images/team/rico/garcia.jpg" alt="Andy Garcia by Rico Torres" class="rico-images huge-margin-before">
                    </li>
                </ul>
            </div>
        </section>

        <section class="section-holder alt-bg-color platform" id="platform">
            <div class="wrap">
                <div class="platform-holder">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="platform-star-holder">
                                <img class="platform-star" src="/images/team/star.png">
                                <h2 class="section-title bold-font">@lang('tokenstars-team.platform.title')</h2>
                                <p class="sub-title-size sub-font-color">@lang('tokenstars-team.platform.subtitle')</p>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="platform-tokens-block huge-margin-before">
                                <div class="platform-token j-platform-token" data-type="ace" data-status="@lang('tokenstars-team.platform.sold')">
                                    <b>ACE</b> <br />@lang('tokenstars-team.platform.token')
                                </div>
                                <div class="platform-token j-platform-token" data-type="team" data-status="@lang('tokenstars-team.platform.sold')">
                                    <b>TEAM</b> <br />@lang('tokenstars-team.platform.token')
                                </div>
                                <div class="platform-token-border">
                                <div class="platform-token j-platform-token" data-type="star" data-status="@lang('tokenstars-team.platform.soon')">
                                    <b>STAR</b> <br />@lang('tokenstars-team.platform.token')
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="platform-tabs-holder huge-margin-before">
                        <li><span class="selected j-platform-tab">@lang('tokenstars-team.platform.tabs.tab1')</span></li>
                        <li><span class="j-platform-tab">@lang('tokenstars-team.platform.tabs.tab2')</span></li>
                        <li><span class="j-platform-tab">@lang('tokenstars-team.platform.tabs.tab3')</span></li>
                        <li><span class="j-platform-tab">@lang('tokenstars-team.platform.tabs.tab4')</span></li>
                        <li><span class="j-platform-tab">@lang('tokenstars-team.platform.tabs.tab5')</span></li>
                    </ul>
                    <div class="platform-items-holder huge-margin-before">
                        <p class="platform-items-row-label bold-font big-margin-before">@lang('tokenstars-team.platform.section1')</p>
                        <div class="platform-items-row clearfix">
                            <a href="#module-1" class="platform-item platform-item--crowd j-platform-item">@lang('tokenstars-team.platform.items.item1')</a>
                            <a href="#module-2" class="platform-item platform-item--time j-platform-item">@lang('tokenstars-team.platform.items.item2')</a>
                            <a href="#module-3" class="platform-item platform-item--income j-platform-item">@lang('tokenstars-team.platform.items.item3')</a>
                        </div>
                        <p class="platform-items-row-label bold-font big-margin-before">@lang('tokenstars-team.platform.section2')</p>
                        <div class="platform-items-row clearfix">
                            <a href="#module-8" class="platform-item platform-item--search highlighted j-platform-item">@lang('tokenstars-team.platform.items.item4')</a>
                            <a href="#module-10" class="platform-item platform-item--vote highlighted j-platform-item">@lang('tokenstars-team.platform.items.item5')</a>
                            <a href="#module-11" class="platform-item platform-item--bet highlighted j-platform-item">@lang('tokenstars-team.platform.items.item6')</a>
                        </div>
                        <p class="platform-items-row-label bold-font big-margin-before">@lang('tokenstars-team.platform.section3')</p>
                        <div class="platform-items-row clearfix">
                            <a href="#module-7" class="platform-item platform-item--check highlighted j-platform-item">@lang('tokenstars-team.platform.items.item7')</a>
                            <a href="#module-4" class="platform-item platform-item--video j-platform-item">@lang('tokenstars-team.platform.items.item8')</a>
                            <a href="#module-6" class="platform-item platform-item--cup highlighted j-platform-item">@lang('tokenstars-team.platform.items.item9')</a>
                        </div>
                        <p class="platform-items-row-label bold-font big-margin-before">@lang('tokenstars-team.platform.section4')</p>
                        <div class="platform-items-row clearfix">
                            <a href="#module-5" class="platform-item platform-item--percent j-platform-item">@lang('tokenstars-team.platform.items.item10')</a>
                            <a href="#module-9" class="platform-item platform-item--promotion highlighted j-platform-item">@lang('tokenstars-team.platform.items.item11')</a>
                            <a href="#module-12" class="platform-item platform-item--merch j-platform-item">@lang('tokenstars-team.platform.items.item12')</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder">
            <div class="wrap">
                <h2 class="section-title bold-font align-center">@lang('tokenstars-team.platform_scheme')</h2>
                <img src="/images/team/@lang('tokenstars-team.platform_image')" alt="TokenStars Platform Scheme" class="platform-scheme">
            </div>
        </section>

        <section class="section-holder alt-bg-color platform-description-toggle">
            <div class="wrap align-center">
                <span class="btn btn-highlight btn-big j-platfrom-full-description-toggle" onclick="ga('send', 'event', 'plt_dsc', 'details', '');">@lang('tokenstars-team.platform.show_btn')</span>
            </div>
        </section>

        <!-- Token and platform descriptions -->
        <div class="hide platform-description-holder">
            <section class="section-holder section-holder--border-top tokens" id="tokens">
                <div class="wrap">
                    <h2 class="section-title section-title--labeled bold-font">@lang('tokenstars-team.token.title')</h2>
                    <p class="section-title-label section-title-label--small">@lang('tokenstars-team.token.title_label')</p>
                    <div class="tokens-block huge-margin-before">
                        <div class="row row-no-padding">
                            <div class="col-md-6">
                                <div class="tokens-block-item tokens-block-item__left-side">
                                    <div class="tokens-ace-circle bold-font">ACE</div>
                                    <img class="tokens-block__image" src="/images/verticals/team-white.png">
                                    <h3 class="big-title-size bold-font big-margin-before">TEAM</h3>
                                    <p class="sub-title-size medium-margin-before">@lang('tokenstars-team.token.team_info')</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tokens-block-item">
                                    <img class="tokens-block__image" src="/images/verticals/star-dark.png">
                                    <h3 class="big-title-size bold-font big-margin-before">STAR</h3>
                                    <p class="sub-title-size medium-margin-before">@lang('tokenstars-team.token.star_info')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="module-section section-holder alt-bg-color big-margin-before" id="modules">
                <div class="module-scroll-holder j-modules-scroll">
                    <img src="/images/team/scroll-arrow.png" > @lang('tokenstars-team.modules.scroll')
                </div>
                <div class="wrap">
                    <div class="row module-1" id="module-1">
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_1.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_1.text1')</p>
                            <p class="medium-margin-before">@lang('tokenstars-team.modules.module_1.text2')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_1.info')</p>
                        </div>
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/@lang('tokenstars-team.modules.module_1.image')" alt="TokenStars Team Module" class="module-image">
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-2" id="module-2">
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/@lang('tokenstars-team.modules.module_2.image')" alt="TokenStars Team Module" class="module-image">
                        </div>
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_2.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_2.text1')</p>
                            <p class="medium-margin-before">@lang('tokenstars-team.modules.module_2.text2')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_2.info')</p>
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-3" id="module-3">
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_3.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_3.text1')</p>
                            <p class="medium-margin-before">@lang('tokenstars-team.modules.module_3.text2')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_3.info')</p>
                        </div>
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/@lang('tokenstars-team.modules.module_3.image')" alt="TokenStars Team Module" class="module-image">
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-8"  id="module-8">
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/8.png" alt="TokenStars Team Module" class="module-image">
                        </div>
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_8.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_8.text1')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_8.info')</p>
                        </div>
                    </div>


                    <div class="row module-block huge-margin-before module-10" id="module-10">
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_10.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_10.text1')</p>
                            <p class="medium-margin-before">@lang('tokenstars-team.modules.module_10.text2')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_10.info')</p>
                        </div>
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/10.png" alt="TokenStars Team Module" class="module-image">
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-11" id="module-11">
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/11.png" alt="TokenStars Team Module" class="module-image">
                        </div>
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_11.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_11.text1')</p>
                            <p class="medium-margin-before">@lang('tokenstars-team.modules.module_11.text2')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_11.info')</p>
                        </div>
                    </div>


                    <div class="row module-block huge-margin-before module-7" id="module-7">
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_7.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_7.text1')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_7.info')</p>
                        </div>
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/@lang('tokenstars-team.modules.module_7.image')" alt="TokenStars Team Module" class="module-image">
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-4" id="module-4">
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/4.png" alt="TokenStars Team Module" class="module-image">
                        </div>
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_4.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_4.text1')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_4.info')</p>
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-6" id="module-6">
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_6.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_6.text1')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_6.info')</p>
                        </div>
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/@lang('tokenstars-team.modules.module_6.image')" alt="TokenStars Team Module" class="module-image">
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-5" id="module-5">
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/@lang('tokenstars-team.modules.module_5.image')" alt="TokenStars Team Module" class="module-image">
                        </div>
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_5.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_5.text1')</p>
                            <ul class="medium-margin-before vision-list">
                                <li>@lang('tokenstars-team.modules.module_5.list.item1')</li>
                                <li>@lang('tokenstars-team.modules.module_5.list.item2')</li>
                                <li>@lang('tokenstars-team.modules.module_5.list.item3')</li>
                            </ul>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_5.info')</p>
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-9" id="module-9">
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_9.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_9.text1')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_9.info')</p>
                        </div>
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/@lang('tokenstars-team.modules.module_9.image')" alt="TokenStars Team Module" class="module-image">
                        </div>
                    </div>
                    <div class="row module-block huge-margin-before module-12" id="module-12">
                        <div class="col-md-6 align-center">
                            <img src="/images/team/modules/12.png" alt="TokenStars Team Module" class="module-image">
                        </div>
                        <div class="col-md-6">
                            <h2 class="section-title bold-font">@lang('tokenstars-team.modules.module_12.name')</h2>
                            <p class="big-margin-before">@lang('tokenstars-team.modules.module_12.text1')</p>
                            <p class="huge-margin-before  highlight-color big-font-size bold-font">@lang('tokenstars-team.modules.module_12.info')</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="section-holder" id="allocation">
            <div class="wrap">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <h2 class="section-title bold-font">@lang('tokenstars-messages.allocation.title_token')</h2>
                        <div class="row big-margin-before">
                            <div class="col-lg-12 col-md-6">
                                <img src="/images/team/@lang('tokenstars-team.allocation.token_image').jpg" class="distribution__image huge-margin-before">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <h2 class="section-title bold-font">@lang('tokenstars-team.allocation.title_parameters')</h2>
                        <div class="row big-margin-before">
                            <div class="col-lg-12 col-md-6">
                                <img src="/images/team/@lang('tokenstars-team.allocation.image').jpg" alt="@lang('tokenstars-team.allocation.title_parameters')" class="distribution__image huge-margin-before">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder smart-team alt-bg-color">
            <div class="wrap">
                <h2 class="section-title bold-font align-center">@lang('tokenstars-messages.smart.title')</h2>
                <div class="huge-margin-before">
                    <script src="https://gist.github.com/anonymous/c9e41f62c49266ba1724c471021f5200.js"></script>
                </div>
                <div class="align-center huge-margin-before">
                    <a href="https://github.com/tokenstars/team-token" target="_blank" class="btn btn-regular btn-highlight" onclick="ga('send', 'event', 'click_github', 'github');">@lang('tokenstars-messages.smart.btn')</a>
                </div>
            </div>
        </section>

        <section class="section-holder alt-bg-color" id="roadmap">
            <div class="wrap">
                <h2 class="section-title bold-font">@lang('tokenstars-messages.roadmap.title')</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="roadmap-holder huge-margin-before">
                            <div class="roadmap-top-row">
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team1.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team1.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team3.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team3.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team5.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team5.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team7.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team7.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team9.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team9.text')</p>
                                </div>
                            </div>
                            <div class="roadmap-bottom-row">
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team2.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team2.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team4.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team4.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team6.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team6.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team8.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team8.text')</p>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-roadmap-holder huge-margin-before phone-only">
                            <div class="roadmap-top-row">
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team1.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team1.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team2.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team2.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team3.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team3.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team4.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team4.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team5.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team5.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team6.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team6.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team7.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team7.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team8.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team8.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date_team9.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date_team9.text')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="roadmap-hor-splitter huge-margin-before"></div>
                <div class="row roadmap-graph-splitter">
                    <div class="col-md-5">
                        <h3 class="sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.roadmap.signed')
                        <br /> <span class="sub-font-color big-font-size">@lang('tokenstars-messages.roadmap.planned')</span></h3>
                        <img src="/images/team/roadmap/@lang('tokenstars-team.roadmap.stars_graph_image').png" alt="" class="roadmap-graph big-margin-before">
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <h3 class="sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.roadmap.revenue')
                            <br /> <span class="sub-font-color big-font-size">@lang('tokenstars-messages.roadmap.estimated')</span></h3>
                            <img src="/images/team/roadmap/@lang('tokenstars-team.roadmap.revenue_graph_image').png" alt="" class="roadmap-graph big-margin-before">
                    </div>
                </div>
            </div>
        </section>


        <section class="section-holder team-holder" id="team">
            <div class="wrap">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="section-title bold-font">@lang('tokenstars-messages.team.title')</h2>
                        <p class="big-margin-before">@lang('tokenstars-messages.team.text')</p>
                    </div>
                    <div class="col-md-6">
                        <img src="/images/ace/tech-version/team-logos.jpg" alt="" class="team-logos">
                    </div>
                </div>
                <div class="row huge-margin-before">
                    <div class="col-md-4 small-margin-before">
                        <div class="team-feature">
                            <img src="/images/ace/tech-version/team-feature-1.png" alt="" class="team-feature-image">
                            @lang('tokenstars-messages.team.features.feature1')
                        </div>
                    </div>
                    <div class="col-md-4 small-margin-before">
                        <div class="team-feature">
                            <img src="/images/ace/tech-version/team-feature-2.png" alt="" class="team-feature-image">
                            @lang('tokenstars-messages.team.features.feature2')
                        </div>
                    </div>
                    <div class="col-md-4 small-margin-before">
                        <div class="team-feature">
                            <img src="/images/ace/tech-version/team-feature-3.png" alt="" class="team-feature-image">
                            @lang('tokenstars-messages.team.features.feature3')
                        </div>
                    </div>
                </div>
                <div class="row team-holder team-mob-limit team-holder--light closed j-team-mob huge-margin-before">
                    <h3 class="col-lg-12 sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.team.roles.blockchain_n_business')</h3>
                    @php
                        $team2 = ['kampers', "kaal", "danilov", "sato", 'chabanenko', 'stratilatov', 'kuznetsov', 'zanko', 'krivochurov'];
                    @endphp
                    @foreach($team2 as $name)
                    <div class="col-md-4 col-lg-4 col-xl-3 team-item-mob">
                        <div class="team-card">
                            <div class="team-photo-holder" style="background-image: url('/upload/images/{{ $name }}.jpg')"></div>
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.fb')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.fb')" target="_blank"><img src="/images/ace/tech-version/fb.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.in')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.in')" target="_blank"><img src="/images/ace/tech-version/in.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.ig')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.ig')" target="_blank"><img src="/images/ace/tech-version/ig.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.url')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.url')" target="_blank"><img src="/images/ace/tech-version/url.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.tw')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.tw')" target="_blank"><img src="/images/ace/tech-version/tw.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.me')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.me')" target="_blank"><img src="/images/ace/tech-version/me.png" alt="" class="team-social-link"></a>
                            @endif
                            <div class="medium-font">@lang('tokenstars-messages.team.members.' . $name . '.name')&nbsp;</div>
                            <div class="small-font-size sub-font-color">@lang('tokenstars-messages.team.members.' . $name . '.title')&nbsp;</div>
                            <div class="team-description super-small-font-size">@lang('tokenstars-messages.team.members.' . $name . '.text')</div>
                        </div>
                    </div>
                    @endforeach
                    <div class="medium-margin-before align-center">
                        <a href="" class="btn btn-small btn-blue-border team-mob-show-btn j-mob-show-team">@lang('tokenstars-messages.team.mob_btn')</a>
                    </div>
                </div>
                <div class="row team-mob-limit closed medium-margin-before j-team-mob">
                    <h3 class="col-lg-12 sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.team.roles.team')</h3>
                    @php
                        $team1 = ['stukolov', 'potapov', 'zak', 'krivochurov', 'mintz', 'shashkina'];
                    @endphp
                    @foreach($team1 as $name)
                    <div class="col-md-4 col-lg-4 col-xl-3 team-item-mob">
                        <div class="team-card">
                            <div class="team-photo-holder" style="background-image: url('/upload/images/{{ $name }}.jpg')"></div>
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.fb')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.fb')" target="_blank"><img src="/images/ace/tech-version/fb.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.in')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.in')" target="_blank"><img src="/images/ace/tech-version/in.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.ig')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.ig')" target="_blank"><img src="/images/ace/tech-version/ig.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.url')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.url')" target="_blank"><img src="/images/ace/tech-version/url.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.tw')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.tw')" target="_blank"><img src="/images/ace/tech-version/tw.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.me')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.me')" target="_blank"><img src="/images/ace/tech-version/me.png" alt="" class="team-social-link"></a>
                            @endif
                            <div class="medium-font">@lang('tokenstars-messages.team.members.' . $name . '.name')&nbsp;</div>
                            <div class="small-font-size sub-font-color">@lang('tokenstars-messages.team.members.' . $name . '.title')&nbsp;</div>
                            <div class="team-description super-small-font-size">@lang('tokenstars-messages.team.members.' . $name . '.text')</div>
                        </div>
                    </div>
                    @endforeach
                    <div class="medium-margin-before align-center">
                        <a href="" class="btn btn-small btn-blue-border team-mob-show-btn j-mob-show-team">@lang('tokenstars-messages.team.mob_btn')</a>
                    </div>
                </div>

                <div class="row team-mob-limit closed j-team-mob">
                    <h3 class="col-lg-12 sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.team.roles.investors')</h3>
                    @php
                        $team3 = ['masolova', 'shpakovsky', 'tokenfund', 'rusakov', 'nomadic'];
                    @endphp
                    @foreach($team3 as $name)
                    <div class="col-md-4 col-lg-4 col-xl-3 team-item-mob">
                        <div class="team-card">
                            <div class="team-photo-holder" style="background-image: url('/upload/images/{{ $name }}.jpg')"></div>
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.fb')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.fb')" target="_blank"><img src="/images/ace/tech-version/fb.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.in')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.in')" target="_blank"><img src="/images/ace/tech-version/in.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.ig')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.ig')" target="_blank"><img src="/images/ace/tech-version/ig.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.url')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.url')" target="_blank"><img src="/images/ace/tech-version/url.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.tw')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.tw')" target="_blank"><img src="/images/ace/tech-version/tw.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.me')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.me')" target="_blank"><img src="/images/ace/tech-version/me.png" alt="" class="team-social-link"></a>
                            @endif
                            <div class="medium-font">@lang('tokenstars-messages.team.members.' . $name . '.name')&nbsp;</div>
                            <div class="small-font-size sub-font-color">@lang('tokenstars-messages.team.members.' . $name . '.title')&nbsp;</div>
                            <div class="team-description super-small-font-size">@lang('tokenstars-messages.team.members.' . $name . '.text')</div>
                        </div>
                    </div>
                    @endforeach
                    <div class="medium-margin-before align-center">
                        <a href="" class="btn btn-small btn-blue-border team-mob-show-btn j-mob-show-team">@lang('tokenstars-messages.team.mob_btn')</a>
                    </div>
                </div>

                <div class="row">
                    <h3 class="col-md-8 col-lg-8 col-xl-6 sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.team.roles.players')</h3>
                    <h3 class="col-md-4 col-lg-4 col-xl-6 sub-section-title bold-font huge-margin-before desktop-only">@lang('tokenstars-messages.team.roles.sports')</h3>
                    @php
                        $team4 = ['kudermetova', 'makarova'];
                    @endphp
                    @foreach($team4 as $name)
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="team-card">
                            <div class="team-photo-holder" style="background-image: url('/upload/images/{{ $name }}.jpg')"></div>
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.fb')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.fb')" target="_blank"><img src="/images/ace/tech-version/fb.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.in')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.in')" target="_blank"><img src="/images/ace/tech-version/in.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.ig')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.ig')" target="_blank"><img src="/images/ace/tech-version/ig.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.url')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.url')" target="_blank"><img src="/images/ace/tech-version/url.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.tw')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.tw')" target="_blank"><img src="/images/ace/tech-version/tw.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.me')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.me')" target="_blank"><img src="/images/ace/tech-version/me.png" alt="" class="team-social-link"></a>
                            @endif
                            <div class="medium-font">@lang('tokenstars-messages.team.members.' . $name . '.name')&nbsp;</div>
                            <div class="small-font-size sub-font-color">@lang('tokenstars-messages.team.members.' . $name . '.title')&nbsp;</div>
                            <div class="team-description super-small-font-size">@lang('tokenstars-messages.team.members.' . $name . '.text')</div>
                        </div>
                    </div>
                    @endforeach
                    <h3 class="col-md-12 sub-section-title bold-font huge-margin-before phone-only">@lang('tokenstars-messages.team.roles.tennis')</h3>
                    @php
                        $team4 = ['antunes', 'demekhine', 'sergeev'];
                    @endphp
                    @foreach($team4 as $name)
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="team-card">
                            <div class="team-photo-holder" style="background-image: url('/upload/images/{{ $name }}.jpg')"></div>

                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.fb')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.fb')" target="_blank"><img src="/images/ace/tech-version/fb.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.in')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.in')" target="_blank"><img src="/images/ace/tech-version/in.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.ig')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.ig')" target="_blank"><img src="/images/ace/tech-version/ig.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.url')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.url')" target="_blank"><img src="/images/ace/tech-version/url.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.tw')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.tw')" target="_blank"><img src="/images/ace/tech-version/tw.png" alt="" class="team-social-link"></a>
                            @endif
                            @if(!empty(trans('tokenstars-messages.team.members.' . $name . '.social.me')))
                                <a href="@lang('tokenstars-messages.team.members.' . $name . '.social.me')" target="_blank"><img src="/images/ace/tech-version/me.png" alt="" class="team-social-link"></a>
                            @endif
                            <div class="medium-font">@lang('tokenstars-messages.team.members.' . $name . '.name')&nbsp;</div>
                            <div class="small-font-size sub-font-color">@lang('tokenstars-messages.team.members.' . $name . '.title')&nbsp;</div>
                            <div class="team-description super-small-font-size">@lang('tokenstars-messages.team.members.' . $name . '.text')</div>
                        </div>
                    </div>
                    @endforeach
                    <div class="medium-margin-before align-center">
                        <a href="" class="btn btn-small btn-blue-border team-mob-show-btn j-mob-show-team">@lang('tokenstars-messages.team.mob_btn')</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder banner-bg partners-holder">
            <div class="wrap align-center">
                <h2 class="section-title title-size bold-font highlight-color">@lang('tokenstars-messages.partners.title')</h2>
                <img src="/images/team/partners/all.png" alt="TokenStars Partners" class="medium-margin-before partners-logos">
            </div>
        </section>

        <section class="section-holder" id="press">
            <div class="wrap press-holder">
                <h2 class="section-title bold-font">@lang('tokenstars-messages.press.title')</h2>

                <ul class="lightSliderPress">
                    <li>
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/cointelegraph.png" alt="cointelegraph" class="press-logo">
                            @lang('tokenstars-messages.press.text4')</div>
                    </li>
                    <li>
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/forbes.png" alt="forbes" class="press-logo">
                            @lang('tokenstars-messages.press.text1')</div>
                    </li>
                    <li>
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/bitcoincom.png" alt="bitcoin.com" class="press-logo">
                            @lang('tokenstars-messages.press.text5')</div>
                    </li>
                    <li>
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/inc.png" alt="inc" class="press-logo">
                            @lang('tokenstars-messages.press.text6')</div>
                    </li>
                    <li>
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/huffpost.png" alt="huffpost" class="press-logo">
                            @lang('tokenstars-messages.press.text2')</div>
                    </li>
                    <li>
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/themerkle.png" alt="huffpost" class="press-logo">
                            @lang('tokenstars-messages.press.text7')</div>
                    </li>
                </ul>
                <div class="press-logos-holder align-center">
                    @include('tokenstars.partial.press')
                </div>
            </div>
        </section>

        <section class="section-holder">
            <div class="wrap">
                <h2 class="section-title bold-font">@lang('tokenstars-team.events.title')</h2>

                <div class="events-holder alt-bg-color">
                    <div class="row row-eq-height align-center">
                        <div class="col-md-4 event-section">
                            <p class="event-subtitle">@lang('tokenstars-team.events.europe')</p>
                            <div class="row big-margin-before">
                                <div class="col-md-6 col-xs-4">
                                    <a href="https://www.blockchainweek.com/home" target="_blank"><img src="/images/team/events/blockchainweek.png" alt="Blockchainweek" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="http://ru.genesismoscow.com/" target="_blank"><img src="/images/team/events/genesis-moscow.png" alt="Genesis Moscow" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="http://d10e.biz/kyiv-2017/" target="_blank"><img src="/images/team/events/d10e-kiev.png" alt="d10e Kiev" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="http://cryptospace.moscow/" target="_blank"><img src="/images/team/events/crypto-space.png" alt="Crypto Space" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="https://www.dagvandecrypto.nl/english/" target="_blank"><img src="/images/team/events/dagvandecrypto.png" alt="Dag van de crypto" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="http://ditelegraph.com/events/674" target="_blank"><img src="/images/team/events/moscow-meetup.png" alt="Moscow Meetup" class="event-logo"></a>
                                </div>
                                <div class="offset-md-3 col-md-6 offset-xs-4 col-xs-4">
                                    <a href="https://www.crypto-finance-conference.com/en/#" target="_blank"><img src="/images/team/events/cfc.png" alt="CFC" class="event-logo"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 event-section">
                            <p class="event-subtitle">@lang('tokenstars-team.events.america')</p>
                            <div class="row big-margin-before">
                                <div class="offset-md-2 col-md-8 col-xs-4">
                                    <a href="https://www.coindesk.com/events/invest-2017/" target="_blank"><img src="/images/team/events/c-invest.png" alt="C invest" class="event-logo"></a>
                                </div>
                                <div class="offset-md-2 col-md-8 col-xs-4">
                                    <a href="https://blockchain-expo.com/northamerica/" target="_blank"><img src="/images/team/events/blockchain-expo.png" alt="Blockchainexpo" class="event-logo"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 event-section">
                            <p class="event-subtitle">@lang('tokenstars-team.events.asia')</p>
                            <div class="row big-margin-before">
                                <div class="col-md-6 col-xs-4">
                                    <a href="http://bef.latoken.com/" target="_blank"><img src="/images/team/events/bef.png" alt="BEF" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="https://blockshowasia.com" target="_blank"><img src="/images/team/events/block-show.png" alt="Block Show Asia 2018" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="https://dibs.ae/" target="_blank"><img src="/images/team/events/dubai.png" alt="Dubai International Blockchain Summit" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="http://www.hongkong-fintech.hk/en/events/finovate-asia-2017.html" target="_blank"><img src="/images/team/events/finovate.png" alt="Finovate Asia 2017" class="event-logo"></a>
                                </div>
                                <div class="col-md-6 col-xs-4">
                                    <a href="http://www.ibdac.com.cn/en/" target="_blank"><img src="/images/team/events/ibdac.png" alt="Asia Blockchain Application Congress" class="event-logo"></a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder alt-bg-color">
            <div class="wrap">
                <div class="row">
                    <div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1">
                        <div class="main-form bold-font">
                            <h3 class="main-form__title">@lang('tokenstars-team.main_form.over')</h3>

                            <div class="main-progress-bar">
                                <span class="main-progress-bar__sale" style="width: {{$stats_data['team_distributed']}}%">10&nbsp;037&nbsp;039 @lang('tokenstars-messages.main.progress.distributed')</span>
                            </div>

                            <div class="big-margin-before main-line--black"></div>
                            <a href="https://teamtoken.tokenstars.com/users/sign_in{{$contribute_url}}" class="btn btn-blue btn-big big-margin-before">@lang('tokenstars-team.main_form.kyc')</a>

                            <br />
                            <a href="https://tokenstars.com/upload/files/how_to_add_TEAM_tokens.pdf" target="_blank" class="btn btn-blue-border btn-small big-margin-before">@lang('tokenstars-team.main_form.how_to')</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if($lang == 'zh')
        <section class="section-holder qr-section align-center">
            <div class="wrap">
                <h2 class="section-title bold-font">TokenStars 粉丝组</h2>
                <div class="huge-margin-before">
                    <div class="row">
                        <div class="col-lg-4 offset-lg-4">
                            <img class="qr__image" src="/images/ace/qr-zh-3.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
@endsection
