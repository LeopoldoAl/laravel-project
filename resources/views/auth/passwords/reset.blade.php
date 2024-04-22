@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login/css//reset.css') }}">
@endsection
@section('content')

<form method="POST" class="form" action="{{ route('password.update') }}">
    @csrf
    
    <input type="hidden" name="token" value="{{ $token }}">

    <h2 class="reset-title">Create password</h2>

    <div class="content-reset">
        <input class="form-email" id="email" type="email" name="email" placeholder="Write your email" 
        value="{{ $email ?? old('email') }}" required>

        @error('email')
        <span class="text-danger">
            *{{ $message }}
        </span>
        @enderror
    </div>

    <div class="content-reset">
        <input class="form-password" id="password" type="password" name="password" placeholder="Write your new password" required>

        @error('password')
        <span class="text-danger">
            *{{ $message }}
        </span>
        @enderror
    </div>

    <div class="content-reset">
        <input class="form-password-confirm" id="password-confirm" type="password" name="password_confirmation"  placeholder="Confirm the password" required>
    </div>

    <input type="submit" value="Submit" class="button send">

</form>

@endsection