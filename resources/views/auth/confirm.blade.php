@extends('layouts.promo.cabinet_layout')
@section('title', 'Tokenstars — Login')

@section('content')
    <form method="post" action="{{ route('auth.loginCheck') }}" class="cabinet-form">
        {{ csrf_field() }}
        <span class="cabinet__title" style="text-align:center;height: 200px;">Registration confirmed</span>

        <div class="cabinet-form-footer">
            @guest
            <p><a href="{{ route('login') }}">Sign In</a></p>
            @else
            <p><a href="{{ route('portfolio') }}">Portfolio</a></p>
            @endguest

        </div>
    </form>
@endsection
