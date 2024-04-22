@extends('layouts.base') <!-- We extend from the base layout -->
@section('styles')  <!-- @yield('styles') -->
<link rel="stylesheet" href="{{ asset('css/login/css/login.css') }}">
@endsection

@section('title', 'Ingress')  <!--<title>@yield('title')</title> -->

@section('content') <!-- @yield('content') -->

<form method="POST" class="form" action="{{ route('login') }}">
    @csrf
    <h2>Log in</h2>
    <div class="content-login">
        <div class="input-content">
            <input type="text" name="email" placeholder="Email" 
            value="{{ old('email') }}" autofocus>

            @error('email')
            <span class="text-danger">
                <span>* {{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="password" name="password" placeholder="Password" value="">

             @error('password')
            <span class="text-danger">
                <span>* {{ $message }}</span>
            </span>
            @enderror

        </div>
    </div>

    <a href="{{ route('password.request') }}" class="password-reset">Forgot your password!</a>

    <input type="submit" value="Log in" class="button">
</form>

<p>Don't you have an account? <a href="{{ route('register') }}" class="link">Create account</a></p>
@endsection
