@extends('layouts.master')

@section('title', 'Welcome to Our Website')

{{-- Content section --}}
@section('content')
    <div class="text-center">
        <h1>Welcome to Our Website</h1>
        <p>Please select an option below:</p>
        <div class="btn-group" role="group">
            <a href="{{ route('login') }}" class="btn btn-success">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </div>
    </div>
@endsection