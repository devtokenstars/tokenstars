@extends('layouts.promo.cabinet_layout')
@section('title', trans('meta.title') . ' — Password reset')

@section('content')
    <form method="post" action="{{ route('password.email') }}" class="cabinet-form">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        {{ csrf_field() }}
        <span class="cabinet__title">Reset password</span>

        <div class="cabinet-form-line">
            <span class="cabinet-form__field">Email</span>
            <input type="email" name="email" class="input" required />
            @if ($errors->has('email'))
                <p class="st-red">{{$errors->first('email') }}</p>
            @endif
        </div>

        <div class="cabinet-form-footer">
            <input type="submit" value="Send Password Reset Link" class="button" onclick="ga('send', 'event', 'recover_page', 'recover');" />

            @guest
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            @else
                <p><a href="{{ route('portfolio') }}">Portfolio</a></p>
            @endguest
        </div>
    </form>
@endsection
