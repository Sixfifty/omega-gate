@extends('layouts.default')
@section('content')
    <div class="container text-center">
        <h1>Omega Gate</h1>
        <p><a href="{{ route('auth.login') }}">Login</a> or <a href="{{ route('auth.register') }}">Register</a></p>
    </div>
@stop