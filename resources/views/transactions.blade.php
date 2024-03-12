@extends('layouts.master')

@section('content')
    @include('partials.header')
    <h1>Transactions</h1>

    {{-- Debugging --}}
    {{ dd($transactions) }}

    {{-- ... rest of your content --}}
@endsection
