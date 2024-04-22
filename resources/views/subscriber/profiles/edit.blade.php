@extends('layouts.base')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user/profiles/css/style_profile.css') }}">
@endsection

@section('title', 'Edit profile')

@section('content')
<div class="btn-article">
    <a href="{{ route('home.index') }}" class="btn-new-article">⬅</a>
</div>

<div class="main-content">
    <div class="title-page-admin">
        <h2>Edit profile</h2>
    </div>
    <form method="POST" action="{{ route('profiles.update', $profile) }}" enctype="multipart/form-data"
        class="form-article">
        @csrf 
        @method('PUT')
        <div class="content-create-article">

            <div class="input-content">
                <label for="name">Full name:</label>
                <input type="text" name="full_name" placeholder="Write your name"
                    value="{{ $profile->user->full_name }}" autofocus>

                @error('full_name')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Email" 
                value="{{ $profile->user->email }}" autofocus>
                
                @error('email')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="image">Profile photo</label> <br>
                <input type="file" id="photo" accept="image/*" name="photo" class="form-input-file">

                @if($profile->photo)
                <label>Current photo</label>
                <div class="img-article">
                    <img src="{{ asset('storage/'.$profile->photo) }}" class="img">
                </div>


                @error('photo')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
                @endif
            </div>

            <div class="input-content">
                <label for="profession">Profession</label>
                <input type="text" name="profession" placeholder="Profession" 
                value="{{ $profile->profession }}">
                
                @error('profession')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="about">About me</label>
                <textarea name='about' placeholder="About me">{{ $profile->about }}</textarea>
                
                @error('about')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            
            </div>

            <div class="input-content">
                <label for="facebook">Facebook</label>
                <input type="text" name="facebook" placeholder="Facebook" 
                value="{{ $profile->facebook }}">
                
                @error('facebook')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>
            <div class="input-content">
                <label for="twitter">Twitter</label>
                <input type="text" name="twitter" placeholder="Twitter" 
                value="{{ $profile->twitter }}">
                
                @error('twitter')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>
            <div class="input-content">
                <label for="linkedin">Linkedin</label>
                <input type="text" name="linkedin" placeholder="Linkedin" 
                value="{{ $profile->linkedin }}">
                
                @error('linkedin')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>
            <input type="submit" value="Edit profile" class="button">
    </form>
</div>
@endsection