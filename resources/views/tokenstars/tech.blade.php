@extends('tokenstars.layouts.layout')

@php
    $lang = app('translator')->getLocale()
@endphp

@section('content')

        <div class="popup-container j-popup j-video-popup">
            <div class="popup-holder popup-holder-video j-popup-holder">
                <div class="popup-hide-btn j-hide-popup">
                    <img src="/images/ace/tech-version/close-icon.png">
                </div>
                <div class="popup-holder-video-container">
                    <iframe class="j-youtube-video" width="560" height="315" src="https://www.youtube.com/embed/t0ZaxGaUFTQ?enablejsapi=1&version=3" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="popup-container j-popup j-subscribe-popup">
            <div class="popup-holder popup-holder--default j-popup-holder">
                <div class="popup-hide-btn j-hide-popup">
                    <img src="/images/ace/tech-version/close-icon-red.png">
                </div>
                <form class="bold-font j-top-form" target="_blank" onsubmit="ga('send', 'event', 'email-add', 'notify-ok', 'updates');">
                    <input type="email" name="EMAIL" id="mce-EMAIL" class="text-input main-form__input medium-font" placeholder="E-mail">
                    <input type="hidden" name="LANGUAGE" value="{{ $lang }}">
                    <input type="hidden" name="SOURCE" value="ace">
                    <div class="big-margin-before j-top-response"></div>
                    <input type="submit" id="mc-embedded-subscribe" class="btn btn-blue btn-big big-margin-before" value="@lang('tokenstars-team.main_form.subscribe')">
                </form>
            </div>
        </div>

        <section class="section-holder main">
            <div class="wrap">
                <div class="row row-eq-height">
                    <div class="col-lg-6 col-md-12">
                        <div class="bold-font">
                            <div class="main-left-side"></div>
                            <h1 class="main-title">@lang('tokenstars-messages.main.title')</h1>

                            <div class="main-line--white huge-margin-before"></div>
                            <h2 class="main-subtitle title-size big-margin-before">@lang('tokenstars-messages.main.title_success')</h2>
                            <a href="https://medium.com/@TokenStars/https-medium-com-tokenstars-join-the-team-10-news-from-tokenstars-98464eb711ed" target="_blank" class="btn btn-highlight-border btn-big huge-margin-before" onclick="ga('send', 'event', 'click', 'learn_more', 'read_story');"><img class="main-btn-icon" title="Medium" alt="Medium" src="/images/ace/medium-highlight.png" /> @lang('tokenstars-messages.main.read_btn')</a>
                            &nbsp;
                            <a href="/upload/files/how_to_add_ACE_tokens.pdf" target="_blank" class="btn huge-margin-before btn-highlight" onclick="">@lang('tokenstars-messages.main.instruction_btn')</a>

                            <div class="huge-margin-before main-line--white"></div>
                            <h3 class="huge-margin-before bold-font">@lang('tokenstars-messages.main.subtitle')</h3>
                            <p class="medium-margin-before medium-font">@lang('tokenstars-messages.main.text')</p>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 col-md-12">
                        <div class="main-form">
                            <h3 class="main-form__title bold-font">@lang('tokenstars-messages.team_form.title')</h3>
                            <p class="sub-font-color big-font-size bold-font small-margin-before">@lang('tokenstars-messages.team_form.subtitle')</p>


                            <div class="big-margin-before main-line--black"></div>

                            <p class="big-font-size medium-font big-margin-before">@lang('tokenstars-messages.team_form.text1')</p>
                            <a href="https://www.tokenstars.com/team" target="_blank" class="btn btn-blue btn-big big-margin-before" onclick="ga('send', 'event', 'click', 'learn_more', 'go_team');">@lang('tokenstars-messages.team_form.learn_more')</a>

                            <div class="big-margin-before main-line--black"></div>

                            <p class="big-font-size sub-font-color medium-font big-margin-before">@lang('tokenstars-messages.team_form.text2')</p>
                            <a href="#" class="btn btn-highlight btn-regular big-margin-before j-popup-trigger" data-target-popup=".j-subscribe-popup">@lang('tokenstars-messages.team_form.get_updates')</a>
                        </div>
                        <div class="huge-margin-before align-center">
                            <a href="https://t.me/TokenStars{{ $lang == 'ru' ? '_ru' : ($lang == 'jp'? 'Japan' : '_en') }}" target="_blank" class="main-social-item" onclick="ga('send', 'event', 'click', 'telegram', 'top');"><img title="Telegram" alt="Telegram" src="/images/ace/tech-version/telegram-white.png" /> Telegram</a>
                            <a href="{{ $lang == 'ru' ? 'https://bitcointalk.org/index.php?topic=2045165.0' : 'https://bitcointalk.org/index.php?topic=2043613.0' }}" target="_blank" class="main-social-item"><img title="BitCoinTalk" alt="BitCoinTalk" src="/images/ace/tech-version/bitcointalk-white.png" /> BitCoinTalk</a>
                        </div>
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

        <section class="section-holder vision" id="vision">
            <div class="wrap">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="section-title bold-font">@lang('tokenstars-messages.vision.title')</h2>
                        <p class="big-margin-before">@lang('tokenstars-messages.vision.text')</p>
                    </div>
                </div>
                <div class="vision-grey-banner huge-margin-before">
                    <div class="row  auto-clear">
                        <div class="col-lg-3 col-md-6 huge-margin-before">
                            <p class="team-feature">
                                <img src="/images/ace/tech-version/vision-feature-1.png" alt="" class="team-feature-image">
                                @lang('tokenstars-messages.vision.feature1')
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 huge-margin-before">
                            <p class="team-feature">
                                <img src="/images/ace/tech-version/vision-feature-2.png" alt="" class="team-feature-image">
                                @lang('tokenstars-messages.vision.feature2')
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 huge-margin-before">
                            <p class="team-feature">
                                <img src="/images/ace/tech-version/vision-feature-3.png" alt="" class="team-feature-image">
                                @lang('tokenstars-messages.vision.feature3')
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 huge-margin-before">
                            <p class="team-feature">
                                <img src="/images/ace/tech-version/vision-feature-4.png" alt="" class="team-feature-image">
                                @lang('tokenstars-messages.vision.feature4')
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 huge-margin-before">
                            <p class="team-feature">
                                <img src="/images/ace/tech-version/vision-feature-5.png" alt="" class="team-feature-image">
                                @lang('tokenstars-messages.vision.feature5')
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 huge-margin-before">
                            <p class="team-feature">
                                <img src="/images/ace/tech-version/vision-feature-6.png" alt="" class="team-feature-image">
                                @lang('tokenstars-messages.vision.feature6')
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 huge-margin-before">
                            <p class="team-feature">
                                <img src="/images/ace/tech-version/vision-feature-7.png" alt="" class="team-feature-image">
                                @lang('tokenstars-messages.vision.feature7')
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 huge-margin-before">
                            <p class="team-feature">
                                <img src="/images/ace/tech-version/vision-feature-8.png" alt="" class="team-feature-image">
                                @lang('tokenstars-messages.vision.feature8')
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder why alt-bg-color" id="why">
            <div class="why-bg"></div>
            <div class="wrap">
                <h2 class="section-title bold-font">@lang('tokenstars-messages.why.title')</h2>
                <div class="row auto-clear">
                    <div class="col-lg-4 col-md-6 huge-margin-before">
                        <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature1.title')</h3>
                        <p class="medium-margin-before">@lang('tokenstars-messages.why.feature1.text')</p>
                    </div>
                    <div class="col-lg-4 col-md-6 huge-margin-before">
                        <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature2.title')</h3>
                        <p class="medium-margin-before">@lang('tokenstars-messages.why.feature2.text')</p>
                    </div>
                    <div class="col-lg-4 col-md-6 huge-margin-before">
                        <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature3.title')</h3>
                        <p class="medium-margin-before">@lang('tokenstars-messages.why.feature3.text')</p>
                    </div>
                    <div class="col-lg-4 col-md-6 huge-margin-before">
                        <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature4.title')</h3>
                        <p class="medium-margin-before">@lang('tokenstars-messages.why.feature4.text')</p>
                    </div>
                    <div class="col-lg-4 col-md-6 huge-margin-before">
                        <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature5.title')</h3>
                        <p class="medium-margin-before">@lang('tokenstars-messages.why.feature5.text')</p>
                    </div>
                    <div class="col-lg-4 col-md-6 huge-margin-before">
                        <h3 class="big-font-size bold-font">@lang('tokenstars-messages.why.feature6.title')</h3>
                        <p class="medium-margin-before">@lang('tokenstars-messages.why.feature6.text')</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder smart alt-bg-color">
            <div class="wrap">
                <h2 class="section-title bold-font">@lang('tokenstars-messages.smart.title')</h2>
                <div class="huge-margin-before">
                    <script src="https://gist.github.com/tokenstars/466210371e17688642bc72b1aa1f1ddb.js"></script>
                </div>
                <div class="align-center huge-margin-before">
                    <a href="https://github.com/token-stars/ace-token" target="_blank" class="btn btn-regular btn-highlight" onclick="ga('send', 'event', 'click_github', 'github');">@lang('tokenstars-messages.smart.btn')</a>
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
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date1.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date1.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date2.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date2.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date3.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date3.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date4.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date4.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date5.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date5.text')</p>
                                </div>
                            </div>
                            <div class="roadmap-bottom-row">
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date6.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date6.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date7.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date7.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date8.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date8.text')</p>
                                </div><div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date9.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date9.text')</p>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-roadmap-holder huge-margin-before phone-only">
                            <div class="roadmap-top-row">
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date1.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date1.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date2.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date2.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date3.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date3.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date4.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date4.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date5.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date5.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date6.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date6.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date7.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date7.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date8.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date8.text')</p>
                                </div>
                                <div class="roadmap-point">
                                    <div class="bold-font highlight-color">@lang('tokenstars-messages.roadmap.date9.date')</div>
                                    <p class="small-font-size">@lang('tokenstars-messages.roadmap.date9.text')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row roadmap-features-holder bold-font huge-margin-before">
                    <div class="col-md-3 roadmap-feature">@lang('tokenstars-messages.roadmap.banner.item1')</div>
                    <div class="col-md-3 roadmap-feature">@lang('tokenstars-messages.roadmap.banner.item2')</div>
                    <div class="col-md-3 roadmap-feature">@lang('tokenstars-messages.roadmap.banner.item3')</div>
                    <div class="col-md-3 roadmap-feature">@lang('tokenstars-messages.roadmap.banner.item4')</div>
                </div>
            </div>
        </section>


        <section class="section-holder" id="team">
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
                <div class="row team-holder team-mob-limit closed huge-margin-before j-team-mob">
                    <h3 class="col-lg-12 sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.team.roles.team')</h3>
                    @php
                        $team1 = ['stukolov', 'potapov', 'zak', 'krivochurov', 'mintz', 'shashkina'];
                    @endphp
                    @foreach($team1 as $name)
                    <div class="col-md-4 col-lg-4 col-xl-3 team-item-mob">
                        <div class="team-card">
                            <div class="team-photo-holder" style="background-image: url('https://tokenstars.com/upload/images/{{ $name }}.jpg')"></div>
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
                    <h3 class="col-lg-12 sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.team.roles.business')</h3>
                    @php
                        $team2 = ['chabanenko', 'stratilatov', 'kuznetsov'];
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

                <div class="row team-mob-limit closed j-team-mob">
                    <h3 class="col-lg-12 sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.team.roles.investors')</h3>
                    @php
                        $team3 = ['masolova', 'shpakovsky', 'tokenfund'];
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
                    <h3 class="col-md-4 col-lg-4 col-xl-3 sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.team.roles.signed_stars')</h3>
                    <h3 class="col-md-8 col-lg-8 col-xl-9 sub-section-title bold-font huge-margin-before desktop-only">@lang('tokenstars-messages.team.roles.tennis')</h3>
                    @php
                        $team4 = ['kudermetova'];
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
                        $team4 = ['myskina', 'demekhine', 'kurilova'];
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

        <section class="section-holder alt-bg-color" id="ecosystem">
            <div class="wrap">
                <h2 class="section-title bold-font">@lang('tokenstars-messages.ecosystem.title')</h2>
                <div class="row">
                    <div class="col-md-6">
                        <img src="/images/ace/tech-version/scheme-1.png" alt="" class="eco-header-img huge-margin-before">
                    </div>
                    <div class="col-md-6">
                        <p class="big-font-size huge-margin-before">@lang('tokenstars-messages.ecosystem.top_text')</p>
                        <ul class="vision-list big-margin-before medium-font">
                            <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.top_list.line1')</li>
                            <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.top_list.line2')</li>
                            <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.top_list.line3')</li>
                            <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.top_list.line4')</li>
                            <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.top_list.line5')</li>
                        </ul>
                    </div>
                </div>
                <div class="row eco-vision-part huge-margin-before">
                    <div class="col-md-6">
                        <h3 class="sub-section-title bold-font huge-margin-before">@lang('tokenstars-messages.ecosystem.subtitle')</h3>
                        <div class="row">
                            <div class="col-md-6 big-margin-before col-sm-6">
                                <h3 class="sub-section-title highlight-color bold-font">2017</h3>
                                <ul class="vision-list big-margin-before medium-font big-font-size">
                                    <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.list1.line1')</li>
                                    <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.list1.line2')</li>
                                    <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.list1.line3')</li>
                                    <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.list1.line4')</li>
                                </ul>
                            </div>
                            <div class="col-md-6 big-margin-before col-sm-6">
                                <h3 class="sub-section-title highlight-color bold-font">@lang('tokenstars-messages.ecosystem.list2.title')</h3>
                                <ul class="vision-list big-margin-before medium-font big-font-size">
                                    <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.list2.line1')</li>
                                    <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.list2.line2')</li>
                                    <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.list2.line3')</li>
                                    <li class="vision-list__item">@lang('tokenstars-messages.ecosystem.list2.line4')</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 eco-bonus-holder">
                        <p class="big-font-size">@lang('tokenstars-messages.ecosystem.side_text_1')</p>
                        <p class="big-font-size big-margin-before">@lang('tokenstars-messages.ecosystem.side_text_2')</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder" id="allocation">
            <div class="wrap">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <h2 class="section-title bold-font">@lang('tokenstars-messages.allocation.title_token')</h2>
                        <div class="row huge-margin-before">
                            <div class="col-lg-6 col-md-6">
                                <svg class="distribution-pie-chart j-token-distribution-graph"></svg>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul class="huge-margin-before distribution-legend__list">
                                    @foreach(app('translator')->get('tokenstars-messages.allocation.token_allocations') as $i => $x)
                                        <li>
                                            <span class="distribution-legend__value">
                                                @if(!empty(trans('tokenstars-messages.allocation.token_allocations.' . $i . '.value')))
                                                    @lang('tokenstars-messages.allocation.token_allocations.' . $i . '.value')%
                                                @endif
                                            </span>
                                            <span class="distribution-legend__color" style="background-color: @lang('tokenstars-messages.allocation.token_allocations.' . $i . '.color')"></span>
                                            <span class="distribution-legend__label">@lang('tokenstars-messages.allocation.token_allocations.' . $i . '.label')</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <h2 class="section-title bold-font">@lang('tokenstars-messages.allocation.title_funds')</h2>
                        <div class="row huge-margin-before">
                            <div class="col-lg-6 col-md-6">
                                 <svg class="distribution-pie-chart j-funding-distribution-graph"></svg>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul class="huge-margin-before distribution-legend__list">
                                @foreach(app('translator')->get('tokenstars-messages.allocation.funding_allocations') as $i => $x)
                                        <li>
                                            <span class="distribution-legend__value">
                                                @if(!empty(trans('tokenstars-messages.allocation.funding_allocations.' . $i . '.value')))
                                                    @lang('tokenstars-messages.allocation.funding_allocations.' . $i . '.value')%
                                                @endif
                                            </span>
                                            <span class="distribution-legend__color" style="background-color: @lang('tokenstars-messages.allocation.funding_allocations.' . $i . '.color')"></span>
                                            <span class="distribution-legend__label">@lang('tokenstars-messages.allocation.funding_allocations.' . $i . '.label')</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder" id="press">
            <div class="wrap press-holder">
                <h2 class="section-title bold-font">@lang('tokenstars-messages.press.title')</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/forbes.png" class="press-logo">
                            @lang('tokenstars-messages.press.text1')</div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/huffpost.png" class="press-logo">
                            @lang('tokenstars-messages.press.text2')</div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="press-card align-center huge-margin-before big-font-size medium-font">
                            <img src="/images/ace/tech-version/inc.png" class="press-logo">
                            @lang('tokenstars-messages.press.text6')</div>
                    </div>
                </div>
                <div class="press-logos-holder align-center">
                    @include('tokenstars.partial.press')
                </div>
            </div>
        </section>

        <section class="section-holder">
            <div class="wrap">
                <h2 class="section-title bold-font">@lang('tokenstars-messages.learn_more.title')</h2>
                <div class="huge-margin-before">
                    <ul class="learn-list">
                        <li class="learn-list__item big-margin-before opened j-learn-list-item">
                            <h3 class="bold-font">@lang('tokenstars-messages.learn_more.list.question1.question')</h3>
                            <p class="medium-font medium-margin-before">@lang('tokenstars-messages.learn_more.list.question1.answer')</p>
                        </li>
                        <li class="learn-list__item big-margin-before j-learn-list-item">
                            <h3 class="bold-font">@lang('tokenstars-messages.learn_more.list.question2.question')</h3>
                            <p class="medium-font medium-margin-before">@lang('tokenstars-messages.learn_more.list.question2.answer')</p>
                        </li>
                        <li class="learn-list__item big-margin-before j-learn-list-item">
                            <h3 class="bold-font">@lang('tokenstars-messages.learn_more.list.question3.question')</h3>
                            <p class="medium-font medium-margin-before">@lang('tokenstars-messages.learn_more.list.question3.answer')</p>
                        </li>
                        <li class="learn-list__item big-margin-before j-learn-list-item">
                            <h3 class="bold-font">@lang('tokenstars-messages.learn_more.list.question4.question')</h3>
                            <p class="medium-font medium-margin-before">@lang('tokenstars-messages.learn_more.list.question4.answer')</p>
                        </li>
                        <li class="learn-list__item big-margin-before j-learn-list-item">
                            <h3 class="bold-font">@lang('tokenstars-messages.learn_more.list.question5.question')</h3>
                            <p class="medium-font medium-margin-before">@lang('tokenstars-messages.learn_more.list.question5.answer')</p>
                        </li>
                        <li class="learn-list__item big-margin-before j-learn-list-item">
                            <h3 class="bold-font">@lang('tokenstars-messages.learn_more.list.question6.question')</h3>
                            <p class="medium-font medium-margin-before">@lang('tokenstars-messages.learn_more.list.question6.answer')</p>
                        </li>
                    </ul>
                </div>
                <a href="@lang('tokenstars-messages.other.faq')" class="btn btn-regular btn-blue big-margin-before" target="_blank">@lang('tokenstars-messages.learn_more.btn')</a>
            </div>
        </section>

        <section class="section-holder alt-bg-color">
            <div class="wrap">
                <h2 class="section-title bold-font">@lang('tokenstars-messages.downloads.title')</h2>
                <div class="row row-eq-height">
                    <div class="col-lg-3 col-md-6 huge-margin-before">
                        <div class="downloads-box">
                            <img class="downloads-box__image" src="/images/ace/materials-presentation.jpg">
                            <h3 class="bold-font sub-title-size big-margin-before">@lang('tokenstars-messages.downloads.presentation.title')</h3>
                            <div class="downloads-box__bottom-block">
                                <a href="/upload/files/presentation{{ $lang == 'ru' ? '_ru' : '_en' }}.pdf" target="_blank" class="btn btn-regular btn-blue-border btn-long" onclick="ga('send', 'event', 'click', 'dl_projectsum');">@lang('tokenstars-messages.downloads.presentation.btn')</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 huge-margin-before">
                        <div class="downloads-box">
                            <span class="materials-video-link j-popup-trigger j-popup-video-trigger" data-target-popup=".j-video-popup">
                                <img class="downloads-box__image" src="/images/ace/materials-video.jpg">
                            </span>

                            <h3 class="bold-font sub-title-size big-margin-before">@lang('tokenstars-messages.downloads.video.title')</h3>
                            <div class="downloads-box__bottom-block">
                                <span class="btn btn-regular btn-blue-border btn-long j-popup-trigger j-popup-video-trigger" data-target-popup=".j-video-popup" onclick="ga('send', 'event', 'click', 'watch_our_video');">@lang('tokenstars-messages.downloads.video.btn')</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 huge-margin-before">
                        <div class="downloads-box">
                            <img class="downloads-box__image" src="/images/ace/materials-marketing.jpg">
                            <h3 class="bold-font sub-title-size big-margin-before">@lang('tokenstars-messages.downloads.marketing.title')</h3>
                            <div class="downloads-box__bottom-block">
                                <a href="/upload/files/marketing.pdf" target="_blank" class="btn btn-regular btn-blue-border btn-long" onclick="ga('send', 'event', 'click', 'dl_mrkstrat');">@lang('tokenstars-messages.downloads.marketing.btn')</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 huge-margin-before">
                        <div class="downloads-box">
                            <img class="downloads-box__image" src="/images/ace/materials-financial.jpg">
                            <h3 class="bold-font sub-title-size big-margin-before">@lang('tokenstars-messages.downloads.financial.title')</h3>
                            <div class="downloads-box__bottom-block">
                                <a href="https://docs.google.com/spreadsheets/d/1Ev4iqlqPu_223CBltd6yy3zn9Ciu4-sWDxDVki8M0iM/edit#gid=2079503814" target="_blank" class="btn btn-regular btn-blue-border btn-long" onclick="ga('send', 'event', 'click', 'dl_finmodel');">@lang('tokenstars-messages.downloads.financial.btn')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-sale-holder huge-margin-before align-center">
                    <div class="row">
                        <div class=".col-xl-6 col-lg-8 col-md-10 offset-lg-2 offset-md-1">
                            <div class="main-form">
                                <h3 class="main-form__title bold-font">@lang('tokenstars-messages.team_form.title')</h3>
                                <p class="sub-font-color big-font-size bold-font small-margin-before">@lang('tokenstars-messages.team_form.subtitle')</p>


                                <div class="big-margin-before main-line--black"></div>

                                <p class="big-font-size medium-font big-margin-before">@lang('tokenstars-messages.team_form.text1')</p>
                                <a href="https://www.tokenstars.com/team" target="_blank"  class="btn btn-blue btn-big big-margin-before">@lang('tokenstars-messages.team_form.learn_more')</a>

                                @if(false)
                                <div class="big-margin-before main-line--black"></div>

                                <p class="big-font-size sub-font-color medium-font big-margin-before">@lang('tokenstars-messages.team_form.text2')</p>
                                <a href="#" class="btn btn-highlight btn-regular big-margin-before">@lang('tokenstars-messages.team_form.get_updates')</a>
                                @endif
                            </div>
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
