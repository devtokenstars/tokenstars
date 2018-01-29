<div class="bid-history-row">
    <div class="bid-history-id">
        @if(Auth::user() && $extBid['user_id'] == Auth::user()->id) YOU @endif
        {!! (substr($extBid['address'], 0, 20) . '[...]') !!}
    </div>
    <div class="bid-history-time align-right sub-font-color">{{$extBid['updated_at']}}</div>
    <div class="bid-history-amount align-right bold-font">
        {{$extBid['amount'] >= 1e-4 ? floatval(substr($extBid['amount'] + 0, 0, 6)) : number_format($extBid['amount'], 8)}} ETH
    </div>
</div>