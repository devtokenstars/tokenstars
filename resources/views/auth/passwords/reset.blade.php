@extends('layouts.promo.cabinet_layout')
@section('title', trans('meta.title') . ' — Password reset')

@section('content')
    <form method="post" action="{{ route('password.request') }}" class="cabinet-form">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <span class="cabinet__title">Reset password</span>

        <div class="cabinet-form-line">
            <span class="cabinet-form__field">Email</span>
            <input type="email" name="email" class="input" required />
            @if ($errors->has('email'))
                <p class="st-red">{{$errors->first('email') }}</p>
            @endif
        </div>

        <div class="cabinet-form-line">
            <span class="cabinet-form__field">Password</span>
            <input type="password" name="password" class="input" required />
            @if ($errors->get('password'))
                <p class="st-red">{{$errors->first('password') }}</p>
            @endif
        </div>
        <div class="cabinet-form-line">
            <span class="cabinet-form__field">Confirm Password</span>
            <input type="password" name="password_confirmation" class="input" required />
            @if ($errors->get('password_confirmation'))
                <p class="st-red">{{$errors->first('password') }}</p>
            @endif
        </div>

        <div class="cabinet-form-footer">
            <input type="submit" value="Reset password" class="button" onclick="ga('send', 'event', 'recover_page', 'recover');" />

            @guest
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            @else
                <p><a href="{{ route('portfolio') }}">Portfolio</a></p>
            @endguest
        </div>
    </form>
@endsection
