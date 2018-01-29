
<div class="bid-history-row">
    <div class="bid-history-id">@if(Auth::user() && $bid->user_id == Auth::user()->id) YOU @endif<a href="#">{!! $bid->fromAddress or '&nbsp;' !!}</a></div>
    <div class="bid-history-time align-right sub-font-color">{{$bid->updated_at}}</div>
    <div class="bid-history-amount align-right bold-font">{{$bid->eth_amount + 0}} ETH</div>
</div>
