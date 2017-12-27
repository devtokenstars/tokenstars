@extends('layouts.layout-team')

@php
    $lang = app('translator')->getLocale()
@endphp

@section('content')
    <section class="section-holder alt-bg-color module-name-block ch-module-header">
        <div class="wrap">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset("/images/charity/charity-icon.png")}}" alt="" class="module-big-icon">
                    <div class="big-font-size">TokenStars charity event:</div>
                    <h1 class="big-title-size">Charity Crypto Auction</h1>
                </div>
                <div class="col-md-6 ch-auction-card-header-stars">
                    <img src="{{asset("/images/charity/stars/hingis.png")}}" alt="" class="ch-header-stars" scroll-to="#martina_hingis">
                    <img src="{{asset("/images/charity/stars/matthaus.png")}}" alt="" class="ch-header-stars" scroll-to="#lothar_matthaus">
                    <img src="{{asset("/images/charity/stars/redfoo.png")}}" alt="" class="ch-header-stars" scroll-to="#redfoo">
                    <img src="{{asset("/images/charity/stars/datsyuk.png")}}" alt="" class="ch-header-stars" scroll-to="#datsyuk">
                    <img src="{{asset("/images/charity/stars/haas.png")}}" alt="" class="ch-header-stars" scroll-to="#tommy_haas">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 align-center">
                    <h2 class="big-title-size bold-font big-margin-before">Welcome to the First Crypto&nbsp;Charity&nbsp;Auction</h2>
                    <div class="medium-margin-before sub-title-size">Make your bids and win exclusive items from the Stars! <br />100% of the money is donated to the charities.</div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="wrap align-center">
            <div class="alt-bg-color ch-auction-card-social-banner big-margin-before">
                <img src="{{asset("/images/charity/charity-banner.png")}}" alt="" class="ch-auction-card-social-banner-image">
                <span class="sub-title-size bold-font uppercase">Spread the word and help our charity</span>
                <div class="ch-auction-card-social-banner-btns">
                    @include('partial.shared_buttons')
                </div>
            </div>
        </div>
    </section>

    <section class="big-margin-before">
        <div class="wrap">

            @foreach ($items as $item)
                @include('items.item', ['image'=>true])
            @endforeach

        </div>
    </section>

    @auth
        @include('popups.bid')
    @else
        @include('popups.bid_without_registration')
        @include('popups.login')
        @include('popups.signup')
    @endauth
    <script type="text/javascript">
        window.new_registered = @json($registered);
    </script>
@endsection
