@extends('emails.layout')
@section('content')
    <tr>
        <td>
            <h2 class="no-border-header">
                Congratulations, your registration is confirmed! <br>
                Please have a look around, here are some recommendations for you:
            </h2>

            <p class="medium-font">
                Please join our Telegram chat at <a href="https://t.me/TokenStars">https://t.me/TokenStars</a> the
                most interesting news are published there.
            </p>
        </td>
    </tr>

    {{--<tr>
      <td>
        <a href='https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2'>
          <img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png'/>
        </a>
      </td>
    </tr>--}}
    @isset($qrCode)
        <tr align="center">
            <td>
                <img src="{{ $message->embedData($qrCode, config('app.name') . 'Google2FAQrCode.png', 'image/png') }}">
            </td>
        </tr>
    @endisset
@endsection
