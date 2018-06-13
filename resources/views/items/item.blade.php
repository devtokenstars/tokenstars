<div class="ch-auction-card-holder row" id="{{ $item['item']->slug_name }}">
    @if ($image)
    <div class="col-md-5">
        @include('items.slider', [$item['item'], /*$item_images*/])
    </div>
    @endif
    <div class="ch-auction-card-text-holder col-md-7">
        @include('items.card',[$item['item']])
        <div class="uppercase big-title-size bold-font big-margin-before">
            <a href="{{url("/charity/".$item['item']->slug_name)}}" class="font-like-link" onclick="ga('send', 'event', 'item', 'charity', '{{ $item['item']->title }}');">{{ $item['item']->title }}</a>
        </div>
        @include('items.item_'.$item['item']->slug_name.'.subtitle')
        <div class="ch-auction-card-details big-margin-before uppercase big-font-size medium-font">
            <div class="row">
                <div class="col-md-7">
                    @if ($item['item']->is_active)
                        <span class="bold-font">End date:</span> {{$item['item']->date_end}}&nbsp;PM&nbsp;UTC <br />
                        <span class="js-auction-card-timer"
                              data-est="{{$item['item']->date_end->format(DateTime::ISO8601) }}"
                              data-current="{{ (new \Carbon\Carbon())->format(DateTime::ISO8601) }}"
                        ></span>
                        <span class="bold-font">
                    @else
                        <span class="ch-auction-card-completed bold-font">Auction completed! <br /><span>Make your bids for the other great lots!</span></span>
                    @endif
                    </span>
                </div>
                <div class="col-md-5">
                    <span class="bold-font">Number of Bids:</span> {{$item['item']->bid_count}}
                </div>
            </div>
        </div>
        <div class="ch-auction-card-actions big-margin-before row">
            <div class="col-md-8 col-sm-6">
                {{--@auth--}}
                @if($item['item']->winner)
                    
                    <div class="uppercase bold-font sub-title-size">
                        @if ($item['item']->is_active)
                            Current Bid: <span>${{round($item['usd'])}}</span>
                            <span>({{round($item['item']->winner->eth_amount, 4)}} ETH)</span>
                        @else
                            Sold for: <span>${{round($item['usd'])}}</span>
                            <span>({{round($item['item']->winner->eth_amount, 4)}} ETH)</span>
                        @endif

                        @if(Auth::check() && $item['item']->winner->user_id == Auth::user()->id)
                            YOU
                        @endif

                    </div>
                    {{--<span class="sub-title-size medium-font">[COINS] <span class="sub-font-color">≈ [DOLLARS]</span></span>--}}
                @else
                    <div class="uppercase bold-font sub-title-size">Be the First to bid</div>
                @endif
                {{--@else--}}
                {{--<a href="{{url("/signin")}}" class="uppercase bold-font sub-title-size" style="text-decoration:underline">--}}
                    {{--show current bid--}}
                {{--</a>--}}
                {{--@endauth--}}
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
            <br>
            <span class="uppercase small-font-size medium-font ">TOP 3 Bidders</span>
            <div class="big-margin-before small-font-size">
                @foreach($item['item']->bids()->limit(3)->get() as $i => $bid)
                    <div class="bid-history-row" style="display: flex;">
                        <span style="width:30px">{{$i + 1 }}.</span>
                        <div class="bid-history-id">@if(Auth::user() && $bid->user_id == Auth::user()->id) YOU @endif
                            {!! (substr($bid->fromAddress, 0, 20) . '[...]') !!}
                        </div>
                        <div class="bid-history-amount align-right bold-font" style="margin-left: auto">{{floatval(substr($bid->eth_amount + 0, 0, 6))}} ETH</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
