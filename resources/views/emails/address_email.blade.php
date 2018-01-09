@extends('emails.layout')
@section('content')
    @if($password)
    <tr>
        <td>
    <p>
        Hi&nbsp;and thanks for joining the Tokenstars platform. Your temporary password is {{$password}}.</p>
        </td>
    </tr>

    @endif
    <tr>
        <td>
    <p>
        @if($highest_bid !== 'NO')Current highest bid is {{$highest_bid}}.@endif
        @if($your_bid === 'NO')
                You are bidding for {{$item}}. We recommend you to bid {{$lead_bid}} or more to take the lead. Hurry up, the maximum bid keeps growing.
        @else
            @if($lead_bid === 'NO')
                Your current bid&nbsp;is {{$your_bid}} and you are the highest bidder!
            @else
                Your current bid&nbsp;is {{$your_bid}}. We&nbsp;recommend you to&nbsp;add {{$lead_bid}} or&nbsp;more to&nbsp;take the lead.
            @endif
        @endif
    </p>
        </td>
    </tr>
    <tr>
        <td>
    <p style="color: #000;
              font-weight: 700;
              text-align: center;
              margin-bottom: 10px;
              padding: 5px;">
        Deposit your bid directly to&nbsp;this {{$account->currency->code}} wallet:
    </p>
        </td>
    </tr>
    <tr>
        <td>
    <p>
        <span style="background: #fff;
                     color: #000;
                     text-align: center;
                     margin-bottom: 10px;
                     border-radius: 7px;
                     padding: 0;">
            {{$account->wallet}}
        </span>
    </p>
        </td>
    </tr>
    <tr>
        <td>
    <p>
        Thank you and good luck with your bid! Please note that it&nbsp;might take from several minutes to&nbsp;an&nbsp;hour to&nbsp;register your transaction depending on&nbsp;the load of&nbsp;the blockchain.&nbsp;90% of&nbsp;transactions are usually registered in&nbsp;less than 5&nbsp;minutes. We&nbsp;will send you an&nbsp;email confirmation on&nbsp;receiving your bid.
    </p>
        </td>
    </tr>
@endsection
