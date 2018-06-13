@extends('layouts.layout-team')

@php
$lang = app('translator')->getLocale()
@endphp

@section('meta')
    @php
    $image_names = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/images/resources/views/items/item_'.$item['item']->slug_name.'/images'),['.','..']);
    $image_name = next($image_names);
    @endphp
    <meta property="og:title" content="{{$item['item']->name}}"/>
    <meta property="og:description" content="{{$item['item']->title}}"/>
    <meta property="og:image" content="{{asset("/images/resources/views/items/item_".$item['item']->slug_name."/images/".$image_name)}}">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ app('url')->current() }}"/>
@endsection

@section('content')
    <section>
        <div class="wrap align-center">
            <div class="alt-bg-color ch-auction-card-social-banner big-margin-before">
                <img src="{{asset("/images/charity/charity-banner.png")}}" alt=""
                     class="ch-auction-card-social-banner-image">
                <span class="sub-title-size bold-font uppercase">Spread the word and help our charity</span>
                <div class="ch-auction-card-social-banner-btns">
                    @include('partial.shared_buttons')
                </div>
            </div>
        </div>
    </section>
    <section class="big-margin-before">
        <div class="wrap">

            <div class="ch-auction-card-holder row">
                <div class="col-md-5">
                    @include('items.slider',$item['item'])
                    <!-- Other auctions for desktop -->
                    <div class="ch-auction-card-other-auctions-holder other-auctions-holder-desktop">
                        <a href="{{url('/')}}"><h2 class="big-font-size uppercase bold-font huge-margin-before">Other
                            Auctions</h2></a>
                        @foreach( $other_auctions as $auction )
                            <div class="ch-auction-card-other-auction big-margin-before">
                                <a href="{{url("/$auction->slug_name")}}">
                                    @php
                                    $image_name = array_values(array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/images/resources/views/items/item_'.$auction->slug_name.'/images', null),['.','..']));
                                    @endphp
                                    <img src="{{asset("/images/resources/views/items/item_$auction->slug_name/images/$image_name[0]")}}"
                                         alt="" class="ch-auction-card-other-auction-image">
                                </a>
                                <div class="ch-auction-card-other-auction-text">
                                    <a href="{{url("/charity/$auction->slug_name")}}"
                                       class="font-like-link big-font-size medium-font">{{$auction->title}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="ch-auction-card-text-holder ch-auction-card-text-holder-inside  col-md-7">
                    @include('items.card',[$item['item']])
                    <div class="uppercase big-title-size bold-font big-margin-before">{{$item['item']->title}}</div>
                    @include('items.item_'.$item['item']->slug_name.'.subtitle')
                    <div class="ch-auction-card-details big-margin-before uppercase big-font-size medium-font">
                        <div class="row mobile_width_clock">
                            <div class="col-md-8 col-lg-8">
                                @if ($item['item']->is_active)
                                    <span class="bold-font">End date: </span> {{$item['item']->date_end}} PM UTC <br>
                                    <span class="js-auction-card-timer"
                                          data-est="{{$item['item']->date_end->format('Y/m/d H:i:s') }}"
                                          data-current="{{ (new \Carbon\Carbon())->format('Y/m/d H:i:s') }}"
                                    ></span>
                                @else
                                    <span class="ch-auction-card-completed bold-font">Auction completed! <br /><span>Make your bids for the other great lots!</span></span>
                                @endif
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <span class="bold-font">Number of Bids:</span> {{count($extBids)}}
                            </div>
                        </div>
                    </div>
                    <div class="ch-auction-card-actions big-margin-before row">
                        <div class="col-md-8 col-sm-6">
                            @if($item['item']->winner)
                                <div class="uppercase bold-font sub-title-size">
                                    @if ($item['item']->is_active)
                                        Current Bid: <span>${{round($item['usd'])}}</span>
                                        <span>({{round($item['item']->winner->eth_amount, 4)}} ETH)</span>
                                    @else
                                        Sold for: <span>${{round($item['usd'])}}</span>
                                        <span>({{round($item['item']->winner->eth_amount, 4)}} ETH)</span>
                                    @endif
                                    
                                    @auth
                                    @if($item['item']->winner->user_id == Auth::user()->id)
                                        YOU
                                    @endif
                                    @endauth
                                </div>
                                {{--<span class="sub-title-size medium-font">[COINS] <span class="sub-font-color">≈ [DOLLARS]</span></span>--}}
                            @else
                                <div class="uppercase bold-font sub-title-size">Be the First to bid</div>
                            @endif
                            <br>


                        </div>
                        <div class="col-md-4 col-sm-6">
                            @if ($item['item']->is_active)
                                <a class="button js-popup_open"
                                   data-type="info"
                                   data-item-id="{{$item['item']->id}}"
                                   data-myskina="{{ $item['item']->name === 'ANASTASIA MYSKINA' ? 1 : 0 }}"
                                   onclick="ga('send', 'event', 'bid_now', 'bid_now', 'Bid Now');">Bid Now</a>
                            @endif
                        </div>
                    </div>

                    @if ($item['item']->bids()->count() > 0)
                        <span class="uppercase small-font-size medium-font ">TOP 3 Bidders</span>
                        <div class="big-margin-before small-font-size">
                            @foreach($item['item']->bids()->limit(3)->get() as $i => $bid)
                                <div class="bid-history-row" style="display: flex;">
                                    <span style="width:30px">{{$i + 1 }}.</span>
                                    <div class="bid-history-id">@if(Auth::user() && $bid->user_id == Auth::user()->id) YOU @endif
                                        {!! (substr($bid->fromAddress, 0, 20) . '[...]') !!}
                                    </div>
                                    <div class="bid-history-amount align-right bold-font" style="margin-left: auto">
                                        {{$bid->eth_amount >= 1e-6 ? floatval(substr($bid->eth_amount + 0, 0, 6)) : number_format($bid->eth_amount, 8)}} ETH
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <br>
                    @endif

                    @if ($item['item']->bid_count > 0)
                        <span class="fake-link uppercase small-font-size medium-font j-toggle-bid-history">Bid history</span>
                    @else
                        <div class="uppercase bold-font sub-title-size">
                            @if(in_array($item['item']->slug_name, ['redfoo', 'redfoo_2']))
                                Minimum price: $150
                            @elseif($item['item']->id > 15)
                                Minimum price: 0,05 ETH (~$50)
                            @else
                                Minimum price: 0,35 ETH (~$250)
                            @endif
                        </div>
                    @endif
                    <div class="bid-history-holder big-margin-before small-font-size hide">
                        @if (count($extBids) > 0)
                            @foreach ($extBids as $extBid)
                                @include('bids.history_row_transfer', $extBid)
                            @endforeach
                        @endif
                    </div>
                    @include('items.lot_description', $item['item'])
                </div>
            </div>
        </div>
    </section>
    @auth
        @include('popups.bid')
    @else
        @include('popups.bid_without_registration')
        @include('popups.login')
        @include('popups.signup')
    @endauth
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->
    <link href="/resources/styles/fotorama.css" rel="stylesheet"> <!-- 3 KB -->

@endsection
