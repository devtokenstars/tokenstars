@extends('layouts.promo.cabinet_layout')
@section('title', 'Tokenstars — Google Authenticator QR code request')

@section('content')
    <form method="post" action="{{ route('auth.requestCode') }}" class="cabinet-form">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        {{ csrf_field() }}
        <span class="cabinet__title">Request Google Authenticator QR code</span>

        <div class="cabinet-form-line">
            <span class="cabinet-form__field">Email</span>
            <input type="email" name="email" class="input" required />
            @if ($errors->has('email'))
                <p class="st-red">{{$errors->first('email') }}</p>
            @endif
        </div>

        <div class="cabinet-form-footer">
            <input type="submit" value="Request QR Code" class="button" onclick="ga('send', 'event', 'request_code_page', 'request');" />

            @guest
                <p>Already got QR code? <a href="{{ route('login') }}">Sign In</a></p>
            @else
                <p><a href="{{ route('portfolio') }}">Portfolio</a></p>
            @endguest
        </div>
    </form>
@endsection
