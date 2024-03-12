<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>
    {{-- <link rel="stylesheet" href="/styles.css"> --}}
    <link rel="stylesheet" href="{{URL::to('styles.css')}}">
    <link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
</head>

<body>
    @include('partials.header')
    <main class="container">
        @yield('content')
    </main>
</body>

</html>
