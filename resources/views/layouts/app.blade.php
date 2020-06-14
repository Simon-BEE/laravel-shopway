<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta-desc')

    <title>{{ config('app.name', 'Laravel') }} &bull; @yield('meta-title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css" integrity="sha256-nwNjrH7J9zS/Ti4twtWX7OsC5QdQHCIKTv5cLMsGo68=" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('extra-css')
</head>
<body class="bg-white min-h-screen antialiased leading-none font-perso relative"  x-data="{ 'isDialogOpen': false }">
    <!--Nav-->
    <x-includes.header />


    @yield('modal')

    <!--Main content-->
    <main class="relative">
        @if (session()->has('type'))
            <x-alert type="{{ session('type') }}">{{ session()->has('message') ? session('message') : '' }}</x-alert>
        @endif

        @yield('content')
    </main>

    <!--Footer-->
    <x-includes.footer />
    @yield('extra-js')
</body>
</html>
