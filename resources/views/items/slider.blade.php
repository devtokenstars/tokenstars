<div class="ch-auction-card-image-holder">
    <div class="fotorama ch-auction-card-image" data-loop="true" data-width="100%" data-ratio="1">
        @php
            $image_names = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/images/resources/views/items/item_'.$item['item']->slug_name.'/images'),['.','..']);
        @endphp
        @foreach($image_names as $image_name)
            <a href="{{asset("/images/resources/views/items/item_".$item['item']->slug_name."/images/".$image_name)}}" class="ch-auction-card-image-item"></a>
        @endforeach
        {{--<img src="/images/charity/lots/2.jpg" alt="" class="">
        <img src="/images/charity/lots/2.jpg" alt="" class="">--}}
    </div>
</div>
