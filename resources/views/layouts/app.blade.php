<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Yummi - @yield('title')</title>

    @include('shared.head.bootstrap')
    @include('shared.head.fontawesome')

    @stack('scripts')

    {{-- app.js --}}
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- app.css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        @include('shared.nav')
    </header>

    <x-alerts class="container my-4" />

    <main class="container py-4 shadow-sm">
        @yield('content')
    </main>

    <footer class="py-4 border-top">
        @include('shared.footer')
    </footer>
</body>
</html>
