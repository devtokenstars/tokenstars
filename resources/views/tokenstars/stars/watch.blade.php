@extends('tokenstars.layouts.layout-stars')

@php
    $lang = app('translator')->getLocale()
@endphp

@section('content')
    <section class="section main-section">
        <div class="wrap">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="huge-title-font-size bold-font">Watch Sports and&nbsp;Earn Crypto</h1>
                    <h2 class="sub-title-font-size medium-margin-before">Get a share of huge $60 billion sports advertising revenue.</h2>
                    <div class="row huge-margin-before">
                        <div class="col-lg-4">
                            <div class="main-point">Over 1 billion videos are available via API.</div>
                        </div>
                        <div class="col-lg-8">
                            <div class="main-point">Tokenstars rewards the community with up to 70% of&nbsp;tokens&nbsp;that advertisers pay for the campaigns.</div>
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
                                <li class="main-bullet">Sports fans need to HODL tokens to get new offers from&nbsp;broadcasters, freezing the token supply.</li>
                                <li class="main-bullet">Token is similar to <b class="highlight-font-color">Kin,</b> <b class="highlight-font-color">BAT</b> and <b class="highlight-font-color">Steem</b> — incentivized&nbsp;blockchain-enabled social media.</li>
                                <li class="main-bullet">Token is a win-win for all: the fan, the brand, the club, the broadcaster, and the Platform.</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 big-margin-before">
                            <div class="main-bullit-header sub-title-font-size">
                                <img src="/images/landing-stars/main-bullit-2.png" alt="" class="main-bullit-icon">
                                <span>Why is TokenStars <br class="desktop-only" /> the&nbsp;next&nbsp;big&nbsp;thing?</span>
                            </div>
                            <ul class="big-margin-before small-font-size">
                                <li class="main-bullet">Billions of sports fans are among the potential audience, as users don’t need to be crypto-savvy or&nbsp;have crypto&nbsp;currencies.</li>
                                <li class="main-bullet">Huge sports broadcasting industry where  advertisers&nbsp;spend $60 billion per year.</li>
                                <li class="main-bullet">Users get rewarded for their <b class="highlight-font-color">daily</b> habit of media consumption. They watch sports a lot.</li>

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

    <section class="section streaming-section" id="market">
        <div class="wrap align-center">
            <h2 class="mobile-huge-title-font-size bold-font">The Video Streaming <br class="desktop-only" />Market&nbsp;is&nbsp;Huge</h2>
            <img src="/images/landing-stars/streaming-market.png" alt="" class="streaming-image big-margin-before desktop-only">
            <img src="/images/landing-stars/streaming-market-mobile.png" alt="" class="streaming-image-mobile big-margin-before phone-only">
        </div>
    </section>

    <section class="section advertising-section" id="advertising">
        <div class="wrap">
            <div class="big-font-size uppercase sub-link-color bold-font align-center">How it works</div>
            <h2 class="mobile-huge-title-font-size bold-font huge-margin-before align-center">How Does the Platform’s "Brands and <br class="desktop-only" /> Advertising" Module &nbsp;Works:</h2>
            <div class="row">
                <div class="col-lg-3 advertising-item">
                    <div>
                        <div class="advertising-circle">1</div><img src="/images/landing-stars/white-line.png" class="advertising-line">
                    </div>
                    <p class="sub-title-font-size big-margin-before">Watch sports via the&nbsp;app like you&nbsp;normally&nbsp;do.</p>
                    <p class="big-margin-before">Users don’t need to be crypto-savvy or have crypto currencies. Billions of sports fans are among the potential audience.</p>
                </div>
                <div class="col-lg-3 advertising-item">
                    <div>
                        <div class="advertising-circle">2</div><img src="/images/landing-stars/white-line.png" class="advertising-line">
                    </div>
                    <p class="sub-title-font-size big-margin-before">Watch some commercials like you&nbsp;normally have to.</p>
                    <p class="big-margin-before">The Platform is built on top of the huge existing sports broadcasting industry where advertisers spend <span class="highlight-font-color">$60 billion per&nbsp;year.</span></p>
                </div>
                <div class="col-lg-3 advertising-item">
                    <div>
                        <div class="advertising-circle">3</div><img src="/images/landing-stars/white-line.png" class="advertising-line">
                    </div>
                    <p class="sub-title-font-size big-margin-before">Get paid for it in crypto&nbsp;(tokens). <br class="desktop-only" /><br class="desktop-only" /></p>
                    <p class="big-margin-before">Users get rewarded for their daily habit of media consumption. This killer feature enables rapid growth and user adoption. Token airdrops enable viral audience growth.</p>
                </div>
                <div class="col-lg-3 advertising-item">
                    <div>
                        <div class="advertising-circle">4</div>
                    </div>
                    <p class="sub-title-font-size big-margin-before">Redeem tokens for sport-related offers or sell them to advertisers.</p>
                    <p class="big-margin-before">An incentivized blockchain-enabled ecosystem is win-win for all the parties. <span class="highlight-font-color">Kin (by Kik), BAT and Steem</span> — incentivized blockchain-enabled social media — seem to be viable successful business models.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section workflow-section" id="workflow">
        <div class="wrap">
            <h2 class="mobile-huge-title-font-size bold-font align-center">Over 1 billion videos are&nbsp;available via APIs of&nbsp;established&nbsp;platforms</h2>
            <div class="big-font-size huge-margin-before align-center">Broadcasting deals are negotiated.</div>

            <div class="workflow-bar">
                <span></span><span></span>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <p class="workflow-bar-bullet">TokenStars gives high rewards to the community: <nobr>30-70%</nobr> per view, depending on&nbsp;the type of content and details of the licensing&nbsp;contract.</p>
                </div>
                <div class="col-lg-4">
                    <p class="workflow-bar-bullet red">TokenStars keeps enough for future R&D&nbsp;and&nbsp;broadcasting rights.</p>
                </div>
                <div class="col-lg-4">
                    <p class="workflow-bar-bullet dark-red">Users HODL up to 5% of all transactions, thus lowering the token supply.</p>
                </div>
            </div>

            <div class="workflow-box align-center">
                <p class="sub-title-font-size">Platform Workflow</p>
                <div class="row big-margin-before">
                    <div class="col-md-2 offset-md-1">
                        <div class="workflow-item">
                            <div class="workflow-line">
                                <img src="/images/landing-stars/white-line.png" class="">
                            </div>
                            <img src="/images/landing-stars/workflow/external.png" class="workflow-icon">
                            <p class="small-font-size sub-font-color uppercase big-margin-before">External <br class="desktop-only" />Workflow APIs</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="workflow-item">
                            <div class="workflow-line workflow-line-back">
                                <img src="/images/landing-stars/white-line.png" class="">
                                <img src="/images/landing-stars/white-line.png" class="">
                            </div>
                            <img src="/images/landing-stars/workflow/api.png" class="workflow-icon">
                            <p class="small-font-size sub-font-color uppercase big-margin-before">TokenStars <br class="desktop-only" />API Off-Chain</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="workflow-item">
                            <div class="workflow-line">
                                <img src="/images/landing-stars/white-line.png" class="">
                            </div>
                            <img src="/images/landing-stars/workflow/client.png" class="workflow-icon">
                            <p class="small-font-size uppercase big-margin-before">Client</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="workflow-item">
                            <div class="workflow-line">
                                <img src="/images/landing-stars/white-line.png" class="">
                            </div>
                            <img src="/images/landing-stars/workflow/smart-contract.png" class="workflow-icon">
                            <p class="small-font-size sub-font-color uppercase big-margin-before">Smart <br class="desktop-only" />Contract</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="workflow-item">
                            <img src="/images/landing-stars/workflow/users.png" class="workflow-icon">
                            <p class="small-font-size sub-font-color uppercase big-margin-before">Token holders <br class="desktop-only" />(users)</p>
                        </div>
                    </div>
                </div>
            </div>
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
