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

    {{-- Bootbox.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" integrity="sha512-8vfyGnaOX2EeMypNMptU+MwwK206Jk1I/tMQV4NkhOz+W8glENoMhGyU6n/6VgQUhQcJH8NqQgHhMtZjJJBv3A==" crossorigin="anonymous"></script>

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

    <main class="container my-4">
        @yield('content')
    </main>

    @include('shared.footer')
</body>
</html>
