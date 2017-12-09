@extends('layouts.promo.cabinet_layout')
@section('title', 'Tokenstars — 2FA Login')

@section('content')
    <form method="post" action="{{ route('auth.check2fa') }}" class="cabinet-form">
        {{ csrf_field() }}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <span class="cabinet__title">Login</span>

        <div class="cabinet-form-line">
            <span class="cabinet-form__field">Auth Code</span>
            <a class="cabinet-form__field-anchor" href="{{ route('auth.requestCode') }}">Don't have one?</a>
            <input type="text" name="code" class="input" required />

            @if ($errors->get('code'))
                <p class="st-red">{{$errors->first('code') }}</p>
            @endif
        </div>
        <div class="cabinet-form-footer">
            <input type="submit" value="Login" class="button" onclick="ga('send', 'event', 'login_page', 'login');" />

            <p>No account? <a href="{{ route('register') }}">Sign Up</a></p>
        </div>
    </form>
@endsection
