@extends('layouts.promo.cabinet_layout')
@section('title', 'Tokenstars — Login')

@section('content')
    <form method="post" action="{{ route('auth.loginCheck') }}" class="cabinet-form">
        {{ csrf_field() }}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <span class="cabinet__title">Login</span>

        <div class="cabinet-form-line">
            <span class="cabinet-form__field">Email</span>
            <input type="email" name="email" class="input" value="{{ old('email') }}" required />
            @if ($errors->has('email'))
                <p class="st-red">{{$errors->first('email') }}</p>
            @endif
        </div>

        <div class="cabinet-form-line">
            <span class="cabinet-form__field">Password</span>
            <a class="cabinet-form__field-anchor" href="{{ route('password.request') }}"
               onclick="ga('send', 'event', 'Click', 'frg_password', 'forgot password');">Forgot password?</a>

            <input type="password" name="password" class="input" required />
            @if ($errors->has('password'))
                <p class="st-red">{{$errors->first('password') }}</p>
            @endif
        </div>
        <div class="cabinet-form-footer">
            <input type="submit" value="Login" class="button" onclick="ga('send', 'event', 'Click', 'login', 'Login');" />

            <p>No account? <a href="{{ route('register') }}" onclick="ga('send', 'event', 'Click', 'sign_up', 'Sign up');">Sign Up</a></p>
        </div>
    </form>
@endsection
