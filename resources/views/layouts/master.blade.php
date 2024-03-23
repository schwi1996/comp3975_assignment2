<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    @stack('styles')
    {{-- <link rel="stylesheet" href="{{ URL::to('styles.css') }}"> --}}
    <link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }
        .content {
            flex: 1;
        }
        .footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e7e7e7;
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('partials.header')
        <main class="container content">
            @yield('content')
        </main>
        <footer class="footer mt-auto py-3">
            <div class="container">
                <div class="footer-content">
                    <span class="text-muted">Sungmok Cho (A01320382)</span>
                    <span class="text-muted">Helen Liu (A01320382)</span>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>