<div class="ch-auction-card-destination">

    @include('items.item_'.$item['item']->slug_name.'.card.image')
    <div class="ch-auction-card-destination-text">
        <div class="bold-font small-font-size uppercase">Your bid supports</div>
        @include('items.item_'.$item['item']->slug_name.'.card.title')
        <div class="small-font-size sub-font-color">
            @include('items.item_'.$item['item']->slug_name.'.card.subtitle')
        </div>
    </div>
</div>
