@extends('layouts.base')
@section('styles')  <!-- @yield('styles') -->
<link rel="stylesheet" href="{{ asset('css/login/css/login.css') }}">
@endsection

@section('title', 'Create account')  <!--<title>@yield('title')</title> -->

@section('content') <!-- @yield('content') -->

<form method="POST" class="form" action="{{ route('register') }}" novalidate>
    @csrf
    <h2>Create account</h2>
    <div class="content-login">
        <div class="input-content">
            <input type="text" name="full_name" placeholder="Full name"
                value="{{ old('full_name') }}" 
                autofocus>

            @error('full_name')
            <span class="text-danger">
                <span>* {{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="text" name="email" placeholder="Email"
                value="{{ old('email') }}" 
                autofocus>

            @error('email')
            <span class="text-danger">
                <span>* {{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="password" name="password" placeholder="Password">

            @error('password')
            <span class="text-danger">
                <span>* {{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="password" name="password_confirmation" placeholder="Confirm password">
        </div>
    </div>

    <input type="submit" value="Register" class="button">
    <p>You have an account? <a href="{{ route('login') }}" class="link">Log in</a></p>
</form>
@endsection
