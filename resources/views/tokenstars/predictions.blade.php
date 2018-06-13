@extends('tokenstars.layouts.layout-predictions')

@php
    $lang = app('translator')->getLocale()
@endphp

@section('content')
        <section class="section-holder main main--team">
            <div class="wrap">
                <div class="main-row">
                    <div class="">
                        <h1 class="main-title">Predict Sports Results <br class="desktop-only" />and Earn Tokens</h1>
                        <a href="http://t.me/TokenStars_Predictions_bot" target="_blank" onclick="ga('send', 'event', 'Predictions', 'Predicting1');" class="btn btn-big btn-blue uppercase">Click to Start Predicting</a>
                    </div>
                    <div class="align-center">
                        <img src="/images/predictions/main-phone.png" class="main-phone" />
                    </div>
                </div>
            </div>
        </section>

        <section class="section-holder align-center">
            <div class="wrap">
                <h3 class="section-title">Your Predictions Are Awesome</h3>
                <div class="row">
                    <div class="offset-lg-1 col-lg-5">
                        <ul class="predictions-list">
                            <li>Predictions module <b>increases token demand</b>.</li>
                            <li>It is <b>viral</b> and attracts new users to&nbsp;our&nbsp;community.</li>
                            <li><b>Premium</b> features for large token holders.</li>
                            <li>Creates new opportunities in growing industries, like betting and talent assessment.</li>
                        </ul>
                    </div>
                    <div class="col-lg-5">
                        <ul class="predictions-list predictions-list--last">
                            <li>Make <b>daily</b> sports predictions and get token rewards.</li>
                            <li>No stakes required - forecast the outcomes and earn tokens with <b>no risk</b>.</li>
                            <li>Contribute to community wisdom and help us gather valuable data for developing ML and AI&nbsp;platform.</li>
                        </ul>
                    </div>
                </div>
                <a href="http://t.me/TokenStars_Predictions_bot" target="_blank" onclick="ga('send', 'event', 'Predictions', 'Predicting2');" class="btn btn-regular btn-blue uppercase">Click to Start Predicting</a>
            </div>
        </section>

        <section class="section-holder alt-bg-color align-center">
            <div class="wrap">
                <h3 class="section-title">Flash Facts</h3>
                <div class="">
                    <div class="row row-eq-height">
                        <div class="col-lg-3 col-xs-6">
                            <div class="facts-block">
                                <img src="/images/predictions/predictions-win.png" class="facts-icon">
                                <p class="facts-label">42% of predictions are&nbsp;successful</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="facts-block">
                                <img src="/images/predictions/predictions-reward.png" class="facts-icon">
                                <p class="facts-label">Reward for each correct forecast</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="facts-block">
                                <img src="/images/predictions/predictions-risks.png" class="facts-icon">
                                <p class="facts-label">No risks</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="facts-block">
                                <img src="/images/predictions/predictions-sports.png" class="facts-icon">
                                <p class="facts-label">Many sports to choose from</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="http://t.me/TokenStars_Predictions_bot" target="_blank" onclick="ga('send', 'event', 'Predictions', 'Predicting3');" class="btn btn-regular btn-blue uppercase">Click to Start Predicting</a>
            </div>
        </section>

        <section class="section-holder align-center ceo-bg">
            <div class="wrap">
                <h3 class="section-title">TokenStars CEO Explains Predictions Module</h3>

                
                <iframe src="https://www.youtube.com/embed/WDGbvQwq6yc?start=606" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="ceo-youtube-box"></iframe>
            </div>
        </section>

        <section class="section-holder align-center">
            <div class="wrap">
                <h3 class="section-title">Simple Rules</h3>
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <ul class="rules-list">
                            <li class="st-telegram">Add and start Telegram <b><a target="_blank" href="http://t.me/TokenStars_Predictions_bot" onclick="ga('send', 'event', 'Predictions', 'bot');">@TokenStars_Predictions_bot</a></b> and complete your profile to get your first token reward.</li>
                            <li class="st-question">Answer your questions <b>DAILY</b> to earn more tokens.</li>
                            <li class="st-pay">You <b>don’t need to pay</b> to predict and win tokens.</li>
                            <li class="st-withdrawal"><b>Withdrawal</b> of tokens (you will need to register and add your ERC-20 address).</li>
                            <li class="st-premium">Buy more tokens to get access to the <b>premium platform&nbsp;features</b>.</li>
                        </ul>
                    </div>
                </div>
                <a href="/predictions/contest_rules.pdf" class="btn btn-regular btn-blue uppercase" target="_blank">contest rules</a>
                <br>
                <br>
                <a href="/predictions/worldcupcontest.pdf" class="btn btn-regular btn-blue uppercase" target="_blank">world cup results</a>
                <br>
                <br>
                <a href="http://t.me/TokenStars_Predictions_bot"  onclick="ga('send', 'event', 'Predictions', 'Predicting4');" class="btn btn-regular btn-blue uppercase">Click to Start Predicting</a>
            </div>
        </section>

@endsection
