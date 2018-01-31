<div class="ch-auction-card-lot-description big-margin-before">
    <h2 class="big-font-size uppercase bold-font big-margin-before">Lot Description</h2>
    @include('items.item_'.$item['item']->slug_name.'.lot_description_text')

    <h2 class="big-font-size uppercase bold-font big-margin-before sub-font-color">Payment options</h2>
    <p class="small-margin-before sub-font-color">ETH, @if ($item['item']->id < 15) BTC @else BCH, ACE, TEAM @endif</p>
    {{--<p class="small-margin-before sub-font-color">Etherium, ACE, BTC, Visa, Matercard</p>--}}


    @if ($item['item']->slug_name == "anastasia_myskina" || $item['item']->slug_name == "anastasia_myskina_ball")
        <p class="small-margin-before sub-font-color"> ACE (not more than 500 ACE in your bid)</p>
    @endif

</div>