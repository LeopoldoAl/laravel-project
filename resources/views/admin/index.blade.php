@extends('adminlte::page')

@section('title', 'Administration panel')

@section('content_header')
    <h1>Welcome to the administration panel</h1>
@stop

@section('content')
    <p>Hello! {{ Auth::user()->full_name }} from in here you can administer your articles
        , categories and commentaries.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop