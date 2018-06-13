@extends('tokenstars.layouts.layout-stars')

@php
    $lang = app('translator')->getLocale()
@endphp

@section('content')
    <section class="section main-section">
        <div class="wrap">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="huge-title-font-size bold-font">Earn Crypto by Following&nbsp;Stars</h1>
                    <h2 class="sub-title-font-size medium-margin-before">Get a share of $60 billion influencer marketing booming industry</h2>
                    <div class="row huge-margin-before">
                        <div class="col-lg-4">
                            <div class="main-point">20 stars are already cooperating</div>
                        </div>
                        <div class="col-lg-8">
                            <div class="main-point">Solid demand: up to 30% of advertising contracts' value&nbsp;is&nbsp;used to buy tokens from the community.</div>
                        </div>
                    </div>
                    <div class="huge-margin-before">
                        <a href="/upload/files/@lang('tokenstars-team.main.onepager_file').pdf" target="_blank" onclick="ga('send', 'event', '1pager', '1pager', 'new_1pager');" class="btn-regular btn-blue small-margin-before small-margin-right">One-pager</a>
                        <a href="@lang('tokenstars-team.other.whitepaper')" onclick="ga('send', 'event', 'click', 'downloadwp', 'new_main_team');" target="_blank" class="btn-regular btn-blue btn-border small-margin-before small-margin-right">White Paper</a>
                        <a href="https://t.me/TokenStars_en" target="_blank" onclick="ga('send', 'event', 'click', 'telegram', 'new_main');" class="btn-regular btn-blue btn-border small-margin-before">Chat</a>
                    </div>
                    <div class="row huge-margin-before">
                        <div class="col-lg-6 col-md-6 big-margin-before">
                            <div class="main-bullit-header sub-title-font-size">
                                <img src="/images/landing-stars/main-bullit-1.png" alt="" class="main-bullit-icon">
                                <span>Why is TEAM <br class="desktop-only" />token unique?</span>
                            </div>
                            <ul class="big-margin-before small-font-size">
                                <li class="main-bullet">Token makes crypto-bounties possible with regular&nbsp;stars’ fans, for the first time ever.</li>
                                <li class="main-bullet">Fans need to HODL tokens to connect with favorite&nbsp;stars, freezing the supply.</li>
                                <li class="main-bullet">Token airdrops via stars make possible for&nbsp;rapid&nbsp;audience growth.</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 big-margin-before">
                            <div class="main-bullit-header sub-title-font-size">
                                <img src="/images/landing-stars/main-bullit-2.png" alt="" class="main-bullit-icon">
                                <span>Why is TokenStars <br class="desktop-only" /> the&nbsp;next&nbsp;big&nbsp;thing?</span>
                            </div>
                            <ul class="big-margin-before small-font-size">
                                <li class="main-bullet">1\3 of advertisers spend $50-500k per <b class="highlight-font-color">one</b> influencer&nbsp;campaign. The market is huge.</li>
                                <li class="main-bullet">Celebrities with millions of fans simplify rapid user&nbsp;growth for the Platform. </li>
                                <li class="main-bullet">The team has 2 Cannes lions and many international awards for advertising. We know the field.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-form align-center big-margin-before">
                        <div class="uppercase sub-title-font-size">Token sale is over</div>
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="huge-title-font-size bold-font medium-margin-before">10 037 039</div>
                                <div class="small-font-size">TEAM tokens distributed</div>
                                <div class="main-form-splitter big-margin-before"></div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="huge-title-font-size bold-font medium-margin-before">3,220</div>
                                <div class="small-font-size">Purchasers</div>
                                <div class="main-form-splitter big-margin-before"></div>
                            </div>
                        </div>
                        <a href="https://teamtoken.tokenstars.com/users/sign_in{{$contribute_url}}" class="btn-regular btn-red huge-margin-before">Complete KYC</a>

                        <a href="https://tokenstars.com/upload/files/how_to_add_TEAM_tokens.pdf" target="_blank" class="btn-small btn-blue btn-border huge-margin-before">How to add TEAM tokens</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-small-padding reviews-section section-sub-bg-color">
        <div class="wrap align-center">
            <img src="/images/landing-stars/reviews/icorating.png" alt="TokenStars TEAM Rating Review" onclick="ga('send', 'event', 'listing', 'icorating', 'top');" class="review-banner">
            <img src="/images/landing-stars/reviews/topicolist.png" alt="TokenStars Gold Level TOP ICO LIST" onclick="ga('send', 'event', 'listing', 'top_ico_gold', 'top');" class="review-banner">
            <img src="/images/landing-stars/reviews/icobazar.png" alt="TokenStars AA ICO Bazaar" onclick="ga('send', 'event', 'listing', 'ico_bazaar', 'top');" class="review-banner">
            <img src="/images/landing-stars/reviews/icobench.png" alt="TokenStars ICObench" onclick="ga('send', 'event', 'listing', 'ico_bench', 'top');" class="review-banner">
            <img src="/images/landing-stars/reviews/trackico.png" alt="TokenStars TrackICO" onclick="ga('send', 'event', 'listing', 'track_ico', 'top');" class="review-banner">
            <img src="/images/landing-stars/reviews/icoranker.png" alt="TokenStars ICORanker" onclick="ga('send', 'event', 'listing', 'ico_ranker', 'top');" class="review-banner">
        </div>
    </section>

    <section class="section quote-section">
        <div class="wrap align-center">
            <div class="mobile-huge-title-font-size bold-font"><span class="sub-font-color">"</span>TokenStars looks like the next big thing<span class="sub-font-color">"</span></div>
            <div class="big-font-size sub-font-color small-margin-before">Lothar Matthäus, football legend</div>
        </div>
    </section>

    <section class="section market-section">
        <div class="wrap align-center">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <h2 class="sub-title-font-size bold-font">TokenStars potential market</h2>
                    <div class="market-number bold-font desktop-only">$60 billion</div>
                    <div class="market-number bold-font phone-only">$60 B</div>
                    <div class="sub-title-font-size"> global sports sponsorships <br /> <span class="small-font-size">Source: Statista, 2017</span></div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <h2 class="sub-title-font-size bold-font">TokenStars is one&nbsp;of the</h2>
                    <div class="market-number bold-font">TOP 10</div>
                    <div class="sub-title-font-size">ICO projects to watch in 2018 <br /><span class="small-font-size"> according&nbsp;to&nbsp;investing.com</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section usage-section">
        <div class="wrap">
            <div class="row">
                <div class="col-lg-4 col-md-4 usage-item">
                    <img src="/images/landing-stars/usage-like.png" alt="" class="usage-icon huge-margin-before">
                    <h2 class="bold-font big-margin-before">Everybody <br /> uses it</h2>
                    <p class="big-margin-before"><b>86%</b> of all marketers have used&nbsp;influencer&nbsp;marketing</p>
                </div>
                <div class="col-lg-4 col-md-4 usage-item">
                    <img src="/images/landing-stars/usage-heart.png" alt="" class="usage-icon huge-margin-before">
                    <h2 class="bold-font big-margin-before">Everybody <br /> likes it</h2>
                    <p class="big-margin-before"><b>94%</b> found it effective</p>
                </div>
                <div class="col-lg-4 col-md-4 usage-item">
                    <img src="/images/landing-stars/usage-money.png" alt="" class="usage-icon huge-margin-before">
                    <h2 class="bold-font big-margin-before">Everybody spends crazy&nbsp;money on it</h2>
                    <p class="big-margin-before">1\3 of marketers spend <b>$50-500k</b> per&nbsp;<b class="highlight-font-color">one</b>&nbsp;influencer campaign</p>
                </div>
            </div>
            <p class="small-font-size sub-font-color huge-margin-before">Source: Statista, 2017</p>
        </div>
    </section>

    <section class="section clients-section section-sub-bg-color">
        <div class="wrap align-center">
            <div class="big-font-size uppercase sub-link-color bold-font">Clients</div>
            <h2 class="mobile-huge-title-font-size bold-font huge-margin-before">We have huge experience in&nbsp;advertising and an&nbsp;impressive&nbsp;portfolio&nbsp;of international clients</h2>
            <img src="/images/landing-stars/clients-logos.png" alt="" class="clients-logos huge-margin-before desktop-only">
            <img src="/images/landing-stars/clients-logos-mobile.png" alt="" class="clients-logos huge-margin-before phone-only">

            <div class="big-font-size uppercase sub-link-color bold-font clients-splitter">Advertising Awards</div>
            <h2 class="mobile-huge-title-font-size bold-font huge-margin-before">Team members are winners of&nbsp;international awards</h2>
            <img src="/images/landing-stars/awwards-logos.png" alt="" class="clients-logos huge-margin-before">
        </div>
    </section>

    <section class="section team-section" id="ambassadors">
        <div class="wrap align-center">
            <div class="title-font-size sub-link-color">★ ★ ★ ★ ★</div>
            <h2 class="title-font-size big-margin-before bold-font">18 Celebrities Already Work with the Platform</h2>
            <div class="row row-eq-height">
                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-mattheus.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.mattheus.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.mattheus.name')</div>
                        <img src="/images/landing-stars/flags/gr.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.mattheus.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.mattheus.info')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-haas.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.haas.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.haas.name')</div>
                        <img src="/images/landing-stars/flags/gr.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.haas.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.haas.info')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-kucherov.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.kucherov.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.kucherov.name')</div>
                        <img src="/images/landing-stars/flags/ru.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.kucherov.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.kucherov.info')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-zambrotta.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.zambrotta.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.zambrotta.name')</div>
                        <img src="/images/landing-stars/flags/it.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.zambrotta.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.zambrotta.info')</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-eq-height">
                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-myskina.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.myskina.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.myskina.name')</div>
                        <img src="/images/landing-stars/flags/ru.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.myskina.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.myskina.info')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-karpin.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.karpin.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.karpin.name')</div>
                        <img src="/images/landing-stars/flags/ru.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.karpin.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.karpin.info')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card align-center">
                        <img src="/upload/images/amb-torres.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.torres.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.torres.name')</div>
                        <img src="/images/landing-stars/flags/us.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <img src="/images/landing-stars/flags/es.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.torres.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.torres.info')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-kurilova.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.kurilova.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.kurilova.name')</div>
                        <img src="/images/landing-stars/flags/ru.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.kurilova.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.kurilova.info')</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-eq-height">
                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-pioline.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.pioline.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.pioline.name')</div>
                        <img src="/images/landing-stars/flags/fr.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.pioline.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.pioline.info')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-soderling.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.soderling.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.soderling.name')</div>
                        <img src="/images/landing-stars/flags/sw.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.soderling.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.soderling.info')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-ambassador-card">
                        <img src="/upload/images/amb-anter.jpg" alt="" class="team-ambassador-card-image">
                        <div class="small-font-size small-margin-before">@lang('tokenstars-team.ambassadors.anter.title')</div>
                        <div class="big-font-size bold-font small-margin-before">@lang('tokenstars-team.ambassadors.anter.name')</div>
                        <img src="/images/landing-stars/flags/sw.png" alt="" class="medium-margin-before team-ambassador-card-flag">
                        <div class="team-ambassador-card-info">
                            <div class="bold-font desktop-only">@lang('tokenstars-team.ambassadors.anter.name')</div>
                            <p class="super-small-font-size">@lang('tokenstars-team.ambassadors.anter.info')</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="team-splitter">
                <h2 class="title-font-size bold-font">13 Celebrities participated in the blockchain <br />
                 auctions, organized by the platform in 2017-2018</h2>
                <div class="huge-margin-before">
                    <div class="team-small-ambassador-card align-center">
                        <img src="/images/landing-stars/team/lingham.png" alt="" class="team-small-ambassador-card-image">
                        <div class="bold-font small-margin-before">Vinny Lingham</div>
                    </div>

                    <div class="team-small-ambassador-card align-center">
                        <img src="/images/landing-stars/team/ver.png" alt="" class="team-small-ambassador-card-image">
                        <div class="bold-font small-margin-before">Roger Ver</div>
                    </div>

                    <div class="team-small-ambassador-card align-center">
                        <img src="/images/landing-stars/team/fedorov.png" alt="" class="team-small-ambassador-card-image">
                        <div class="bold-font small-margin-before">Sergei Fedorov</div>
                    </div>

                    <div class="team-small-ambassador-card align-center">
                        <img src="/images/landing-stars/team/redfoo.png" alt="" class="team-small-ambassador-card-image">
                        <div class="bold-font small-margin-before">Redfoo</div>
                    </div>

                    <div class="team-small-ambassador-card align-center">
                        <img src="/images/landing-stars/team/datsyuk.png" alt="" class="team-small-ambassador-card-image">
                        <div class="bold-font small-margin-before">Pavel Datsyuk</div>
                    </div>

                    <div class="team-small-ambassador-card align-center">
                        <img src="/images/landing-stars/team/hingis.png" alt="" class="team-small-ambassador-card-image">
                        <div class="bold-font small-margin-before">Martina Hingis</div>
                    </div>

                    <div class="team-small-ambassador-card align-center">
                        <img src="/images/landing-stars/team/boe.png" alt="" class="team-small-ambassador-card-image">
                        <div class="bold-font small-margin-before">Tarjei Boe</div>
                    </div>
                </div>
            </div>

            <div class="team-splitter">
                <h2 class="title-font-size bold-font">@lang('tokenstars-messages.team.roles.blockchain_n_business')</h2>
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/kampers.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.kampers.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.kampers.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.kampers.social.fb')">
                                <img src="/images/ace/tech-version/fb.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.kampers.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.kampers.social.tw')">
                                <img src="/images/ace/tech-version/tw.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/kaal.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.kaal.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.kaal.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.kaal.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.kaal.social.url')">
                                <img src="/images/ace/tech-version/url.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/stratilatov.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.stratilatov.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.stratilatov.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.stratilatov.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.stratilatov.social.fb')">
                                <img src="/images/ace/tech-version/fb.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/sato.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.sato.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.sato.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.sato.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.sato.social.fb')">
                                <img src="/images/ace/tech-version/fb.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/danilov.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.danilov.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.danilov.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.danilov.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/zanko.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.zanko.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.zanko.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.zanko.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="team-splitter">
                <h2 class="title-font-size bold-font">@lang('tokenstars-messages.team.roles.team')</h2>
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/stukolov.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.stukolov.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.stukolov.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.stukolov.social.fb')">
                                <img src="/images/ace/tech-version/fb.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.stukolov.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.stukolov.social.ig')">
                                <img src="/images/ace/tech-version/ig.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/potapov.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.potapov.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.potapov.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.potapov.social.fb')">
                                <img src="/images/ace/tech-version/fb.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.potapov.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/denisov.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.denisov.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.denisov.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.denisov.social.fb')">
                                <img src="/images/ace/tech-version/fb.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.denisov.social.url')">
                                <img src="/images/ace/tech-version/url.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/zak.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.zak.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.zak.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.zak.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/hooke.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.hooke.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.hooke.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.hooke.social.fb')">
                                <img src="/images/ace/tech-version/fb.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                            <a href="@lang('tokenstars-messages.team.members.hooke.social.in')">
                                <img src="/images/ace/tech-version/in.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="team-ambassador-card team-card">
                            <img src="/upload/images/krivochurov.jpg" alt="" class="team-ambassador-card-image">
                            <div class="super-small-font-size small-margin-before">@lang('tokenstars-messages.team.members.krivochurov.title')</div>
                            <div class="bold-font small-margin-before">@lang('tokenstars-messages.team.members.krivochurov.name')</div>
                            <a href="@lang('tokenstars-messages.team.members.krivochurov.social.fb')">
                                <img src="/images/ace/tech-version/fb.png" alt="" class="medium-margin-before team-ambassador-card-flag team-social">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="team-splitter">
                <h2 class="title-font-size bold-font">The iconic images shot by&nbsp;our Hollywood ambassador Rico Torres</h2>
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
        </div>
    </section>

    <section class="section how-section" id="tokens">
        <div class="wrap align-center">
            <h2 class="mobile-huge-title-font-size bold-font">Follow your favorite celebrities, <br /> complete tasks and&nbsp;earn&nbsp;crypto</h2>
            <div class="row huge-margin-before">
                <div class="col-lg-3 col-md-3 how-item">
                    <div class="bold-font how-number">1</div>
                    <p class="big-margin-before">Cristiano needs bigger and more&nbsp;engaged audience to&nbsp;attract&nbsp;advertisers.*</p>
                </div>
                <div class="col-lg-3 col-md-3 how-item">
                    <div class="bold-font how-number">2</div>
                    <p class="big-margin-before">Fans actively follow Cristiano, complete activities and earn crypto.</p>
                </div>
                <div class="col-lg-3 col-md-3 how-item">
                    <div class="bold-font how-number">3</div>
                    <p class="big-margin-before">Cristiano pays crypto rewards to&nbsp;his&nbsp;fans (in TEAM tokens).</p>
                </div>
                <div class="col-lg-3 col-md-3 how-item">
                    <div class="bold-font how-number">4</div>
                    <p class="big-margin-before">Fans can redeem tokens for premium offers from Cristiano or sell tokens to the advertisers who need them to pay for campaigns.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section how-sub-section">
        <div class="wrap">
            <h2 class="sub-title-font-size bold-font align-center">*Cristiano sets up a list of rewarded&nbsp;tasks for fans, like a&nbsp;“<nobr>Crypto-Bounty</nobr>&nbsp;fan&nbsp;club”</h2>
            <div class="row big-margin-before">
                <div class="col-lg-3">
                    <p class="how-sub-task">Like and share Cristiano’s content (promoting brands or&nbsp;personal)</p>
                </div>
                <div class="col-lg-3">
                    <p class="how-sub-task">Create Cristiano-related content (memes, videos,&nbsp;streams);</p>
                </div>
                <div class="col-lg-3">
                    <p class="how-sub-task">Invite new followers to Cristiano’s social media&nbsp;accounts;</p>
                </div>
                <div class="col-lg-3">
                    <p class="how-sub-task">Participate actively in the polls, online events, contests etc.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section how-scheme-section">
        <div class="wrap align-center">
            <img src="/images/landing-stars/how-scheme.png" alt="" class="how-scheme big-margin-before">
            <img src="/images/landing-stars/how-fb-scheme.jpg" alt="" class="how-fb-scheme huge-margin-before">
        </div>
    </section>

    <section class="section partners-section section-sub-bg-color">
        <div class="wrap align-center">
            <div class="big-font-size uppercase sub-link-color bold-font">Partners</div>
            <img src="/images/landing-stars/partners-logos.png" alt="" class="clients-logos big-margin-before">
        </div>
    </section>

    <section class="section press-section">
        <div class="wrap press-holder">
            <h2 class="huge-title-font-size bold-font medium-margin-before align-center">@lang('tokenstars-messages.press.title')</h2>
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


    <section class="section events-section">
        <div class="wrap">
            <h2 class="huge-title-font-size bold-font medium-margin-before align-center">@lang('tokenstars-team.events.title')</h2>
            <div class="events-holder alt-bg-color huge-margin-before">
                <div class="row row-eq-height align-center">
                    <div class="col-md-4 event-section">
                        <p class="bold-font title-font-size">@lang('tokenstars-team.events.europe')</p>
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
                        <p class="bold-font title-font-size">@lang('tokenstars-team.events.america')</p>
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
                        <p class="bold-font title-font-size">@lang('tokenstars-team.events.asia')</p>
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
                                <a href="http://d10e.biz/seoul-2018/" target="_blank"><img src="/images/team/events/d10e-seoul.png" alt="d10e Seoul" class="event-logo"></a>
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

    <section class="section main-section">
        <div class="wrap">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="main-form align-center">
                        <div class="uppercase sub-title-font-size">Token sale is over</div>
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="huge-title-font-size bold-font medium-margin-before">10 037 039</div>
                                <div class="small-font-size">TEAM tokens distributed</div>
                                <div class="main-form-splitter big-margin-before"></div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="huge-title-font-size bold-font medium-margin-before">3,220</div>
                                <div class="small-font-size">Purchasers</div>
                                <div class="main-form-splitter big-margin-before"></div>
                            </div>
                        </div>
                        <a href="https://teamtoken.tokenstars.com/users/sign_in{{$contribute_url}}" class="btn-regular btn-red huge-margin-before">Complete KYC</a>

                        <a href="https://tokenstars.com/upload/files/how_to_add_TEAM_tokens.pdf" target="_blank" class="btn-small btn-blue btn-border huge-margin-before">How to add TEAM tokens</a>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </section>

@endsection
